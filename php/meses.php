<?php
$meses = array("","ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
$mes = array();
$year = date("Y-m-01");



for ($i = 0;$i<=11;$i++){
    $mes[$i] = date("n-Y",strtotime($year."+ $i month"));
    $div = explode("-",$mes[$i]);
    $mes[$i] = $meses[$div[0]]." ".$div[1];
}

$mes[12] = date("n-Y",strtotime($year."- 1 month"));
$div = explode("-",$mes[12]);
$mes[12] = $meses[$div[0]]." ".$div[1];

$mes[13] = date("n-Y",strtotime($year."- 2 month"));
$div = explode("-",$mes[13]);
$mes[13] = $meses[$div[0]]." ".$div[1];
   
