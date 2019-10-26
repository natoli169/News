$(document).ready(function () {
    $.get("scripts/checkSession.php",function(res){
        if (res != ""){
            window.location.replace("index.html");
        }
    });
});


function register() {
    let errors = [];


    if($("#firstName").val()  == ""){
        errors.push("First name can't be empty!");
    }

    if($("#lastName").val()  == ""){
        errors.push("Last Name can't be empty!");
    }


    if($("#email").val()  == ""){
        errors.push("Email can't be empty!");
    }

    if($("#password").val() == ""){
        errors.push("Password can't be empty!");
    }


    if($("#confirmPassword").val()  == ""){
        errors.push("Confirm password can't be empty!");
    }

    if(($("#confirmPassword").val() != "") && ($("#password").val() != "")) {
        if ($("#confirmPassword").val() != $("#password").val()) {
            errors.push("Passwords don't match!");
        }
    }

    if(errors.length === 0) {
        let myData = new FormData($("#registerForm")[0]);

        $.ajax({
            url: 'scripts/register.php',
            data: myData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                console.log(data);
                if(data == ""){
                    window.location.replace("index.html");
                }else{
                    $(".errors #error").empty();
                    $(".errors #error").append("<li>Email already in use!</li>");
                }
            }

        });
    }else{
        console.log(errors);
        $(".errors #error").empty();
        for (let i = 0; i < errors.length; i++) {
            $(".errors #error").append("<li>" +errors[i] + "</li>");

        }
    }
}

