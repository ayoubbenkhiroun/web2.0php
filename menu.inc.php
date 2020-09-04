<?php

echo "<div id=\"menu\">\n";

if(!empty($login)){

    $sql_string = "SELECT id, label FROM menu WHERE status='1' ORDER BY ord ASC;";
    $res = mysql_query($sql_string);
    while($rec = mysql_fetch_assoc($res)){
        echo "<a class=\"menu_item\" href=\"./?menu=".$rec["id"]."\">\n";
        echo $rec["label"];
        echo "</a>\n";
    }
    echo "<a class=\"menu_item\" href=\"./?disconnect\">\n";
    echo "Log Out";
    echo "</a>\n";


}


echo "</div>\n";
?>

