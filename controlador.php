<?php

include("MySQL.php");
include("consulta.php");

//----------------CONNECT BD----------------

$bd = new MySQL("admin", "admin", "localhost", "campions");

//----------------VARIABLES EXTERNAS----------------

$jugadores; $batallas; $campeones;
$post;

//----------------ARRAYS PARA LOS POST----------------

$jugadorArgs = array(
    'id'        => FILTER_SANITIZE_ENCODED,
    'nombre'    => FILTER_SANITIZE_ENCODED,
    'nivel'     => FILTER_SANITIZE_ENCODED,
    'fecha'     => FILTER_SANITIZE_ENCODED,
);

$campioArgs = array(
    'id'        => FILTER_SANITIZE_ENCODED,
    'nombre'    => FILTER_SANITIZE_ENCODED,
    'tipo'      => FILTER_SANITIZE_ENCODED,
    'precio'    => FILTER_SANITIZE_ENCODED,
    'fecha'     => FILTER_SANITIZE_ENCODED,
);

$batallaArgs = array(
    'idJ'        => FILTER_SANITIZE_ENCODED,
    'idC'        => FILTER_SANITIZE_ENCODED,
    'cantidad'   => FILTER_SANITIZE_ENCODED,
);



//----------------CONDICIONALES----------------

if(!empty($_POST)){
    action($post, $bd);
}

//----------------FUNCTION----------------
//----------------FUNCTION----------------
//----------------FUNCTION----------------

if(filter_input(INPUT_POST, "form", FILTER_SANITIZE_STRING) == 'jugador'){ $post = filter_input_array(INPUT_POST, $jugadorArgs);
    if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'crear') insertJugador($post, $bd);
    else if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'modificar') updateJugador($post, $bd);
    else if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'eliminar') deleteJugador($post, $bd);
} else if (filter_input(INPUT_POST, "form", FILTER_SANITIZE_STRING) == 'campio') {
    $post = filter_input_array(INPUT_POST, $campioArgs);
    if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'crear') insertCampeon($post, $bd); 
    else if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'modificar') updateCampeon($post, $bd);
    else if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'eliminar') deleteCampeon($post, $bd);
} else if (filter_input(INPUT_POST, "form", FILTER_SANITIZE_STRING) == 'batalla') { $post = filter_input_array(INPUT_POST, $batallaArgs);
    if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'crear') insertBatalla($post, $bd);
    else if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'modificar') updateBatalla($post, $bd);
    else if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'eliminar') deleteBatalla($post, $bd);
}

function action($post, $bd){
    echo "hola";
}

//----------------GET ALL----------------

function getAllJugadores($bd){
    global $jugadores;
    $query = "SELECT * FROM jugador";
    $jugadores = new Consulta($query, $bd);
}

function getAllBatallas($bd){
    global $batallas;
    $query = "SELECT * FROM batalla";
    $batallas = new Consulta($query, $bd);
}

function getAllCampeones($bd){
    global $campeones;
    $query = "SELECT * FROM campeon";
    $campeones = new Consulta($query, $bd);
}

//----------------INSERT FROM BD----------------

function insertJugador($j, $bd){
    $id=$j['id'];
    $nombre=$j['nombre'];
    $nivel=(int)$j['nivel'];
    $fecha=$j['fecha'];

    $query = "INSERT INTO jugador (id, nombre, `nivel`, fecha) VALUES ('$id', '$nombre', '$nivel', '$fecha')";
    $j = new Consulta($query, $bd);
    $bd->x;

}
function insertCampeon($c, $bd){
    $id=$c['id'];
    $nombre=$c['nombre'];
    $tipo=$c['tipo'];
    $precio=(int)$c['precio'];
    $fecha=$c['fecha'];

    $query = "INSERT INTO campeon (id, nombre, tipo, `precio`, fecha) VALUES ('$id', '$nombre', '$tipo', '$precio', '$fecha')";
    $c = new Consulta($query, $bd);
    $bd->x;
}
function insertBatalla($b, $bd){
    $idJugador=$b['idJ'];
    $idCampeon=$b['idC'];
    $cantidad=(int)$b['cantidad'];

    $query = "INSERT INTO batalla (idJugador, idCampeon, `cantidad`) VALUES ('$idJugador', '$idCampeon', '$cantidad')";
    $b = new Consulta($query, $bd);
    $bd->x;
}

//----------------UPDATE FROM BD----------------

function updateJugador($j, $bd){
    $id=$j['id'];
    $nombre=$j['nombre'];
    $nivel=(int)$j['nivel'];
    $fecha=$j['fecha'];

    $query = "UPDATE jugador SET nombre='$nombre', nivel='$nivel', fecha='$fecha' WHERE id=$id";
    $j = new Consulta($query, $bd);
    $bd->x;
}
function updateCampeon($c, $bd){
    $id=$c['id'];
    $nombre=$c['nombre'];
    $tipo=$c['tipo'];
    $precio=(int)$c['precio'];
    $fecha=$c['fecha'];

    $query = "UPDATE campeon SET nombre='$nombre', tipo='$tipo', precio='$precio', fecha='$fecha' WHERE id=$id";
    $c = new Consulta($query, $bd);
    $bd->x;
}
function updateBatalla($b, $bd){
    $idJugador=$b['idJ'];
    $idCampeon=$b['idC'];
    $cantidad=(int)$b['cantidad'];
    // al dar id
    $query = "UPDATE batalla SET cantidad='$cantidad' WHERE idJugador='$idJugador' AND idCampeon='$idCampeon'";
    $batallas = new Consulta($query, $bd);
    $bd->x;
}

//----------------DELETE FROM BD----------------

function deleteJugador($j, $bd){
    $id=$j['id'];

    $query = "DELETE FROM jugador WHERE id=$id";
    $j = new Consulta($query, $bd);
    $bd->x;
}
function deleteCampeon($c, $bd){
    $id=$c['id'];

    $query = "DELETE FROM campeon WHERE id=$id";
    $c = new Consulta($query, $bd);
    $bd->x;
}
function deleteBatalla($b, $bd){
    $idJugador=$b['idJ'];
    $idCampeon=$b['idC'];

    $query = "DELETE FROM batalla WHERE idJugador='$idJugador' AND idCampeon='$idCampeon'";
    $b = new Consulta($query, $bd);
    $bd->x;
}

//$conectmysql = new MySQL($usuario, $contrasena, $servidor, $bd);
//$query = "SELECT * FROM jugador";
//$consulta = new Consulta($query, $conectmysql);
//for ($i = 0; $i < $consulta->numFilasObtenidas; $i++)
//    echo $consulta->tablaResultados[$i]->nombre."\n";

?>