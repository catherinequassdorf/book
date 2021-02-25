<?php
$currentPage = basename($_SERVER['PHP_SELF']);
// echo $currentPage; //

$current_page = explode('/', $_SERVER['REQUEST_URI']);
$current_page = end($current_page);

$host = "localhost";
$databdase = "db_books";
$user = "root";
$password = "root";

//hugo12345 är mysql lösen men root är det som funkar//

session_start();

?>