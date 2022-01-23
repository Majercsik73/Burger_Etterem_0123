<?php 
    class NavLink
    {
        public $nev;
        public $uri;

        function __construct($nev,$uri)
        {
            $this->nev = $nev;
            $this->uri = $uri;
        }
    }

    $linkek = []; //ebbe lesznek a navlink classú itemek
    $linkekInfo = 
    [
        ["Főoldal","index.php"], 
        ["Hamburgerek","hamburgerek.php"],
        ["Köretek","koretek.php"],
        ["Desszertek","desszertek.php"],
        ["Italok","italok.php"],
        ["Foglalás","belepes.php"]
    ]; //ebből készítjük el a navlinkeket,első érték minden tömbbe a navlink neve, második az uri
    
    foreach($linkekInfo as $nevLinkPar) //végigmegyünk a linkekinfon és elkészítjük a navlinkeket amiket végül hozzáadunk a linkek tömbhöz
    {
        $navlink = new NavLink($nevLinkPar[0],$nevLinkPar[1]);
        array_push($linkek,$navlink);
    }

    
?>



<nav class="nav navbar navbar-expand-sm bg-dark navbar-dark justify-content-center sticky-top">
    <!-- Links -->
    <ul class="nav navbar nav-justified">
        <?php
        foreach($linkek as $link) //végigmegyünk a navlinkes tömbön
        {
            //megnézzük hogy az adott urlünkben benne van-e az adott link uri értéke, ha igen akkor a stringünk "active text-light" lesz különben üres string
            $aktiv = strpos($_SERVER["REQUEST_URI"], $link->uri) ? "active text-light" : ""; 

            echo "<li class='nav-item'>
                    <a class='nav-link text-center $aktiv' href=$link->uri> $link->nev </a>
                </li>";
        }
        ?>
    </ul>
</nav>