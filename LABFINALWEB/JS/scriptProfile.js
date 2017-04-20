$(document).ready(function(){ 
    var jsonToSend = {
        "action" : "LOADPROFILE"
    };
    $.ajax({
        url : "data/applicationLayer.php",
        type : "POST",
        data : jsonToSend, 
        dataType : "json",
        contentType : "application/x-www-form-urlencoded",
        success: function(jsonResponse){
            $("#usernameProfile").append(jsonResponse.username);
            $("#firstnameProfile").append(jsonResponse.fName);
            $("#lastnameProfile").append(jsonResponse.lName);
            $("#emailProfile").append(jsonResponse.email);
            $("#genderProfile").append(jsonResponse.gender);
            $("#countryProfile").append(jsonResponse.country);
        },
        error: function(errorMessage){
            alert(errorMessage.responseText);
            window.location.replace("Login.html");
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