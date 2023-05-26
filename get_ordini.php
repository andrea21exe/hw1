<?php
    session_start();
    if(!isset($_SESSION["email"])){
        echo "Non puoi essere qui";
        header("Location: login.php");
        exit;
    }

    $conn = mysqli_connect("localhost", "root", "", "hw1_database");

    $query = "SELECT *
              FROM ordini
              WHERE utente = '".$_SESSION["email"]."'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    mysqli_close($conn);

    $ordini = array();
    if(mysqli_num_rows($res)){

        while($elemento = mysqli_fetch_assoc($res)){
            $ordini[] = $elemento;
        }

        echo json_encode($ordini);

    } else {

        echo json_encode("Nessun ordine effettuato");

    }

?>