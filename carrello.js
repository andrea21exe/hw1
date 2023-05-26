function onResponse(response){
    return response.json();
}

function onModificaNPezziJson(json){
    fetch("get_carrello.php").then(onResponse).then(onJsonCarrello);
}


function onNumberInput(event){
    const number_input = event.currentTarget;

    const nome_prodotto = encodeURIComponent(number_input.parentNode.parentNode.querySelector("a.nome_prodotto").textContent);
    const taglia = encodeURIComponent(number_input.parentNode.parentNode.querySelector("span.taglia").textContent);
    const n_pezzi = encodeURIComponent(number_input.value);
    
    const link = "modifica_carrello.php?n_pezzi=" + n_pezzi + "&nome_prodotto=" + nome_prodotto + "&taglia=" + taglia.toLowerCase();
    fetch(link).then(onResponse).then(onModificaNPezziJson);
}


function onJsonCarrello(json){

    document.querySelector("section.cart").innerHTML = "";
    let prezzo_checkout = 0.00;

    //Se il carrello è vuoto
    if(json === "Carrello vuoto"){
        const carrello_vuoto = document.createElement("h1");
        carrello_vuoto.textContent = "Carrello vuoto";
        document.querySelector("section.cart").appendChild(carrello_vuoto);
        //Rendo il pulsante checkout (#acquista) NON visibile
        document.getElementById("acquista").classList.add("hidden");

    } else {
        //Se il carrello non è vuoto
        const table = document.createElement("table");
        document.querySelector("section.cart").appendChild(table);

        const tr = document.createElement("tr");
        table.appendChild(tr);

        const th1 = document.createElement("th");
        const th2 = document.createElement("th");
        const th3 = document.createElement("th");
        const th4 = document.createElement("th");
        const th5 = document.createElement("th");
        th2.textContent = "Prodotto";
        th3.textContent = "Taglia";
        th4.textContent = "Pezzi";
        th5.textContent = "Prezzo";
        tr.appendChild(th1);
        tr.appendChild(th2);
        tr.appendChild(th3);
        tr.appendChild(th4);
        tr.appendChild(th5);

        for(prodotto of json){
            
            const tr = document.createElement("tr");
            table.appendChild(tr);

            const th1 = document.createElement("td");
            const img = document.createElement("img");
            img.src = prodotto.image_src;
            th1.appendChild(img);

            const th2 = document.createElement("td");
            const nome_prodotto = document.createElement("a");
            nome_prodotto.href = "product_page.php?id=" + encodeURIComponent(prodotto.nome_prodotto);
            nome_prodotto.classList.add("nome_prodotto");
            nome_prodotto.textContent = prodotto.nome_prodotto;
            th2.appendChild(nome_prodotto);

            const th3 = document.createElement("td");
            const taglia = document.createElement("span");
            taglia.classList.add("taglia");
            taglia.textContent = prodotto.taglia.toUpperCase();
            th3.appendChild(taglia);

            const th4 = document.createElement("td");
            const numero_pezzi = document.createElement("input");
            numero_pezzi.type = "number";
            numero_pezzi.name = "n_pieces"
            numero_pezzi.value = prodotto.n_pezzi;
            numero_pezzi.min = "0";
            numero_pezzi.addEventListener("blur", onNumberInput);
            th4.appendChild(numero_pezzi);

            const th5 = document.createElement("td");
            const prezzo = document.createElement("span");
            const prezzo_per_riga = Number(prodotto.prezzo);
            prezzo.textContent = "€" + prezzo_per_riga.toFixed(2); 
            prezzo_checkout += prezzo_per_riga;
            th5.appendChild(prezzo);
            
            tr.appendChild(th1);
            tr.appendChild(th2);
            tr.appendChild(th3);
            tr.appendChild(th4);
            tr.appendChild(th5);
                
        }
        
        //Rendo il pulsante checkout (#acquista) visibile
        document.getElementById("acquista").classList.remove("hidden");
        
    }

    const elemento_prezzo_checkout = document.querySelector("#prezzo_checkout");
    elemento_prezzo_checkout.textContent = "€ " + prezzo_checkout.toFixed(2);

}

fetch("get_carrello.php").then(onResponse).then(onJsonCarrello);

