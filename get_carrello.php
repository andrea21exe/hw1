<?php

    //Restituisco un json con tutti gli elementi inseriti nel carrello dall'utente
    session_start();
    if(!isset($_SESSION["email"])){
        echo "Non puoi essere qui";
        header("Location: login.php");
        exit;
    }

    $conn = mysqli_connect("localhost", "root", "", "hw1_database");

    $query = "SELECT nome_prodotto, taglia, n_pezzi, carrelli.prezzo, image_src
              FROM carrelli LEFT JOIN prodotti ON carrelli.nome_prodotto = prodotti.nome
              WHERE utente = '".$_SESSION["email"]."'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    mysqli_close($conn);

    $elementi_nel_carrello = array();

    if(mysqli_num_rows($res)){

        while($elemento = mysqli_fetch_assoc($res)){
            $elementi_nel_carrello[] = $elemento;
        }

        echo json_encode($elementi_nel_carrello);

    } else {

        echo json_encode("Carrello vuoto");

    }

?>