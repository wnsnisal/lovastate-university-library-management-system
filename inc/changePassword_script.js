
var showPassword = false;
function eyeClick(passwordNo){
    var eye = document.getElementById('eye'+passwordNo);
    var password = document.getElementById('txtPassword'+passwordNo);

    if(showPassword == false){
        password.setAttribute('type','text');
        eye.classList.add("fa-eye-slash");
        eye.classList.remove("fa-eye");
        showPassword = true;
    }else{
        password.setAttribute('type','password');
        eye.classList.add("fa-eye");
        eye.classList.remove("fa-eye-slash");
        showPassword = false;
    }
}

function goBack(){
    window.location = 'home.php';
}