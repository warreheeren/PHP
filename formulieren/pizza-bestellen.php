<?php 

$errors = [];
$input = [
    'pikant' => '',
    'naam' => '',
    'straat' => '',
    'gemeente' => '',
    'email' => '',
    'tel' => '',
];

$toppings = [
   "adress" => ["Feta", "Geraspte kaas", "Mozzarella", "Gorgonzola"],
   "Vlees" => ["Kip (€2)", 'Kebab(€2)', "Salami(€2)", "Tonijn(€2)", "Zalm(€2)"],
   "Extra" => ["Olijven(€1)", "Pepers(€1)", "Champignons(€1)","Ajuin(€1)"]
];
$gekozenToppings = [];

$korst = ["normaal", "cheesy"];
$gekozenKorst=[];

$grootte = ["Small", "Medium", "Large", "Extra large"];
$gekozenGrootte=[];

$bodem = ["Dik", "Dun"];
$gekozenBodem=[];

$saus = ["Rode saus", "Witte saus"];
$gekozenSaus=[];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input['email'] = htmlspecialchars(addslashes(trim($_POST['email'])));
    $input['gemeente'] = htmlspecialchars(addslashes(trim($_POST['gemeente'])));
    $input['straat'] = htmlspecialchars(addslashes(trim($_POST['straat'])));
    $input['naam'] = htmlspecialchars(addslashes(trim($_POST['naam'])));
    $input['tel'] = htmlspecialchars(addslashes(trim($_POST['tel'])));
    $gekozenKorst = isset($_POST['korst']) ? $_POST['korst'] : '' ;  
    $gekozenBodem = isset($_POST['bodem']) ? $_POST['bodem'] : '';
    $gekozenGrootte = isset($_POST['grootte']) ? $_POST['grootte'] : '';
    $gekozenSaus = isset($_POST['saus']) ? $_POST['saus'] : '';
    $gekozenToppings = isset($_POST['toppings']) ? $_POST['toppings'] : [];
    $input['pikant'] = $_POST['pikant'];
 
    if (empty($gekozenGrootte)) {
        $errors['grootte'] = 'Grootte is verplicht.';
    } 

    if (empty($gekozenBodem)) {
        $errors['bodem'] = 'Bodem is verplicht.';
    }

    if (empty($gekozenKorst)) {
        $errors['korst'] = 'Korst is verplicht.';
    } 

    if (empty($gekozenSaus)) {
        $errors['saus'] = 'Saus is verplicht.';
    }

    if (empty($gekozenToppings) || count($gekozenToppings) < 2 || count($gekozenToppings) > 5) {
        $errors['toppings'] = 'Kies minstens 2 en maximaal 5 toppings.';
    }

    if (empty($input['naam'])) {
        $errors['naam'] = 'Naam is verplicht.';
    } elseif(strlen($input['naam']) < 2){
        $errors['naam'] = 'Je naam moet meer dan 2 letters bevatten.';
    }

    if (empty($input['straat'])) {
        $errors['straat'] = 'Straat is verplicht.';
    } 

    if (empty($input['gemeente'])) {
        $errors['gemeente'] = 'Gemeente is verplicht.';
    } 

    if (empty($input['email']) || !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Vul een geldig e-mailadres in.';
    } 

    if (!empty($input['tel']) && !preg_match('/^\\+32[0-9]{8,}$/', $input['tel'])) {
        $errors['tel'] = 'Telefoonnummer moet beginnen met +32 en minstens 9 cijfers bevatten.';
    } 

    if (empty($errors)) {
        header('Location: success.php');



        
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
    <title>Pizza bestellen</title>
    <link rel="stylesheet" href="pizza-bestellen.css">
</head>

<body>

    <div class="container">
        <header>
            <h1>Stel je eigen pizza samen</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat cupiditate iure vero, soluta ipsum
                voluptate non aliquid dicta voluptatem eum?</p>
        </header>
        <pre><?php print_r($_POST) ?></pre>
        <form method="POST" action="">
            <fieldset
                class="<?= isset($errors['grootte']) || isset($errors['bodem']) || isset($errors) ? 'has_error' : '' ?>">
                <legend>Basis</legend>
                <div class="<?= isset($errors['grootte']) ? 'has_error' : '' ?>">
                    <label>
                        <span class="label">Grootte:</span>
                        <select name="grootte" id="">
                            <?php foreach($grootte as $g): ?>
                            <option value="<?= $g ?>" <?= $g === $gekozenGrootte ? 'selected' : '' ?>>
                                <?=$g?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </label>
                    <?php if (isset($errors['grootte'])): ?>
                    <span class="error"><?= $errors['grootte'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="<?= isset($errors['bodem']) ? 'has_error' : '' ?>">
                    <label>
                        <span class="label">Bodem:</span>
                        <select name="bodem" id="">
                            <?php foreach($bodem as $b): ?>
                            <option value="<?= $b ?>" <?= $b === $gekozenBodem ? 'selected' : '' ?>>
                                <?=$b?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </label>
                    <?php if (isset($errors['bodem'])): ?>
                    <span class="error"><?= $errors['bodem'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="<?= isset($errors['korst']) ? 'has_error' : '' ?>">
                    <label>
                        <span class="label">Korst:</span>
                        <select name="korst" id="korst">
                            <?php foreach($korst as $k): ?>
                            <option value="<?= $k ?>" <?= $k === $gekozenKorst ? 'selected' : '' ?>>
                                <?=$k?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </label>
                    <?php if (isset($errors['korst'])): ?>
                    <span class="error"><?= $errors['korst'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="<?= isset($errors['saus']) ? 'has_error' : '' ?>">
                    <span class="label">Saus:</span>
                    <?php foreach($saus as $s): ?>
                    <label>
                        <input type="radio" name="saus" value="<?= $s ?>" <?= $s === $gekozenSaus ? 'checked' : '' ?>>
                        <?=$s?>
                    </label>
                    <?php endforeach ?>
                    <?php if (isset($errors['saus'])): ?>
                    <span class="error"><?= $errors['saus'] ?></span>
                    <?php endif; ?>
                </div>
            </fieldset>
            <fieldset class="<?= isset($errors['toppings']) ? 'has_error' : '' ?>">
                <legend>Toppings</legend>
                <?php foreach($toppings as $topping =>$items): ?>
                <h3><?= $topping ?></h3>
                <?php foreach($items as $item) :?>
                <div>
                    <label>
                        <input <?= in_array($item, $gekozenToppings) ? 'checked' : '' ?> value="<?= $item?>"
                            type="checkbox" name="toppings[]"> <?= $item ?>
                    </label>
                </div>
                <?php endforeach ?>
                <?php endforeach ?>
                <?php if (isset($errors['toppings'])): ?>
                <span class="error"><?= $errors['toppings'] ?></span>
                <?php endif; ?>
            </fieldset>
            <fieldset class="<?= isset($errors['pikant']) ? 'has_error' : '' ?>">
                <legend>Pikant</legend>
                <div>
                    <div class="pikant">
                        <input type="range" name="pikant" min="0" max="10" value="<?= $input['pikant']?>">
                        <div>
                            <span>Niet pikant</span>
                            <span>Heel pikant</span>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset
                class="<?= isset($errors['naam']) || isset($errors['straat']) || isset($errors['email']) || isset($errors['gemeente']) || isset($errors['tel']) || isset($errors) ? 'has_error' : '' ?>">
                <legend>Jouw gegevens</legend>
                <div class="<?= isset($errors['naam']) ? 'has_error' : '' ?>">
                    <label for="naam">Naam</label>
                    <input type="text" name="naam" id="naam" value="<?= $input['naam'] ?>">
                </div>
                <?php if (isset($errors['naam'])): ?>
                <span class="error"><?= $errors['naam'] ?></span>
                <?php endif; ?>
                <div class="<?= isset($errors['straat']) ? 'has_error' : '' ?>">
                    <label for="straat">Straat + Huisnummer</label>
                    <input type="text" name="straat" id="straat" value="<?= $input['straat'] ?>">
                </div>
                <?php if (isset($errors['straat'])): ?>
                <span class="error"><?= $errors['straat'] ?></span>
                <?php endif; ?>
                <div class="<?= isset($errors['gemeente']) ? 'has_error' : '' ?>">
                    <label for="gemeente">Postcode + Gemeente</label>
                    <input type="text" name="gemeente" id="gemeente" value="<?= $input['gemeente'] ?>">
                </div>
                <?php if (isset($errors['gemeente'])): ?>
                <span class="error"><?= $errors['gemeente'] ?></span>
                <?php endif; ?>
                <div class="<?= isset($errors['email']) ? 'has_error' : '' ?>">
                    <label for="email">E-mailadres</label>
                    <input type="text" name="email" id="email" value="<?=$input['email'] ?>">
                </div>
                <?php if (isset($errors['email'])): ?>
                <span class="error"><?= $errors['email'] ?></span>
                <?php endif; ?>
                <div class="<?= isset($errors['tel']) ? 'has_error' : '' ?>">
                    <label for="tel">Telefoonnummer</label>
                    <input type="text" name="tel" id="tel" value="<?=$input['tel'] ?>">
                </div>
                <?php if (isset($errors['tel'])): ?>
                <span class="error"><?= $errors['tel'] ?></span>
                <?php endif; ?>
            </fieldset>

            <input type="submit" value="Bestelling plaatsen" class="submit">
        </form>

        <footer class="footer">
            Met het plaatsen van een bestelling ga je akkoord met de algemene voorwaarden.
        </footer>
    </div>

</body>

</html>