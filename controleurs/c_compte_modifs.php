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
        
        $nom = Recuperation::getPostFromInput('mod_nom','identite');
        $prenom = Recuperation::getPostFromInput('mod_prenom','identite');
        $pseudo = Recuperation::getPostFromInput('mod_pseudo','l33tName');
        
        // Intégration dans la BDD
        wantIdentite($numero,$nom,$prenom,$pseudo);
        
        // Intégration dans la session
        $identiteCompte = ($pseudo != '') ? $pseudo : $prenom." ".$nom;
        $_SESSION['nomLogged'] = $identiteCompte;
        
    }



    /*** La personne veut modifier son mail et/ou mdp ***/
    if ( Recuperation::testNotEmptyPostFromInput('mod_confidentiel') ) {
        
        $numero = $compteDatas->get_numero();
        
        $email0 = Recuperation::getPostFromInput('mod_email0','email');
        $email1 = Recuperation::getPostFromInput('mod_email1','email');
        $email2 = Recuperation::getPostFromInput('mod_email2','email');
        $mdp0Cru = $_POST['mod_mdp0'];
        $mdp1Cru = $_POST['mod_mdp1'];
        $mdp2Cru = $_POST['mod_mdp2'];
        $newMdpSafe = Recuperation::getPostFromInput('mod_mdp1','mdp');
        
        // Intégration dans la BDD
        if ( $email1 == $email2 && $mdp1Cru == $mdp2Cru ) {
            
            $erreurTxt = wantConfidentiel($numero,$email0,$mdp0Cru,$email1,$newMdpSafe);
            
        } else { $erreurTxt="Erreur : mauvaise confirmation."; }
        
    }



    /*** La personne veut modifier sa description ***/
    if ( Recuperation::testNotEmptyPostFromInput('mod_description') ) {
        
        $numero = $compteDatas->get_numero();
        
        $description = Recuperation::getPostFromInput('mod_description','desc');
        
        // Intégration dans la BDD
        wantDescription($numero,$description);
        
    }



    /*** La personne veut modifier ses liens ***/
    if ( Recuperation::testNotEmptyPostFromInput('mod_liens') ) {
        
        $numero = $compteDatas->get_numero();
        
        $linkedin = Recuperation::getPostFromInput('mod_linkedin','link');
        $twitter = Recuperation::getPostFromInput('mod_twitter','link');
        $website = Recuperation::getPostFromInput('mod_website','link');
        $urlAvatar = Recuperation::getPostFromInput('mod_urlAvatar','link');
        
        
        // retirer @ ou les liens devant l'id linkedin.
            // .* -> tout
            // (?=.com\/in\/) -> ce qui est suivi par .com/in/
            // (.com\/in\/) -> et aussi .com/in/
            // /i -> case insensitive
        $linkedin = preg_replace("/(@|(.*(?=.com\/in\/)(.com\/in\/))|(.*(?=.fr\/in\/)(.fr\/in\/)))/i", '', $linkedin);
        
        $twitter = preg_replace("/(@|(.*(?=.com\/)(.com\/))|(.*(?=.fr\/)(.fr\/) ))/i", '', $twitter);
        
        // vérifier que l'url de l'image envoie bien vers un .jpg ou .png
        $verifImg = preg_match("/(.jpg)$|(.png)$/i", $urlAvatar);
        if (!$verifImg) { $urlAvatar = ''; }
        
        
        // Intégration dans la BDD
        wantLiens($numero,$linkedin,$twitter,$website,$urlAvatar);
        
    }



?>