<?php

require_once __DIR__ . '/../vendor/autoload.php';

$ramClient = new \RAMC\RAMClient();
if (isset($_GET['character'])) {
    $response = $ramClient->getCharacter($_GET['character']);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personajes</title>
</head>
<body>
    <main>
        <form action="characters.php" method="get">
            <div>
                <label for="character"><h1>Indica el numero de la imagen que deseas</h1></label>
                <br />
                <input type="number" name="character" />
            </div>
            <div>
                <button>Consular</button>
            </div>
        </form>
    </main>

    <?php if(isset($response)): ?>
        <ol>
            <li><b>ID:</b> <?php echo $response['id'] ?></li>
            <li><b>NOMBRE:</b> <?php echo $response['name'] ?></li>
            <li><b>STATUS:</b> <?php echo $response['status'] ?></li>
            <li><b>SPECIES:</b> <?php echo $response['species'] ?></li>
            
        </ol>
    
    <?php endif; ?>
</body>
</html>


