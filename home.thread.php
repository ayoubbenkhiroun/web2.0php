<?php

echo "<div style=\"width:60%;float:left;\">\n";

echo "<div style=\"width:96%;float:left;border-bottom:1px solid #CCC;padding:10px 2% 10px 2%;font-weight:bold;\">\n";

    echo "<div style=\"width:20%;float:left;\">\n";
    echo "Share: ";
    echo "</div>\n";

    echo "<div style=\"width:20%;float:left;\">\n";
    echo "<span style=\"cursor:pointer;\"
        onclick=\"$('#frame_to_fill').load('ajax_action.php?action=session_5');\">\n";
    echo "Write Up";
    echo "</span>\n";
    echo "</div>\n";

echo "</div>\n";

echo "<div id=\"frame_to_fill\" style=\"width:100%;float:left\"></div>\n";

echo "<div id=\"thread_content\" style=\"width:100%;float:left\">\n";

$q = "SELECT * FROM write_up ORDER BY id DESC;";
$res = mysql_query($q);

while($rec = mysql_fetch_assoc($res)){
    print_a_write_up_item($rec["id"]);
}

echo "</div>\n";


echo "</div>\n";
?>
