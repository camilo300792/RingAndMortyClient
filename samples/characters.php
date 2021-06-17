<?php

require_once __DIR__ . '/../vendor/autoload.php';

$ramClient = new \RAMC\RAMClient();

$response = $ramClient->getCharacter($_GET['character']);

echo $response;


