$(document).ready(function(){
	var jsonToSend = {
		"action" : "GETCircular"
	};
	$.ajax({
		url : "data/applicationLayer.php",
		type : "POST",
		data : jsonToSend, 
		dataType : "json",
		contentType : "application/x-www-form-urlencoded",
		success: function(jsonResponse){			
			var newHtml = "";
			for (var i = 0; i < jsonResponse.length; i++){
				var cont = i + 1;
				var imagen = "C" + cont + ".png";
				var nombre = jsonResponse[i].nombre;
				var precio = jsonResponse[i].precio;
				newHtml += "<li class='CirculoListElement'> <h3 class='circuloListHeading' id='circuloListHeading" + i + "'>" + nombre + "</h3> <p class='circuloListP' id='circuloListP" + i + "'>"
				+ '<img src = "images/img/' + imagen + '" style = "width:20%; height:20%;">'
				+ "<p>Precio:" + precio + "<input type='submit' class='OrdenarButton' value='Ordenar Arreglo'" + "id='OrdenarButton" + i + "'" + "/></li>";           
			}
			$("#arrCircular").append(newHtml);
		},
		error: function(errorMessage){
			alert(errorMessage.responseText);
			window.location.replace("Login.html");
		}
	});
	$(document).on("click", ".OrdenarButton" ,function(){
		var idButton = $(this).attr('id');
		var lastChar = idButton[idButton.length-1];
		var $id = "circuloListHeading" + lastChar;
		var $name = document.getElementById($id).innerHTML;
		var jsonToSend = {
			"action" : "hacerPedido",
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
				window.location.replace("home.html");

			},
			error: function(errorMessage){
				alert(errorMessage.responseText);
			}
		});
	});
    $("#searchButton").on("click", function(){
        var $searchText = $("#searchText");
        if ($searchText.val() == ""){
            alert("Please insert search petition");
        }
        else {
            var jsonToSend = {
                "action" : "SEARCHCOOKIE",
                "searchName" : $searchText.val()
            };
            $.ajax({
                url : "data/applicationLayer.php",
                type : "POST",
                data : jsonToSend,
                dataType : "json",
                contentType : "application/x-www-form-urlencoded",
                success : function(jsonResponse){
                    console.log(jsonResponse);
                    window.location.replace("search.html");
                },
                error : function(errorMessage){
                    alert(errorMessage.responseText);
                }
            });
        }
    });
	
});

