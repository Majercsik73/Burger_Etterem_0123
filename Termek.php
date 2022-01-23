<?php
    class Termek
    {
        public $id,$nev,$ar,$leiras;

        function __construct($id,$nev,$ar,$leiras)
        {
            $this->id = $id;
            $this->nev = $nev;
            $this->ar = $ar;
            $this->leiras = $leiras;
        }
    }
?>