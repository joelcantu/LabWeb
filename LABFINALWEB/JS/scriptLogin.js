$(document).ready(function(){
    activeSession(); 
    $("#submit").on("click", function(){
        var $userName = $("#userName");
        var $userPass = $("#pass");
        if ($userName.val() == ""){
            $("#errorLabelUserName").text("Please provide your username");
        }
        else{
            $("#errorLabelUserName").text("");
        }
        if ($userPass.val() == ""){
            $("#errorLabelPass").text("Please provide your password");
        }
        else{
            $("#errorLabelPass").text("");
        }
        if($userName.val() != "" && $userPass.val() != ""){
            $("#errorLabelUserName").text("Wrong username");
            $("#errorLabelPass").text("Wrong password");
        }
        var jsonToSend ={
            "action" : "LOGIN",
            "username" : $("#userName").val(),
            "userPassword" : $("#pass").val(),
            "remember" : $("#remember").is(":checked")
        };
        $.ajax({
            url : "data/applicationLayer.php",
            type : "POST",
            data : jsonToSend,
            dataType : "json",
            contentType : "application/x-www-form-urlencoded",
            success : function(jsonResponse){
                window.location.replace("home.html");
            },
            error : function(errorMessage){
                alert(errorMessage.responseText);
            }
        });
    });
    function activeSession(){
        var jsonToSend = {
            "action" : "ACTIVESESSION"
        };
        $.ajax({
            url : "data/applicationLayer.php",
            type : "POST",
            data : jsonToSend,
            dataType : "json",
            contentType : "application/x-www-form-urlencoded",
            success : function(jsonResponse){
                window.location.replace("home.html");
            },
            error : function(errorMessage){
                //
            }
        });
    }
});