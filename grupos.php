<?php //  vg
include('config.php');

?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soy el título</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php 
$activo='grupos';
include('menu.php'); 

?>

<h3 class="text-primary">Gestor de Grupos</h3>
    <div class="container">
        <div class="row">
<div class="col-sm-6">

<div class="row">
<div class="col-sm-6">
<label class="h4 text-info">Gente a repartir</label>
<textarea name="gente" id="gente" rows="15" class="form-control"></textarea></div>
<div class="col-sm-6">
<label class="h4 text-success">Temas a repartir</label>
<textarea name="temas" id="temas" rows="15" class="form-control"></textarea></div>
</div>


<?php /*<div class="mt-3">
  <label for="cantidad" class="form-label">Grupos a Crear</label>
  <input type="number" class="form-control" id="cantidad" value="1" step="1" min="1" max="99">
</div>*/ ?>
<div class="d-grid gap-2 d-block mt-4">
<button type="button" id="crear" class="btn btn-lg btn-primary"><i class="fa-solid fa-arrow-down-1-9"></i> Crear Grupos</button>
</div>
</div>
<div class="col-sm-6" id="contenidod">Ingresa una lista de personas y elige cuántos grupos quieres crear</div>

        </div>
   </div>




   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
<script>

$(document).ready(function(){

$('#crear').click(function(){
    $('#contenidod').html('<center class="text-primary mt-5"><i class="fas fa-spinner fa-fw fa-spin" style="--fa-animation-duration: 3s;"></i> Repartiendo Grupos...</center>')

    let gente=$('#gente').val()
    let temas=$('#temas').val()

    $.post('calculagrupo.php',{gente:gente,temas:temas},function(data){
$('#contenidod').hide().html(data).slideDown()
    })
})

})


</script>
</body>
</html>