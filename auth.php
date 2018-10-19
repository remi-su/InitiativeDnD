<?php

session_start();


function verificarSesion(){
	if (isset($_SESSION["usuario"])){
		return $_SESSION["usuario"];
	} else {
		return "0";
	}
}

function desconectar(){
	session_destroy();
	return "Desconectado";
}

if(isset($_POST['tipo']) && !empty($_POST['tipo'])) {
	$action = $_POST['tipo'];
	switch($action) {
		case "verificar" : echo verificarSesion();break;
		case "desconectar" : echo desconectar();break;
	}
}