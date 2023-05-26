function onJsonProdotti(json){
    console.log(json);
    const section = document.querySelector("section");

    for(prodotto of json){
        //Creo il product-container, aggiungo la classe 
        const product_container = document.createElement("a");
        product_container.classList.add("product-container");

        //creo l'immagine e la inserisco nel container
        const img = document.createElement("img");
        img.src = prodotto.image_src;
        product_container.appendChild(img);

        //inserisco il titolo e la inserisco nel container
        const titolo = document.createElement("h4");
        titolo.textContent = prodotto.nome;
        product_container.appendChild(titolo);

        //inserisco il prezzo e lo inserisco nel container
        const prezzo = document.createElement("span");
        prezzo.textContent = String("€" + prodotto.prezzo);
        product_container.appendChild(prezzo);

        //Inserisco il riferimento al link
        product_container.href = "product_page.php?id=" + encodeURIComponent(prodotto.nome);

        //Inserisco il container dentro la section
        section.appendChild(product_container);
    }
}

function onResponseProdotti(response){
    return response.json();
}

fetch("get_products_db.php").then(onResponseProdotti).then(onJsonProdotti);