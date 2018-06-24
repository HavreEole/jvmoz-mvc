<?php

    include_once("/modeles/m_compte_projets.php");


        
        
    /*** La personne vient seulement d'arriver sur la page ***/
    if ( Recuperation::testValueFromInput('projets_gerer','Gérer vos projets') ) {

        // on ne fait rien, mais ça permet le else plus bas.




    /*** La personne veut lier un projet ***/
    } else if ( Recuperation::testValueFromInput('projets_gerer','lier_projet') ) {

        $lier_nom = Recuperation::getPostFromInput('lier_nom','l33tName');
        $lier_mdp = Recuperation::getPostFromInput('lier_mdp','passProjet');

        // Intégration dans la BDD
        $erreurTxt = wantLierProjet($safePersonneNum,$lier_nom,$lier_mdp);
        



    /*** La personne veut créer un projet ***/
    } else if ( Recuperation::testValueFromInput('projets_gerer','creer_projet') ) {

        $creer_nom = Recuperation::getPostFromInput('creer_nom','l33tName');
        $creer_studio = Recuperation::getPostFromInput('creer_studio','l33tName');

        // Intégration dans la BDD
        $erreurTxt = wantCreerProjet($safePersonneNum,$creer_nom,$creer_studio);




    /*** La personne veut modifier un projet ***/
    } else {


        
        /* Récupérer le numéro du projet */

            // on va chercher un "projet_xxx dans les clefs de $_POST,
            // on commence par stocker toutes les clefs dans un tableau :
        $numProjetArray = array_keys($_POST);
            // puis on cherche dedans laquelle contient le terme "projet_" :
        $numProjetArray = preg_grep('/^projet_/',$numProjetArray);
            // on obtient un array avec (normalement..) un seul résultat,
            // l'array conserve les index d'origine donc on va récupérer juste les (la) valeurs :
        $numProjetArray = array_values($numProjetArray);
            // on va ensuite chercher dans cette clef tout ensemble (+) de digits (\d),
            // et re-stocker le résultat dans $numProjetArray (3e paramètre) :
        preg_match('/\d+/',$numProjetArray[0],$numProjetArray);
            // pour finir il suffit de récupérer le seul résultat obtenu :
        $numProjet = $numProjetArray[0];


        
        /* Modifier le projet */
        
        if ( Recuperation::testNotEmptyPostFromInput('projets_gerer') ) {
            switch ( $_POST['projets_gerer'] ) {

                case 'modif_projet_infos' :

                    $modif_nom = Recuperation::getPostFromInput('modif_nom','l33tName');
                    $modif_studio = Recuperation::getPostFromInput('modif_studio','l33tName');
                    $modif_website = Recuperation::getPostFromInput('modif_website','link');
                    $modif_dateSortie = Recuperation::getPostFromInput('modif_dateSortie','date');

                    // Intégration dans la BDD
                    $erreurTxt = wantModifInfos(    $safePersonneNum,
                                                    $numProjet,
                                                    $modif_nom,
                                                    $modif_studio,
                                                    $modif_website,
                                                    $modif_dateSortie    );

                break;

                case 'modif_projet_description' :

                    $modif_description = Recuperation::getPostFromInput('modif_description','desc');
                    $erreurTxt = wantModifDescription($safePersonneNum,$numProjet,$modif_description);

                break;

                case 'modif_projet_urlVisuel' :

                    $modif_urlVisuel = Recuperation::getPostFromInput('modif_urlVisuel','link');
                    $erreurTxt = wantModifUrlVisuel($safePersonneNum,$numProjet,$modif_urlVisuel);

                break;

                case 'modif_projet_tags' :

                    $erreurTxt = 'Soon soon !'; // TODO.

                    // Renvoi vers la gestion des tags ... du projet.
                    //include_once("controleurs/c_compte_tags_projets.php");
                    // -> une page quasi identique à include_once("/vues/v_compte_tags.php");
                    // mais avec les numeros de projet plutôt que personne
                    // et surtout ça va pas du tout renvoyer sur les mêmes requetes sur le modèle...
                    // voir si la vue peut être mise en commun. :?
                    // juste le titre à changer, et le menu.

                break;

                case 'modif_projet_mdp' :

                    $erreurTxt = wantProjetPassword($safePersonneNum,$numProjet);

                break;

                case 'modif_projet_suppr' :

                    // Retrait dans la BDD (et suppression si seule personne à afficher).
                    $erreurTxt = wantRetirerProjet($safePersonneNum,$numProjet);

                break;

                default: break;

            }
        }

    }
        
        


    /*** Afficher le formulaire ***/
    getProjetsInfos($safePersonneNum,$compteDatas);
    include_once("/vues/v_compte_projets.php");

?>