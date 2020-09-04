<?php

function print_a_write_up_item($post_id){
    $q = "SELECT * FROM write_up WHERE id='$post_id'";
    $res = mysql_query($q);
    $rec = mysql_fetch_assoc($res);
    echo "<div class=\"write_up_frame\">\n";
    $sqluser = "SELECT firstname, lastname, pic_file FROM user WHERE id='".$rec["user_id"]."';";
    $resuser = mysql_query($sqluser);
    $recuser = mysql_fetch_assoc($resuser);

    echo "<div class=\"write_up_thumbnail\">\n";
    echo "<img src=\"images/users/".$recuser["pic_file"]."\" />\n";
    echo "</div>\n";

    echo "<div class=\"write_up_body\">\n";

    echo "<div class=\"write_up_author\">".$recuser["firstname"]." ".$recuser["lastname"]."</div>\n";

    echo nl2br( $rec["value"] );

    echo "<abbr class=\"timeago\" title=\"".$rec["post_date"]."T".$rec["post_time"]."Z\">".$rec["post_date"]." at ".$rec["post_time"]."</abbr>\n";

    echo "</div>\n";
    echo "</div>\n";

    echo "<script type=\"text/javascript\">\n";
    echo "jQuery('abbr.timeago').timeago();\n";
    echo "</script>\n";
}


function print_an_event_item($post_id){
    $q = "SELECT * FROM event WHERE id='$post_id'";
    $res = mysql_query($q);
    $rec = mysql_fetch_assoc($res);
    echo "<div class=\"write_up_frame\">\n";
    $sqluser = "SELECT firstname, lastname, pic_file FROM user WHERE id='".$rec["user_id"]."';";
    $resuser = mysql_query($sqluser);
    $recuser = mysql_fetch_assoc($resuser);

    echo "<div class=\"write_up_thumbnail\">\n";
    echo "<img src=\"images/users/".$recuser["pic_file"]."\" />\n";
    echo "</div>\n";

    echo "<div class=\"write_up_body\">\n";

    echo "<div class=\"write_up_author\">".$recuser["firstname"]." ".$recuser["lastname"]."</div>\n";

    echo "<div style=\"width:10%;float:left;\">\n";
    echo print_calendar_sheet($rec["event_date"]);
    echo "</div>\n";

    echo "<div style=\"width:90%;float:left;\">\n";
    echo "<div style=\"width:100%;float:left;\"><strong>When: </strong>". $rec["event_time"]."</div>\n";
    echo "<div style=\"width:100%;float:left;\"><strong>Where: </strong>". $rec["event_location"]."</div>\n";

    echo "<p>".nl2br( $rec["event_description"] )."</p>";
    echo "</div>\n";

    echo "<abbr class=\"timeago\" title=\"".$rec["post_date"]."T".$rec["post_time"]."Z\">".$rec["post_date"]." at ".$rec["post_time"]."</abbr>\n";

    echo "</div>\n";
    echo "</div>\n";

    echo "<script type=\"text/javascript\">\n";
    echo "jQuery('abbr.timeago').timeago();\n";
    echo "</script>\n";

}

