function onBlurScadenza(event){
    event.currentTarget.parentNode.classList.remove("error");
    const data_inserita = event.currentTarget.value;
    if(data_inserita === ""){
        event.currentTarget.parentNode.classList.add("error");
        return;
    }
    const anno = data_inserita.split('-')[0];
    const mese = data_inserita.split('-')[1];
    const scadenza = new Date(anno, mese - 1);

    const currentDate = new Date();
    if(scadenza < currentDate){
        event.currentTarget.parentNode.classList.add("error");
    }
}

function onBlurNCarta(event){
    event.currentTarget.parentNode.classList.remove("error");
    const numero_carta = event.currentTarget.value;
    const regex = /^\d{16}$/;
    if(!regex.test(numero_carta)){
        event.currentTarget.parentNode.classList.add("error");
    }
}

function campoVuoto(event){
    event.currentTarget.parentNode.classList.remove("error");
    if(!event.currentTarget.value.trim().length){
        event.currentTarget.parentNode.classList.add("error");
    }
}

const form = document.querySelector("form");
form.nome.addEventListener("blur", campoVuoto);
form.cognome.addEventListener("blur", campoVuoto);
form.indirizzo.addEventListener("blur", campoVuoto);
form.intestatario.addEventListener("blur", campoVuoto);
form.città.addEventListener("blur", campoVuoto);

form.numero_carta.addEventListener("blur", onBlurNCarta);
form.scadenza.addEventListener("blur", onBlurScadenza);