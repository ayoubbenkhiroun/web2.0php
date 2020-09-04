<?php

/* Paramètres BD locaux */
define('DB_HOST', 'localhost');
define('DB_USER', 'programmer');
define('DB_PASSWORD', 'programmer++');
define('DB_NAME', 'web_programming');



// Ouverture de la base de données en localhost
$connection=@mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
$db = mysql_select_db(DB_NAME, $connection);
?>
