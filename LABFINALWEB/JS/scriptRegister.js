$(document).ready(function(){
    $("#submitRegistration").on("click", function(){
        var $userFirstName = $("#FirstName");
        var $userLastName = $("#LastName");
        var $Direccion = $("#Direccion");
        var $userName = $("#Username");
        var $userEmail = $("userEmail")
        var $userPass = $("#Password");
        var $userPassCon = $("#ConPassword");
        var $Gender = $("input[name='gender']:checked").val();
        var $Country = $("#country");

        if ($userFirstName.val() == ""){
            $("#errorFirstName").text("Please provide your first name");
        }
        else{
            $("#errorFirstName").text("");
        }
        if ($userLastName.val() == ""){
            $("#errorLastName").text("Please provide your last name");
        }
        else{
            $("#errorLastName").text("");
        }
        if ($Direccion.val() == ""){
            $("#errorLabelDireccion").text("Please provide your address ");
        }
        else{
            $("#errorLabelDireccion").text("");
        }
        if ($userName.val() == ""){
            $("#errorUserName").text("Please provide your username");
        }
        else{
            $("#errorUserName").text("");
        }
        if ($userEmail.val() == ""){
            $("#errorEmail").text("Please provide your email");
        }
        else{
            $("#errorEmail").text("");
        }
        if ($userPass.val() == ""){
            $("#errorPassword").text("Please provide your password");
        }
        else{
            $("#errorPassword").text("");
        }
        if ($userPassCon.val() == ""){
            $("#errorPasswordCon").text("Please provide your password confirmation");
        }
        else{
            $("#errorPasswordCon").text("");
        }
        if(!$Gender) {
            $("#errorLabelGender").text("Please select a gender");
        }
        else{
            $("#errorLabelGender").text("");
        }
        if ($Country.val() == "SC"){
            $("#errorLabelCountry").text("Please select a country");
        }
        else{
            $("#errorLabelCountry").text("");
        }
        if ($userPass.val() != $userPassCon.val()){
            $("#errorPasswordCon").text("Please provide your password same as the one before");
        }
        if($userFirstName.val() != "" && $userLastName.val() != "" && $Direccion.val() != "" && $userName.val() != "" 
            && $userEmail.val() != "" && $userPass.val() != "" && $userPass.val() == $userPassCon.val() 
            && $Gender && $Country.val() != "SC"){
            var jsonObject = {

                "action" : "REGISTER",
                "username" : $("#Username").val(),
                "userPassword" : $("#Password").val(),
                "direccion" : $("#Direccion").val(),
                "userFirstName" : $("#FirstName").val(),
                "userLastName" : $("#LastName").val(),
                "userEmail" : $("#userEmail").val(),
                "gender" : $('input[name=gender]:checked').val(),
                "country" : $("#country option:selected").text()
            }; 
            $.ajax({
                type: "POST",
                url: "data/applicationLayer.php",
                data : jsonObject,
                dataType : "json",
                contentType : "application/x-www-form-urlencoded",
                success: function(jsonData) {
                    alert(jsonData);
                    window.location.replace("home.html");   
                },
                error: function(errorMsg){
                    alert(errorMsg.statusText);
                }
            });
        }
    });
});