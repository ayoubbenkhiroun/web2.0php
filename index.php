<?php
session_cache_limiter('no-cache, must-revalidate');
session_cache_expire(360000000); // in minutes
session_start();

    echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
    echo "<html>\n";
    echo "<head>\n";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/page_setting.css\" />\n";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/demo_page.css\" />\n";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/demo_table.css\" />\n";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/demo_table_jui.css\" />\n";

    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/jquery-ui-1.8.16.custom.css\" />\n";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/jquery.ui.theme.css\" />\n";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/jquery.ui.datepicker.css\" />\n";

    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/calendar_sheet.css\" />\n";

    // Link to the jQuery Library
    echo "<script type=\"text/javascript\" src=\"jquery/jquery-1.4.4.min.js\"></script>\n";
    // Link to the data.table plug-in
    echo "<script type=\"text/javascript\" src=\"jquery/jquery.dataTables.min.js\"></script>\n";

    // Link to the jQuery Form Plug-in
    echo "<script type=\"text/javascript\" src=\"jquery/jquery.form.js\"></script>\n";

    // Link to the jQuery Time Stamp Plug-in
    echo "<script type=\"text/javascript\" src=\"jquery/jquery.timeago.js\"></script>\n";

    // Link to the jQuery datepicker
    echo "<script type=\"text/javascript\" src=\"jquery/jquery-ui-1.8.6.custom.min.js\"></script>\n";
    echo "<script type=\"text/javascript\" src=\"jquery/jquery.ui.datepicker.min.js\"></script>\n";

    // Link to costum jQuery functions
    echo "<script type=\"text/javascript\" src=\"jquery/functions.js\"></script>\n";

    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n";
    echo "<title>Web 2.0 Programming Workshop</title>\n";
    echo "</head>\n";
    echo "<body>\n";
    include("variables/config.inc.php");
    include("php_functions/functions.php");

    if(isset($_GET["disconnect"])){
        unset($_SESSION);
        $_SESSION = array();
        session_destroy();
    }

    if(isset($_POST["auth_submit"])){
        $username = $_POST["username"];
        $userpass = $_POST["userpass"];
        if(!empty($username) && !empty($userpass)){
        $q = "SELECT * FROM user WHERE login='".$username."' AND password='".$userpass."';";
        $r = @mysql_query($q, $connection);
        // Si l'utilisateur existe
        if(mysql_num_rows($r)==1){

            $_SESSION = mysql_fetch_assoc($r);
        }


        }
    }

    if(isset($_SESSION["login"])) $login=$_SESSION["login"]; else $login="";

    if(isset($_GET["menu"])) $menu = $_GET["menu"]; else $menu = "home";
    if(isset($_GET["submenu"])) $submenu = $_GET["submenu"]; else $submenu = "";
    if(isset($_GET["id"])) $id = $_GET["id"]; else $id = "";



    include("header.inc.php");
    include("menu.inc.php");
    include("submenu.inc.php");
    include("content.inc.php");
    

    echo "</body>\n";
    echo "</html>";
?>