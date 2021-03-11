<?php 
include('config.php');
session_start();
?>

<!doctype html>
<html>
<head>
    <meta charset="utf8">
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <?php include('templates/nav.php');?>
    <?php 
    session_start();
    if (!isset($_SESSION['loginstatus']) || ($_SESSION['usertype'] != 2)) {
        header("location:index.php"); 
    die(); 
  }
    ?>

    <div class="c-container">
        <div class="c-left">

            <ul>
                <li class="l-browse">


            
        </div>


        <div class="c-right">
            <div class="c-search">
            
            </div>  

            
            <div class="t-big2">
                <h2>User</h2>
                <a href="logout.php">Log out</a>
            </div>
        </div>
    </div>

</body>




<footer>
    <?php include('templates/footer.php');?>
</footer>

</html>
