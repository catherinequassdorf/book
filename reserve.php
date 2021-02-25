<!-- boken: vid refresh på denna sida i html läggs nedanstående query till i datbasen, tabell "books" -->

<html>
<head>
<title>Reservation</title>
</head>

<body>
<h2>Your reservation!</h2>

<?php

$onloan = $_GET['onloan'];
$id = $_GET['id'];

$db = mysqli_connect('localhost', 'root', 'root', 'db_books') or die('Error connecting');

$query = "UPDATE books #ändringar i table
SET onloan = 1 #value of this column changes to 1 = reserverad
WHERE id = '{$id}' ";


//if($_GET){ //shows att GET är set till ngt och ej tom
   // echo "JA";
  // } 
   // if(!$_GET){
   // echo "NEJ";
  //  } 

$result = mysqli_query ($db, $query)
    or die('Error querying database.');

mysqli_close($db);

echo 'Reservation of book confirmed';


?>

<br/>
<a href="/browse.php">Go back to "Browse books"</a>
<br/>
<br/>
<a href="/mybooks.php">Go to "My books"</a>
