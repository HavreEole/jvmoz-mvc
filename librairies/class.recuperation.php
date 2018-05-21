<?php

    class recuperation {
        
        // private $numerosPersonnes;
        
        public function _construct() {
           // $this->numerosPersonnes = array();
        }

        
        /* vérifie uniquement que ce n'est pas vide. */
        public function testNotEmptyGetFromUrl ($aThing) {

            if (isset($_GET[$aThing])) { // éviter des erreurs avec certains hébergeurs.

                if (!empty($_GET[$aThing])) {
                    return true;

                } else { // but empty return false if 0 :
                    return ($_GET[$aThing] == 0) ? true : false;

                }

            } else { return false; }

        }


        /* (URL) retourne un résultat secure depuis les GET. */
        public function getGetFromUrl ($aThing,$nombrePersonnes = 0) {

            $safeGetThing = $_GET[$aThing];

            if ($aThing == "num") {

                $safeGetThing = preg_replace('/[^0-9]/', '', $safeGetThing); // retire tout non-digit
                $safeGetThing = preg_replace('/\A[0+]/', '', $safeGetThing); // puis retire les 0 au début
                if ( $safeGetThing == "" ) { $safeGetThing = "0"; } // s'il ne reste rien on en fait un 0.

                // vérifier que l'index ne dépasse pas.
                if ( $safeGetThing >= $nombrePersonnes ) { $safeGetThing = "0"; }

            } else if ($aThing == "tag") {

                // Any single character except : the range a-z or A-Z or 0-9 or ,
                $safeGetThing = preg_replace('/[^a-zA-Z0-9,-]/', '', $safeGetThing);

            }

            return $safeGetThing;

        }
        
    }

?>