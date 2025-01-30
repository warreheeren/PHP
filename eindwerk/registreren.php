<?php 
include('./includes/pdo.php');
$foutmeldingen = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($users) > 0) {
        $foutmeldingen['error'] = "Er is al een account gemaakt. U kunt inloggen.";
    }
    
    if (empty($_POST['username'])) {
        $foutmeldingen['username'] = "Vul een username in.";
    }

    if (empty($foutmeldingen)) {
        $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $username  = $_POST['username'];
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => $password_hash]);
        }
        catch (PDOException $e) {
            $foutmeldingen['error'] = "Er is iets misgegaan: ". $e->getMessage();
        }
        header('location: aanmelden.php');
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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Bieren</title>
</head>

<body>

    <div class="container mx-auto">
        <h1 class="text-4xl mt-8">Bieren winkel</h1>

        <p class="text-2xl font-semibold">Registreren</p>

        <div class="mt-12">
            <form method="post" class="grid gap-4 max-w-lg">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" class="w-full bg-neutral-100 p-2 block"
                        value="<?php echo $_POST['username'] ?? '' ?>" id="username" name="username">
                    <?php if (isset($foutmeldingen['username'])): ?>
                    <span class="text-red-500 text-sm"><?php echo $foutmeldingen['username'] ?></span>
                    <?php endif ?>
                </div>

                <div>
                    <label for="password">Wachtwoord:</label>
                    <input type="password" id="password" class="w-full bg-neutral-100 p-2 block"
                        value="<?php echo $_POST['password'] ?? '' ?>" id="password" name="password">
                    <?php if (isset($foutmeldingen['password'])): ?>
                    <span class="text-red-500 text-sm"><?php echo $foutmeldingen['password'] ?></span>
                    <?php endif ?>
                </div>

                <div>
                    <label for="password_confirmation">Wachtwoord confirmatie:</label>
                    <div>
                        <input type="password" value="<?php echo $_POST['password_confirmation'] ?? '' ?>"
                            placeholder="..." id="password_confirmation" type="text" name="password_confirmation"
                            class="block bg-gray-200 p-2 w-full border border-neutral-400">
                    </div>
                    <?php if (isset($foutmeldingen['password_confirmation'])): ?>
                    <span class="text-red-500 text-sm"><?php echo $foutmeldingen['password_confirmation'] ?></span>
                    <?php endif ?>
                </div>
                <?php if (isset($foutmeldingen['error'])): ?>
                <span class="text-red-500 text-sm"><?php echo $foutmeldingen['error'] ?></span>
                <?php endif ?>

                <div class="flex items-center gap-4">
                    <input type="submit" value="Registreren"
                        class="cursor-pointer p-2 bg-green-500 text-green-100 inline-block">
                </div>
            </form>
        </div>
    </div>

</body>

</html>