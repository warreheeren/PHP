<?php

require_once('./db.php');

try{
    $stmt = $pdo->query('SELECT * FROM klanten');
    $klanten = $stmt->fetchAll();
    
    $stmt = $pdo->query('SELECT * FROM gemeentes');
    $gemeentes = $stmt->fetchAll();
} catch(PDOException $e){
    die ('Error: ' . $e->getMessage());
}


?>
<h1>Klanten</h1>
<pre>
    <?php  print_r(($klanten))?>
</pre>
<h1>Gemeentes</h1>
<pre>
    <?php  print_r(($gemeentes))?>
</pre>