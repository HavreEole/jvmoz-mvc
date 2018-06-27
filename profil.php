<?php
    
    session_start();
 
    /* Erreurs */
    // Masquer les erreurs PHP : https://stackoverflow.com/a/32648423
    error_reporting(E_ALL); ini_set('display_errors', 0);

    /* Infos de connexion */
    include("modeles/conf.php");

    /* Classes */
    include_once("librairies/class.recuperation.php");
    include_once("librairies/class.profildatas.php");
    include_once("librairies/class.personne.php");
    include_once("librairies/class.projet.php");

    $profilDatas = new profildatas();

    /* controleurs */
    // Le c_header est appellé dans c_profil.
    include_once("controleurs/c_profil.php");
    include_once("controleurs/c_footer.php");

?>