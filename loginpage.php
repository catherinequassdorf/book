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

      // startar igång session
      session_start();
      
      if ( ! empty( $_POST ) ) {
          if ( isset( $_POST['username'] ) && isset( $_POST['userpw'] ) ) {            
              
            $db = mysqli_connect('localhost', 'root', 'root', 'db_books') or die('Error connecting');

            //grabs username and pw entered by the user
              $username = mysqli_real_escape_string($db, trim($_POST['username'])); //user cannot write code in the form, only text
              $userpw = mysqli_real_escape_string($db, trim($_POST['userpw'])); //user cannot write code in the form, only text
    
              $query = "SELECT id, username, userpw, usertype FROM users
                        WHERE username = '".$username."' AND " . "userpw = '".md5($userpw)."'";
              $data = mysqli_query($db, $query);//prepares for execution
    
              if (mysqli_num_rows($data) == 1){ //returns number of rows present in the result set
                            $row = mysqli_fetch_assoc($data);

              // Verify user password and set $_SESSION
              //if ( userpw_verify( $_POST['userpw'], $username->userpw ) ) {
                $_SESSION['id'] = $row["id"]; //sets user ID for session
                $_SESSION['usertype'] = $row["usertype"]; //sets usertype for session
                $_SESSION['username'] = $row["username"]; //username is same as variable above
            

              if ($row['usertype'] == '1') {
                header("location:admin.php");
            } else if ($row['usertype'] == '2') {
                header("location:user.php");
            }

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
                        <input type="text" name="userpw" placeholder="Enter password" required /> <!-- ändra type=password för att det ska bli prickar när man skrivar -->
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
