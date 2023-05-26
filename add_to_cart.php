<?php

    session_start();
    if(!isset($_SESSION["email"])){
        header("Location: login.php");
        exit;
    }

    if (isset($_GET["nome_prodotto"]) &&
        isset($_GET["size"]) &&
        isset($_GET["n_pieces"]))
    {

        if(strcmp($_GET["size"], "s") != 0 && strcmp($_GET["size"], "m") != 0 && strcmp($_GET["size"], "l") != 0 ){
            echo "Errore, taglia non trovata";
            exit;
        }

        if($_GET["n_pieces"] <= 0){
            echo "Impossibile aggiungere un numero nullo o negativo di pezzi";
            exit;
        }

        //connessione al DB
        $conn = mysqli_connect("localhost", "root", "", "hw1_database");

        $nome_prodotto = mysqli_real_escape_string($conn, $_GET["nome_prodotto"]);
        $size = mysqli_real_escape_string($conn, $_GET["size"]);
        $n_pieces = mysqli_real_escape_string($conn, $_GET["n_pieces"]);

        $query = "SELECT * FROM carrelli where utente = '".$_SESSION["email"]."' and nome_prodotto = '".$nome_prodotto."' and taglia = '".$size."'";
        $query_get_price = "SELECT prezzo FROM prodotti WHERE nome = '".$nome_prodotto."'";

        //Ottengo il prezzo unitario del prodotto che voglio aggiungere al carrello
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $res_get_price = mysqli_query($conn, $query_get_price) or die(mysqli_error($conn));
        $array_prezzo = mysqli_fetch_assoc($res_get_price);
        $prezzo_unitario_prodotto = $array_prezzo["prezzo"];
        
        if (mysqli_num_rows($res) > 0){
            //incremento il numero di pezzi
            $query_incrementa_n_pezzi = "UPDATE carrelli SET n_pezzi = n_pezzi + ".$n_pieces.", prezzo = prezzo + ".$prezzo_unitario_prodotto*$n_pieces." WHERE utente = '".$_SESSION["email"]."' and nome_prodotto = '".$nome_prodotto."' and taglia = '".$size."'";
            $res2 = mysqli_query($conn, $query_incrementa_n_pezzi) or die(mysqli_error($conn));

        } else {
            //altrimenti inserisco il prodotto nel carrello
            $query_inserimento_nel_carrello = "INSERT INTO carrelli values ('".$_SESSION["email"]."', '".$nome_prodotto."', '".$size."', '".$n_pieces."','".$prezzo_unitario_prodotto*$n_pieces."')";
            $res2 = mysqli_query($conn, $query_inserimento_nel_carrello) or die(mysqli_error($conn));
            
        }

        mysqli_close($conn);
        header("Location: carrello.php");

    } else {
        echo "Inserisci tutti i dati";
    }
?>