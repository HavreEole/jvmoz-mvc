 <?php



    function getProjetsInfos($safePersonneNum,$compteDatas) {

        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        /*** récupérer les projets de la personne ***/
        $requete = $pdo->prepare('  SELECT p.nom FROM mz_projet p
                                    INNER JOIN mz_travailler t ON t.numero_PROJET = p.numero
                                    WHERE t.numero_PERSONNE = :numero
                                    ORDER BY p.numero DESC');
        $requete->execute(array('numero' => $safePersonneNum));
        $resultat = $requete->fetchAll(PDO::FETCH_COLUMN);
        $compteDatas->set_projetsListNom($resultat);
        $requete->closeCursor(); $requete=NULL; unset($resultat);
        
        
        /*** pour chaque projet récupérer les infos, tags et team ***/
        foreach ($compteDatas->get_projetsListNom() as $aProjectName) {
            
            // infos du projet
            $requete = $pdo->prepare('  SELECT * FROM mz_projet WHERE nom = :nom');
            $requete->execute(array('nom' => $aProjectName));
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);
            $numProjet = $resultat['numero'];
            $compteDatas->add_ProjetInfos($numProjet,$resultat);
            $requete->closeCursor(); $requete=NULL; unset($resultat);

            // récupérer les tags qui décrivent le projet
            $requete = $pdo->prepare('  SELECT nom FROM mz_tags t
                                        INNER JOIN mz_decrire d ON t.numero = d.numero_TAGS
                                        WHERE d.numero_PROJET = :numero');
            $requete->execute(array('numero' => $numProjet));
            $resultat = $requete->fetchAll(PDO::FETCH_COLUMN);
            $tagListArray = array('tagList'=>$resultat);
            $compteDatas->add_ProjetInfos($numProjet,$tagListArray); unset($tagListArray);
            $requete->closeCursor(); $requete=NULL; unset($resultat);

            // liste des gens qui travaillent sur le même projet
            $requete = $pdo->prepare('  SELECT p.numero,nom,prenom,pseudo FROM mz_personne p
                                        INNER JOIN mz_travailler t ON p.numero = t.numero_PERSONNE
                                        WHERE t.numero_PROJET = :projNum
                                        AND p.ban = 0
                                        AND p.numero != :persNum');
            $requete->execute(array('projNum' => $numProjet,'persNum' => $safePersonneNum));
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
            $teamListArray = array('equipe'=>$resultat);
            $compteDatas->add_ProjetInfos($numProjet,$teamListArray); unset($teamListArray);
            $requete->closeCursor(); $requete=NULL; unset($resultat);
            
        }
        

        $pdo = NULL; // fin de connexion.
        
    }



    function wantLierProjet($safePersonneNum,$lier_nom,$lier_mdp) {

        $logErrorTxt = '';
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** vérifier si le projet existe avec ce mot de passe ***/
        $requete = $pdo->prepare('  SELECT numero FROM mz_projet
                                    WHERE nom = :nom AND mdp = :mdp');
        $requete->execute(array('nom' => $lier_nom,'mdp' => $lier_mdp));
        $numProj = $requete->fetchColumn();
        $requete->closeCursor(); $requete=NULL; 
        
        
        if ( $numProj != false || $numProj === 0 ) {
            
            /*** vérifier si le projet n'est pas déjà lié à cette personne ***/
            $requete = $pdo->prepare('  SELECT numero FROM mz_travailler
                                        WHERE numero_PERSONNE = :persNum
                                        AND numero_PROJET = :projNum');
            $requete->execute(array('persNum' => $safePersonneNum,'projNum' => $numProj));
            $resultat = $requete->fetchColumn();
            $requete->closeCursor(); $requete=NULL;
            
            
            if ( $resultat === false ) {
                
                /*** lier le projet à cette personne ***/
                
                $requete = $pdo->prepare('  INSERT INTO mz_travailler(numero_PERSONNE,numero_PROJET)
                                            VALUES(:persNum,:projNum)');
                $requete->execute(array('persNum' => $safePersonneNum,'projNum' => $numProj));
                $requete->closeCursor(); $requete=NULL;
                
                $logErrorTxt = 'Le projet a bien été ajouté.';
                
            } else {  $logErrorTxt = 'Erreur : la liaison existe déjà.'; }
            
        } else {  $logErrorTxt = 'Erreur : mot de passe incorrect ou projet inexistant.'; }
        
        
        unset($resultat); unset($numProj); $pdo = NULL; // fin de connexion.
        return $logErrorTxt;
        
    }



    function wantCreerProjet($safePersonneNum,$creer_nom,$creer_studio) {

        $logErrorTxt = '';
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** vérifier si le projet existe déjà avec ce studio ***/
        $requete = $pdo->prepare('  SELECT numero FROM mz_projet
                                    WHERE nom = :nom AND studio = :studio');
        $requete->execute(array('nom' => $creer_nom,'studio' => $creer_studio));
        $resultat = $requete->fetchColumn();
        $requete->closeCursor(); $requete=NULL; 
        
        
        if ( $resultat === false ) {
            
            /*** créer un mdp ***/
            $specSeed = '&&&&____';
            $abcdSeed = 'bBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ';
            $randSeed = mt_rand(100000000,999999999);
            $mdpProj = str_shuffle($abcdSeed.$randSeed.$specSeed);
            $mdpProj = substr($mdpProj,0,20);
            
            /*** créer le projet ***/
            $requete = $pdo->prepare('  INSERT INTO mz_projet(nom,studio,mdp) VALUES(:nom,:studio,:mdp)');
            $requete->execute(array('nom' => $creer_nom,'studio' => $creer_studio,'mdp' => $mdpProj));
            $requete->closeCursor(); $requete=NULL;
            
            /*** récupérer le numéro du projet ***/
            $requete = $pdo->prepare('  SELECT numero FROM mz_projet
                                        WHERE nom = :nom AND studio = :studio');
            $requete->execute(array('nom' => $creer_nom,'studio' => $creer_studio));
            $numProj = $requete->fetchColumn();
            $requete->closeCursor(); $requete=NULL;
            
            /*** lier le projet à cette personne ***/
            $requete = $pdo->prepare('  INSERT INTO mz_travailler(numero_PERSONNE,numero_PROJET)
                                        VALUES(:persNum,:projNum)');
            $requete->execute(array('persNum' => $safePersonneNum,'projNum' => $numProj));
            $requete->closeCursor(); $requete=NULL;

            unset($abcdSeed,$randSeed,$specSeed,$mdpProj);
            $logErrorTxt = 'Le projet a bien été créé.';
                
        } else {  $logErrorTxt = 'Erreur : ce projet existe déjà.'; }
        
        unset($resultat);
        $pdo = NULL; // fin de connexion.
        return $logErrorTxt;
        
    }



    function verifProjetRights($safePersonneNum,$numProjet,$pdo) {

        $logErrorTxt = '';
        
        /*** vérifier si le projet existe ***/
        $requete = $pdo->prepare('  SELECT numero FROM mz_projet WHERE numero = :numero');
        $requete->execute(array('numero' => $numProjet));
        $numProj = $requete->fetchColumn();
        $requete->closeCursor(); $requete=NULL;  
        
        if ( $numProj != false || $numProj === 0 ) {
            
            /*** vérifier si cette personne est bien liée au projet ***/
            $requete = $pdo->prepare('  SELECT numero FROM mz_travailler
                                        WHERE numero_PERSONNE = :persNum
                                        AND numero_PROJET = :projNum');
            $requete->execute(array('persNum' => $safePersonneNum,'projNum' => $numProj));
            $resultat = $requete->fetchColumn();
            $requete->closeCursor(); $requete=NULL;
            
            if ( $resultat === false ) { $logErrorTxt = 'Erreur : accès non autorisé.'; }
            
        } else {  $logErrorTxt = 'Erreur : projet inexistant.'; }
        
        unset($numProj,$resultat);
        return $logErrorTxt;
        
    }



    function wantModifInfos( $safePersonneNum,
                             $numProjet,
                             $modif_nom,
                             $modif_studio,
                             $modif_website,
                             $modif_dateSortie  ) {

        $logErrorTxt = '';
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $logErrorTxt = verifProjetRights($safePersonneNum,$numProjet,$pdo);
        
        if ( $logErrorTxt == '' ) {
            
            $requete = $pdo->prepare('  UPDATE mz_projet
                                        SET nom=:nom,studio=:studio,dateSortie=:dateSortie,website=:website
                                        WHERE numero=:numero');
            $requete->execute(array('nom'=>$modif_nom,'studio'=>$modif_studio,'dateSortie'=>$modif_dateSortie,'website'=>$modif_website,'numero'=>$numProjet));
            $requete->closeCursor(); $requete=NULL;
            
            $logErrorTxt = 'Les informations ont été mises à jour.';
            
        }
        
        $pdo = NULL; // fin de connexion.
        return $logErrorTxt;
        
    }



    function wantModifDescription($safePersonneNum,$numProjet,$modif_description) {

        $logErrorTxt = '';
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $logErrorTxt = verifProjetRights($safePersonneNum,$numProjet,$pdo);
        
        if ( $logErrorTxt == '' ) {
            
            $requete = $pdo->prepare('  UPDATE mz_projet
                                        SET description=:description
                                        WHERE numero=:numero');
            $requete->execute(array('description'=>$modif_description,'numero'=>$numProjet));
            $requete->closeCursor(); $requete=NULL;
            
            $logErrorTxt = 'La description a été mise à jour.';
            
        }
        
        $pdo = NULL; // fin de connexion.
        return $logErrorTxt;
        
    }



    function wantModifUrlVisuel($safePersonneNum,$numProjet,$modif_urlVisuel) {

        $logErrorTxt = '';
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $logErrorTxt = verifProjetRights($safePersonneNum,$numProjet,$pdo);
        
        if ( $logErrorTxt == '' ) {
            
            $requete = $pdo->prepare('  UPDATE mz_projet
                                        SET urlVisuel=:urlVisuel
                                        WHERE numero=:numero');
            $requete->execute(array('urlVisuel'=>$modif_urlVisuel,'numero'=>$numProjet));
            $requete->closeCursor(); $requete=NULL;
            
            $logErrorTxt = 'Le lien du visuel a été mis à jour.';
            
        }
        
        $pdo = NULL; // fin de connexion.
        return $logErrorTxt;
        
    }



    function wantProjetPassword($safePersonneNum,$numProjet) {

        $logErrorTxt = '';
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $logErrorTxt = verifProjetRights($safePersonneNum,$numProjet,$pdo);
        
        if ( $logErrorTxt == '' ) {
            
            $requete = $pdo->prepare('SELECT mdp FROM mz_projet WHERE numero=:numero');
            $requete->execute(array('numero'=>$numProjet));
            $resultat = $requete->fetchColumn();
            $requete->closeCursor(); $requete=NULL;
            
            $logErrorTxt = '<span class="hoverMdp">Survolez ce message pour afficher le mot de passe : <span>'.$resultat.'</span></span>';
            
            unset($resultat);
        }
        
        $pdo = NULL; // fin de connexion.
        return $logErrorTxt;
        
    }



    function wantRetirerProjet($safePersonneNum,$numProjet) {

        $logErrorTxt = '';
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $logErrorTxt = verifProjetRights($safePersonneNum,$numProjet,$pdo);
        
        if ( $logErrorTxt == '' ) {
            
            $requete = $pdo->prepare('  DELETE FROM mz_travailler
                                        WHERE numero_PERSONNE=:numPers
                                        AND numero_PROJET=:numProj');
            $requete->execute(array('numPers'=>$safePersonneNum,'numProj'=>$numProjet));
            $requete->closeCursor(); $requete=NULL;
            
            $logErrorTxt = 'Ce projet n\'est plus lié à votre profil.';
            
            /*** Supprimer le projet si personne d'autre ne l'affiche ***/
            
            $requete = $pdo->prepare('  SELECT numero FROM mz_travailler
                                        WHERE numero_PROJET = :numProj');
            $requete->execute(array('numProj' => $numProjet));
            $resultat = $requete->fetchAll(PDO::FETCH_COLUMN);
            $requete->closeCursor(); $requete=NULL;
            
            if( count($resultat) == 0 ) {
                
                $requete = $pdo->prepare('DELETE FROM mz_projet WHERE numero = :numProj');
                $requete->execute(array('numProj' => $numProjet));
                $requete->closeCursor(); $requete=NULL;
                
                $logErrorTxt = 'Ce projet a été supprimé avec succès.';
            }
            
            unset($resultat);
            
        }
        
        $pdo = NULL; // fin de connexion.
        return $logErrorTxt;
        
    }

?>