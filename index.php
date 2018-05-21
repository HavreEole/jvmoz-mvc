<?php
    
    //session_start();

    /* Erreurs */
    // Masquer les erreurs PHP : https://stackoverflow.com/a/32648423
    // error_reporting(E_ALL); ini_set('display_errors', 0);


    /* Infos de connexion */
    include("/modeles/conf.php");


    /* Classes */
    include_once("/librairies/class.recuperation.php");
    include_once("/librairies/class.listes.php");
    include_once("/librairies/class.personne.php");

    $listes = new listes();
    $recuperation = new recuperation();
    //if ( isset($_SESSION['listes']) ) { $listes->loadInfosSession($_SESSION['listes']); }


    /* modèle du super-controleur */
    // requête vérifiant la concordance des tags présents dans l'url avec ceux de la BDD.
    // le résultat est stocké dans $listes et utilisé dans plusieurs modèles ensuite.
    include_once("modeles/m_index.php");


    /* controleurs */
    $isIndex = true; include_once("controleurs/c_header.php"); unset($isIndex);
    include_once("controleurs/c_menu.php");
    include_once("controleurs/c_list.php");
    include_once("controleurs/c_footer.php");

    //$_SESSION['listes'] = $listes->saveInfosSession();

?>

<script type="text/javascript" src="vues/v_menu_script.js"></script>