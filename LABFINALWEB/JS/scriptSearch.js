$(document).ready(function(){	
    var $searchText = $("#searchText");
    var jsonToSend = {
        "action" : "SEARCHUSER",
        "searchName" : $searchText.val()
    };
    $.ajax({
        url : "data/applicationLayer.php",
        type : "POST",
        data : jsonToSend,
        dataType : "json",
        contentType : "application/x-www-form-urlencoded",
        success : function(jsonResponse){
            var newHtml = "";
            for (var i = 0; i < jsonResponse.length; i++){
                 newHtml += "<li class='searchElement'> <h3 class='searchListHeading'>" 
                + jsonResponse[i].nombre + "</h3> <p class='searchListP'>" 
                +  jsonResponse[i].tipo + " " + jsonResponse[i].precio + "</p></li>";
            }
            $("#usersListDisplay").append(newHtml);
        },
        error : function(errorMessage){
            alert(errorMessage.responseText);
        }
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





