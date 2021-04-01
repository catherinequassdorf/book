<?php include("config.php");
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
        <div class="c-left">

            <ul>
                <li class="l-browse">


                <?php include("nav.php")?>
    <h2>Login</h2>
    <?php


      // Always start this first
      session_start();
      
      if ( ! empty( $_POST ) ) {
          if ( isset( $_POST['username'] ) && isset( $_POST['userpw'] ) ) {
              // Getting submitted user data from database
            
                    # Open the database
                    $db = mysqli_connect('localhost', 'root', 'root', 'db_books') or die('Error connecting');
                    $stmt = $con->prepare("SELECT * FROM users WHERE username = '".$username."' AND " . "userpw = '".md5($userpw)."'");
                    $stmt->bind_param('s', $_POST['username']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $user = $result->fetch_object();
                  
              // Verify user password and set $_SESSION
              if ( userpw_verify( $_POST['userpw'], $username->userpw ) ) {
                $_SESSION['id'] = $row["id"]; //sets user ID for session
                $_SESSION['usertype'] = $row["usertype"]; //sets usertype for session
                $_SESSION['username'] = $username; //username is same as variable above
              }

              if ($row['usertype'] == '1') {
                header("location:admin.php");
            } else if ($row['usertype'] == '2') {
                header("location:user.php");
            }

          }
      }
      ?>


        </div>


        <div class="c-right">
            <div class="c-search">

            <form method="POST" action="">
						<label for="title">Username</label>
                        <input type="text" name="username" placeholder="Enter username" required /><br />
                        <label for="isbn">Password</label>
                        <input type="text" name="userpw" placeholder="Enter password" required />
                        <input type="submit" value="Submit" />
					</form>

            </div>  

            
            <div class="t-big2">
                <h2>Login</h2>
            </div>
        </div>
    </div>

</body>




<footer>
    <?php include('templates/footer.php');?>
</footer>

</html>

<!--- NÄSTA KOD --->

<?php include("config.php");
session_start(); //website remembers session information
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
        <div class="c-left">

            <ul>
                <li class="l-browse">


                <?php include("nav.php")?>
    <h2>Login</h2>
    <?php

      # Open the database
      $db = mysqli_connect('localhost', 'root', 'root', 'db_books') or die('Error connecting');


      if(isset($_POST['xss'])){
          $xss = $_POST['xss'];

          echo "THE XSS STRING IS: $xss";
      }

        if (isset($_POST) & !empty($_POST))  {
          $username = mysqli_real_escape_string($db, trim($_POST['username'])); //user cannot write code in the form, only text
          $userpw = mysqli_real_escape_string($db, trim($_POST['userpw'])); //user cannot write code in the form, only text

          $query = "SELECT username, userpw, usertype, id FROM users
					WHERE username = '".$username."' AND " . "userpw = '".md5($userpw)."'";
          $data = mysqli_query($db, $query);//prepares for execution


          if (mysqli_num_rows($data) == 1){ //returns number of rows present in the result set
						$row = mysqli_fetch_assoc($data);

						$_SESSION['id'] = $row["id"]; //sets user ID for session
						$_SESSION['username'] = $row["username"]; //sets usertype for session
						$_SESSION['usertype'] = $usertype; //username is same as variable above
						$_SESSION['loginstatus'] = true; //user is logged in
					//	$_SESSION['userip']=$_SERVER['REMOVE_ADDR']; //returns user IP address

				if ($row['usertype'] == '1') {
							header("location:admin.php");
						} else if ($row['usertype'] == '2') {
							header("location:user.php");
						}

          }

        }

		if (!isset($_SESSION['username'])){ ?>
    <div id="login">
        <form id="loginForm" name="login" method="POST">
          <p>Username</p>
          <input type="text" name="username">
          <p>Password</p>
          <input type="userpw" name="userpw">
          <input type="submit" value="Login">
			  </form>
      </div> 
      
      <?php
		}else{ ?>
					<a href="logout.php">Log out</a>
	<?php	
    }
?>

            
        </div>


        <div class="c-right">
            <div class="c-search">

            <form method="POST" action="login.php">
						<label for="title">Username</label>
                        <input type="text" id="title" name="title" /><br />
                        <label for="isbn">Password</label>
                        <input type="text" id="isbn" name="isbn" />
                        <input type="submit" value="Log in!" name="submit" />
					</form>

            </div>  

            
            <div class="t-big2">
                <h2>Login</h2>
            </div>
        </div>
    </div>

</body>




<footer>
    <?php include('templates/footer.php');?>
</footer>

</html>

<!--- NÄSTA KOD --->


<?php
require_once('config.php');
$db=$conn; // Enter your Connection variable;
$tableName='gallery_img'; // Enter your table Name;
// upload image on submit
if(isset($_POST['submit'])){ 
    echo upload_image($tableName); 
}
  function upload_image($tableName){
   
    $uploadTo = "uploads/"; 
    $allowedImageType = array('jpg','png','jpeg','gif');
    $imageName = array_filter($_FILES['image_gallery']['name']);
    $imageTempName=$_FILES["image_gallery"]["tmp_name"];
    $tableName= trim($tableName);
if(empty($imageName)){ 
   $error="Please Select Images..";
   return $error;
}else if(empty($tableName)){
   $error="You must declare table name";
   return $error;
}else{
   $error=$savedImageBasename='';
   foreach($imageName as $index=>$file){
         
    $imageBasename = basename($imageName[$index]);
    $imagePath = $uploadTo.$imageBasename; 
    $imageType = pathinfo($imagePath, PATHINFO_EXTENSION); 
 if(in_array($imageType, $allowedImageType)){ 
    // Upload image to server 
    if(move_uploaded_file($imageTempName[$index],$imagePath)){ 
        
    // Store image into database table
     $savedImageBasename .= "('".$imageBasename."'),";     
    }else{ 
     $error = 'File Not uploaded ! try again';
  } 
}else{
    $error .= $_FILES['file_name']['name'][$index].' - file extensions not allowed<br> ';
 }
 }
    save_image($savedImageBasename, $tableName);
}
    return $error;
}
    // File upload configuration 
 function save_image($savedImageBasename, $tableName){
      global $db;
      if(!empty($savedImageBasename))
      {
      $value = trim($savedImageBasename, ',');
      $saveImage="INSERT INTO ".$tableName." (image_name) VALUES".$value;
      $exec= $db->query($saveImage);
      if($exec){
        echo "Images are uploaded successfully";  
       }else{
        echo  "Error: " .  $saveImage . "<br>" . $db->error;
       }
      }
    }     
    
?>

<!--- NÄSTA KOD --->

<?php
require_once('config.php');
$db = mysqli_connect('localhost', 'root', 'root', 'db_books') or die('Error connecting'); // Enter your Connection variable;
$tableName='gallery_img'; // Enter your table Name;

// upload image on submit
if(isset($_POST['submit'])){ 
    echo upload_image($tableName); 
}
  function upload_image($tableName){
   
    $uploadTo = "uploads/"; 
    $allowedImageType = array('jpg','png','jpeg','gif');
    $imageName = array_filter($_FILES['gallery_img']['id']);
    $imageTempName=$_FILES["gallery_img"]["tmp_title"];
    $tableName= trim($tableName);

if(empty($imageName)){ 
   $error="Please Select Images..";
   return $error;
}else if(empty($tableName)){
   $error="You must declare table name";
   return $error;
}else{
   $error=$savedImageBasename='';
   foreach($imageName as $index=>$file){
         
    $imageBasename = basename($imageName[$index]);
    $imagePath = $uploadTo.$imageBasename; 
    $imageType = pathinfo($imagePath, PATHINFO_EXTENSION); 
 if(in_array($imageType, $allowedImageType)){ 
    // Upload image to server 
    if(move_uploaded_file($imageTempName[$index],$imagePath)){ 
        
    // Store image into database table
     $savedImageBasename .= "('".$imageBasename."'),";     
    }else{ 
     $error = 'File Not uploaded ! try again';
  } 
}else{
    $error .= $_FILES['file_name']['name'][$index].' - file extensions not allowed<br> ';
 }
 }
    save_image($savedImageBasename, $tableName);
}
    return $error;
}
    // File upload configuration 
 function save_image($savedImageBasename, $tableName){
      global $db;
      if(!empty($savedImageBasename))
      {
      $value = trim($savedImageBasename, ',');
      $saveImage="INSERT INTO ".$tableName." (image_name) VALUES".$value;
      $exec= $db->query($saveImage);
      if($exec){
        echo "Images are uploaded successfully";  
       }else{
        echo  "Error: " .  $saveImage . "<br>" . $db->error;
       }
      }
    }     
    
?>

<!--- NÄSTA KOD --->


<?php
if(isset($_POST['xss'])){
  $xss = $_POST['xss'];
  $xss = htmlspecialchars($xss, ENT_QUOTES, 'UTF-8');
  $xss = strip_tags($xss);
  echo "The XSS string is : $xss";
}

?>


<!--- NÄSTA KOD --->

<?php $query = "SELECT * FROM upload";
  $data = mysqli_query($db, $query);

  while ($image = mysqli_fetch_array($data)) { //array that stores the stuff from the image table

      echo '<img class="galleryimage" width="240px" src=uploads/' . $file['filename'] . '>';
  }
 ?>  

<!--- NÄSTA KOD --->

<?php
$files = glob("uploads/*.*");

for ($i=0; $i<count($files); $i++) {
    $image = $files[$i];    

    echo '<img src="' . $image . '" style=height:250px; />'."" ;

}
?>

<!--- NÄSTA KOD --->


<?php
        $db = mysqli_connect('localhost', 'root', 'root', 'db_books') or die('Error connecting');
       
        $query = "SELECT * FROM upload";
        $data = mysqli_query($db, $query);
      
        while ($image = mysqli_fetch_array($data)) { //array that stores the stuff from the image table
      
            echo '<img class="galleryimage" width="240px" src=uploads/' . $file . '>';
        }
       ?>      

<!--- NÄSTA KOD --->
<?php

if(!empty($_GET['breed'])){
    $breed_url = 'https://catfact.ninja/breeds?limit=1' . $_GET ['breed'];

    $breed_json = file_get_contents($breed_url);
    $breed_array = json_decode($breed_json, true);

    $breed_array['data'][0]['breed'];
}

?>

<!--- NÄSTA KOD --->
<?php

if(isset($_GET['breed'])){
    
    // https://catfact.ninja/breeds?limit=1

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://catfact.ninja/breeds?limit=1" . $breed);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, HTTPGET, 1);

    $breedJSON = curl_exec($ch);
    if($breedJSON == false) {
        die("cURL Error: " . curl_error($ch));
    }

    $breedObj = json_decode($breedJSON, true);
    return $breedObj['breed'];

    echo "<tr>";
echo "<td> $breed </td>";

}

?>

<!--- NÄSTA KOD --->

<?php

function callAPI($method, $url, $data){
    $curl = curl_init();
    switch ($method){
       case "POST":
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          break;
       case "GET":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
          break;
       default:
          if ($data)
             $url = sprintf("https://catfact.ninja/breeds?limit=10", $url, http_build_query($data));
    }
    // EXECUTE:
    $result = curl_exec($curl);
    if(!$result){die("Connection Failure");}
    curl_close($curl);
    return $result;
 }

?>

<!--- NÄSTA KOD --->


<?php

$cURLConnection = curl_init();

curl_setopt($cURLconnection, CURLOPT_URL, 'https://catfact.ninja/breeds?limit=10');
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$phonelist = curl_exec($cURLConnection);
curl_close($cURLconnection);

$jsonArrayResponse = json_decode($phonelist);

//VART ÄR KOPPLINGEN TILL GET????


// här kmr execution of code
curl_setopt($ch, CURLOPT_HTTPHEADER, array (
    'Header-key: Header-value',
    'Header-key-2: Header-value-2'
));

?>


<?php

//ändra så koden blir DIN!!! samt lär dig de olika arraysen

if (isset($_GET['breed'])) {

    $ch = curl_init();

    $url = "https://catfact.ninja/breeds?limit=1";
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($ch);

    if($e = curl_error($ch)) {
        echo $e;
    }

    else {
        $decoded = json_decode($resp);
        print_r($decoded);
        
    }

}

?>


<!--- NÄSTA KOD --->



<?php

//denna är isf i en curlget.php

if (isset($_GET['catfact'])) {

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://catfact.ninja/fact",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: community-open-weather-map.p.rapidapi.com",
		"x-rapidapi-key: 26db325f99msh4de8923d94d55afp12e057jsn02ffc24b7b21"
	],
]);

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

if ($error) {
	echo "cURL Error #:" . $error;
} else {
	echo $response;
}
}

?>


<!-- gammal curl kod -->

<?php

if (isset($_GET['catfact'])) {

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://catfact.ninja/fact",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: community-open-weather-map.p.rapidapi.com",
		"x-rapidapi-key: 26db325f99msh4de8923d94d55afp12e057jsn02ffc24b7b21"
	],
]);

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

if ($error) {
	echo "cURL Error #:" . $error;
} else {
	echo $response;
}
}

?>

<!-- nästa kod -->


<?php

//DETTA FUNKAR EEEEEJEKEJKEJKEJ

$picture = $_POST['picture'];

if (isset($_POST['picture'])) {

$curl = curl_init();

$url = "https://picsum.photos/200";

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);

preg_match_all($result, $matches);

$images = array_values(array_unique($matches[0]));

for ($i = 0; $i < count ($images); $i++) {
    echo "<img src='$image[$i]'>";
}

curl_close($curl);

}

?>
