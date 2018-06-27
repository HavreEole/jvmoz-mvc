<?php

    $titre;
    $description;

    if (isset($isProfil)) {
        $identite = $profilDatas->get_onePersonneInfo( $profilDatas->get_profilPersonneNum() )->get_Identite();
        
        $description = 'Consultez le profil et les projets de '.$identite.', une personne évoluant dans l\'industrie du jeu vidéo.';
        $titre = 'Profil de '.$identite;

    } else {
        $description = 'Afin de faciliter les prises de contact, cet annuaire filtre les profils de personnes évoluant dans l\'industrie du jeu vidéo en fonction de leurs spécificités.';
        $titre = 'Personnes de l\'industrie du jeu vidéo';
    }

    include_once("vues/v_header.php");

    unset($description);
    unset($titre);

?>