 <?php 

    if (extension_loaded("PDO")) {
            
        try {
            
            // modèles :
            include_once("/modeles/m_profil.php");
            
            // le header a besoin de l'identité récupérée dans le modèle.
            include_once("controleurs/c_header.php");
            
            // vues :
            include_once("/vues/v_profil.php");


        } catch (exception $e) { die('Erreur: Accès refusé.'); }
            
    }

?>