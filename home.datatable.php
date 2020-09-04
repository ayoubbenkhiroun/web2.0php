<?php

echo "<h2>Interactive data table</h2>\n";

if(empty($id)){
    echo "<table id=\"example_\" style=\"width:100%;\" class=\"display\">\n";

    echo "<thead>\n";
    echo "<tr>\n";
    echo "<th>ID</th>\n";
    echo "<th>Actions</th>\n";
    echo "<th>Name</th>\n";
    echo "<th>Level</th>\n";
    echo "</tr>\n";
    echo "</thead>\n";

    echo "<tbody>\n";

    $sql = "SELECT id, level_id, name FROM parcours";
    $res = mysql_query($sql);
    $i= 1;
    while($rec = mysql_fetch_assoc($res)){
        echo "<tr>\n";
        echo "<td>".$i."</td>\n";
        echo "<td><a href=\"\">Edit</a></td>\n";
        echo "<td><a href=\"./?menu=$menu&submenu=$submenu&id=".$rec["id"]."\">".$rec["name"]."</a></td>\n";
        echo "<td>".$rec["level_id"]."</td>\n";
        echo "</tr>\n";
        $i++;
    }

    echo "</tbody>\n";
    echo "</table>\n";
?>
<script type="text/javascript">
    $('#example_').dataTable();
</script>
<?php

} else {
    $sql = "SELECT * FROM parcours WHERE id='$id'";
    $res = mysql_query($sql);
    $rec = mysql_fetch_assoc($res);

    echo "<h3>".$rec["name"]."</h3>";

    echo "<h3>Objectives</h3>";
    echo $rec["objective"];

    echo "<h3>Perspectives</h3>";
    echo $rec["perspective"];
}
?>

