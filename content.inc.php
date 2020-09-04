<?php
echo "<div id=\"content\">\n";

if(!empty($login)){
    if($submenu=="") {
        if(file_exists($menu.".php")) include($menu.".php");
        else echo "This file does not exist";
    }
    else {
        if(file_exists($menu.".".$submenu.".php")) include($menu.".".$submenu.".php");
        else echo "This sub file does not exist";
    }
} else include("authentication.inc.php");

echo "</div>\n";
?>
