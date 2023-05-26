
<?php 
    session_start();
    if (!isset($_SESSION["email"])){
        header("Location: login.php");
        exit;
    }

    $conn = mysqli_connect("localhost", "root", "", "hw1_database");

    $query = "SELECT nome, cognome
              FROM utenti
              WHERE email = '".$_SESSION["email"]."'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    mysqli_close($conn);
    
    $dati_utente = mysqli_fetch_assoc($res);
    $nome = $dati_utente["nome"];
    $cognome = $dati_utente["cognome"];

?>

<html>
    <head>
        <meta name="viewport"
        content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="my_account.css">
        <script src="my_account.js" defer></script>
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
                <a href="carrello.php">
                    <div>
                        <img src="icons/shoppingcart.png">
                        <span>Carrello</span>
                    </div>
                </a>
                <a href="logout.php">
                    <div>
                        <img src="icons/logout.png">
                        <span>Logout</span>
                    </div>
                </a>
            </nav>
        </header>

        <main>
            <h1>Ciao <?php echo $nome." ".$cognome?>, ecco i tuoi ordini</h1>
            <section class="container-ordini"></section>
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