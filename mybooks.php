<?php include('config.php');?>


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
                    

                    <?php
$db = mysqli_connect('localhost', 'root', 'root', 'db_books') or die('Error connecting');


$sql = mysqli_query($db, "SELECT *  FROM books");
$count = mysqli_num_rows($sql); //mysqli_num_rows räknar rows från databasen

//kollar ifall database returnerar more than 0 rows
if($count>0){
//om rows >0 FETCHAR VI DATAN!!!
while ($row = mysqli_fetch_array($sql)){

//denna delen stores variable i every field
$id=$row['id'];
$title=$row['title'];
$isbn=$row['isbn'];
$onloan=$row['onloan'];

if($onloan==1) {   // 0 = available, 1 = not available

//table creationnnn
echo "<tr>";
echo "<td> $title </td>"; //what is visible in the form
    echo "<div class='button-wrapper'><br/><td><form class='button return-button' method='GET' action='unreserve.php'>
    <button name='id' value='$id' type='submit'>Return</button></div><br/><br/>
    </form>
</td>
</tr>";


mysqli_close($db);

}
}
}


?>


<br/>

                
                </li>
            </ul>

        </div>

    <div class="c-right">
        <div class="c-search">
        </div>  
        <div class="t-big3">
            <h2>My </br> books</h2>
        </div>
    </div>
</div>

</body>

<footer>
    <?php include('templates/footer.php');?>
</footer>

</html>
