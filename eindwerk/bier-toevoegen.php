<?php 
include('./includes/init.php');
if(!isset($_SESSION['user_id'])) {
    header('Location: aanmelden.php');
    exit;
}
include('./includes/pdo.php');
$query = $pdo->query('SELECT beers.*, breweries.id AS brewery_id, breweries.name AS brewery_name FROM beers JOIN breweries ON beers.brewery_id=breweries.id');
$beers = $query->fetchAll();

$breweries = $pdo->query("SELECT * FROM breweries")->fetchAll(PDO::FETCH_ASSOC);;

$foutmeldingen = [];
$naam = $beschrijving = $stock = $price = $brouwerij = "" ;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('./includes/validatie.php');

    try {
        $query = $pdo->prepare('
            INSERT INTO beers (name, brewery_id, description, price, stock) 
            VALUES (:name, :brewery_id, :description, :price, :stock)
        ');
        $query->execute([
            ':name' => $_POST['name'],
            ':brewery_id' => $_POST['brewery_id'],
            ':description' => $_POST['description'],
            ':price' => $_POST['price'],
            ':stock' => $_POST['stock'],
        ]);
    } catch (PDOException $e) {
        $foutmeldingen[] = 'Er is een fout opgetreden: ' . $e->getMessage();
        die(implode('<br>', $foutmeldingen));
    }

    header('Location: index.php');
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

        <p class="text-2xl font-semibold">Bier toevoegen</p>

        <div class="mt-4 mb-12">
            <a href="index.php" class="text-blue-500 underline">Terug naar overzicht</a>
        </div>

        <div class="">
            <form method="post" class="grid gap-4 max-w-lg">
                <?php include('./includes/bier-formulier.php') ?>
                <div class="flex items-center gap-4">
                    <input type="submit" value="Toevoegen"
                        class="cursor-pointer p-2 bg-green-500 text-green-100 inline-block">
                    <a href="index.php" class="text-blue-500 underline">annuleren</a>
                </div>
            </form>
        </div>

        <?php include('./includes/footer.php') ?>
    </div>

</body>

</html>