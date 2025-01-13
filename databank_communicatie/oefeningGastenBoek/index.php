<?php 
require_once('./db.php');

try{
    $stmt = $pdo->query('SELECT gastenboek.*, hotels.naam AS hotel_naam FROM gastenboek INNER JOIN hotels ON gastenboek.hotel_id = hotels.id');
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
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-neutral-800">

    <div class="max-w-md mx-auto bg-gray-100 mt-8 rounded p-4 shadow-lg">
        <h1 class="text-center text-4xl mb-8">Gastenboek</h1>

        <p class="flex justify-center mb-8">
            <a href="item-toevoegen.php"
                class="bg-green-500 hover:bg-green-400 transition text-green-100 rounded p-2">Nieuw item schrijven</a>
        </p>
        <?php foreach($gastenboek as $g): ?>
        <div class="grid gap-4">
            <article class="bg-gray-200 rounded p-4 m-2">

                <h2 class="text-lg font-semibold">
                    <?= $g['naam'] ?>
                </h2>

                <p class="italic text-sm text-gray-500">
                    <?= $g['hotel_naam'] ?>
                </p>
                <p class="text-sm my-4">
                    <a class="transition bg-orange-500 hover:bg-orange-400 rounded px-2 text-orange-100"
                        href="item-aanpassen.php?id=<?=$g['id']?>">aanpassen</a>
                    <a class="transition bg-red-500 hover:bg-red-400 rounded px-2 text-red-100"
                        href="item-verwijderen.php?id=<?=$g['id']?>">verwijderen</a>
                </p>
                <div class="my-4">
                    <?= $g['beschrijving'] ?>
                </div>
                <p class="text-gray-500">
                    <?= $g['score'] ?>
                    <?php switch($g['score']):  
                    case 1: ?>
                    <span class="text-yellow-400">
                        ★☆☆☆☆
                    </span>
                    <?php break; ?>
                    <?php case 2: ?>
                    <span class="text-yellow-400">
                        ★★☆☆☆
                    </span>
                    <?php break; ?>
                    <?php case 3: ?>
                    <span class="text-yellow-400">
                        ★★★☆☆
                    </span>
                    <?php break; ?>
                    <?php case 4: ?>
                    <span class="text-yellow-400">
                        ★★★★☆
                    </span>
                    <?php break; ?>
                    <?php case 5: ?>
                    <span class="text-yellow-400">
                        ★★★★★
                    </span>
                    <?php break; ?>
                    <?php endswitch; ?>
                </p>
                <p class="text-gray-400 text-sm">
                    <?= $g['aangemaakt_op'] ?>
                </p>
            </article>
        </div>
        <?php endforeach ?>
    </div>


</body>

</html>