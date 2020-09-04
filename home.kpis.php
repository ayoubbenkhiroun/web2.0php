<?php

echo "<h1>Key Performance Indicators</h1>";

if(isset($_COOKIE["date_inf"])){
    $date_inf = $_COOKIE["date_inf"];
} else $date_inf = "2011-01-01";

if(isset($_COOKIE["date_sup"])){
    $date_sup = $_COOKIE["date_sup"];
} else $date_sup = "2011-07-01";



echo "<div style=\"float:left;width:100%;\">\n";
echo "Please select a semester to display:&nbsp;&nbsp;";

echo "<select id=\"semester_selector\" name=\"smester_selector\" onchange=\"change_semester('./?menu=$menu&submenu=$submenu');\">\n";

echo "<option value=\"\" date_inf=\"2011-01-01\" date_sup=\"2011-07-01\"";
if($date_inf=="2011-01-01" && $date_sup=="2011-07-01") echo " selected=\"selected\"";
echo ">Sem 1 - 2011</option>\n";


echo "<option value=\"\" date_inf=\"2011-07-01\" date_sup=\"2011-12-31\"";
if($date_inf=="2011-07-01" && $date_sup=="2011-12-31") echo " selected=\"selected\"";
echo ">Sem 2 - 2011</option>\n";

echo "<option value=\"\" date_inf=\"2012-01-01\" date_sup=\"2012-07-01\"";
if($date_inf=="2012-01-01" && $date_sup=="2012-07-01") echo " selected=\"selected\"";
echo ">Sem 1 - 2012</option>\n";

echo "<option value=\"\" date_inf=\"2012-07-01\" date_sup=\"2012-12-31\"";
if($date_inf=="2012-07-01" && $date_sup=="2012-12-31") echo " selected=\"selected\"";
echo ">Sem 2 - 2012</option>\n";

echo "</select>\n";
echo "</div>\n";

// Value of indicator labels
$label["1"] = "# of posted write-ups";
$label["2"] = "# of posted events";
$label["3"] = "# of posted files";

// Values of targets
$targets["1"] = "";
$targets["2"] = 13;
$targets["3"] = 2;

// Values of SQL statements
$sql["1"] = "SELECT count(*) FROM write_up WHERE post_date>='$date_inf' AND post_date<'$date_sup'";
$sql["2"] = "SELECT count(*) FROM event WHERE post_date>='$date_inf' AND post_date<'$date_sup'";
$sql["3"] = "SELECT count(*) FROM file WHERE post_date>='$date_inf' AND post_date<'$date_sup'";

echo "<table id=\"example_\" style=\"width:100%;\" class=\"display\">\n";
echo "<thead>\n";
echo "<tr>\n";
echo "<th>&nbsp;</th>\n";
echo "<th colspan=\"3\">Achievement</th>\n";
echo "<th>Target</th>\n";
echo "</tr>\n";
echo "</thead>\n";


echo "<tbody>\n";

foreach($sql as $i => $v){
    $res = mysql_query($v);
    $rec = mysql_fetch_row($res);
    if($targets[$i]!=0) {
        $per = $rec[0]/$targets[$i]*100;
        $per = number_format($per,1)."%";
    } else {
        $per = "NA";
    }
    echo "<tr>\n";
    echo "<td>$label[$i]</td>\n";
    echo "<td>$rec[0]</td>\n";
    echo "<td>$per</td>\n";
    echo "<td>";
    if($targets[$i]!=0){
        if($rec[0]>=$targets[$i]) echo "<image src=\"images/icons/status.png\" />\n";
        else echo "<image src=\"images/icons/status-busy.png\" />\n";
    } else echo "&nbsp;";
    echo "</td>\n";
    echo "<td>$targets[$i]</td>\n";
    echo "</tr>\n";
}

echo "</tbody>\n";
echo "</table>\n";
?>

<!--script type="text/javascript">
    $('#example_').dataTable();
</script-->
<?php

?>
