
<?php
    session_start();
    include("dbconnect.php");
    if(isset($_SESSION["Azonosito"]))
    {
        header("Location: ./foglalas.php");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["pw1"]) && !empty($_POST["pw1"]))
            {
                $email = $_POST["email"];
                $pw1 = $_POST["pw1"];
                $hashpw = md5($pw1);
                
                //Felhasználónév lekérés ellenőrzéshez
                $sql2 = "SELECT * FROM felhasznalo WHERE email = '$email'";
                $result2 = $db->query($sql2);
                
                //belépési jelszó lekérés ellenőrzéshez
                $sql3 = "SELECT * FROM felhasznalo WHERE pw = '$hashpw'";
                $result3 = $db->query($sql3);

                //Itt megyünk végig a tényleges ellenőrzéseken
                if($result2->num_rows < 1){
                    echo "<script>alert('A megadott email címmel nincs regisztráció!')</script>";
                    //echo "<script>location.href = 'belepes.php'</script>";;
                }

                elseif($result3->num_rows < 1){
                    echo "<script>alert('A megadott jelszó nem megfelelő!')</script>";
                    //echo "<script>location.href = 'belepes.php'</script>";
                }

                else{   //Ha minden rendben, beléptetjük
                    echo "<script>alert('Köszöntjük weboldalunkon!')</script><br />";
                    //Azonosítószám és név kinyerése db-ből
                    $sql1 = "SELECT azon, nev, pw FROM felhasznalo WHERE email = '$email' AND pw = '$hashpw'";
                    $result1 = $db->query($sql1);

                    if ($result1->num_rows > 0){
                        $row = $result1->fetch_assoc();
                        $azon = $row['azon'];
                        $nev = $row['nev'];
                        $_SESSION['Azonosito'] = $azon;
                        $_SESSION['Felhasznalonev'] = $nev;
                        //$_SESSION['Jelszo'] = $hashpw;
                    }
                }
                echo "<script>location.href = 'foglalas.php'</script>";
            }
    }        

?>

<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/style.css">
        <title>Burger Étterem</title>
    </head>
    <body class="container bg-dark">
        <header>
            <div class="headerimage"></div>

            <div class="jumbotron jumbotron-fluid bg-dark">
                <div class="text-center text-light bg-dark p-5 display-2">Burger Étterem</div>
            </div>
        </header>
        <?php
            include_once("navbar.php"); 
        ?>
        <br />
        <div class="container">
            <div class="ujfelhasznalo">
                <form method = "POST" action="" >
                    <div>
                        <h2>Asztalfoglaláshoz kérjük lépjen be a fiókjába, vagy regisztráljon!</h2> <!--<label class="labella">Regisztráció</label><br />-->
                    </div>
                    
                    <div>
                        <label class="labella">E-mail cím:</label><br />
                        <input type="email" class="bevitel" name="email" id="email" value="<?php if(isset ($_SESSION['Email'])){ echo "".$_SESSION['Email'];}?>" placeholder="az Ön email címe">
                    </div>
                    <div>
                        <label class="labella">Jelszó:</label><br />
                        <input type="password" class="bevitel" name="pw1" id="pw1" value="<?php if(isset ($_SESSION['pw1'])){ echo "".$_SESSION['pw1'];}?>" placeholder="az Ön jelszava">
                    </div>
                    <br />
                    <input type="submit" class="btn btn-success" value="Belépek!">
                    <br />
                    <br />
                    <a class="btn btn-primary" href="regisztracio.php">Regisztrálok!</a>
                </form>
            <br />
            </div>
        </div>
        <br />
        <footer class="page-footer text-center wow fadeIn">
            <div class="py-3 bg-dark">
                <span class="footer-copyright text-secondary center" id="copyright">© 2022 Copyright:</span>
                <span class="text-secondary center">Burger Étterem</span>
            </div>
        </footer>
    </body>
</html>