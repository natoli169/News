$(document).ready(function () {
    $.get("scripts/checkSession.php",function(res){
        if (res != ""){
            window.location.replace("index.html");
        }
    });
});

function login() {
    let errors = [];
    if($("#email").val()  == ""){
        errors.push("email can't be empty!");
    }

    if($("#password").val() == 0){
        errors.push("password can't be empty!");
    }

    if(errors.length === 0) {
        let myData = new FormData($("#loginForm")[0]);

        $.ajax({
            url: 'scripts/login.php',
            data: myData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
               if(data == "logged"){
                   window.location.replace("index.html");
               }else{
                   $(".errors #error").empty();
                   $(".errors #error").append("<li>Incorrect Username or Password</li>");
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

