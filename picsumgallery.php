<?php

//DETTA FUNKAR EEEEEJEKEJKEJKEJ

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


<div class="c-container">

<form method="POST" action="">
<input type="submit" value="picture" name="picture" />
</form>
</div>


