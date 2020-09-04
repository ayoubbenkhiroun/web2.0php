<?php
echo "<form method=\"post\" id=\"login_form\" name=\"login_form\" action=\"./\">\n";

echo "<div class=\"input_div\">\n";
    echo "<div class=\"input_label\">\n";
    echo "User Name: \n";
    echo "</div>\n";

    echo "<div class=\"input_item\">\n";
    echo "<input id=\"username\" name=\"username\" type=\"text\" />\n";
echo "</div>\n";
echo "</div>\n";


echo "<div class=\"input_div\">\n";
    echo "<div class=\"input_label\">\n";
    echo "Password: ";
    echo "</div>\n";

    echo "<div class=\"input_item\">\n";
    echo "<input id=\"userpass\" name=\"userpass\" type=\"password\" />\n";
    echo "</div>\n";
echo "</div>\n";

echo "<div class=\"input_div\">\n";
    echo "<div class=\"input_label\">\n";
    echo "</div>\n";

    echo "<div class=\"input_item\">\n";
    echo "<input type=\"submit\" id=\"auth_submit\" name=\"auth_submit\" value=\"Log In\" />\n";
    echo "</div>\n";
echo "</div>\n";
echo "</form>\n";
?>
