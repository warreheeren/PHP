<?php 

$foutmeldingen = [];

if ($_POST) {
    if (empty($_POST['cijfer'])) {
        $foutmeldingen['cijfer'] = "Je moet een cijfer invullen.";
    }

    if (empty($foutmeldingen)) {

    }
} else {

}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puntenboek</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    
    <div class="container mx-auto">
        <?php include 'includes/main-header.php' ?>

        <h2 class="font-semibold text-2xl mb-4">
            Resultaat aanpassen voor Wiskunde - Tafels.
        </h2>

        <p class="mb-4 text-neutral-500">Datum: 2022-05-12</p>

        <form method="post" class="grid gap-4">
            <div>
                <label for="cijfer" class="font-semibold">Cijfer</label>
                <input name="cijfer" value="<?php echo $_POST['cijfer'] ?? '5' ?>" type="number" min="0" max="10" id="cijfer" class="block w-full p-4 bg-neutral-100">
                <?php if (isset($foutmeldingen['cijfer'])) : ?>
                    <p class="text-red-500"><?php echo $foutmeldingen['cijfer'] ?></p>
                <?php endif ?>
            </div>
            <div class="flex gap-4 items-center">
                <input type="submit" class="block bg-orange-500 text-orange-100 text-center p-4" value="Aanpassen">
                <a href="toets.php?id=1" class="text-blue-500 hover:underline">Annuleer</a>
            </div>
        </form>
    </div>

</body>
</html>