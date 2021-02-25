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

///denna delen stores variable i every field
$id=$row['id'];
$title=$row['title'];
$isbn=$row['isbn'];
$onloan=$row['onloan'];

if($onloan==0) {     // 0 = available, 1 = not available

//table creationnnn
echo "<tr>";
echo "<td> $title </td>";
      echo "<div class='button-wrapper'><br/><td><form class='button return-button' method='GET' action='reserve.php'>
      <button name='id' value='$id' type='submit'>Reserve</button></div><br/><br/>
      </form>
  </td>
  </tr>";


mysqli_close($db);

}
}
}


?>

            
        </div>


        <div class="c-right">
            <div class="c-search">

            <form method="POST" action="submit.php">
						<label for="title">Title:</label>
                        <input type="text" id="title" name="title" /><br />
                        <label for="isbn">ISBN:</label>
                        <input type="text" id="isbn" name="isbn" />
                        <input type="submit" value="Submit!" name="submit" />
					</form>

            </div>  

            
            <div class="t-big2">
                <h2>Browse</h2>
            </div>
        </div>
    </div>

</body>




<footer>
    <?php include('templates/footer.php');?>
</footer>

</html>
