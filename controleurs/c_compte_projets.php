<?php

    include_once("/modeles/m_compte_projets.php");


        
        
    /*** La personne vient seulement d'arriver sur la page ***/
    if ( $_POST['projets_gerer'] == 'Gérer vos projets' ) { // TODO safiser ?

        // on ne fait rien, mais ça permet le else plus bas.




    /*** La personne veut lier un projet ***/
    } else if ( $_POST['projets_gerer'] == 'lier_projet' ) { // TODO safiser ?

        // TODO safiser :
        $lier_nom = $_POST['lier_nom'];
        $lier_mdp = $_POST['lier_mdp'];

        // Intégration dans la BDD
        $erreurTxt = wantLierProjet($safePersonneNum,$lier_nom,$lier_mdp);
        



    /*** La personne veut créer un projet ***/
    } else if ( $_POST['projets_gerer'] == 'creer_projet' ) { // TODO safiser ?

        // TODO safiser :
        $creer_nom = $_POST['creer_nom'];
        $creer_studio = $_POST['creer_studio'];
        // TODO vérifier valeurs ni trop courtes ni trop longues

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

        switch ( $_POST['projets_gerer'] ) { // TODO safiser ?

            case 'modif_projet_infos' :
                
                // TODO safiser :
                $modif_nom = $_POST['modif_nom'];
                $modif_studio = $_POST['modif_studio'];
                $modif_website = $_POST['modif_website'];
                $modif_dateSortie = $_POST['modif_dateSortie'];

                // Intégration dans la BDD
                $erreurTxt = wantModifInfos(    $safePersonneNum,
                                                $numProjet,
                                                $modif_nom,
                                                $modif_studio,
                                                $modif_website,
                                                $modif_dateSortie    );
                
            break;

            case 'modif_projet_description' :
                
                $modif_description = $_POST['modif_description']; // TODO safiser
                $erreurTxt = wantModifDescription($safePersonneNum,$numProjet,$modif_description);
                
            break;

            case 'modif_projet_urlVisuel' :
                
                $modif_urlVisuel = $_POST['modif_urlVisuel']; // TODO safiser
                $erreurTxt = wantModifUrlVisuel($safePersonneNum,$numProjet,$modif_urlVisuel);
                
            break;

            case 'modif_projet_tags' :
                
                $erreurTxt = 'Soon soon !'; // TODO.
                
                // Renvoi vers la gestion des tags ... du projet.
                //include_once("controleurs/c_compte_tags_projets.php");
                // -> une page quasi identique à include_once("/vues/v_compte_tags.php");
                // mais avec les numeros de projet plutôt que personne
                // et surtout ça va pas du tout renvoyer sur les mêmes requetes
                // sur le modèle...
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
        
        


    /*** Afficher le formulaire ***/
    getProjetsInfos($safePersonneNum,$compteDatas);
    include_once("/vues/v_compte_projets.php");

?>