<?php

include("MySQL.php");
include("consulta.php");

$bd = new MySQL("admin", "admin", "localhost", "campions");

$initargs = array(
    'form'      => FILTER_SANITIZE_ENCODED,
);

$jugadorArgs = array(
    'id'        => FILTER_SANITIZE_ENCODED,
    'nombre'    => FILTER_SANITIZE_ENCODED,
    'nivel'     => FILTER_SANITIZE_ENCODED,
    'fecha'     => FILTER_SANITIZE_ENCODED,
);

$campioArgs = array(
    'id'        => FILTER_SANITIZE_ENCODED,
    'nombre'    => FILTER_SANITIZE_ENCODED,
    'tipo'     => FILTER_SANITIZE_ENCODED,
    'precio'     => FILTER_SANITIZE_ENCODED,
    'fecha'     => FILTER_SANITIZE_ENCODED,
);

$batallaArgs = array(
    'idJ'        => FILTER_SANITIZE_ENCODED,
    'idC'    => FILTER_SANITIZE_ENCODED,
);

$jugadores;
$batallas;
$campeones;

//filtros


//comprovación de formulario
$initPost = filter_input_array(INPUT_POST, $initargs);
$post;

if(!empty($_POST)){
    if($initPost['form'] == 'jugador'){
        $post = filter_input_array(INPUT_POST, $jugadorArgs);
        var_dump($post);
        insertJugador($jugadores, $bd);
    } else if ($initPost['form'] == 'campio') {
        $post = filter_input_array(INPUT_POST, $campioArgs);
        var_dump($post); 
    } else if ($initPost['form'] == 'batalla') {
        $post = filter_input_array(INPUT_POST, $batallaArgs);
        var_dump($post); 
    }
}

function accion( $post, $bd ){

}

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

function insertJugador($jugadores, $bd){
    global $jugadores;
    $id=$post['id'];
    echo $id;
    $nombre=$post['nombre'];
    $nivel=(int)$post['nivel'];
    $fecha=$post['fecha'];
    $post = NULL;
    $_POST = NULL;
    $initPost = NULL;
    $query = "INSERT INTO jugador (id, nombre, `nivel`, fecha) VALUES ('$id', '$nombre', '$nivel', '$fecha')";
    $jugadores = new Consulta($query, $bd);
    $bd->x; 
}
function insertCampeon($campeones, $bd){
    
}
function insertBatalla($batallas, $bd){
    
}


function updateJugador($jugadores, $bd){

}
function updateCampeon($campeones, $bd){
    
}
function updateBatalla($batallas, $bd){
    
}

$bd->x; 


//$conectmysql = new MySQL($usuario, $contrasena, $servidor, $bd);
//$query = "SELECT * FROM jugador";
//$consulta = new Consulta($query, $conectmysql);
//for ($i = 0; $i < $consulta->numFilasObtenidas; $i++)
//    echo $consulta->tablaResultados[$i]->nombre."\n";

?>