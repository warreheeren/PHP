<?php

include './includes/init.php';
unset($_SESSION['name']);
session_destroy();
print_r($_SESSION);
header('Location: index.php');
exit();
?>