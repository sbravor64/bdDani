<?php

include("MySQL.php");
include("consulta.php");

//----------------CONNECT BD----------------

$bd = new MySQL("admin", "admin", "192.168.1.80", "campions");

//----------------VARIABLES EXTERNAS----------------
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

function action($post, $bd){
    global $jugadorArgs; global $batallaArgs; global $campioArgs;
    if($_POST["form"] == "jugador"){
        $post = filter_input_array(INPUT_POST, $jugadorArgs);

        if($_POST["accion"] == 'crear') insertJugador($post, $bd);
        else if($_POST["accion"] == 'modificar') updateJugador($post, $bd);
        else if($_POST["accion"] == 'eliminar') deleteJugador($post, $bd);

    } else if ($_POST["form"] == 'campio') {
        $post = filter_input_array(INPUT_POST, $campioArgs);

        if($_POST["accion"] == 'crear') insertCampeon($post, $bd); 
        else if($_POST["accion"] == 'modificar') updateCampeon($post, $bd);
        else if($_POST["accion"] == 'eliminar') deleteCampeon($post, $bd);

    } else if ($_POST["form"] == 'batalla') {
        $post = filter_input_array(INPUT_POST, $batallaArgs);

        if($_POST["accion"] == 'crear') insertBatalla($post, $bd);
        else if($_POST["accion"] == 'modificar') updateBatalla($post, $bd);
        else if($_POST["accion"] == 'eliminar') deleteBatalla($post, $bd);

    }
}

//----------------GET ALL----------------

function getAllJugadores($bd){
    $query = "SELECT * FROM jugador";
    return new Consulta($query, $bd);
}

function getAllBatallas($bd){
    $query = "SELECT * FROM batalla";
    return new Consulta($query, $bd);
}

function getAllCampeones($bd){
    global $campeones;
    $query = "SELECT * FROM campeon";
    return new Consulta($query, $bd);
}

//----------------INSERT FROM BD----------------

function insertJugador($j, $bd){
    $id=$j['id'];
    $nombre=$j['nombre'];
    $nivel=(int)$j['nivel'];
    $fecha=$j['fecha'];

    $query = "INSERT INTO jugador (id, nombre, nivel, fecha) VALUES ('$id', '$nombre', '$nivel', '$fecha')";
    consulta($query, $bd);
}
function insertCampeon($c, $bd){
    $id=$c['id'];
    $nombre=$c['nombre'];
    $tipo=$c['tipo'];
    $precio=(int)$c['precio'];
    $fecha=$c['fecha'];

    $query = "INSERT INTO campeon (id, nombre, tipo, precio, fecha) VALUES ('$id', '$nombre', '$tipo', '$precio', '$fecha')";
    consulta($query, $bd);
}
function insertBatalla($b, $bd){
    $idJugador=$b['idJ'];
    $idCampeon=$b['idC'];
    $cantidad=(int)$b['cantidad'];

    $query = "INSERT INTO batalla (idJugador, idCampeon, cantidad) VALUES ('$idJugador', '$idCampeon', '$cantidad')";
    consulta($query, $bd);
}

//----------------UPDATE FROM BD----------------

function updateJugador($j, $bd){
    $id=$j['id'];
    $nombre=$j['nombre'];
    $nivel=(int)$j['nivel'];
    $fecha=$j['fecha'];

    $query = "UPDATE jugador SET nombre='$nombre', nivel='$nivel', fecha='$fecha' WHERE id=$id";
    consulta($query, $bd);
}
function updateCampeon($c, $bd){
    $id=$c['id'];
    $nombre=$c['nombre'];
    $tipo=$c['tipo'];
    $precio=(int)$c['precio'];
    $fecha=$c['fecha'];

    $query = "UPDATE campeon SET nombre='$nombre', tipo='$tipo', precio='$precio', fecha='$fecha' WHERE id=$id";
    consulta($query, $bd);
}
function updateBatalla($b, $bd){
    $idJugador=$b['idJ'];
    $idCampeon=$b['idC'];
    $cantidad=(int)$b['cantidad'];
    
    $query = "UPDATE batalla SET cantidad='$cantidad' WHERE idJugador='$idJugador' AND idCampeon='$idCampeon'";
    consulta($query, $bd);
}

//----------------DELETE FROM BD----------------

function deleteJugador($j, $bd){
    $id=$j['id'];

    $query = "DELETE FROM jugador WHERE id=$id";
    consulta($query, $bd);
}
function deleteCampeon($c, $bd){
    $id=$c['id'];

    $query = "DELETE FROM campeon WHERE id=$id";
    consulta($query, $bd);
}
function deleteBatalla($b, $bd){
    $idJugador=$b['idJ'];
    $idCampeon=$b['idC'];

    $query = "DELETE FROM batalla WHERE idJugador='$idJugador' AND idCampeon='$idCampeon'";
    consulta($query, $bd);
}


//---------------CONSULTA-----------------
function consulta($query, $bd){
    $consulta = new Consulta($query, $bd);
    $bd->x;
}

?>