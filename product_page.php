<?php 

    session_start(); 

    $nome_prodotto = $_GET["id"];

    $conn = mysqli_connect("localhost", "root", "", "hw1_database");
    
    $query = "SELECT * FROM prodotti WHERE nome = '".$nome_prodotto."'";
    
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $product = mysqli_fetch_assoc($res);

    mysqli_close($conn);
?>

<html>
    <head>
        <meta name="viewport"
        content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="product_page.css">
        <script src="product_page.js" defer></script>
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

        <main>

            <section id="img-container">
                <img src= <?php echo '"'.$product["image_src"].'"'?>>
            </section>

            <section id="details-container">

                <h1 id="titolo"><?php echo $nome_prodotto?></h1>
                <p id="descrizione"><?php echo $product["descrizione"]?></p>
                <p id="prezzo">€<?php echo $product["prezzo"]?></p>

                <form action="add_to_cart.php">

                    <label><input type="hidden" name = "nome_prodotto" value= <?php echo '"'.$nome_prodotto.'"' ?>></label>          

                    <span id="radio-container">
                        <label>Taglia:<input type="radio" name="size" value="s">S</label>
                        <label><input type="radio" name="size" value="m">M</label>
                        <label><input type="radio" name="size" value="l">L</label>
                    </span>

                    <div>
                        <label><input type="number" value = "1" min = "1" name = "n_pieces"></label>
                        <label><input type="submit" value="Aggiungi al carrello"></label>
                    </div>

                </form>
                
            </section>

        </main>

        <footer>
            <span>Seguimi su:</span>
            <a href="https://www.etsy.com/it/shop/AndreaAnastasio21">
                <img src="icons/etsy.png">
            </a>
            <a href="https://www.instagram.com/andreanastasio_art/">
                <img src="icons/ig.png">
            </a>
            <a href="https://www.tiktok.com/@andreanastasio_art">
                <img src="icons/tiktok.png">
            </a>
        </footer>
    </body>

</html>