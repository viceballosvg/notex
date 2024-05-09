<?php //  vg
include('config.php');

?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soy el títul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php 
$activo='tareas';

$papelera=isset($_GET['papelera']);


include('menu.php'); ?>
<h3 class="text-primary">Gestor de Tareas 
  <?php if(!$papelera){ ?>
  <a href="./?papelera" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i> Ver Papelera</a>
  <?php } else { ?>
  <a href="./" class="btn btn-success"><i class="fa-solid fa-list"></i> Ver Todos</a>
  <?php } ?>
</h3>
    <div class="container">
        <div class="row">
<div class="col-sm-4">
<div class="list-group listado">
<?php
// FETCH_ASSOC

if($papelera)
$sql="SELECT * FROM tareas WHERE estado=0";
else
$sql="SELECT * FROM tareas WHERE estado=1";

if(isset($_POST['q']) && trim($_POST['q'])!=''){
$q=filter_var($_POST['q'], FILTER_SANITIZE_STRING);
$q=trim($q);
$sql .= " AND (titulo like '%$q%' OR contenido LIKE '%$q%')";
}


$stmt = $DB->prepare($sql);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmt->execute();
// Mostramos los resultados
$i=0;
while ($row = $stmt->fetch()){
  $i++;
$titulo=$row['titulo'];
$id=$row['id'];
echo "<a href=\"#\" class=\"list-group-item list-group-item-action\" tid=\"$id\">$titulo</a>";
}
//
if($i==0){
  if(isset($q)) 
  echo "<p class='text-danger'>No se han encontrado resultados.<p>";
  else
echo "<p class='text-danger'>No se hay notas que mostrar.<p>";
}
?>
<button type="button" id="agregar" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#agregartarea" onclick="limpiar()">+</button>
</div></div>
<div class="col-sm-8" id="contenidod">Selecciona una tarea para ver sus detalles</div>

        </div>
   </div>

<!-- Modal -->
        <form action="guardar.php" method="post">
          <input type="hidden" name="id" id="id" value="0">
<div class="modal fade" id="agregartarea" tabindex="-1" aria-labelledby="agregartarea" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Agregar Nueva Tarea</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="mb-3">
  <label for="titulo" class="form-label">Título</label>
  <input type="text" class="form-control" name="titulo" placeholder="Título de la Tarea">
</div>
<div class="mb-3">
  <label for="contenido" class="form-label">Contenido</label>
  <textarea class="form-control" id="contenido"  name="contenido" rows="3"></textarea>
</div>

<div class="mb-3">
  <label for="contenido" class="form-label">Inicio</label>
 <input type="datetime-local" class="form-control" name="inicio" placeholder="Fecha y Hora Inicio" value="<?php echo date('Y-m-d\TH:i');?>">
</div>
<div class="mb-3">
  <label for="contenido" class="form-label">Fin</label>
 <input type="datetime-local" class="form-control" name="fin" placeholder="Fecha y Hora Fin" value="<?php echo date('Y-m-d\TH:i' , strtotime('+1 hour'));?>">
</div>

<div class="mb-3">
  <label for="autor" class="form-label">Autor</label>
  <input type="text" class="form-control" name="autor" placeholder="Autor de la Tarea">
</div>

       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
 </form>

   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
<script>

  function eliminar(id,a){
let frase=''
let frase2=''
    switch(a){
      case 0:
frase='¿Tay seguro de echarte este registro?'
frase2='Eliminación exitosa'
        break
      case 1:
frase='¿Seguro de restaurar?'
frase2='Restauración exitosa'
        break
      case 2:
frase='¿Seguro de ELIMINAR DEFINITIVAMENTE? Esta acción no puede deshacerse'
frase2='Eliminación Completa, exitosa'
        break
    }

if(confirm(frase)){
  $.post('bin/eliminar.php',{id:id,a:a},function(data){

if(data=='ok'){
  alert(frase2)
  location.href='./'
} else {
  alert('Hubo un error: ' + data)
}

  })
}

  }

  function limpiar(){
    $('#exampleModalLabel').html('Agregar Tarea')
$('input[name="titulo"]').val('')
$('textarea[name="contenido"]').val('')
$('input[name="inicio"]').val('')
$('input[name="fin"]').val('')
$('input[name="autor"]').val('')
$('#id').val(0)
  }

  function editar(id){

    $.post('bin/detalles.php',{id:id},function(data){
console.log(data)

if(data.error){
  alert('Error: ' + data.error)
  return false
}

$('#exampleModalLabel').html('Editar Tarea')
$('input[name="titulo"]').val(data.titulo)
$('textarea[name="contenido"]').val(data.contenido)
$('input[name="inicio"]').val(data.inicio)
$('input[name="fin"]').val(data.fin)
$('input[name="autor"]').val(data.autor)
$('#id').val(data.id)

const modal = new bootstrap.Modal('#agregartarea', {
  keyboard: false
})

modal.show()

    },'json')

  }

$(document).ready(function(){

$('.listado a').click(function(){
    var el=$(this)
    let id=el.attr('tid')
    $('#contenidod').html('<center class="text-primary mt-5"><i class="fas fa-spinner fa-fw fa-spin" style="--fa-animation-duration: 3s;"></i> Cargando...</center>')

    /*$.post('detalles.php',{id:id},function(data){
$('#contenidod').hide().html(data).slideDown()
    })*/

    $.post('bin/detalles.php',{id:id},function(data){
console.log(data)

var txt='<h1 class="text-primary">'+data.titulo+'</h1>'
txt+='<div class="card p-3 mb-3">'+data.contenido+'</div>'
txt+='<div class="card p-3 bg-dark small text-white">'
txt+='<b>Inicio:</b> '+data.inicio+'<br>'
txt+='<b>Fin:</b> '+data.fin+'<br>'
txt+='<b>Autor:</b> '+data.autor+'</div>'

txt+='<div class="row"><div class="col-sm-6"><button type="button" class="btn btn-primary mt-4" onclick="editar('+data.id+')"><i class="fa-solid fa-file-pen"></i> Editar</button>'

if(data.estado==1){
txt+=' <button type="button" class="btn btn-danger mt-4" onclick="eliminar('+data.id+',0)"><i class="fa-regular fa-trash-can"></i> Eliminar</button>'
}

if(data.estado==0){
txt+=' <button type="button" class="btn btn-success mt-4" onclick="eliminar('+data.id+',1)"><i class="fa-regular fa-trash-can"></i> Restaurar</button>'

txt+=' <button type="button" class="btn btn-danger mt-4" onclick="eliminar('+data.id+',2)"><i class="fa-regular fa-trash-can"></i> Eliminar Definitivamente</button>'
}
txt+='</div></div>'



$('#contenidod').hide().html(txt).slideDown()

    },'json')
})

})


</script>
</body>
</html>