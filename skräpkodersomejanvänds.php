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