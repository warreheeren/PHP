<?php 


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

        <h2 class="font-semibold text-2xl uppercase">Leerlingen</h2>

        <p class="flex gap-4 my-4">
            <a href="leerling-toevoegen.php" class="bg-green-500 text-green-100 px-2 py-1">Nieuwe leerling toevoegen</a>
        </p>

        <table class="w-full">
            <thead class="bg-neutral-300">
                <tr>
                    <th>Voornaam</th>
                    <th>Naam</th>
                    <th>Handelingen</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>
                        <a href="leerling.php?id=1" class="text-blue-500 hover:underline">resultaten bekijken</a>
                        <a href="leerling-aanpassen.php?id=1" class="text-orange-500 hover:underline">aanpassen</a>
                        <a href="leerling-verwijderen.php?id=1" class="text-red-500 hover:underline">verwijderen</a>
                    </td>
                </tr>

                <tr>
                    <td>Jane</td>
                    <td>Doe</td>
                    <td>
                        <a href="leerling.php?id=1" class="text-blue-500 hover:underline">resultaten bekijken</a>
                        <a href="leerling-aanpassen.php?id=1" class="text-orange-500 hover:underline">aanpassen</a>
                        <a href="leerling-verwijderen.php?id=1" class="text-red-500 hover:underline">verwijderen</a>
                    </td>
                </tr>
                

                <!-- ... -->

            </tbody>
        </table>
    </div>

</body>
</html>