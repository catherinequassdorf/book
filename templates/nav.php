<nav>
    <ul class="n-template">
        <a href="index.php" class= "<?php echo($currentPage == 'index.php' || $currentPage == '') ? 'active' : ''?> ">Home</a>
        <a href="about.php" class= "<?php echo($currentPage == 'about.php') ? 'active' : ''?> ">About us</a>
        <a href="contact.php" class= "<?php echo($currentPage == 'contact.php') ? 'active' : ''?> ">Contact</a>
        <a href="browse.php" class= "<?php echo($currentPage == 'browse.php') ? 'active' : ''?> ">Browse books</a>
        <a href="mybooks.php" class= "<?php echo($currentPage == 'mybooks.php') ? 'active' : ''?> ">My books</a>
        <a href="loginpage.php" class= "<?php echo($currentPage == 'loginpage.php') ? 'active' : ''?> ">Login</a>
    </ul>
</nav>