
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

<?php

    //request
    $url = "https://picsum.photos/v2/list?page=2&limit=10";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
       "Content-Type: image/jpeg;",
       "accept: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //above GETS data that already exists
    
    //response
    $resp = curl_exec($curl);
    $result = json_decode($resp, true);

        //echo '<pre>'; print_r($result); echo '</pre>';

        foreach($result as $post){
          echo '<img height=100px src= "'. $post["download_url"] .'"/>';

     

    }

    ?>


<?php


if (isset($_POST['randomimg'])) {

//request
$url = "https://picsum.photos/v2/list?page=2&limit=10";
    //länken får separat id

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$headers = array(
   "Content-Type: image/jpeg;",
   "accept: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//above GETS data that already exists


//response
$resp = curl_exec($curl);
$result = json_decode($resp, true);

//echo '<pre>'; print_r($result); echo '</pre>';


$num = rand(1, 10);
switch($num) {
    case 1: $randomarray = 1;
        break;

    case 2: $randomarray = 2;
        break;

    case 3: $randomarray = 3;
        break;

    case 4: $randomarray = 4;
        break;
    
    case 5: $randomarray = 5;
        break;

    case 6: $randomarray = 6;
        break;

    case 7: $randomarray = 7;
        break;

    case 8: $randomarray = 8;
        break;

    case 9: $randomarray = 9;
        break;
    
    case 10: $randomarray = 10;
        break;

}

echo '<img height=100px src= "'. $result[$randomarray]["download_url"].'"/>';

//while ($stmt->fetch()) {    


}

//DETTA BBEHÖVER LOOPAS!!! while stämmer ej utan ska göras om så bild läggs till en efter en








?>
    


    <div class="c-container">

    <form method="POST" action="">
    <input type="submit" value="Random image yay!" name="randomimg" />
    </form>

<br/>

    <?php

echo "<h2>Result:</h2>";

    ?>

       </div>

</body>


</html>
