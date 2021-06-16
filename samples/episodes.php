<?php

require_once __DIR__ . '/../vendor/autoload.php';

$ramClient = new \RAMC\RAMClient();

$response = $ramClient->getEpisode($_GET['episode']);

echo $response;



