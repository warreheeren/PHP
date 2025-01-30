<?php 
include('./includes/init.php');
include('./includes/pdo.php');
$query = $pdo->prepare('SELECT beers.*, breweries.name AS brewery_name FROM beers JOIN breweries ON beers.brewery_id = breweries.id WHERE beers.id = :id;');
$query->execute([':id' => $_GET['id']]);
$beer = $query->fetch(PDO::FETCH_ASSOC);
$errors = [];
$besteld = false;
$naam = $email = $adres = $gemeente = $aantal = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = htmlspecialchars(addslashes(trim($_POST['naam'])));
    $email = htmlspecialchars(addslashes(trim($_POST['email'])));
    $adres = htmlspecialchars(addslashes(trim($_POST['adres'])));
    $gemeente = htmlspecialchars(addslashes(trim($_POST['gemeente'])));
    $aantal = htmlspecialchars(addslashes(trim($_POST['aantal'])));
    $voorwaarden = isset($_POST['voorwaarden']);
    if (empty($naam)) {
        $errors['naam'] = 'Naam is verplicht.';
    } elseif(strlen($naam) < 2){
        $errors['naam'] = 'Je naam moet meer dan 2 letters bevatten.';
    }

    if (empty($adres)) {
        $errors['adres'] = 'Adres is verplicht.';
    } 

    if (!isset($gemeente)) {
        $errors['gemeente'] = 'Gemeente is verplicht.';
    } 

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Vul een geldig e-mailadres in.';
    }

    if (empty($aantal)) {
        $errors['aantal'] = 'aantal is verplicht.';
    }
    
   if (!$voorwaarden) {
        $errors['voorwaarden'] = 'Accepteer de voorwaarden.';
    }
    

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO customers (name, email, adres, gemeente) VALUES (:name, :email, :adres, :gemeente)");
        $stmt->execute([
            ':name' => $naam,
            ':email' => $email,
            ':adres' => $adres,
            ':gemeente' => $gemeente,

        ]);
        $customer_id = $pdo->lastInsertId();
        $stmt = $pdo->prepare("INSERT INTO orders (date,customer_id, beer_id, quantity, is_done) VALUES (:date,:customer_id, :beer_id, :quantity, :is_done)");
        $stmt->execute([
            ':date' => date('Y-m-d'),
            ':customer_id' => $customer_id,
            ':beer_id' => $beer['id'],
            ':quantity' => $aantal,
            ':is_done' => 0
        ]);
       
        if ($beer['stock'] >= $aantal) {
            $query = $pdo->prepare("UPDATE beers SET stock = stock - :quantity WHERE id = :id");
            $query->execute([
                ':quantity' => $aantal,
                ':id' => $beer['id']
            ]);
            $besteld = true;
        } else {
            $errors['stock'] = 'Er is geen voldoende stock om de bestelling te plaatsen.';
        }
    } 
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

        <p class="text-2xl font-semibold">Bier bestellen</p>

        <div class="mt-4 mb-12">
            <a href="index.php" class="text-blue-500 underline">Terug naar overzicht</a>
        </div>
        <?php if ($besteld) :?>
        <div class="bg-green-500 text-green-100 p-4 rounded inline-block my-4">
            Jouw bestelling is geplaatst!
        </div>
        <?php endif;?>

        <p class="text-xl">
            Je plaatst een bestelling voor het bier: <?=$beer['name']?>.
        </p>

        <p>
            Brouwerij: <a href="brouwerij.php?id=1" class="text-blue-500 underline"><?=$beer['brewery_name']?></a>
        </p>

        <div class="mt-12">
            <form method="post" class="grid gap-4 max-w-lg">
                <?php include('./includes/bestel-formulier.php') ?>
                <?php if (isset($errors['stock'])): ?>
                <span class="text-red-500 text-sm"><?php echo $errors['stock'] ?></span>
                <?php endif ?>
                <div class="flex items-center gap-4">
                    <input type="submit" value="Bestellen maar"
                        class="cursor-pointer p-2 bg-green-500 text-green-100 inline-block">
                    <a href="index.php" class="text-blue-500 underline">annuleren</a>
                </div>
            </form>
        </div>

        <?php include('./includes/footer.php') ?>
    </div>

</body>

</html>