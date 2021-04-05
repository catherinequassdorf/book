
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

//ändra så koden blir DIN!!! samt lär dig de olika arraysen
// BRA FÖRKLARING: https://www.youtube.com/watch?v=_p4U3qPqqGQ
// https://reqbin.com/req/php/c-vdhoummp/curl-get-json-example hehe 

if (isset($_GET['breed'])) {

    //request
    $url = "https://catfact.ninja/breeds?limit=10";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
       "accept: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //above GETS data that already exists

    
    //response
    $resp = curl_exec($curl);
    $result = json_decode($resp, true);

    echo '<pre>'; print_r($result); echo '</pre>';
    curl_close($curl); 
    }
    ?>





<?php


if (isset($_GET['catfact'])) {

    //request
    $url = "https://catfact.ninja/fact";
    
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
       "accept: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //above GETS data that already exists

    
    //response
    $resp = curl_exec($curl);
    
    $result = json_decode($resp, true);

 // echo '<pre>'; print_r($result); echo '</pre>';

    curl_close($curl); 
        
    }

    
    ?>
    


    <div class="c-container">

    <form method="GET" action="">
    <input type="submit" value="breed" name="breed" />
    <input type="submit" value="catfact" name="catfact" />
    </form>

<br/>

    <?php

echo "<h2>Result:</h2>";
echo $result['fact'];

$num = rand(1, 10);

switch($num) {
    case 1: $randombreed = 1;
        break;

    case 2: $randombreed = 2;
        break;

    case 3: $randombreed = 3;
        break;

    case 4: $randombreed = 4;
        break;
    
    case 5: $randombreed = 5;
        break;

    case 6: $randombreed = 6;
        break;

    case 7: $randombreed = 7;
        break;

    case 8: $randombreed = 8;
        break;

    case 9: $randombreed = 9;
        break;
    
    case 10: $randombreed = 10;
        break;
}

echo $result['data'][$randombreed]['breed'];

    ?>

       </div>

</body>


</html>
