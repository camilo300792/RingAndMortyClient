<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/database.php';

$ramClient = new \RAMC\RAMClient();

$query = <<<EOD
SELECT * FROM characters WHERE id = ?
EOD;

$queryInsert = <<<EOD
INSERT INTO characters (id, `name`, status, species, type, gender)
VALUES (?, ?, ?, ?, ?, ?)
EOD;

$stmt = $connection->prepare($query);
$stmtInsert = $connection->prepare($queryInsert);

if (is_numeric($_GET['character']) && is_int((int) $_GET['character'])) {
    $stmt->execute([$_GET['character']]);
    if (!$result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $response = $ramClient->getCharacter($_GET['character']);
        $responseDecoded = json_decode($response, true);
        $stmtInsert->execute([
            $responseDecoded['id'],
            $responseDecoded['name'],
            $responseDecoded['status'],
            $responseDecoded['species'],
            $responseDecoded['type'],
            $responseDecoded['gender']
            
        ]);
        echo $response;
    } else {
        echo json_encode($result);
    }
} else {
    echo 'El id del personage debe ser un número entero';
}
;


