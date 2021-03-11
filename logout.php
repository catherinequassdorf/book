hejhej logout

<?php
include("config.php");

// # Open the database
//   @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname); //opens database from config
//     if ($db->connect_error) {			//no connection
//       echo "could not connect: " . $db->connect_error; //display message
//       printf("<br><a href=index.php>Return to home page </a>"); //link to startpage
//       die();
//     }

session_start();
$_SESSION = array();

session_destroy();

header('location:index.php')

?>
