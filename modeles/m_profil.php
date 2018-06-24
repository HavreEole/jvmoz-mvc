 <?php 

    $pdo = new PDO(SERVEUR, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    /*** Vérification de présence de num dans l'url ***/

    if (Recuperation::testNotEmptyGetFromUrl("num")) { // s'il y a des num dans l'url,

        
        /*** récupérer le num dans l'url, ***/
        $safePersonneNum = Recuperation::getGetFromUrl("num");
        $requete = $pdo->prepare('SELECT ban FROM mz_personne WHERE numero = :numero');
        $requete->execute(array('numero' => $safePersonneNum));
        $resultat = $requete->fetchColumn();
        if ( $resultat === 0 ) { // La personne existe et n'est pas bannie.
            $profilDatas->set_profilPersonneNum($safePersonneNum);
        }
        $requete->closeCursor(); $requete=NULL; unset($resultat);

        
        
        // Si la personne existe et n'est pas bannie,
        if ( $profilDatas->get_profilPersonneNum() != -1 ) {
        
            
            /*** récupérer le profil de la personne ***/
            $requete = $pdo->prepare('SELECT numero,prenom,pseudo,nom,twitter,linkedin,website,description,urlAvatar FROM mz_personne WHERE numero = :numero');
            $requete->execute(array('numero' => $safePersonneNum));
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);
            $profilDatas->add_PersonneInfos($resultat);
            $requete->closeCursor(); $requete=NULL; unset($resultat);


            /*** récupérer les tags de la personne ***/
            $requete = $pdo->prepare('  SELECT nom FROM mz_tag t
                                    INNER JOIN mz_depeindre d ON t.numero = d.numero_TAG
                                    WHERE d.numero_PERSONNE = :numero');
            $requete->execute(array('numero' => $safePersonneNum));
            $resultat = $requete->fetchAll(PDO::FETCH_COLUMN);
            $profilDatas->add_PersonneInfos(array('numero'=>$safePersonneNum,'tagList'=>$resultat));
            $requete->closeCursor(); $requete=NULL; unset($resultat);


            /*** récupérer les projets de la personne ***/

            // récupérer les numeros de projets d'une personne
            $requete = $pdo->prepare('SELECT numero_PROJET FROM mz_travailler WHERE numero_PERSONNE = :numero ORDER BY numero_PROJET DESC');
            $requete->execute(array('numero' => $safePersonneNum));
            $resultat = $requete->fetchAll(PDO::FETCH_COLUMN);
            $profilDatas->set_profilProjetsNum($resultat);
            $requete->closeCursor(); $requete=NULL; unset($resultat);


            // récupérer les infos de chaque projet
            foreach( $profilDatas->get_profilProjetsNum() as $aProjectNum ) {


                $requete = $pdo->prepare('SELECT numero,nom,studio,description,dateSortie,website,urlVisuel FROM mz_projet WHERE numero = :numero');
                $requete->execute(array('numero' => $aProjectNum));
                $resultat = $requete->fetch(PDO::FETCH_ASSOC);
                $profilDatas->add_ProjetInfos($resultat);
                $requete->closeCursor(); $requete=NULL; unset($resultat);


                // récupérer les tags qui décrivent le projet
                $requete = $pdo->prepare('  SELECT nom FROM mz_tag t
                                            INNER JOIN mz_decrire d ON t.numero = d.numero_TAG
                                            WHERE d.numero_PROJET = :numero');
                $requete->execute(array('numero' => $aProjectNum));
                $resultat = $requete->fetchAll(PDO::FETCH_COLUMN);
                $profilDatas->add_ProjetInfos(array('numero'=>$aProjectNum,'tagList'=>$resultat));
                $requete->closeCursor(); $requete=NULL; unset($resultat);


                // liste des gens qui travaillent sur le même projet
                $requete = $pdo->prepare('  SELECT p.numero,nom,prenom,pseudo FROM mz_personne p
                                            INNER JOIN mz_travailler t ON p.numero = t.numero_PERSONNE
                                            WHERE t.numero_PROJET = :projNum
                                            AND p.ban = 0
                                            AND p.numero != :persNum');
                $requete->execute(array('projNum' => $aProjectNum,'persNum' => $safePersonneNum));
                $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
                $profilDatas->add_ProjetInfos(array('numero'=>$aProjectNum,'equipe'=>$resultat));
                $requete->closeCursor(); $requete=NULL; unset($resultat);

            }
            
        
        }
        
    }



    $pdo = NULL; // fin de connexion.

?>