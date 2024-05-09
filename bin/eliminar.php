<?php
include('../config.php');


if(!isset($_POST['id'])) exit();

$id=intval($_POST['id']);
$a=intval($_POST['a']);

if($a==2)
$sql="DELETE FROM tareas WHERE id=?";
else
$sql="UPDATE tareas SET estado=$a WHERE id=?";

$stmt = $DB->prepare($sql);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmt->execute(array($id));
// Mostramos los resultados

echo 'ok';


?>