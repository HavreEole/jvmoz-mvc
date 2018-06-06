<?php

    include_once("/modeles/m_compte_modifs.php");



    /*** La personne veut afficher ou cacher son profil ***/
    if ( Recuperation::testNotEmptyPostFromInput('mod_afficher') ) {
        
        // La personne peut modifier l'affichage dans l'annuaire si son nom et une description sont enregistrées.
        if (    $compteDatas->get_nom() != null && $compteDatas->get_nom() != ''
                && $compteDatas->get_description() != ''   ) {
            
            $banNum = (isset($_POST['true_afficher'])) ? 0 : 2 ;
            wantAfficherProfil($banNum);
            
        } else { $erreurTxt="Erreur : pour pouvoir afficher votre profil, vous devez avoir enregistré un nom et une description."; }
        
    }



    /*** La personne veut modifier son identité ***/
    if ( Recuperation::testNotEmptyPostFromInput('mod_identite') ) {
        
        $numero = $compteDatas->get_numero();
        
        // TODO safiser :
        $nom = $_POST['mod_nom'];
        $prenom = $_POST['mod_prenom'];
        $pseudo = $_POST['mod_pseudo'];
        
        // Intégration dans la BDD
        wantIdentite($numero,$nom,$prenom,$pseudo);
        
        // Intégration dans la session
        $identiteCompte = ($pseudo != '') ? $pseudo : $prenom." ".$nom;
        $_SESSION['nomLogged'] = $identiteCompte;
        
    }



    /*** La personne veut modifier son mail et/ou mdp ***/
    if ( Recuperation::testNotEmptyPostFromInput('mod_confidentiel') ) {
        
        $numero = $compteDatas->get_numero();
        
        // TODO safiser :
        $email0 = $_POST['mod_email0'];
        $email1 = $_POST['mod_email1'];
        $email2 = $_POST['mod_email2'];
        $mdp0 = $_POST['mod_mdp0'];
        $mdp1 = $_POST['mod_mdp1'];
        $mdp2 = $_POST['mod_mdp2'];
        
        // Intégration dans la BDD
        if ( $email1 == $email2 && $mdp1 == $mdp2 ) {
            
            $erreurTxt = wantConfidentiel($numero,$email0,$mdp0,$email1,$mdp1);
            
        } else { $erreurTxt="Erreur : mauvaise confirmation."; }
        
    }



    /*** La personne veut modifier sa description ***/
    if ( Recuperation::testNotEmptyPostFromInput('mod_description') ) {
        
        $numero = $compteDatas->get_numero();
        
        // TODO safiser :
        $description = $_POST['mod_description'];
        
        // Intégration dans la BDD
        wantDescription($numero,$description);
        
    }



    /*** La personne veut modifier ses liens ***/
    if ( Recuperation::testNotEmptyPostFromInput('mod_liens') ) {
        
        $numero = $compteDatas->get_numero();
        
        // TODO safiser :
        $linkedin = $_POST['mod_linkedin'];
        $twitter = $_POST['mod_twitter'];
        $website = $_POST['mod_website'];
        $urlAvatar = $_POST['mod_urlAvatar'];
        
        // Intégration dans la BDD
        wantLiens($numero,$linkedin,$twitter,$website,$urlAvatar);
        
    }



?>