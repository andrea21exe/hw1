function onResponse(response){
    return response.json();
}

function onClose(event){
    event.currentTarget.parentNode.remove();
}

function onJsonOrdineSingolo(json){

    let container_ordine = document.querySelector("div.container-ordine");
    if(container_ordine){
        container_ordine.remove();
    }

    container_ordine = document.createElement("div");
    container_ordine.classList.add("container-ordine");
    
    const close_order = document.createElement("img");
    close_order.classList.add("close_order");
    close_order.src = "icons/x_close.png";
    close_order.addEventListener("click", onClose);
    container_ordine.appendChild(close_order);

    //Tabella ORDINE SINGOLO
    const table = document.createElement("table");

    //INTESTAZIONE TABELLA
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

    //AGGIUNGO I PRODOTTI ALLA TABELLA 
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
        const numero_pezzi = document.createElement("span");
        numero_pezzi.textContent = prodotto.n_pezzi;
        th4.appendChild(numero_pezzi);

        const th5 = document.createElement("td");
        const prezzo = document.createElement("span");
        prezzo.textContent = "€" + prodotto.prezzo; 
        th5.appendChild(prezzo);
            
        tr.appendChild(th1);
        tr.appendChild(th2);
        tr.appendChild(th3);
        tr.appendChild(th4);
        tr.appendChild(th5)
    }

    container_ordine.appendChild(table);
    document.querySelector("main").appendChild(container_ordine);

}

function onClickOrdine(event){
    fetch("get_ordine_singolo.php?id=" + event.currentTarget.dataset.id).then(onResponse).then(onJsonOrdineSingolo);
}

function onJsonOrdini(json){

    //Se l'utente non ha effettuato ordini
    if(json === "Nessun ordine effettuato"){
        const nessun_ordine = document.createElement("h1");
        nessun_ordine.textContent = "Nessun ordine effettuato";
        document.querySelector("section.container-ordini").appendChild(nessun_ordine);

    } else {
        //Se l'ultente ha effettuato ordini
        const table = document.createElement("table");
        document.querySelector("section.container-ordini").appendChild(table);

        const tr = document.createElement("tr");
        table.appendChild(tr);

        const th1 = document.createElement("th");
        const th2 = document.createElement("th");
        const th3 = document.createElement("th");
        const th4 = document.createElement("th");
        th1.textContent = "ID-Ordine";
        th2.textContent = "Data";
        th3.textContent = "Importo";
        th4.textContent = "Indirizzo"
        tr.appendChild(th1);
        tr.appendChild(th2);
        tr.appendChild(th3);
        tr.appendChild(th4);

        for(ordine of json){
            
            const tr = document.createElement("tr");
            tr.dataset.id = ordine.id;
            tr.addEventListener("click", onClickOrdine);
            table.appendChild(tr);

            const th1 = document.createElement("td");
            const id = document.createElement("span");
            id.textContent = "#" + ordine.id;
            th1.appendChild(id);
            
            const th2 = document.createElement("td");
            const data = document.createElement("span");
            data.textContent = ordine.data_ordine;
            th2.appendChild(data);

            const th3 = document.createElement("td");
            const importo = document.createElement("span");
            importo.textContent = "€" + ordine.importo;
            th3.appendChild(importo);

            const th4 = document.createElement("td");
            const indirizzo = document.createElement("span");
            indirizzo.textContent = ordine.indirizzo;
            th4.appendChild(indirizzo);

            tr.appendChild(th1);
            tr.appendChild(th2);
            tr.appendChild(th3);
            tr.appendChild(th4);
        }
    }
}


fetch("get_ordini.php").then(onResponse).then(onJsonOrdini);