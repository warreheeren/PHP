<?php 
require_once('./db.php');
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM gastenboek WHERE id=:id");
$stmt -> execute([":id"=> $id]);
$user = $stmt->fetch();

$errors =[];
$naam = $user['naam'];
$hotel_id = $user['hotel_id'];
$beschrijving = $user['beschrijving'];
$score = $user['score'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $naam = htmlspecialchars(addslashes(trim($_POST['naam'])));
    $beschrijving = htmlspecialchars(addslashes(trim($_POST['beschrijving'])));
    $hotel_id = $_POST['hotel_id'];
    $score = $_POST['score'];

    if (empty($naam)) {
        $errors['naam'] = 'Naam is verplicht.';
    }

    if (empty($beschrijving)) {
        $errors['beschrijving'] = 'beschrijving is verplicht.';
    }

    if (empty($errors)) {
        try{
            $sql = "INSERT INTO gastenboek (naam, beschrijving, hotel_id, score)
            VALUES (:naam, :beschrijving, :hotel_id, :score)";
            $stmt =$pdo -> prepare($sql);
            $stmt -> execute([
                ':naam' => $naam,
                ':beschrijving' => $beschrijving,
                ':hotel_id' => $hotel_id,
                ':score' => $score
            ]);
        }catch(PDOException $e){
            die('Failed: ' . $e->getMessage());
        }
        
        header('Location: index.php');
        exit;
        
    }
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

        <form method="post" class="grid gap-4">

            <?php require_once('./form.php')?>

            <div class="flex gap-2 mt-4">
                <input type="submit" value="Aanpassen"
                    class="flex-1 p-2 bg-green-500 transition hover:bg-green-400 cursor-pointer text-green-100 rounded">
                <a href="index.php"
                    class="bg-orange-500 hover:bg-orange-400 transition text-orange-100 rounded p-2 inline-block">Annuleren</a>
            </div>
        </form>
    </div>

</body>

</html>