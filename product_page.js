function onSubmit(event){
    if(!form.size.value){
        form.querySelector("#radio-container").classList.add("error");
        event.preventDefault();
    }
}

const form = document.querySelector("form");
form.addEventListener("submit", onSubmit);