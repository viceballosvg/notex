<?php
include('config.php');

$titulo=$_POST['titulo'];
$contenido=$_POST['contenido'];
$inicio=$_POST['inicio'];
$fin=$_POST['fin'];
$autor=($_POST['autor']);
$id=intval($_POST['id']);

//print_r($_POST); exit();

if($id==0)
$sql="INSERT INTO tareas (titulo, contenido, inicio, fin, autor) VALUES(?,?,?,?,?)";
else
$sql="UPDATE tareas SET titulo=?, contenido=?, inicio=?, fin=?, autor=? WHERE id=$id";

$stmt = $DB->prepare($sql);

// Ejecutamos
$stmt->execute(array($titulo, $contenido, $inicio, $fin, $autor));

header('location: ./');

?>