<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/database.php';

$ramClient = new \RAMC\RAMClient();

$query = <<<EOD
SELECT * FROM episodes WHERE id = ?
EOD;

$queryInsert = <<<EOD
INSERT INTO episodes (id, `name`, air_date, episode, url, created)
VALUES (?, ?, ?, ?, ?, ?)
EOD;

$stmt = $connection->prepare($query);
$stmtInsert = $connection->prepare($queryInsert);

if (is_numeric($_GET['episode']) && is_int((int) $_GET['episode'])) {
    $stmt->execute([$_GET['episode']]);
    if (!$result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $response = $ramClient->getEpisode($_GET['episode']);
        $responseDecoded = json_decode($response, true);
        $stmtInsert->execute([
            $responseDecoded['id'],
            $responseDecoded['name'],
            $responseDecoded['air_date'],
            $responseDecoded['episode'],
            $responseDecoded['url'],
            $responseDecoded['created']
        ]);
        echo $response;
    } else {
        echo json_encode($result);
    }
} else {
    echo 'El id del episodio debe ser un número entero';
}
