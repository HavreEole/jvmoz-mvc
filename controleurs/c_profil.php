 <?php 

    if (extension_loaded("PDO")) {
            
        try {
            
            include_once("/modeles/m_profil.php");
            
            if ( $profilDatas->get_profilPersonneNum() != -1 ) { // le profil existe.
                
                // ce header a besoin de l'identité récupérée dans le modèle.
                $isProfil = true; include_once("controleurs/c_header.php"); unset($isProfil);
                include_once("/vues/v_profil.php");
                
            } else {
                
                $erreurTxt = "Erreur - profil non disponible";
                include_once("/vues/v_erreur.php");
                unset($erreurTxt);
                
            }

        } catch (exception $e) {
            $erreurTxt = "Erreur - Accès refusé";
            include_once("/vues/v_erreur.php");
            include_once("/controleurs/c_footer.php");
            unset($erreurTxt);
            die();
        }
            
    }

?>