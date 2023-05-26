<?php

    //Restituisco un json con tutti gli elementi inseriti nel carrello dall'utente
    session_start();
    if(!isset($_SESSION["email"])){
        echo "Non puoi essere qui";
        header("Location: login.php");
        exit;
    }

    if(isset($_GET["id"])){

        $conn = mysqli_connect("localhost", "root", "", "hw1_database");
        $id_ordine = mysqli_real_escape_string($conn, $_GET["id"]);

        //Controllo se l'ordine appartiene all'utente in sessione
        $query = "SELECT utente FROM ordini WHERE id = '".$id_ordine."'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $array_utente_ordine = mysqli_fetch_array($res); 
        $utente_ordine = $array_utente_ordine[0];

        if(strcmp($utente_ordine, $_SESSION["email"])){
            echo "Ordine non effettuato dall'utente in sessione";
            exit;
        }
        
        //Se l'ordine appartiene all'utente in sessione ottengo tutti i prodotti dell'ordine
        $query = "SELECT nome_prodotto, taglia, n_pezzi, ordini_prodotti.prezzo, image_src
              FROM ordini_prodotti LEFT JOIN prodotti ON ordini_prodotti.nome_prodotto = prodotti.nome
              WHERE ordine = ".$id_ordine;

        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        mysqli_close($conn);

        $elementi_ordine = array();

        while($elemento = mysqli_fetch_assoc($res)){
            $elementi_ordine[] = $elemento;
        }

        echo json_encode($elementi_ordine);

    }
?>