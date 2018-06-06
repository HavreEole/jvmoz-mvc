<?php

    include_once("/modeles/m_compte_projets.php");

    if ( Recuperation::testNotEmptyPostFromInput('projets_gerer') ) {
        
    }

    /*** Afficher le formulaire ***/
    // getTagsInfos($safePersonneNum,$compteDatas);
    include_once("/vues/v_compte_projets.php");

?>