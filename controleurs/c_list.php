<?php 

    if (extension_loaded("PDO")) {
            
        try {
            
            include_once("/modeles/m_list.php");
            include_once("/vues/v_list.php");

        } catch (exception $e) {
            die("<section><header>Erreur - Accès refusé</header></section>");
        }
            
    }

?>