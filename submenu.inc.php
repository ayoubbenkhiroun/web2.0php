<?php
echo "<div id=\"submenu\">\n";

if(!empty($login)){

    $sql_ = "SELECT id, label FROM submenu WHERE status='1' AND menu_id='$menu' ORDER BY ord ASC;";
    $res = mysql_query($sql_);
    while($rec = mysql_fetch_assoc($res)){
        echo "<a class=\"submenu_item\" href=\"./?menu=$menu&submenu=".$rec["id"]."\">\n";
        echo $rec["label"];
        echo "</a>\n";
    }
}

echo "<div style=\"width:100%;float:left;padding-top:20px;text-align:center;\">\n";
    echo "<img src=\"images/logo-isic.png\" alt=\"\" title=\"\" />\n";
    echo "</div>\n";

echo "</div>\n";
?>
