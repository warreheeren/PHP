<?php
include('./includes/init.php');
include('./includes/pdo.php');
$query = $pdo->query('SELECT beers.*, breweries.id AS brewery_id, breweries.name AS brewery_name FROM beers JOIN breweries ON beers.brewery_id=breweries.id ORDER BY name ASC');
$entries = $query->fetchAll();
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
        <?php include('./includes/admin-menu.php') ?>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <?php foreach ($entries as $entry) :?>
            <div class="bg-neutral-100 p-4 flex flex-col relative mt-5">
                <div class="absolute top-0 inset-x-0 text-center transform -translate-y-1/2 bg-neutral-200 rounded">
                    <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="bier-aanpassen.php?id=<?= $entry['id']?>" class="text-orange-500 underline">aanpassen</a>
                    <a href="bier-verwijderen.php?id=<?= $entry['id']?>" class="text-red-500 underline">verwijderen</a>
                    <?php endif;?>
                </div>
                <div class="flex-1">
                    <header class="mb-4">
                        <p class="text-lg font-semibold"><?= $entry['name']?></p>
                        <p class="text-neutral-500 italic text-sm mb-2"><?=$entry['description']?></p>
                        <p>Brouwerij: <a href="brouwerij.php?id=<?= $entry['id']?>"
                                class="text-blue-500 underline"><?=$entry['brewery_name']?></a></p>
                        <p>Prijs: &euro;<?=$entry['price']?></p>
                    </header>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                    <?php if ($entry['stock'] == 0):?>
                    <p class="text-red-500">Niet meer voorradig</p>
                    <?php elseif ($entry['stock'] <= 6):?>
                    <p class="text-orange-500">Bijna uit stock</p>
                    <?php else:?>
                    <p class="text-green-500">Vooradig</p>
                    <?php endif ?>
                    <?php if(isset($_SESSION['user_id'])): ?>
                    <?php endif;?>
                    <?php endif;?>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($entry['stock'] >= 6): ?>
                    <p class="text-green-500">Nog <?=$entry['stock']?> in stock</p>
                    <?php elseif ($entry['stock'] > 0): ?>
                    <p class="text-orange-500">Nog <?=$entry['stock']?> in stock</p>
                    <?php else: ?>
                    <p class="text-red-500">Niet meer voorradig</p>
                    <?php endif; ?>
                    <?php endif;?>
                </div>
                <?php if (!isset($_SESSION['user_id'])): ?>
                <p class="mt-2"><a href="bestellen.php?id=<?=$entry['id']?>"
                        class="bg-green-500 text-green-100 px-2 py-1 rounded inline-block">Bestellen!</a></p>
                <?php endif;?>
            </div>
            <?php endforeach;?>
        </div>
        <?php include('./includes/footer.php') ?>
    </div>

</body>

</html>