<?php

    session_start();
    if(!isset($_SESSION["email"])){
        header("Location: login.php");
        exit;
    }

    if(!isset($_GET["n_pezzi"]) ||
       !isset($_GET["nome_prodotto"]) ||
       !isset($_GET["taglia"])){

        echo "Errore, parametri mancanti";
        exit;

    }

    $conn = mysqli_connect("localhost", "root", "", "hw1_database");

    $nome_prodotto = mysqli_real_escape_string($conn, $_GET["nome_prodotto"]);
    $size = mysqli_real_escape_string($conn, $_GET["taglia"]);
    $n_pieces = mysqli_real_escape_string($conn, $_GET["n_pezzi"]);

    //SE IL NUMERO DEI PEZZI INSERITO E' 0 ---> ELIMINO L'ELEMENTO DAL CARRELLO NEL DB
    if($_GET["n_pezzi"] === "0"){
        $query = "DELETE FROM carrelli WHERE utente = '".$_SESSION["email"]."' and nome_prodotto = '".$nome_prodotto."' and taglia = '".$size."'"; 
    } else {
        //ALTRIMENTI MODIFICO LA QUANTITA'
        //Ottengo il prezzo unitario del prodotto di cui voglio modificare il numero di pezzi
        $query_get_price = "SELECT prezzo FROM prodotti WHERE nome = '".$nome_prodotto."'";
        $res_get_price = mysqli_query($conn, $query_get_price) or die(mysqli_error($conn));
        $array_prezzo = mysqli_fetch_assoc($res_get_price);
        $prezzo_unitario_prodotto = $array_prezzo["prezzo"];

        //Modifico la quantità
        $query = "UPDATE carrelli SET n_pezzi = ".$n_pieces.", prezzo = ".$prezzo_unitario_prodotto*$n_pieces." WHERE utente = '".$_SESSION["email"]."' and nome_prodotto = '".$nome_prodotto."' and taglia = '".$size."'";
    }
    
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    echo json_encode($res);

?>