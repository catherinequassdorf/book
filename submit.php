<!-- boken: vid refresh på denna sida i html läggs nedanstående query till i datbasen, tabell "books" -->

<html>
<head>
<title>Adding a book!</title>
</head>

<body>
<h2>You submitted a book!</h2>

<?php


$title = $_POST['title'];
$isbn = $_POST['isbn'];


$db = mysqli_connect('localhost', 'root', 'root', 'db_books') or die('Error connecting');

$query = "INSERT INTO books (bookID, title, isbn, onloan) " . 
"VALUES ('BOOK', '$title', '$isbn', 0)";

$result = mysqli_query ($db, $query)
    or die('Error querying database.');

mysqli_close($db);

    echo 'You added ' . $title . ' which has the ISBN-code ' . $isbn;

?>
<br/>
<a href="/browse.php">Go back to "Browse books"</a>
