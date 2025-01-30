<?php
$foutmeldingen=[];
include('./includes/init.php');
include('./includes/pdo.php');
$query = $pdo->query('SELECT 
    orders.id,
    orders.is_done, 
    customers.name AS customer_name, 
    beers.name AS beer_name,
    beers.price AS beer_price,
    breweries.name AS brewery_name, 
    orders.date, 
    orders.quantity
FROM orders
JOIN customers ON orders.customer_id = customers.id
JOIN beers ON orders.beer_id = beers.id
JOIN breweries ON beers.brewery_id = breweries.id');
$entries = $query->fetchAll();
$count = $pdo->query('SELECT COUNT(*) FROM orders WHERE is_done = 0')->fetchColumn();
$orders = $pdo->query('SELECT COUNT(*) FROM orders')->fetchColumn();
$total_income = $pdo->query('SELECT SUM(orders.quantity * beers.price) FROM orders JOIN beers ON orders.beer_id = beers.id WHERE orders.is_done = 1')->fetchColumn();
$average_quantity = $pdo->query('SELECT AVG(orders.quantity) FROM orders WHERE orders.is_done = 1')->fetchColumn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $query = $pdo->prepare("UPDATE orders SET is_done=:is_done WHERE id = :id");
        $query->execute([
            ':is_done' => 1,
            ':id' => $_POST['id']
        ]);

        header('location: orders-beheren.php');
        exit;
    }
    catch(PDOException $e) {
      $foutmeldingen[] = "Er is iets fout gegaan: ". $e->getMessage();
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

        <p class="text-2xl font-semibold">Orders beheren</p>

        <div class="mt-4 mb-12">
            <a href="index.php" class="text-blue-500 underline">Terug naar overzicht</a>
        </div>

        <div class="my-12">
            <p class="text-2xl">
                <b class="font-semibold">Totale inkomsten:</b>
                &euro;<?=$total_income?>
            </p>
            <p class="text-2xl">
                <b class="font-semibold">Aantal orders:</b>
                <?=$orders ?>
            </p>
            <p class="text-2xl">
                <b class="font-semibold">Gemiddeld aantal flesjes per order:</b>
                <?=$average_quantity?>
            </p>

            <?php if ($count != 0) :?>
            <p class="text-2xl text-orange-500">
                <b class="font-semibold">Nog af te werken:</b>
                <?= $count?>
            </p>
            <?php else :?>
            <p class="text-2xl text-green-500">
                <b class="font-semibold">Alles afgewerkt!</b>
            </p>
            <?php endif;?>
        </div>

        <div class="">
            <table class="w-full">
                <thead class="bg-neutral-800 text-neutral-100">
                    <tr>
                        <th class="text-left p-2">
                            Datum
                        </th>
                        <th class="text-left p-2">
                            Bier
                        </th>
                        <th class="text-left p-2">
                            Aantal
                        </th>
                        <th class="text-left p-2">
                            Totale prijs
                        </th>
                        <th class="text-left p-2">
                            Naam
                        </th>
                        <th class="text-left p-2">
                            Afgehandeld
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($entries as $entry) :?>
                    <tr class="even:bg-neutral-200 odd:bg-neutral-100">
                        <td class="p-2">
                            <?= date('Y-m-d', strtotime($entry['date'])) ?>
                        </td>
                        <td class="p-2">
                            <?=$entry['beer_name']?>
                            <span class="text-sm text-neutral-500 block italic"><?=$entry['brewery_name']?></span>
                        </td>
                        <td class="p-2">
                            <?=$entry['quantity']?> flesjes
                        </td>
                        <td class="p-2">
                            <span
                                class="font-semibold">&euro;<?= number_format($entry['beer_price'] * $entry['quantity'], 2, ',', '.') ?></span>
                        </td>
                        <td class="p-2">
                            <a href="mailto:<?=$entry['customer_name']?>@test.be"
                                class="text-blue-500 underline"><?=$entry['customer_name']?></a>
                        </td>
                        <td class="p-2">
                            <form method="post">
                                <?php if (!$entry['is_done']) :?>
                                <input type="hidden" value="<?=$entry['id']?>" name="id">
                                <input type="submit" value="Afhandelen" class="cursor-pointer bg-neutral-300 px-2 py-1">
                                <?php else :?>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="bg-green-500 text-green-100 p-2 rounded-full w-6 h-6 inline-block text-sm flex items-center justify-center">&checkmark;</span>
                                    <span class="text-green-500">Afgehandeld!</span>
                                </div>
                                <?php endif;?>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php include('./includes/footer.php') ?>
    </div>

</body>

</html>