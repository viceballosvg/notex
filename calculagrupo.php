<?php
$gente=filter_var($_POST['gente'], FILTER_SANITIZE_STRING);
$temas=filter_var($_POST['temas'], FILTER_SANITIZE_STRING);
//$cantidad=intval($_POST['cantidad']);



$gente=explode("\n",trim($gente));
$temas=explode("\n",trim($temas));



$cantidad=count($temas);

$totalpersonas=count($gente);

$cuantagente=ceil($totalpersonas/$cantidad);

//var_dump($gente);

shuffle($gente);
shuffle($temas);
shuffle($gente);
shuffle($temas);
shuffle($gente);
shuffle($temas);

$premiado=mt_rand(0,$cantidad-1);
$castigado=mt_rand(0,$cantidad-1);

$grupos=array_chunk($gente,$cuantagente,false);

echo "<p>Cantidad: $cantidad | Premiado: $premiado | Castigado: $castigado</p>";

foreach($grupos as $k=>$gente){
    $i=$k+1;
    $tema=$temas[$k];
$premio=$k==$premiado?'<i class="fa-solid fa-star text-warning"></i> ':'';
$castigo=$k==$castigado?'<i class="fa-solid fa-skull text-danger"></i> ':'';

    echo "<h4>$premio$castigo Grupo $i: $tema</h4>";
echo '<ul>';
foreach($gente as $persona){
echo "<li>$persona</li>";
}
echo '</ul>';
}

?>