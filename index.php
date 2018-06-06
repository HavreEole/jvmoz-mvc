<?php
    
    session_start();

    /* Erreurs */
    // Masquer les erreurs PHP : https://stackoverflow.com/a/32648423
    // error_reporting(E_ALL); ini_set('display_errors', 0);

    /* Infos de connexion */
    include("/modeles/conf.php");

    /* Classes */
    include_once("/librairies/class.recuperation.php");
    include_once("/librairies/class.stockdatas.php");
    include_once("/librairies/class.personne.php");

    $stockDatas = new stockdatas();
    //if ( isset($_SESSION['listes']) ) { $stockDatas->loadInfosSession($_SESSION['listes']); }

    /* modèle du super-controleur */
    // requête vérifiant la concordance des tags présents dans l'url avec ceux de la BDD.
    // le résultat est stocké dans $stockDatas et utilisé dans plusieurs modèles ensuite.
    include_once("modeles/m_index.php");

    /* controleurs */
    include_once("controleurs/c_header.php");
    include_once("controleurs/c_menu.php");
    include_once("controleurs/c_list.php");
    include_once("controleurs/c_footer.php");

    //$_SESSION['listes'] = $stockDatas->saveInfosSession();

?>

<script type="text/javascript" src="vues/v_menu_script.js"></script>