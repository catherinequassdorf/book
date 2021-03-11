
<?php 
include('config.php');
?>

<!doctype html>
<html>
<head>
    <meta charset="utf8">
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <?php include('templates/nav.php');?>

    <div class="c-container">

    <?php
        $db = mysqli_connect('localhost', 'root', 'root', 'db_books') or die('Error connecting');
       
        $query ="SELECT * FROM upload";
        $stmt = $db->prepare($query);
        $stmt->bind_result($id, $image);
        $stmt->execute();

        while ($stmt->fetch()) {
            echo '<img width=250px src=uploads/' .$image . '>';
        }

       ?>      
       
       </div>

</body>




<footer>
    <?php include('templates/footer.php');?>
</footer>

</html>
