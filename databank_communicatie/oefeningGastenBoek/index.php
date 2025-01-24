<?php 
require_once('./db.php');

try{
    $stmt = $pdo->query('SELECT gastenboek.*, hotels.naam AS hotel_naam, hotels.url AS hotel_url FROM gastenboek INNER JOIN hotels ON gastenboek.hotel_id = hotels.id;');
    $gastenboek = $stmt->fetchAll();
    
} catch(PDOException $e){
    die ('Error: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastenboek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="text-center mb-4">Gastenboek</h1>

            <div class="text-center mb-4">
                <a href="item-toevoegen.php" class="btn btn-success">Nieuw item schrijven</a>
            </div>

            <?php foreach($gastenboek as $g): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="h5 card-title"> <?= $g['naam'] ?> </h2>
                    <p class="text-muted"> <?= $g['hotel_naam'] ?> </p>
                    <p>
                        <a class="btn btn-warning btn-sm" href="item-aanpassen.php?id=<?=$g['id']?>">Aanpassen</a>
                        <a class="btn btn-danger btn-sm" href="item-verwijderen.php?id=<?=$g['id']?>">Verwijderen</a>
                    </p>
                    <p class="card-text"> <?= $g['beschrijving'] ?> </p>
                    <p class="text-muted"> <?= $g['score'] ?>
                        <?php switch($g['score']):  
                        case 1: ?>
                        <span class="text-warning">★☆☆☆☆</span>
                        <?php break; ?>
                        <?php case 2: ?>
                        <span class="text-warning">★★☆☆☆</span>
                        <?php break; ?>
                        <?php case 3: ?>
                        <span class="text-warning">★★★☆☆</span>
                        <?php break; ?>
                        <?php case 4: ?>
                        <span class="text-warning">★★★★☆</span>
                        <?php break; ?>
                        <?php case 5: ?>
                        <span class="text-warning">★★★★★</span>
                        <?php break; ?>
                        <?php endswitch; ?>
                    </p>
                    <img class="img-fluid mb-3" src="<?=$g['hotel_url']?>">
                    <p class="text-muted small"> <?= $g['aangemaakt_op'] ?> </p>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>