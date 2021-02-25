<!-- boken: vid refresh på denna sida i html läggs nedanstående query till i datbasen, tabell "books" -->

<html>
<head>
<title>Return of books</title>
</head>

<body>
<h2>Return of book!</h2>

<?php

$onloan = $_GET['onloan'];
$id = $_GET['id'];

$db = mysqli_connect('localhost', 'root', 'root', 'db_books') or die('Error connecting');

$query = "UPDATE books #ändringar i table
SET onloan = 0 #value of this column changes to 0 (not reserved anymore)
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

echo 'Return of book confirmed';


?>

<br/>
<a href="/mybooks.php">Go back to "My books"</a>
<br/>
<br/>
<a href="/browse.php">Go to "Browse books"</a>

