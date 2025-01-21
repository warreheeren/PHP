<?php
$host = "localhost";
$dbName ="relaties";
$username = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$dbName";

$options = [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try{
    $pdo = new PDO($dsn,$username,$password,$options);
}catch(PDOException $e){
    die("Connection failed" . $e->getMessage());
}