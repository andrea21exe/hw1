<?php    

    session_start();
    if(isset($_SESSION["email"])){
        header("Location: home.php");
        exit;
    }

    //Se sono stati trasmessi dati POST, creo l'account aggiungendo una riga alla tabella "utenti" del DB
    if(isset($_POST["name"]) && 
       isset($_POST["surname"]) &&
       isset($_POST["email"]) &&
       isset($_POST["password"]) &&
       isset($_POST["conferma_password"])) 
       {
            
            $conn = mysqli_connect("localhost", "root", "", "hw1_database");
            $errore = array();
            
            //Effettuo l'escape dell'input
            $name = mysqli_real_escape_string($conn, $_POST["name"]);
            $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $password = mysqli_real_escape_string($conn, $_POST["password"]);
            $c_pwd = mysqli_real_escape_string($conn, $_POST["conferma_password"]);

            //Controllo se nome e cognome sono validi
            if(empty(trim($name)) || empty(trim($surname))){
                $errore[] = "Campi vuoti";
            }

            //Controllo VALIDITA' EMAIL
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $errore[] = "E-mail non valida";
            } else {
                //Controllo se l'email è già stata registrata
                $query = "SELECT * FROM utenti WHERE email = '".$email."'";           
                $res = mysqli_query($conn, $query);

                if (mysqli_num_rows($res)){
                    $errore[] = "E-mail già registrata";
                }
            }

            //Controllo Validità Password
            if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)){
                $errore[] = "Password non valida";
            }

            //Controllo conferma pwd
            if(strcmp($password, $c_pwd) != 0){
                $errore[] = "Password non coincidenti";
            }

            //Se non vi è alcun errore, aggiungo l'account al DB
            if(!$errore){
                $password = password_hash($password, PASSWORD_BCRYPT);
                $query = "INSERT INTO utenti VALUES ('".$email."','".$name."','".$surname."','".$password."')";
                $res = mysqli_query($conn, $query);
                if($res){
                    $_SESSION["email"] = $email;
                    header("Location: home.php");
                    exit;
                }
            }
       }
?>

<html>
    <head>

    <title>HW1 - Crea Account</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="signup_login.css">
    <script src="crea_account.js" defer></script>

    </head>

    <body>

        <div id="form-container">
            <h1>Crea il tuo account!</h1>   
                <?php 
                    if(isset($errore)){
                        foreach ($errore as $e)
                        {echo "<h5>".$e."</h5>";}
                    }
                ?>
            <form method="post">
                <div>
                    <label>Nome <input class="in" type="text" name="name" <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?>></label>
                    <span></span>
                </div>
                <div>
                    <label>Cognome <input class="in" type="text" name="surname" <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?> ></label>
                    <span></span>
                </div>
                <div>
                    <label>E-mail <input class="in" type="text" name="email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?> ></label>
                    <span></span>
                </div>
                <div>
                    <label>Password <input class="in" type="password" name="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></label>
                    <span></span>
                </div>
                <div>
                    <label>Conferma password <input class="in" type="password" name="conferma_password" <?php if(isset($_POST["conferma_password"])){echo "value=".$_POST["conferma_password"];} ?> ></label>
                    <span></span>
                </div>
                <label><input class="login_btn" type="submit" value="Crea account"></label>
            </form>
            <span>Hai già un account? <a href="login.php">Accedi</a></span>
        </div>
        
    </body>
</html>