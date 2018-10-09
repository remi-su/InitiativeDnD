<?php


session_start();
if (!isset($_SESSION["arregloPersonajes"])){
	$_SESSION["arregloPersonajes"] = array();
}

function agregarPersonajes(){
	$nombrePersonaje = $_POST["nombrePersonaje"];
	$modificador = $_POST["modificador"];
	$dadoMagico = rand(1,20);
	$iniciativa = $dadoMagico + $modificador;
	$personajeCompleto = array('nombre' => $nombrePersonaje, 'iniciativa' => $iniciativa);
	$_SESSION["arregloPersonajes"][] = $personajeCompleto;
}

function ordenarPersonajes(){
	usort($_SESSION["arregloPersonajes"], 'sort_by_orden');
}


function sort_by_orden ($a, $b) {
	return $a['iniciativa'] - $b['iniciativa'];
}
function regresarPersonajes(){

	ordenarPersonajes();
	$htmlTable = "<table class='table table-bordered'>";
	for ($i=0; $i < count($_SESSION["arregloPersonajes"]); $i++) { 
		$htmlTable .= "<tr id='".str_replace(" ", "-",$_SESSION["arregloPersonajes"][$i]["nombre"])."'><td>".$_SESSION["arregloPersonajes"][$i]["nombre"]."</td><td>".$_SESSION["arregloPersonajes"][$i]["iniciativa"]."</td></tr>";
	}
	$htmlTable .= "</table>";
	return $htmlTable;
}

if(isset($_POST['tipo']) && !empty($_POST['tipo'])) {
	$action = $_POST['tipo'];
	switch($action) {
		case "crearPersonaje" : echo agregarPersonajes();break;
		case "obtenerPersonajes": echo regresarPersonajes();break;
	}
}