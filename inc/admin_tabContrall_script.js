//changing tab active
function tabContral(tabNo){
    console.log(tabNo);
    
    document.getElementsByClassName('active')[0].classList.remove('active');
    document.getElementById('tab-li-'+tabNo).classList.add('active');
}