function print_a_file_item($file_id){
    $q = "SELECT * FROM file WHERE id='$file_id'";
    $res = mysql_query($q);
    $rec = mysql_fetch_assoc($res);
    echo "<div class=\"write_up_frame\">\n";
    $sqluser = "SELECT firstname, lastname, pic_file FROM user WHERE id='".$rec["user_id"]."';";
    $resuser = mysql_query($sqluser);
    $recuser = mysql_fetch_assoc($resuser);

    echo "<div class=\"write_up_thumbnail\">\n";
    echo "<img src=\"images/users/".$recuser["pic_file"]."\" />\n";
    echo "</div>\n";

    echo "<div class=\"write_up_body\">\n";

    echo "<div class=\"write_up_author\">".$recuser["firstname"]." ".$recuser["lastname"]."</div>\n";

    echo "<div style=\"width:100%;float:left;\">\n";

    echo "<a href=\"".$rec["folder"]."/".$rec["name"].".".$rec["extension"]."\">";

    
    $icon_file = "images/icons/mimetypes/".$rec["extension"]."_icon.png";

    if(!file_exists($icon_file)) $icon_file = "images/icons/mimetypes/unknown_icon.png";

    echo "<div style=\"float:left;width:20px;\">\n";
    echo "<img src=\"$icon_file\" />";
    echo "</div>\n";



    echo "<div style=\"float:left;\">\n";
    //echo $rec["name"].".".$rec["extension"];
    echo $rec["name"];
    echo "</div>\n";

    echo "</a>\n";

    echo "</div>\n";

    echo "<div style=\"width:100%;float:left;margin-top:5px;\">\n";
    echo nl2br( $rec["description"] );
    echo "</div>\n";

    echo "<abbr class=\"timeago\" title=\"".$rec["post_date"]."T".$rec["post_time"]."Z\">".$rec["post_date"]." at ".$rec["post_time"]."</abbr>\n";

    echo "</div>\n";
    echo "</div>\n";

    echo "<script type=\"text/javascript\">\n";
    echo "jQuery('abbr.timeago').timeago();\n";
    echo "</script>\n";

}


function transform_clean_text(& $value){
           $value = utf8_decode($value);
           $value = mysql_escape_string($value);
           $value = strip_tags($value,"<strong>");
           $value = trim($value);
 
}


// Fonction qui permet d'afficher une feuille du calendrier correspondant à un jour ($date) de l'année
function print_calendar_sheet($date, $color="orange"){
    format_date_for_calendar_sheet($date, $year, $month, $day);
    $str="<div class=\"calendar_sheet\">\n";
    $str.="<div class=\"calendar_sheet_".$color."_head\">\n";
    $str.=$month." ".$year;
    $str.="</div>\n";
    $str.="<div class=\"calendar_sheet_body\">\n";
    $str.=$day;

    $jour_ = array("Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam");

    // Récupération des valeurs numérique du mois ($m), du jour ($d) et de l'année ($y)
    list($y, $m, $d) = sscanf($date, "%d-%d-%d");
    // Calcul du nombre de seconde de la date d'origine UNIX
    $timestamp = mktime(0, 0, 0, intval($m), intval($d), intval($y));
    // Trouver le numéro du jour de la semaine
    $wd = date("w", $timestamp);
    // Recherche de l'abréviation du jour correspondant
    $str_dat = $jour_[$wd];
    $str.="<div class=\"day_of_week\">".$str_dat."</div>";
    $str.="</div>\n";
    $str.="</div>\n";
    return $str;
}


// Fonction qui permet de retourner à partir d'une date $str
// l'année ($year), le mois ($month) et le jour ($day) de l'année

function format_date_for_calendar_sheet($str, & $year, & $month, & $day){
    if($str!=""){
        list($year, $m, $day) = sscanf($str, "%d-%d-%d");
        if(strlen($year)>2) $year = substr($year,2,2);
        $month = return_abrv_month_name($m);
    }
}

// Fonction qui permet de retourner - en français - l'abréviation du mois $m
	function return_abrv_month_name($m){
		$month="";
		switch($m) {
			case "1" : $month = "Jan"; break;
			case "2" : $month = "Fév"; break;
			case "3" : $month = "Mar"; break;
			case "4" : $month = "Avr"; break;
			case "5" : $month = "Mai"; break;
			case "6" : $month = "Jun"; break;
			case "7" : $month = "Jul"; break;
			case "8" : $month = "Aoû"; break;
			case "9" : $month = "Sep"; break;
			case "10" : $month = "Oct"; break;
			case "11" : $month = "Nov"; break;
			case "12" : $month = "Déc"; break;
		}
		return $month;
	}


?>
