<?php foreach ($entries as $entry) {
 if ($entry['stock'] <= 5) { 
    $bestellen[]=$entry; }
}
?>
<?php if (isset($_SESSION['user_id'])): ?>
<?php if(!empty($bestellen)): ?>
<div class="text-orange-500 mb-6">
    Je moet de volgende bieren bijbestellen:
    <ul>
        <?php foreach ($bestellen as $bier): ?>
        <li><?= $bier['name'] ?> (Voorraad: <?= $bier['stock'] ?>)</li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<div class="mt-4 mb-12 flex gap-4">
    <a href="bier-toevoegen.php" class="text-blue-500 underline">Nieuw bier toevoegen</a>
    <a href="orders-beheren.php" class="text-blue-500 underline">Orders beheren</a>
</div>
<?php endif; ?>