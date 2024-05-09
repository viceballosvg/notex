<?php

session_start();
date_default_timezone_set('America/Santiago');
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soy el título</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h2>Soy un título</h2>
    <p>Hola <?php 
if(isset($_POST['nombre'])){

echo $_POST['nombre'];
    $_SESSION['nombre']=$_POST['nombre'];

}elseif(isset($_SESSION['nombre'])){

echo $_SESSION['nombre'];

} else
echo 'Invitado';

//echo isset($_GET['nombre'])?$_GET['nombre']:'Invitado';
if(isset($_SESSION['nombre'])) echo ' <a href="cerrar.php" class="btn btn-danger">Cerrar Sesión</a>';
    
    ?>, la hora actual es <?php
    echo date('H:i:s');
    ?></p>
    <p>La fecha actual es: <?php
    echo date('d-m-Y');
    ?> y en 20 días hábiles será: <?php
    echo date('d-m-Y', strtotime('+20 weekdays'));
    ?>, mientras que 20 días corridos son: <?php
    echo date('d-m-Y', strtotime('+20 days'));
    ?></p>
<?php if(!isset($_SESSION['nombre'])) { ?>
    <form action="index_14-03-2024.php" method="post">
<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pon tu nombre poh" autocomplete="on">
<input type="submit" class="btn btn-warning" value="Validarme">
    </form>
<?php } ?>

<h2>Conexión a una API</h2>
<form action="index_14-03-2024.php" method="post" id="form">
    <select name="indicador" id="indicador">
<?php 

$indicador=isset($_POST['indicador'])?$_POST['indicador']:'uf';


$indicadores=[
    'uf'=>'Unidad de Fomento',
    'dolar'=>'Dólar Observado',
    'euro'=>'Euro',
    'utm'=>'Unidad Tributaria Mensual',
    'ivp'=>'Índice Valor Promedio',
    'libra_cobre'=>'Libra de Cobre',
];

foreach($indicadores as $clave=>$valor){
$sel=$clave==$indicador?' selected':'';
echo "<option value=\"$clave\"$sel>$valor</option>";
}
?>
        
    </select>
</form>

<?php 
$resultado=file_get_contents('https://mindicador.cl/api/' . $indicador);
$resultado=json_decode($resultado);

echo '<p>';
echo $resultado->nombre;
echo '</p>';

$serie=$resultado->serie;
//var_dump($resultado);
echo '<div class="container"><div class="row">';
foreach($serie as $dia){
$fecha=$dia->fecha;
$fecha=date('d-m-Y',strtotime($fecha));


$valor=$dia->valor;
$valor=number_format($valor,2,',','.');

echo "<div class=\"col-sm-4\"><div class=\"card mb-3\"><b>$fecha:</b> $valor</div></div>";
}
echo '</div></div>';
?>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
<script>

$(document).ready(function(){

$('#indicador').change(function(){
    $('#form').submit()
})

})


</script>
</body>
</html>