<?php
    
    // session_start();
    /*
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    */
 
    /* Erreurs */
    // Masquer les erreurs PHP : https://stackoverflow.com/a/32648423
    // error_reporting(E_ALL); ini_set('display_errors', 0);

    /* Infos de connexion */
    include("/modeles/conf.php");

    /* Classes */
    include_once("/librairies/class.recuperation.php");
    include_once("/librairies/class.stockdatas.php");
    include_once("/librairies/class.personne.php");
    include_once("/librairies/class.projet.php");

    $stockDatas = new stockdatas();
    //if ( isset($_SESSION['listes']) ) { $stockDatas->loadInfosSession($_SESSION['listes']); }

    /* controleurs */
    // Le c_header est appellé dans c_profil.
    include_once("controleurs/c_profil.php");
    include_once("controleurs/c_footer.php");

    //$_SESSION['listes'] = $stockDatas->saveInfosSession();

?>