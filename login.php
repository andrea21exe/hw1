<?php    

    session_start();
    if(isset($_SESSION["email"])){
        header("Location: home.php");
        exit;
    }

    //Se sono stati trasmessi dati POST tento l'accesso
    if(isset($_POST["email"]) &&
       isset($_POST["password"])) 
       {
            
            $conn = mysqli_connect("localhost", "root", "", "hw1_database");
            
            //Effettuo l'escape dell'input
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $password = mysqli_real_escape_string($conn, $_POST["password"]);

            //Controllo se l'email inserita è già presente nel DB
            $query = "SELECT * FROM utenti WHERE email = '".$email."'";           
            $res = mysqli_query($conn, $query);

            if ($account = mysqli_fetch_assoc($res)){
                if(password_verify($password, $account["password"])){
                    //Se email e password sono corrette, vado alla home
                    $_SESSION["email"] = $email;
                    header("Location: home.php");
                    exit;
                }
            }

            $errore = 1;

       }

?>

<html>
    <head>
    <title>HW1 - Accedi</title>
    <meta name="viewport"
    content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="signup_login.css">
    <script src="" defer></script>
    </head>

    <body>

        <div id="form-container">
            <h1>Accedi al tuo account!</h1>
            <h5>
                <?php 
                    if(isset($errore)){
                        echo "Credenziali non valide";
                    }
                ?>
            </h5>
            <form method="post">
                <label>E-mail <input class="in" type="text" name="email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?> ></label>
                <label>Password <input class="in" type="password" name="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></label>
                <label><input class="login_btn" type="submit" value="Accedi"></label>
            </form>
            <span>Non hai un account? <a href="crea_account.php">Crea account</a></span>
        </div>
        
    </body>
</html>