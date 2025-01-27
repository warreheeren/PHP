<?php 
session_start();
include('./includes/pdo.php');
$foutmeldingen = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $password = $_POST['password'];
    if (empty($foutmeldingen)) {
        try{
            $smt = $pdo -> prepare('SELECT * FROM users WHERE username = :username');
            $smt -> execute(['username' => $_POST['username']]);
            $user = $smt -> fetch();
        } 
        catch(PDOException $e){
            $foutmeldingen['error'] = 'Er is een fout opgetreden: '. $e->getMessage();
        }
        if($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: index.php');
            exit;
        }
         else {
            $foutmeldingen['error'] = 'Ongeldig gebruikersnaam of wachtwoord';
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

        <p class="text-2xl font-semibold">Aanmelden</p>

        <div class="mt-4 mb-12">
            <a href="index.php" class="text-blue-500 underline">Terug naar overzicht</a>
        </div>

        <div class="">
            <form method="post" class="grid gap-4 max-w-lg">
                <div>
                    <label for="username" class="text-gray-500 font-semibold">Wat is je username?</label>
                    <div>
                        <input value="<?php echo $_POST['username'] ?? '' ?>" placeholder="..." id="username"
                            type="text" name="username" class="block bg-gray-200 p-2 w-full border border-neutral-400">
                    </div>
                </div>

                <div>
                    <label for="password" class="text-gray-500 font-semibold">Wat is je wachtwoord?</label>
                    <div>
                        <input type="password" value="<?php echo $_POST['password'] ?? '' ?>" placeholder="..."
                            id="password" type="text" name="password"
                            class="block bg-gray-200 p-2 w-full border border-neutral-400">
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <input type="submit" value="Aanmelden"
                        class="cursor-pointer p-2 bg-green-500 text-green-100 inline-block">
                    <a href="index.php" class="text-blue-500 underline">annuleren</a>
                </div>
                <?php if (isset($foutmeldingen['error'])): ?>
                <span class="text-red-500 text-sm"><?php echo $foutmeldingen['error'] ?></span>
                <?php endif ?>
            </form>
        </div>

        <?php include('./includes/footer.php') ?>
    </div>

</body>

</html>