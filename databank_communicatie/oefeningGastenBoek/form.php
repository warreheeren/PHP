<?php 
 $stmt = $pdo->query('SELECT * FROM hotels');
 $hotels = $stmt->fetchAll();
?>

<div>
    <label for="naam" class="text-gray-500 font-semibold">Wat is je naam?</label>
    <div>
        <input type="text" name="naam" id="naam" class="block bg-gray-200 p-2 w-full border border-neutral-400"
            value="<?= $naam ?>">
    </div>
    <?php if(isset($errors['naam'])): ?>
    <span class="text-red-500 text-sm">Naam is verplicht in te vullen.</span>
    <?php endif ?>
</div>
<div>
    <label for="hotel" class="text-gray-500 font-semibold">Waar verbleef je?</label>
    <div>
        <select name="hotel_id" id="hotel" class="block w-full p-2 border border-neutral-400">
            <?php foreach($hotels as $h): ?>
            <option <?= ($hotel_id == $h['id']) ? 'selected' : '' ?> value="<?=$h['id']?>"><?=$h['naam']?>
            </option>
            <?php endforeach ?>
        </select>
    </div>
</div>
<div>
    <label for="beschrijving" class="text-gray-500 font-semibold">Wat was je ervaring?</label>
    <div>
        <textarea placeholder="..." name="beschrijving" id="beschrijving"
            class="block bg-gray-200 p-2 w-full border border-neutral-400"><?= $beschrijving ?></textarea>
    </div>
    <?php if(isset($errors['beschrijving'])): ?>
    <span class="text-red-500 text-sm"><?= $errors['beschrijving'] ?></span>
    <?php endif ?>
</div>
<div>
    <label for="score" class="text-gray-500 font-semibold">Welke score geef je?</label>
    <div>
        <select name="score" id="score" class="block w-full p-2 border border-neutral-400">
            <option <?= ($score == 1) ? 'selected' : '' ?> value="1">★</option>
            <option <?= ($score == 2) ? 'selected' : '' ?> value="2">★★</option>
            <option <?= ($score == 3) ? 'selected' : '' ?> value="3">★★★</option>
            <option <?= ($score == 4) ? 'selected' : '' ?> value="4">★★★★</option>
            <option <?= ($score == 5) ? 'selected' : '' ?> value="5">★★★★★</option>
        </select>
    </div>
</div>