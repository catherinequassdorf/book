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

//if not logged in OR user account you cannot enter admin
session_start();

if (!isset($_SESSION['loginstatus']) || ($_SESSION['usertype'] != 1)) {
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
            
                <form  action="imgupload.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="image">
                <button type="submit" name="upload">UPLOAD</button>
</form>

            </div>  

            
            <div class="t-big2">
                <h2>Admin</h2>
                <a href="logout.php">Log out</a>
            </div>
        </div>
    </div>
    

</body>

<footer>
    <?php include('templates/footer.php');?>
</footer>

</html>

