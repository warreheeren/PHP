<?php 
include('./includes/init.php');
include('./includes/pdo.php');
$query = $pdo->prepare('SELECT beers.*, breweries.name AS brewery_name FROM beers JOIN breweries ON beers.brewery_id = breweries.id WHERE beers.id = :id;');
$query->execute([':id' => $_GET['id']]);
$beer = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = $pdo->prepare('DELETE FROM orders WHERE beer_id = :id');
    $query->execute([
        'id' => $_GET['id']
    ]);

    $query = $pdo->prepare('DELETE FROM beers WHERE id = :id');
    $query->execute([
        'id' => $_GET['id']
    ]);

    header('location: index.php');
    exit;
}
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

        <p class="text-2xl font-semibold">Bier verwijderen</p>

        <div class="mt-4 mb-12">
            <a href="index.php" class="text-blue-500 underline">Terug naar overzicht</a>
        </div>

        <div class="">
            <form method="post" class="grid gap-8 max-w-4xl">
                <p class="text-xl">
                    Ben je zeker dat je <?=$beer['name']?> van brouwerij "<a href="brouwerij.php?id=<?=$_GET['id']?>"
                        class="text-blue-500 underline"><?=$beer['brewery_name']?></a>" wilt
                    verwijderen?
                </p>
                <p>
                    Deze handeling verwijderd ook alle bijhorende orders.
                </p>
                <div class="flex items-center gap-4">
                    <input type="submit" value="Verwijderen"
                        class="cursor-pointer p-2 bg-red-500 text-red-100 inline-block">
                    <a href="index.php" class="text-blue-500 underline">annuleren</a>
                </div>
            </form>
        </div>

        <?php include('./includes/footer.php') ?>
    </div>

</body>

</html>