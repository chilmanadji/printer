<?php

date_default_timezone_set('Asia/Jakarta');
 
$url = str_replace("https", "http", $_GET['url']); 

$cash = intval($_GET['cash']);

$result = file_get_contents($url);
//$result = json_decode($result);
print_r($result);