<?php

require '../vendor/autoload.php';
$ramClient = new \RAMC\RAMClient();
if (isset($_GET['episode'])) {
    $response = $ramClient->getEpisode($_GET['episode']);
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
    <main>
        <form action="episodes.php" method="get">
            <div>
                <label for="episode">Indica el número del episodio que deseas consultar</label>
                <br />
                <input type="number" name="episode" />
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
            <li><b>AL AIRE:</b> <?php echo $response['air_date'] ?></li>
            <li><b>CÓDIGO:</b> <?php echo $response['episode'] ?></li>
        </ol>
    <?php endif; ?>
</body>
</html>


