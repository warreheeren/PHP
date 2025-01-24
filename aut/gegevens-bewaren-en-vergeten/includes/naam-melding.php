<?php include_once './includes/init.php';
 if(isset($_SESSION['name'])): ?>
<div>
    Hallo <?=$_SESSION['name']?>! Welkom op deze website.
</div>
<?php else: ?>
<div>
    Je hebt nog geen naam ingegeven. <a href="index.php">Geef je naam in.</a>
</div>
<?php endif; ?>