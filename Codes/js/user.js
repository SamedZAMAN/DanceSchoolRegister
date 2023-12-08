let success = document.getElementById("success");
let warning = document.getElementById("warning");
let buttoncls = document.querySelector(".btn-close");


buttoncls.addEventListener("click", function(){
    let prnt = buttoncls.parentElement;
    prnt.remove();
})
