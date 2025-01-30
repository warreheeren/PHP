<div class="font-semibold">Gegevens</div>

<div>
    <div>
        <label class="text-neutral-500 italic text-sm" for="naam">Naam:</label>
        <input class="w-full bg-neutral-100 p-2 block" type="text" name="naam" id="naam" value="<?= $naam ?>">
    </div>
    <?php if (isset($errors['naam'])): ?>
    <span class="text-red-500 text-sm"><?= $errors['naam'] ?></span>
    <?php endif; ?>
</div>

<div>
    <div>
        <label class="text-neutral-500 italic text-sm" for="email">email:</label>
        <input class="w-full bg-neutral-100 p-2 block" type="text" name="email" id="email" value="<?= $email?>">
    </div>
    <?php if (isset($errors['email'])): ?>
    <span class="text-red-500 text-sm"><?= $errors['email'] ?></span>
    <?php endif; ?>
</div>


<div class="font-semibold">Adres</div>

<div>
    <div>
        <label class="text-neutral-500 italic text-sm" for="adres">Straat + Huisnummer</label>
        <input class="w-full bg-neutral-100 p-2 block" type="text" name="adres" id="adres" value="<?= $adres?>">
    </div>
    <?php if (isset($errors['adres'])): ?>
    <span class="text-red-500 text-sm"><?= $errors['adres'] ?></span>
    <?php endif; ?>
</div>

<div>
    <div>
        <div>
            <label class="text-neutral-500 italic text-sm" for="gemeente">Gemeente</label>
            <select name="gemeente" id="gemeente" class="w-full bg-neutral-100 p-2 block">
                <option disabled value="">-- Kies een gemeente</option>
                <option value="3960<?= isset($gemeente) && $gemeente == '3960' ? 'selected' : '' ?>">3960 - Bree
                </option>
                <option value="3550" <?= isset($gemeente) && $gemeente == '3550' ? 'selected' : '' ?>>3550 -
                    Heusden-Zolder</option>
            </select>
        </div>
        <?php if (isset($errors['gemeente'])): ?>
        <span class="text-red-500 text-sm"><?= $errors['gemeente'] ?></span>
        <?php endif; ?>
    </div>
</div>

<div class="font-semibold">Bijkomend</div>

<div>
    <div>
        <label class="text-neutral-500 italic text-sm" for="aantal">Aantal</label>
        <input class="w-full bg-neutral-100 p-2 block" type="text" name="aantal" id="aantal" value="<?= $aantal?>">
    </div>
    <?php if (isset($errors['aantal'])): ?>
    <span class="text-red-500 text-sm"><?= $errors['aantal'] ?></span>
    <?php endif; ?>
</div>

<div>
    <div>
        <div>
            <input name="voorwaarden" type="checkbox" id="voorwaarden" class="" value="<?= $voorwaarden?>">
            <label for="aantal">Ik plaats mijn bestelling en ik ga akkoord met de voorwaarden.</label>
        </div>
        <?php if (isset($errors['voorwaarden'])): ?>
        <span class="text-red-500 text-sm"><?= $errors['voorwaarden'] ?></span>
        <?php endif; ?>
    </div>
</div>