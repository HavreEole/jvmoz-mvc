<?php 

    if (extension_loaded("PDO")) {
            
        try {
            
            // modèles :
            include_once("/modeles/m_list.php");

            // vues :
            include_once("/vues/v_list.php");


        } catch (exception $e) { die('Erreur: Accès refusé.'); }
            
    }

?>