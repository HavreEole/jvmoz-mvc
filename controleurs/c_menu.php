<?php 

    if (extension_loaded("PDO")) {
            
        try {
            
            include_once("/modeles/m_menu.php");
            include_once("/vues/v_menu.php");

        } catch (exception $e) {
            $erreurTxt = "Erreur - Accès refusé";
            include_once("/vues/v_erreur.php");
            include_once("/controleurs/c_footer.php");
            unset($erreurTxt);
            die();
        }
            
    }

?>