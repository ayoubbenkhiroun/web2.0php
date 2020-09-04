<?php
session_start();

include("variables/config.inc.php");
include("php_functions/functions.php");

// Date et heure en cours

$da = getdate();
$today = $da["year"]."-".$da["mon"]."-".$da["mday"];
$now = date('H:i:s');


if(isset($_GET["action"])) $action = $_GET["action"]; else $action = "";


switch($action){
    case  "test" :
        echo "<h2>User full name: ";
        $sql = "SELECT * FROM user WHERE id='".$_SESSION["id"]."'";
        $res = @mysql_query($sql, $connection);
        $rec = mysql_fetch_assoc($res);
        echo $rec["firstname"]." ".$rec["lastname"]."</h2>\n";
        break;

    case "session_5":
        
        $sql = "SELECT id FROM write_up ORDER BY id DESC;";
        $res = mysql_query($sql);
        $rec = mysql_fetch_assoc($res);
        $post_id = $rec["id"]+1;

        if(!isset($_POST["submit_post"])){
            echo "<form id=\"write_up_form\" style=\"width:96%;padding:10px 2% 10px 2%;\"
                action=\"ajax_action.php?action=session_5\" method=\"post\">\n";
            echo "<textarea name=\"write_up_value\" style=\"width:100%;\"></textarea>\n";
            echo "<div style=\"float:right;margin-top:10px;\">\n";
            echo "<input id=\"submit_post\" name=\"submit_post\" type=\"submit\" 
            value=\"Post\" onclick=\"submit_write_up('write_up_form','frame_to_fill','thread_content','$post_id');\" />\n";
            echo "</div>\n";
            echo "</form>\n";

        } else {

            $value = $_POST["write_up_value"];
            transform_clean_text($value);
            if(!empty($value)){

              $q_insert = "INSERT INTO write_up VALUES ('$post_id', '".$_SESSION["id"]."', '$value', '$today', '$now');";
              mysql_query($q_insert);
            }

        }
        break;

    case "print_a_write_up" :
        $post_id = $_GET["post_id"];
        print_a_write_up_item($post_id);
        break;


    case "session_6":

        $sql = "SELECT id FROM event ORDER BY id DESC;";
        $res = mysql_query($sql);
        $rec = mysql_fetch_assoc($res);
        $event_id = $rec["id"]+1;

        if(!isset($_POST["submit_event"])){
            echo "<form id=\"event_form\" style=\"width:96%;padding:10px 2% 10px 2%;\"
                action=\"ajax_action.php?action=session_6\" method=\"post\">\n";
            echo "<div style=\"width:100%;float:left;font-weight:bold;margin-bottom:10px;\">\n";
            echo "When : <input id=\"event_date\" name=\"event_date\" type=\"text\" style=\"width:120px;\" />\n";
            echo "&nbsp;&nbsp;Time : ";
            //<input id=\"event_time\" name=\"event_time\" type=\"text\" style=\"width:120px;\" />\n";
            $minutes = array("00","15","30","45");
            echo "<select id=\"event_time\" name=\"event_time\">\n";
            for($i=0; $i<24; $i++){
                foreach($minutes as $j){
                    echo "<option value=\"".$i.":".$j.":00\">".$i.":".$j."</option>\n";
                }
            }
            echo "</select>\n";
            echo "</div>\n";
            echo "<div style=\"width:100%;float:left;font-weight:bold;margin-bottom:10px;\">\n";
            echo "Location : <input id=\"event_location\" name=\"event_location\" type=\"text\" style=\"width:180px;\" />\n";
            echo "</div>\n";
            echo "<textarea id=\"event_description\" name=\"event_description\" style=\"width:100%;\"></textarea>\n";
            echo "<div style=\"float:right;margin-top:10px;\">\n";

            echo "<input id=\"submit_event\" name=\"submit_event\" type=\"submit\" value=\"Post\" onclick=\"submit_an_event('event_form','frame_to_fill','thread_content','$event_id');\" />\n";
            echo "</div>\n";
            echo "</form>\n";

            echo "<script type=\"text/javascript\">\n";
            echo "$('#event_date').datepicker({ dateFormat: 'yy-mm-dd' });\n";
            echo "</script>\n";

        } else {

            $event_date = $_POST["event_date"];
            $event_time = $_POST["event_time"];
            $event_location = $_POST["event_location"];
            $event_description = $_POST["event_description"];

            transform_clean_text($event_location);
            transform_clean_text($event_description);
            
            if(!empty($event_date) && !empty($event_time)){

              $q_insert = "INSERT INTO event VALUES ('$event_id', '".$_SESSION["id"]."', '$event_date', '$event_time', '$event_location', '$event_description', '$today', '$now');";
              mysql_query($q_insert);
            }


        }

        break;

    case "print_an_event":
            $event_id = $_GET["event_id"];
            print_an_event_item($event_id);

            break;

    case "session_7":
        $root = "./files/user_".$_SESSION["id"];
        if(!file_exists($root)) mkdir($root, 0775);

        $sql = "SELECT id FROM file ORDER BY id DESC;";
        $res = mysql_query($sql);
        $rec = mysql_fetch_assoc($res);
        $file_id = $rec["id"]+1;
        
        if(!isset($_POST["submit_file"])){
            echo "<form id=\"file_form\" name=\"file_form\" style=\"width:96%;padding:10px 2% 10px 2%;\"
                action=\"ajax_action.php?action=session_7\" method=\"post\" enctype=\"multipart/form-data\">\n";

            echo "<div style=\"width:100%;float:left;font-weight:bold;margin-bottom:10px;\">\n";
            echo "File : <input id=\"file_to_upload\" name=\"file_to_upload\" type=\"file\" style=\"width:120px;\" />\n";
            echo "</div>\n";

            echo "<textarea id=\"file_description\" name=\"file_description\" style=\"width:100%;\"></textarea>\n";

            echo "<div style=\"float:right;margin-top:10px;\">\n";
            echo "<input id=\"submit_file\" name=\"submit_file\" type=\"submit\" value=\"Post\"
            onclick=\"submit_a_file('file_form','frame_to_fill','thread_content','$file_id');\" />\n";
            echo "</div>\n";

            echo "</form>\n";
        } else {
            $file_description = $_POST["file_description"];
            transform_clean_text($file_description);


            if(!empty($_FILES["file_to_upload"]["tmp_name"])){

                $tempFile = $_FILES["file_to_upload"]["tmp_name"];

                $fileParts  = pathinfo($_FILES["file_to_upload"]["name"]);
                $file_name = utf8_decode($fileParts["filename"]);
                $file_extension = $fileParts["extension"];
                $file_size = $_FILES["file_to_upload"]["size"];

                $file_url = $root."/".$file_name.".".$file_extension;

                $upload_test = @move_uploaded_file($tempFile, $file_url);

                if($upload_test) {
                      $q_insert = "INSERT INTO file VALUES ('$file_id', '".$_SESSION["id"]."', '$root', '$file_name', '$file_extension', '$file_size', '$file_description', '$today', '$now');";
                      mysql_query($q_insert);
                }
            }
        }
            
            break;

      case "print_a_file":
            $file_id = $_GET["file_id"];
            print_a_file_item($file_id);

            break;
}



?>
