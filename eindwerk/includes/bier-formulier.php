
<div>
    <label for="naam">Naam:</label>
    <input name="name" type="text" id="naam" class="w-full bg-neutral-100 p-2 block">
    <?php if (isset($foutmeldingen['naam'])): ?>
    <span class="text-red-500 text-sm"><?php echo $foutmeldingen['error'] ?></span>
    <?php endif ?>

</div>

<div>
    <label for="beschrijving">Korte beschrijving:</label>
    <input name="description" type="text" id="beschrijving" class="w-full bg-neutral-100 p-2 block">
    <?php if (isset($foutmeldingen['beschrijving'])): ?>
    <span class="text-red-500 text-sm"><?php echo $foutmeldingen['error'] ?></span>
    <?php endif ?>

</div>

<div>
    <label for="brouwerij">Brouwerij:</label>
    <select name="brewery_id" id="brewery" class="block w-full p-2 border border-neutral-400">
        <?php foreach($beers as $beer): ?>
        <option
            <?php if (isset($_POST['brewery_id']) && $_POST['brewery_id'] == $beer['brewery_id']) { echo 'selected'; } ?>
            value="<?php echo $beer['brewery_id'] ?>"><?php echo $beer['brewery_name'] ?></option>
        <?php endforeach ?>
    </select>
    <?php if (isset($foutmeldingen['brouwerij'])): ?>
    <span class="text-red-500 text-sm"><?php echo $foutmeldingen['error'] ?></span>
    <?php endif ?>
</div>

<div>
    <label for="stock">Stock:</label>
    <input name="stock" min=0 type="number" id="stock" class="w-full bg-neutral-100 p-2 block">
    <?php if (isset($foutmeldingen['stock'])): ?>
    <span class="text-red-500 text-sm"><?php echo $foutmeldingen['error'] ?></span>
    <?php endif ?>
</div>

<div>
    <label for="prijs">Prijs:</label>
    <input name="price" min=0 type="number" id="prijs" class="w-full bg-neutral-100 p-2 block">
    <?php if (isset($foutmeldingen['price'])): ?>
    <span class="text-red-500 text-sm"><?php echo $foutmeldingen['error'] ?></span>
    <?php endif ?>
</div>