
function toggleCard(button) {
    var cardHeader = button.parentElement.parentElement;
    var classButtons = cardHeader.querySelector(".class_buttons");
    var classHidden = cardHeader.querySelector(".class_hidden");

    classButtons.classList.add("d-none");
    classHidden.classList.remove("d-none");
    classHidden.classList.add("d-block");
}

function hideCard(button) {
    var cardHeader = button.parentElement.parentElement.parentElement;
    var classButtons = cardHeader.querySelector(".class_buttons");
    var classHidden = cardHeader.querySelector(".class_hidden");

    classHidden.classList.add("d-none");
    classHidden.classList.remove("d-block");
    classButtons.classList.remove("d-none");
    
}
