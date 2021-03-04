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

if(filter_input(INPUT_POST, "form", FILTER_SANITIZE_STRING) == 'jugador'){
    $post = filter_input_array(INPUT_POST, $jugadorArgs);
    //var_dump($post);
    if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'crear'){
        insertJugador($jugadores, $bd);
    } else if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'modificar') {
        updateJugador($jugadores, $bd);
    } else if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'eliminar'){
        deleteJugador($jugadores, $bd);
    }
    
} else if (filter_input(INPUT_POST, "form", FILTER_SANITIZE_STRING) == 'campio') {
    $post = filter_input_array(INPUT_POST, $campioArgs);
    //var_dump($post);
    if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'crear'){
        insertCampeon($campeones, $bd); 
    } else if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'modificar') {
        updateCampeon($campeones, $bd);
    } else if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'eliminar'){
        deleteCampeon($campeones, $bd);
    }
    
} else if (filter_input(INPUT_POST, "form", FILTER_SANITIZE_STRING) == 'batalla') {
    $post = filter_input_array(INPUT_POST, $batallaArgs);
    //var_dump($post); 
    if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'crear'){
        insertBatalla($batallas, $bd);
    } else if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'modificar') {
        updateBatalla($batallas, $bd);
    } else if(filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING) == 'eliminar'){
        deleteBatalla($batallas, $bd);
    }
}

//----------------FUNCTION----------------
//----------------FUNCTION----------------
//----------------FUNCTION----------------

function accion( $post, $bd ){

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

function insertJugador($jugadores, $bd){
    global $jugadores;
    global $post;

    $id=$post['id'];
    $nombre=$post['nombre'];
    $nivel=(int)$post['nivel'];
    $fecha=$post['fecha'];

    $query = "INSERT INTO jugador (id, nombre, `nivel`, fecha) VALUES ('$id', '$nombre', '$nivel', '$fecha')";
    $jugadores = new Consulta($query, $bd);
    $bd->x;

}
function insertCampeon($campeones, $bd){
    global $campeones;
    global $post;

    $id=$post['id'];
    $nombre=$post['nombre'];
    $tipo=$post['tipo'];
    $precio=(int)$post['precio'];
    $fecha=$post['fecha'];

    $query = "INSERT INTO campeon (id, nombre, tipo, `precio`, fecha) VALUES ('$id', '$nombre', '$tipo', '$precio', '$fecha')";
    $campeones = new Consulta($query, $bd);
    $bd->x;
}
function insertBatalla($batallas, $bd){
    global $batallas;
    global $post;

    $idJugador=$post['idJ'];
    $idCampeon=$post['idC'];
    $cantidad=(int)$post['cantidad'];

    $query = "INSERT INTO batalla (idJugador, idCampeon, `cantidad`) VALUES ('$idJugador', '$idCampeon', '$cantidad')";
    $batallas = new Consulta($query, $bd);
    $bd->x;
}

//----------------UPDATE FROM BD----------------

function updateJugador($jugadores, $bd){
    global $jugadores;
    global $post;

    $id=$post['id'];
    $nombre=$post['nombre'];
    $nivel=(int)$post['nivel'];
    $fecha=$post['fecha'];

    $query = "UPDATE jugador SET nombre='$nombre', nivel='$nivel', fecha='$fecha' WHERE id=$id";
    $jugadores = new Consulta($query, $bd);
    $bd->x;
}
function updateCampeon($campeones, $bd){
    global $campeones;
    global $post;

    $id=$post['id'];
    $nombre=$post['nombre'];
    $tipo=$post['tipo'];
    $precio=(int)$post['precio'];
    $fecha=$post['fecha'];

    $query = "UPDATE campeon SET nombre='$nombre', tipo='$tipo', precio='$precio', fecha='$fecha' WHERE id=$id";
    $campeones = new Consulta($query, $bd);
    $bd->x;
}
function updateBatalla($batallas, $bd){
    global $batallas;
    global $post;

    $idJugador=$post['idJ'];
    $idCampeon=$post['idC'];
    $cantidad=(int)$post['cantidad'];
    // al dar id
    $query = "UPDATE batalla SET cantidad='$cantidad' WHERE idJugador='$idJugador' AND idCampeon='$idCampeon'";
    $batallas = new Consulta($query, $bd);
    $bd->x;
}

//----------------DELETE FROM BD----------------

function deleteJugador($jugadores, $bd){
    global $jugadores;
    global $post;

    $id=$post['id'];

    $query = "DELETE FROM jugador WHERE id=$id";
    $jugadores = new Consulta($query, $bd);
    $bd->x;
}
function deleteCampeon($campeones, $bd){
    global $jugadores;
    global $post;

    $id=$post['id'];

    $query = "DELETE FROM campeon WHERE id=$id";
    $campeones = new Consulta($query, $bd);
    $bd->x;
}
function deleteBatalla($batallas, $bd){
    global $jugadores;
    global $post;

    $idJugador=$post['idJ'];
    $idCampeon=$post['idC'];

    $query = "DELETE FROM batalla WHERE idJugador='$idJugador' AND idCampeon='$idCampeon'";
    $batallas = new Consulta($query, $bd);
    $bd->x;
}

//$conectmysql = new MySQL($usuario, $contrasena, $servidor, $bd);
//$query = "SELECT * FROM jugador";
//$consulta = new Consulta($query, $conectmysql);
//for ($i = 0; $i < $consulta->numFilasObtenidas; $i++)
//    echo $consulta->tablaResultados[$i]->nombre."\n";

?>