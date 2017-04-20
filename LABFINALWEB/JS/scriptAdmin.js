$(document).ready(function(){
//Se cargan todos los elementos a borrar
var jsonToSend = {
	"action" : "GETArreglos"
	};

	$.ajax({
		url : "data/applicationLayer.php",
		type : "POST",
		data : jsonToSend, 
		dataType : "json",
		contentType : "application/x-www-form-urlencoded",
		success: function(jsonResponse){
		//modificar para mostrar todos			
			var newHtml = "";
			for (var i = 0; i < jsonResponse.length; i++){
				var cont = i + 1;
				var nombre = jsonResponse[i].nombre;
				var precio = jsonResponse[i].precio;
				newHtml += "<li class='ArregloListElement'> <h3 class='circuloListHeading' id='circuloListHeading" + i + "'>" + nombre + "</h3> <p class='circuloListP' id='circuloListP" + i + "'>"
				+ "<p>Precio:" + precio + "<br><input type='submit' class='BorrarButton' value='Borrar Arreglo'" + "id='BorrarButton" + i + "'" + "/></li>";           
			}
			$("#borrar").append(newHtml);
		},
		error: function(errorMessage){
			alert(errorMessage.responseText);
			window.location.replace("Login.html");
		}
	});

	$(document).on("click", ".BorrarButton" ,function(){
		var idButton = $(this).attr('id');
		var lastChar = idButton[idButton.length-1];
		var $id = "circuloListHeading" + lastChar;
		var $name = document.getElementById($id).innerHTML;
		alert("Nombre a borrar" + $name);
		var jsonToSend = {
			"action" : "borrarArreglo",
			"name" : $name
		};
		$.ajax({
			url : "data/applicationLayer.php",
			type : "POST",
			data : jsonToSend, 
			dataType : "json",
			contentType : "application/x-www-form-urlencoded",
			success: function(jsonResponse){
				alert(jsonResponse.message);
				window.location.replace("admin.html");

			},
			error: function(errorMessage){
				alert(errorMessage.responseText);
			}
		});
	});




});