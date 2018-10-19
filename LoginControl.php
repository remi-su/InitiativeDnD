<?php 

function ConectarBaseDatos($sql){

	$mysqli = new mysqli('127.0.0.1', 'root', '', 'proyectolinux');
	if(!$mysqli){
		return false; 
	}
	else{
		$resultado = $mysqli->query($sql);
		$mysqli->close();
		return $resultado;               
	}

}

function crearUsuarioMaestro(){
	$usuario = $_POST["usuario"];
	$clave = $_POST["clave"];

	$sql = "SELECT usuario FROM maestros WHERE usuario = '$usuario'";
	$resultado = ConectarBaseDatos($sql);

	if ($resultado->num_rows == 0){
		$sql = "INSERT INTO `maestros`(`usuario`, `clave`) VALUES ('$usuario','$clave')";
		$resultado = ConectarBaseDatos($sql);
		if ($resultado){
			return "El maestro se ha registrado correctamente";
		} else {
			return "Hubo un error en el registro, intente de nuevo";
		}
	} else {
		return "Ya existe un maestro con este usuario";
	}

}

function validarUsuarioMaestro(){
	$usuario = $_POST["usuario"];
	$clave = $_POST["clave"];

	$sql = "SELECT usuario FROM maestros WHERE usuario = '$usuario' AND clave = '$clave'";
	$resultado = ConectarBaseDatos($sql);
	if ($resultado->num_rows > 0){
		session_start();
		if (!isset($_SESSION["usuario"])){
			$_SESSION["usuario"] = "Pedro";
		//header('location: ./index.html');
		}
		return "0";
	} else {
		return "El Maestro No Inicio Sesion";
	}

}


if(isset($_POST['tipo']) && !empty($_POST['tipo'])) {
	$action = $_POST['tipo'];
	switch($action) {
		case 1 : echo crearUsuarioMaestro();break;
		case 2 : echo validarUsuarioMaestro();break;
	}
}
