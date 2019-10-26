$.get("scripts/checkSession.php",function(res){
    if (res == ""){
        window.location.replace("login.html");
    }
});

function logout(){
    $.get("scripts/logout.php",function(res){
        window.location.replace("login.html");
    });
}