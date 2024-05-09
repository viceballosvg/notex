<?php
session_start();
date_default_timezone_set('America/Santiago');

$user='vg';
$password='FkmPWeL!L_JvoZfY';
$dbname='tareas';

// Con un array de opciones
try {
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    $DB = new PDO($dsn, $user, $password);
   } catch (PDOException $e){
    echo $e->getMessage();
   }
   // Con un el método PDO::setAttribute
   try {
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $DB = new PDO($dsn, $user, $password);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $e){
    echo $e->getMessage();
}
?>