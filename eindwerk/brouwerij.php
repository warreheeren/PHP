<?php 
include('./includes/init.php');
include('./includes/pdo.php');
$query = $pdo->prepare('SELECT beers.*, breweries.name AS brewery_name FROM beers JOIN breweries ON beers.brewery_id = breweries.id WHERE beers.id = :id;');
$query->execute([':id' => $_GET['id']]);
$beer = $query->fetch(PDO::FETCH_ASSOC);

$query = $pdo->prepare('SELECT beers.*, breweries.name AS brewery_name FROM beers JOIN breweries ON beers.brewery_id = breweries.id  WHERE brewery_id = :brewery_id;');
$query->execute([':brewery_id' => $beer['brewery_id']]);
$beers = $query->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Bieren</title>
</head>

<body>

    <div class="container mx-auto">
        <h1 class="text-4xl mt-8">Bieren winkel</h1>

        <p class="text-2xl font-semibold">Brouwerij: <?=$beer['brewery_name']?></p>
        <div class="mt-4 mb-12">
            <a href="index.php" class="text-blue-500 underline">Terug naar overzicht</a>
        </div>
        <?php foreach ($beers as $b ): ?>
        <div class="grid grid-cols-4 gap-4 mt-5">
            <div class="bg-neutral-100 p-4 flex flex-col relative">
                <?php if (isset($_SESSION['user_id'])): ?>
                <div class="absolute top-0 inset-x-0 text-center transform -translate-y-1/2 bg-neutral-200 rounded">
                    <a href="bier-aanpassen.php?id=<?=$b['id']?>" class="text-orange-500 underline">aanpassen</a> <a
                        href="bier-verwijderen.php?id=<?=$b['id']?>" class="text-red-500 underline">verwijderen</a>
                </div>
                <?php endif;?>
                <div class="flex-1">
                    <header class="mb-4">
                        <p class="text-lg font-semibold"><?=$b['name']?></p>
                        <p class="text-neutral-500 italic text-sm mb-2"><?=$b['description']?></p>
                        <p>Brouwerij: <a href="brouwerij.php?id=<?= $b['id']?>"
                                class="text-blue-500 underline"><?=$b['brewery_name']?></a></p>
                        <p>Prijs: &euro;<?=$b['price']?></p>
                    </header>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                    <?php if ($b['stock'] == 0):?>
                    <p class="text-red-500">Niet meer voorradig</p>
                    <?php elseif ($b['stock'] <= 6):?>
                    <p class="text-orange-500">Bijna uit stock</p>
                    <?php else:?>
                    <p class="text-green-500">Vooradig</p>
                    <?php endif ?>
                    <?php if(isset($_SESSION['user_id'])): ?>
                    <?php endif;?>
                    <?php endif;?>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <p class="text-orange-500">Nog <?=$b['stock']?> in stock</p>
                    <?php endif;?>
                </div>
                <?php if (!isset($_SESSION['user_id'])): ?>
                <p class="mt-2"><a href="bestellen.php?id=1"
                        class="bg-green-500 text-green-100 px-2 py-1 rounded inline-block">Bestellen!</a></p>
                <?php endif;?>
            </div>


        </div>
        <?php endforeach;?>
        <?php include('./includes/footer.php') ?>
    </div>

</body>

</html>