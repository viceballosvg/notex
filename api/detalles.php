<?php
include('../config.php');


if(!isset($_POST['id'])) exit();

$id=intval($_POST['id']);


$stmt = $DB->prepare("SELECT * FROM tareas WHERE id=?");
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmt->execute(array($id));
// Mostramos los resultados
$row = $stmt->fetch();



if($row){

$row['inicio']=date('Y-m-d H:i',strtotime($row['inicio']));
$row['fin']=date('Y-m-d H:i',strtotime($row['fin']));

echo json_encode($row);
}else 
echo '{"error":"No encontrado"}';


?>