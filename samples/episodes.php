<?php

require '../vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'https://rickandmortyapi.com/api/',
    'verify' => false
]);

$responseEpisode = $client->request('GET', 'episode/2');

$responseEpisodeDecoded = json_decode($responseEpisode->getBody()->getContents(), true);

$characters = [];
foreach ($responseEpisodeDecoded['characters'] as $character) {
    $responseCharacter = $client->request('GET', $character);
    $responseCharacterDecoded = json_decode($responseCharacter->getBody()->getContents(), true);
    $characters[] = [
        'name' => $responseCharacterDecoded['name'],
        'image' => $responseCharacterDecoded['image'],
    ];
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $responseEpisodeDecoded['name']; ?></h1>
    <span>Fecha de lanzamiento: <?php echo $responseEpisodeDecoded['air_date']; ?></span>
    <h2>Personajes</h2>
    <?php foreach ($characters as $character): ?>
        <div>
            <p><?php echo $character['name']; ?></p>
            <img src="<?php echo $character['image']; ?>" alt="200"/>
        </div>
    <?php endforeach; ?>
    <h2>hola</h2>
</body>
</html>
