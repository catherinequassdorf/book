<?php 

// https://www.youtube.com/watch?v=_30-z26baEo
// https://www.youtube.com/watch?v=JaRq73y5MJk

$db = mysqli_connect('localhost', 'root', 'root', 'db_books') or die('Error connecting');

if (isset($_POST['upload'])) { // check if button is pressed, if we click the button it runs the code within this
   $file = $_FILES['image']['name']; //_FILES is a superglobal which means that we wanna upload || $file is a variable || name = file since the forms name is file

   $fileTmpName = $_FILES['image']['tmp_name'];
   $fileSize = $_FILES['image']['size'];
   $fileError = $_FILES['image']['error'];   
   $fileType = $files['image']['type'];

   $fileExt = explode('.', $file); //name = equal to the file, we want to exploit the e.g. ".jpg"
   $fileActualExt = strtolower(end($fileExt)); //including JPG and jpg (lowecase and uppercase), END grabs out the "name" in array

   $allowed = array('jpg', 'jpeg', 'png', 'pdf');

   if (in_array($fileActualExt, $allowed)) {
      if ($fileError === 0) {
         if (fileSize < 2) {

            // uploading locally on computer
         $fileNameNew = uniqid('', true).".".$fileActualExt; //so that images with same double in local folder?????
           $fileDestination = 'uploads/' .$fileNameNew; 

            $query = "INSERT INTO upload(image) VALUES('$fileNameNew')"; //this part uploads the picture to database
            $res = mysqli_query ($db, $query);
            if($res) {
               move_uploaded_file($fileTmpName, $fileDestination);

               header("location:gallery.php"); 
            }

         } else {
            echo "Your file is too big!";
         }
      } else {
         echo "There was an error uploading your file!";
      }
   } else {
      echo "You cannot upload files of this type!";
   }

   //print_r($file); // this creates an array

}
?>