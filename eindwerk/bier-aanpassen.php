<?php 
include('./includes/pdo.php');
include('./includes/init.php');

$query = $pdo->query('SELECT beers.*, breweries.id AS brewery_id, breweries.name AS brewery_name FROM beers JOIN breweries ON beers.brewery_id=breweries.id');
$beers = $query->fetchAll();

$id = intval($_GET['id']);

$query = $pdo->prepare('SELECT beers.*, breweries.id AS brewery_id, breweries.name AS brewery_name 
                        FROM beers 
                        JOIN breweries ON beers.brewery_id = breweries.id 
                        WHERE beers.id = :id');

$query->execute([':id' => $id]);
$beer_id = $query->fetch(PDO::FETCH_ASSOC);
$breweries = $pdo->query("SELECT * FROM breweries")->fetchAll(PDO::FETCH_ASSOC);;

$foutmeldingen = [];
if ($beer_id) {
        $naam = $beer_id['name'];
        $beschrijving = $beer_id['description'];
        $stock = $beer_id['stock'];
        $price = $beer_id['price'];
    } else {
        die("Bier niet gevonden.");
    }
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = $_POST['name'];
    $beschrijving = $_POST['description'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];

    include('./includes/validatie.php');
    
    try {
        $query = $pdo->prepare("UPDATE beers SET name=:name, description=:description, brewery_id=:brewery_id, price=:price, stock=:stock WHERE id=:id");
        $query->execute([
            ':name' => $naam,
            ':brewery_id' => $_POST['brewery_id'],
            ':description' => $beschrijving,
            ':price' => $price,
            ':stock' => $stock,
            ':id' => $_GET['id']
        ]);

        header('location: index.php');
        exit;
    }
 catch(PDOException $e) {
      $foutmeldingen[] = "Er is iets fout gegaan: ". $e->getMessage();
    }
}
?>
<?php ?>
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

        <p class="text-2xl font-semibold">Bier aanpassen</p>

        <div class="mt-4 mb-12">
            <a href="index.php" class="text-blue-500 underline">Terug naar overzicht</a>
        </div>

        <div class="">
            <form method="post" class="grid gap-4 max-w-lg">
                <?php include('./includes/bier-formulier.php') ?>
                <div class="flex items-center gap-4">
                    <input type="submit" value="Aanpassen"
                        class="cursor-pointer p-2 bg-orange-500 text-orange-100 inline-block">
                    <a href="index.php" class="text-blue-500 underline">annuleren</a>
                </div>
            </form>
        </div>

        <?php include('./includes/footer.php') ?>
    </div>

</body>

</html>