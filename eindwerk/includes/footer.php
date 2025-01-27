<div class="py-12 text-sm text-neutral-500">
    Copyright 2023 -
    <?php if(!isset($_SESSION['user_id'])): ?>
    <a href="aanmelden.php" class="text-blue-500 underline">Aanmelden</a>
    <?php else: ?>
    <a href="afmelden.php" class="text-blue-500 underline">Afmelden</a>
    <?php endif;?>
</div>