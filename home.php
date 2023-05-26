<?php session_start(); ?>

<html>
    <head>
        <meta name="viewport"
        content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="homepage.css">
        <script src="home.js"></script>
    </head>

    <body>
        <header>
            <nav>
                <?php 
                    if (isset($_SESSION["email"])){
                        echo '<a href="my_account.php">
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
                            </a>';
                    } else {
                        echo '<a href="crea_account.php">
                                <div>
                                    <img src="icons/add-user.png">
                                    <span>Registrati</span>
                                </div>

                            </a>
                            <a href="login.php">
                                <div>
                                    <img src="icons/log-in.png">
                                    <span>Entra</span>
                                </div>
                            </a>';
                    }
                ?>
            </nav>
        </header>

        <section></section>

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