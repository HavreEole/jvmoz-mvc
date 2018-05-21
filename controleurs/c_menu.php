<?php 

    if (extension_loaded("PDO")) {
            
        try {
            
            // modèles :
            include_once("/modeles/m_menu.php");

            // vues :
            include_once("/vues/v_menu.php");


        } catch (exception $e) { die('Erreur: Accès refusé.'); }
            
    }

?>