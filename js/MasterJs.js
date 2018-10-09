$(document).ready(function(){
	$("#numeroPersonajes").change(function(){
		crearInputPalabras();
	});

	document.getElementById("cargarPersonajes").onclick = function () { agregarPersonajes(); };
	document.getElementById("obtenerPersonajes").onclick = function () { solicitarPersonajes(); };

	function cargarPersonajeIndividual(nombrePersonaje, modificador){
		$.ajax({ url: './php/ControllerDungeonMaster.php',
			data: {tipo: "crearPersonaje", nombrePersonaje: nombrePersonaje, modificador: modificador},
			type: 'post',
			success: function(output) {
				alert(output);
			}
		});
	}

	function agregarPersonajes(){
		var numeroPersonajes = $("#numeroPersonajes").val();
		for (var i = 0; i < numeroPersonajes; i++) {
			var nombrePersonaje = $("#input"+i).val();
			var modificador = $("#modificador"+i).val();
			cargarPersonajeIndividual(nombrePersonaje, modificador);
		}
	}

	function solicitarPersonajes(){
		$.ajax({ url: './php/ControllerDungeonMaster.php',
			data: {tipo: "obtenerPersonajes"},
			type: 'post',
			success: function(output) {
				$("#tableCharacters").empty();
				$("#tableCharacters").append(output);
			}
		});
	}

	function crearInputPalabras(){
		var numeroPalabras = $("#numeroPersonajes").val();
		$("#almacenDePersonajes").empty();
		var htmlGeneral = "";
		for (var i = 0; i < numeroPalabras; i++) {
			htmlGeneral += "Nombre Personaje #" + i + ": <Input type='text' id='input" + i + "'> Modificador: " + "<Input type='text' id='modificador" + i + "'> <br>"; 
		}
		$("#almacenDePersonajes").append(htmlGeneral);
	}
});