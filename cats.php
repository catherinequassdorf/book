
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
    
    
    //response
    $resp = curl_exec($curl);
    
    $result = json_decode($resp, true);

    echo $result['data']['breed'] . "<br />"; 

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
    
    //response
    $resp = curl_exec($curl);
    
    $result = json_decode($resp, true);

  //echo '<pre>'; print_r($result); echo '</pre>';

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

    ?>

       </div>

</body>


</html>
