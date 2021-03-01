<?php

include("MySQL.php");
include("consulta.php");

$usuario = "admin";
$contrasena = "admin"; 
$servidor = "localhost";
$bd = "campions";

$conectmysql = new MySQL($usuario, $contrasena, $servidor, $bd);

$query = "SELECT * FROM jugador";
$consulta = new Consulta($query, $conectmysql);
    
for ($i = 0; $i < $consulta->numFilasObtenidas; $i++)
    echo $consulta->tablaResultados[$i]->nombre."\n";

$conectmysql->x;

?>