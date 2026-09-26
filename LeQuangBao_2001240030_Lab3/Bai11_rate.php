<?php
$apiUrl = "https://open.er-api.com/v6/latest/USD";
$response = file_get_contents($apiUrl);
header('Content-Type: application/json');
echo $response;
?>