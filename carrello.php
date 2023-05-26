<?php 
    session_start(); 
    if(!isset($_SESSION["email"])){
        header("Location: login.php");
        exit;
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
        <link rel="stylesheet" href="carrello.css">
        <script src="carrello.js"></script>
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
                <a href="logout.php">
                    <div>
                        <img src="icons/logout.png">
                        <span>Logout</span>
                    </div>
                </a>
            </nav>
        </header>

        <main>
            <section class="cart"></section>

            <section id="checkout">
                <h2>Totale</h2>
                <h2 id="prezzo_checkout"></h2>
                <a class="hidden" href="checkout.php" id="acquista">Checkout</a>
            </section>
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