<?php
    
    session_start();

    /* Erreurs */
    // Masquer les erreurs PHP : https://stackoverflow.com/a/32648423
    error_reporting(E_ALL); ini_set('display_errors', 0);

    /* Infos de connexion */
    include("modeles/conf.php");

    /* Classes */
    include_once("librairies/class.recuperation.php");
    include_once("librairies/class.indexdatas.php");
    include_once("librairies/class.personne.php");

    $indexDatas = new indexDatas();

    /*** Récupérer ou créer les informations de recherches ***/
    $indexSessionDatas = ( isset($_SESSION['indexSessionDatas']) )
        ? $_SESSION['indexSessionDatas']
        : array(    'list'=>array(),
                    'listOffset'=>array(8,0), // nb affiché, nb max.
                    'menuOffset'=>array(6,0), // nb affiché, nb max.
                    'indexSearch'=>''    );

    /* modèle du super-controleur */
    // requête vérifiant la concordance des tags présents dans l'url avec ceux de la BDD.
    // le résultat est stocké dans $indexDatas et utilisé dans c_menu et c_list ensuite.
    include_once("modeles/m_index.php");


    /* controleurs */
    include_once("controleurs/c_header.php");
    include_once("controleurs/c_menu.php");
    include_once("controleurs/c_list.php");
    include_once("controleurs/c_footer.php");

    $_SESSION['indexSessionDatas'] = $indexSessionDatas;
        

?>

<script type="text/javascript" src="vues/scripts/menu.js"></script>