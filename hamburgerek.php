<?php
    include_once "./Termek.php";
    $hamburgerek = []; //ebbe lesznek a Termek classú itemek
    $mysqlConn = new mysqli("localhost","root","","burgeretterem"); //példányosítunk egy mysqli classt
    $eredmeny = $mysqlConn->query("SELECT * FROM burger WHERE bar != 0"); //lementjük az eredményeket a queryből

    while($sor = $eredmeny->fetch_assoc()) //amíg tudunk sort csinálni az eredményekből,addig minden sor egy asszociatív tömb lesz
    {
        $hamburger = new Termek($sor["bazon"],$sor["bnev"],$sor["bar"],$sor["bleir"]);//,$sor["aktiv"]); //minden tömbből elkészítjük a termékünket
        array_push($hamburgerek,$hamburger); //és bepusholjuk a hamburgerek arraybe egyenként minden terméket
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

        <!--Navbar-->
        <?php
            include_once("navbar.php");
        ?>
        <br />

        <!-- Nav pills
        <div>
            <nav class="nav nav-pills navbar navbar-expand-sm bg-dark navbar-dark justify-content-center sticky-top">
                <ul class="nav navbar nav-justified">
                    <?php
                        foreach($hamburgerek as $h) //végigmegyünk a termékeket tartalmazó tömbön
                        {
                            echo "<li class='nav-item'>
                                    <a class='nav-link text-center text-light' data-bs-toggle='pill' href='#\\3$h->id'>$h->nev</a>
                                </li>";
                        }
                    ?>
                </ul>
            </nav>
        </div> -->


        <!-- Tab panes -->
        <div class="tab-content">
            <?php
                foreach($hamburgerek as $h) //végigmegyünk a termékeket tartalmazó tömbön
                {
                    $aktiv = $h->id == 1 ? "active" : ""; //az 1es idvel lévő legyen active, szóval a string felveszi az "active" értéket ha a foreachben lévő item idje 1
                    //utána berakjuk a classok közé, lényegében az elsőnél fogja beleírni az activeot, a többinél meg csak egy üres stringet rak be
                    echo "<div id='$h->id' class='container tab-panel'><br>
                          <div class='row p-2 m-3'>
                              <div class='col-sm-6 col-m-12'>
                                  <div class='text-center'>
                                      <img src='images/burgerek/$h->id.jpg' style='width:25rem; height: 18rem;'  class='img-fluid rounded' alt=$h->nev>
                                  </div>
                              </div>
                  
                              <div class='col-sm-6'>
                                  <h1 class='text-center text-light p-2 m-3'>
                                      $h->nev
                                  </h1>
                                  <p>
                                      <span class='text-info'>Összetevők: </span>
                                      <span class='p-2'>$h->leiras</span>
                                  </p>
                                  <p>
                                      <span class='text-warning'>Ár: </span>
                                      <span class='p-2'>$h->ar,-Ft.</span>
                                  </p>
                              </div>
                          </div>
                      </div>";
                }
            ?>
        </div>

        <footer class="page-footer text-center wow fadeIn">
            <div class="py-5 bg-dark">
                <span class="footer-copyright text-secondary center" id="copyright">© 2022 Copyright:</span>
                <span class="text-secondary center">Burger Étterem</span>
            </div>
        </footer>


    </body>
</html>