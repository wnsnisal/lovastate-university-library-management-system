var eye = document.getElementById('eye');
var password = document.getElementById('password');
var showPassword = false;


eye.addEventListener('click',function(){
    
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
    
});

var loginText = document.getElementById('loginText');
var form = document.getElementById('frmLogin');
var shoForm = false;

loginText.addEventListener('click',function(){
    if(shoForm==false){
        form.classList.remove('non_visible');
        form.classList.add('visible');
        shoForm=true;
    }else{
        form.classList.remove('visible');
        form.classList.add('non_visible');
        shoForm= false;
    }
    
});


/*
var student = document.getElementById('rdoStudent');
var profeser = document.getElementById('rdoProfeser');

student.addEventListener('click',function(){
    student.checked = true;
    profeser.checked= false;
});
profeser.addEventListener('click',function(){
    student.checked = false;
    profeser.checked= true;
});
*/

