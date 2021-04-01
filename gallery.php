
<!-- använd denna för att göra bildgrejen i labb 5: https://www.youtube.com/watch?v=1X2-UEUqrd8 -->

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


    <form method="POST" action="">
    <input type="submit" value="Upload random picture!" name="img" />
    </br>
    </br>

    <?php
    //uploaded image
        $db = mysqli_connect('localhost', 'root', 'root', 'db_books') or die('Error connecting');
       
        $query ="SELECT * FROM upload";
        $stmt = $db->prepare($query);
        $stmt->bind_result($id, $image);
        $stmt->execute();

        while ($stmt->fetch()) {
            echo '<img height=300px src=uploads/' .$image . '>';
        }

       ?>    

<?php

if (isset($_POST['img'])) {

    $fileNameNew = uniqid('', true).".jpg"; //lägger bild i lokal mapp med .jpg i filnamn
    //lägger bild lokalt på datorn
    copy('https://picsum.photos/200/300', ($fileDestination = 'uploads/' .$fileNameNew));

          $query = "INSERT INTO upload(image) VALUES('$fileNameNew')"; //this part uploads the picture to database
          $res = mysqli_query ($db, $query);
          if($res) {
             move_uploaded_file($fileTmpName, $fileDestination);

             //header("location:gallery.php"); 
          }
 }
?>
    
  


       
       </div>

</body>

</html>
