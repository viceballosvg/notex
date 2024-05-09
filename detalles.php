<?php
include('config.php');

function fecha($a) {

    $a=date('d-m-Y \a \l\a\s H:i:s' , strtotime($a));
    return $a;
}


//sleep(1);

if(!isset($_POST['id'])) exit();

$id=intval($_POST['id']);

$stmt = $DB->prepare("SELECT * FROM tareas WHERE id=?");
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmt->execute(array($id));
// Mostramos los resultados
$row = $stmt->fetch();

$titulo=$row['titulo'];
$id=$row['id'];
$contenido=$row['contenido'];
$inicio=$row['inicio'];
$fin=$row['fin'];
$autor=$row['autor'];
$estado=$row['estado'];
?>
<h1 class="text-primary"><?php echo $titulo; ?></h1>
<div class="card p-3 mb-3">
<?php echo $contenido; ?>

</div>
<div class="card p-3 bg-dark small text-white">
<b>Inicio:</b> <?php echo fecha($inicio); ?><br>
<b>Fin:</b> <?php echo fecha($fin); ?><br>
<b>Autor:</b> <?php echo ($autor); ?>
</div>

<div class="row">
<div class="col-sm-6">
<button type="button" class="btn btn-primary mt-4" onclick="editar(<?php echo $id; ?>)"><i class="fa-solid fa-file-pen"></i> Editar</button>
<?php if ($estado==1){ ?>
<button type="button" class="btn btn-danger mt-4" onclick="eliminar(<?php echo $id; ?>,0)"><i class="fa-regular fa-trash-can"></i> Eliminar</button>
<?php } 
if ($estado==0) {
?>
<button type="button" class="btn btn-success mt-4" onclick="eliminar(<?php echo $id; ?>,1)"><i class="fa-regular fa-trash-can"></i> Restaurar</button>

<button type="button" class="btn btn-danger mt-4" onclick="eliminar(<?php echo $id; ?>,2)"><i class="fa-regular fa-trash-can"></i> Eliminar Definitivamente</button>
<?php } ?>
    </div>
    
</div>