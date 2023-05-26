<?php 
    session_start(); 
    if(!isset($_SESSION["email"])){
        header("Location: login.php");
        exit;
    }        

    $conn = mysqli_connect("localhost", "root", "", "hw1_database");

    //Ottengo i prodotti dal carrello
    $query = "SELECT * FROM carrelli WHERE utente = '".$_SESSION["email"]."'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $carrello = array();

    while($elemento_carrello = mysqli_fetch_assoc($res)){
        $carrello[] = $elemento_carrello;
    }

    //Se il carrello è vuoto, blocco tutto
    if (empty($carrello)) {
        header("Location: carrello.php");
        exit;
    }

    //Se sono stati trasmessi dati POST, creo l'account aggiungendo una riga alla tabella "utenti" del DB
    if(isset($_POST["nome"]) && 
       isset($_POST["cognome"]) &&
       isset($_POST["indirizzo"]) &&
       isset($_POST["città"]) &&
       isset($_POST["intestatario"]) &&
       isset($_POST["numero_carta"]) &&
       isset($_POST["scadenza"])) 
       {
            $errore = array();

            //Effettuo l'escape dell'input
            $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
            $cognome = mysqli_real_escape_string($conn, $_POST["cognome"]);
            $indirizzo = mysqli_real_escape_string($conn, $_POST["indirizzo"]);
            $città = mysqli_real_escape_string($conn, $_POST["città"]);
            $intestatario = mysqli_real_escape_string($conn, $_POST["intestatario"]);
            $numero_carta = mysqli_real_escape_string($conn, $_POST["numero_carta"]);
            $scadenza = mysqli_real_escape_string($conn, $_POST["scadenza"]);

            //Controllo che i seguenti campi non siano vuoti: nome, cognome, indirizzo, città, intestatario
            if(empty(trim($nome)) || empty(trim($cognome)) || empty(trim($indirizzo)) || empty(trim($città)) || empty(trim($intestatario))){
                $errore[] = "Campi vuoti";
            }

            //Controllo validità numero_carta
            if(!preg_match('/^\d{16}$/', $_POST["numero_carta"])){
                $errore[] = "Carta non valida";
            }

            //Controllo validità data di scadenza
            $data_attuale = date("Y-m-d H-i-s");
            $data_scadenza = date($_POST["scadenza"]);
            if($data_scadenza < $data_attuale){
                $errore[] = "Data di scadenza non valida";
            }

            //Se non vi è alcun errore, aggiungo l'ordine al DB
            if(!$errore){
                //Compongo l'indirizzo completo (unica stringa)
                $indirizzo_completo = $nome." ".$cognome." ".$indirizzo." ".$città;

                //Ottengo l'importo totale dell'ordine
                $query_importo_totale = "SELECT sum(prezzo) FROM carrelli WHERE utente = '".$_SESSION["email"]."'";
                $res = mysqli_query($conn, $query_importo_totale) or die(mysqli_error($conn));
                $array_importo_totale = mysqli_fetch_array($res);
                $importo_totale = $array_importo_totale[0];

                //Inserisco l'ordine nel DB
                $query_inserimento_ordine = "INSERT INTO ordini (utente, indirizzo, data_ordine, importo) VALUES
                                            ('".$_SESSION["email"]."','" .$indirizzo_completo."','".$data_attuale."','".$importo_totale."')";  
                mysqli_query($conn, $query_inserimento_ordine) or die(mysqli_error($conn));

                //Ottengo l'id dell'ordine appena effettuato
                $query_get_id = "SELECT id FROM ordini where utente = '".$_SESSION["email"]."' and data_ordine = '".$data_attuale."'";
                $res = mysqli_query($conn, $query_get_id) or die(mysqli_error($conn));
                $array_id = mysqli_fetch_array($res);
                $id_ordine = $array_id[0];

                //Associo all'ordine i prodotti acquistati 
                foreach($carrello as $elemento){
                    $query = "INSERT INTO ordini_prodotti 
                              VALUES ('".$id_ordine."','".$elemento["nome_prodotto"]."','".$elemento["taglia"]."','".$elemento["n_pezzi"]."','".$elemento["prezzo"]."')";

                    mysqli_query($conn, $query) or die(mysqli_error($conn));
                }

                //Svuoto il carrello dell'utente
                $query = "DELETE FROM CARRELLI WHERE utente = '".$_SESSION["email"]."'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));

                header("Location: my_account.php");
                exit;

            }
       }

?>

<html>
    <head>
        <meta name="viewport"
        content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="checkout.css">
        <script src="checkout.js" defer></script>
    </head>

    <body>
        <header>
            <nav>
                <a href="home.php">
                    <div>
                        <img src="icons/home.png">
                        <span>Home</span>
                    </div>
                </a>
                <a href="my_account.php">
                    <div>
                        <img src="icons/profile.png">
                        <span>Profilo</span>
                    </div>
                </a>
                <a href="carrello.php">
                    <div>
                        <img src="icons/shoppingcart.png">
                        <span>Carrello</span>
                    </div>
                </a>
            </nav>
        </header>

        <main>
            <form method="post">
                <div>
                    <h2>Dati di spedizione</h2>
                    <label for=""><input type="text" name="nome" <?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?>>Nome</label>
                    <label for=""><input type="text" name="cognome" <?php if(isset($_POST["cognome"])){echo "value=".$_POST["cognome"];} ?>>Cognome</label>
                    <label for=""><input type="text" name="indirizzo" <?php if(isset($_POST["indirizzo"])){echo "value=".$_POST["indirizzo"];} ?>>Indirizzo</label>
                    <label for=""><input type="text" name="città" <?php if(isset($_POST["città"])){echo "value=".$_POST["città"];} ?>>Città</label>
                </div>

                <div>
                    <h2>Dati di pagamento</h2> 
                    <label for=""><input type="text" name="intestatario" <?php if(isset($_POST["intestatario"])){echo "value=".$_POST["intestatario"];} ?>>Intestatario</label>
                    <label for=""><input type="tel" name="numero_carta" maxLength="16" <?php if(isset($_POST["numero_carta"])){echo "value=".$_POST["numero_carta"];} ?>>Numero carta</label>
                    <label for=""><input type="month" name="scadenza" <?php if(isset($_POST["scadenza"])){echo "value=".$_POST["scadenza"];} ?>>Scadenza</label>                   
                </div>   
                        <label for=""><input type="submit" value="Acquista"></label>
                       
                    <?php 
                        if(isset($errore)){
                            foreach($errore as $err)
                                echo '<h4 class="error">'.$err."</h4>";
                        }
                    ?>                
            </form>
        </main>

        <footer>
            <span>Seguimi su:</span>
            <a href="https://www.etsy.com/it/shop/AndreaAnastasio21">
                <img src="icons/etsy.png" alt="">
            </a>
            <a href="https://www.instagram.com/andreanastasio_art/">
                <img src="icons/ig.png" alt="">
            </a>
            <a href="https://www.tiktok.com/@andreanastasio_art">
                <img src="icons/tiktok.png" alt="">
            </a>
        </footer>
    </body>

</html>