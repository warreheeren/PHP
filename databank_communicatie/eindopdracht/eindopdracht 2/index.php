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

        <h2 class=""></h2>

        <table class="w-full">
            <thead class="bg-neutral-300">
                <tr>
                    <th>Onderwerp</th>
                    <th>Vak</th>
                    <th>Datum</th>
                    <th>Aantal ingestuurd</th>
                    <th>Gemiddelde score</th>
                    <th>Maximum cijfer</th>
                    <th>Handelingen</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <td><a href="toets.php?id=1" class="text-blue-500 hover:underline">Tafels</a></td>
                    <td><a href="vak.php?id=1" class="text-blue-500 hover:underline">Wiskunde</a></td>
                    <td>2022-12-4</td>
                    <td>4</td>
                    <td class="text-red-500">3</td>
                    <td>10</td>
                    <td>
                        <a href="toets-aanpassen.php?id=1" class="text-orange-500 hover:underline">aanpassen</a>
                        <a href="toets-verwijderen.php?id=1" class="text-red-500 hover:underline">verwijderen</a>
                    </td>
                </tr>
                
                <tr>
                    <td><a href="toets.php?id=1" class="text-blue-500 hover:underline">Hoofdstuk 2 vocabulaire</a></td>
                    <td><a href="vak.php?id=1" class="text-blue-500 hover:underline">Frans</a></td>
                    <td>2022-11-5</td>
                    <td>6</td>
                    <td class="text-green-500">17</td>
                    <td>20</td>
                    <td>
                        <a href="toets-aanpassen.php?id=1" class="text-orange-500 hover:underline">aanpassen</a>
                        <a href="toets-verwijderen.php?id=1" class="text-red-500 hover:underline">verwijderen</a>
                    </td>
                </tr>

                <!-- ... -->

            </tbody>
        </table>
    </div>

</body>
</html>