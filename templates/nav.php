<nav>
    <ul class="n-template">
        <a href="index.php" class= "<?php echo($currentPage == 'index.php' || $currentPage == '') ? 'active' : ''?> ">Home</a>
        <a href="about.php" class= "<?php echo($currentPage == 'about.php') ? 'active' : ''?> ">About us</a>
        <a href="contact.php" class= "<?php echo($currentPage == 'contact.php') ? 'active' : ''?> ">Contact</a>
        <a href="browse.php" class= "<?php echo($currentPage == 'browse.php') ? 'active' : ''?> ">Browse books</a>
        <a href="mybooks.php" class= "<?php echo($currentPage == 'mybooks.php') ? 'active' : ''?> ">My books</a>
        <a href="gallery.php" class= "<?php echo($currentPage == 'gallery.php') ? 'active' : ''?> ">Gallery</a>


        <?php if (isset($_SESSION['loginstatus'])) {
		if($_SESSION['usertype'] == '1'){
			?><a class="<?php echo ($current_page == 'admin.php') ? 'active' : NULL ?>"href="admin.php">Admin</a><?php
		} else if($_SESSION['usertype'] == '2'){
			?><a class="<?php echo ($current_page == 'user.php') ? 'active' : NULL ?>"href="user.php">User</a><?php
		}
	}
    ?>

        <?php if (isset($_SESSION['loginstatus'])) {
            ?><a class="<?php echo ($current_page == 'logout.php') ? 'active' : NULL ?>"href="logout.php">Log out!</a><?php

		} else {
            ?><a class="<?php echo ($current_page == 'loginpage.php') ? 'active' : NULL ?>"href="loginpage.php">Log in?</a><?php
		}
	
    ?>

        </ul>
</nav>