function checkEmail(event){
    const email = event.currentTarget.value;
    const label_container = event.currentTarget.parentNode.parentNode;
    const email_expression = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if(!email_expression.test(String(email).toLowerCase())){
        label_container.classList.add("err");
        label_container.querySelector("span").textContent = "Email non valida";
    } else {
        label_container.classList.remove("err");
        label_container.querySelector("span").textContent = "";
    }
}

function checkPassword(event){
    const password = event.currentTarget.value;
    const label_container = event.currentTarget.parentNode.parentNode;
    const pwd_expression = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/

    if(!pwd_expression.test(String(password))){
        label_container.classList.add("err");
        label_container.querySelector("span").textContent = "La password deve contenere almeno 8 caratteri, una lettera maiuscola, una lettera minuscola ed un numero";
    } else {
        label_container.classList.remove("err");
        label_container.querySelector("span").textContent = "";
    }
}

function checkConfermaPassword(event){
    const password = form.password.value;
    const conferma_password = event.currentTarget.value;
    const label_container = event.currentTarget.parentNode.parentNode;

    if(password != conferma_password){
        label_container.classList.add("err");
        label_container.querySelector("span").textContent = "Le password non coincidono";
    } else {
        label_container.classList.remove("err");
        label_container.querySelector("span").textContent = "";
    }
}

function checkEmpty(event){
    const text = event.currentTarget.value;
    const label_container = event.currentTarget.parentNode.parentNode;

    if(!text.trim().length){
        label_container.classList.add("err");
        label_container.querySelector("span").textContent = "Campo vuoto";
    } else {
        label_container.classList.remove("err");
        label_container.querySelector("span").textContent = "";
    }
}

const form = document.querySelector("form");
form.name.addEventListener("blur", checkEmpty);
form.surname.addEventListener("blur", checkEmpty);
form.email.addEventListener("blur", checkEmail);
form.password.addEventListener("blur", checkPassword);
form.conferma_password.addEventListener("blur", checkConfermaPassword);

