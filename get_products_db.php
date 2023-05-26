<?php
//Chiedo al DB tutti i prodotti
$conn = mysqli_connect("localhost", "root", "", "hw1_database");

$query = "SELECT * FROM prodotti";

$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

$prodotti = array();

while($prodotto = mysqli_fetch_assoc($res)){
    $prodotti[] = $prodotto;
}

mysqli_close($conn);

echo json_encode($prodotti);

?>