<?php

echo "<div style=\"width:60%;float:left;\">\n";

echo "<div style=\"width:96%;float:left;border-bottom:1px solid #CCC;padding:10px 2% 10px 2%;font-weight:bold;\">\n";

    echo "<div style=\"width:20%;float:left;\">\n";
    echo "Share: ";
    echo "</div>\n";

    echo "<div style=\"width:20%;float:left;\">\n";
    echo "<span style=\"cursor:pointer;\"
        onclick=\"$('#frame_to_fill').load('ajax_action.php?action=session_5');\">\n";
    echo "<div style=\"float:left;padding-right:4px;margin-top:-2px;\">\n";
    echo "<img src=\"images/icons/sticky-note--plus.png\" />\n";
    echo "</div>\n";
    echo "Write Up";
    echo "</span>\n";
    echo "</div>\n";

    echo "<div style=\"width:20%;float:left;\">\n";
    echo "<span style=\"cursor:pointer;\"
        onclick=\"$('#frame_to_fill').load('ajax_action.php?action=session_6');\">\n";
    echo "<div style=\"float:left;padding-right:4px;margin-top:-2px;\">\n";
    echo "<img src=\"images/icons/calendar--plus.png\" />\n";
    echo "</div>\n";
    echo "Event";
    echo "</span>\n";
    echo "</div>\n";

echo "</div>\n";

echo "<div id=\"frame_to_fill\" style=\"width:100%;float:left\"></div>\n";

echo "<div id=\"thread_content\" style=\"width:100%;float:left\">\n";

$item_id = array();
$item_date = array();
$item_time = array();
$item_type = array();

$q = "SELECT * FROM write_up ORDER BY id DESC;";
$res = mysql_query($q);

while($rec = mysql_fetch_assoc($res)){
    $item_id[] = $rec["id"];
    $item_date[] = $rec["post_date"];
    $item_time[] = $rec["post_time"];
    $item_type[] = "write_up";

}


$q = "SELECT * FROM event ORDER BY id DESC;";
$res = mysql_query($q);

while($rec = mysql_fetch_assoc($res)){
    $item_id[] = $rec["id"];
    $item_date[] = $rec["post_date"];
    $item_time[] = $rec["post_time"];
    $item_type[] = "event";

}

array_multisort($item_date, SORT_DESC, $item_time, SORT_DESC, $item_id, $item_type);

foreach($item_id as $key){
    if($item_type[$key]=="write_up") print_a_write_up_item($key);
    if($item_type[$key]=="event") print_an_event_item($key);
}


echo "</div>\n";


echo "</div>\n";
?>
