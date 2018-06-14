<?php 

    $pdo = new PDO(SERVEUR, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    /*** Selection du titre et des personnes à afficher ***/
        
    /* s'il y a un tag dans l'url, on va afficher les personnes qui y sont liées */
    if ($indexDatas->get_tagsFromUrlTxt() != '') {

        $indexDatas->set_titreHtml("Les résultats pour votre recherche : ".$indexDatas->get_tagsFromUrlTxt());

        $resultatBrut = array();
        $resultat = array();
        
        
        
        /* liste des personnes pour chaque tag */
        
        foreach ($indexDatas->get_tagsFromUrlArray() as $oneTagName) {
            
            //faire correspondre l'url au tag
            $oneTagName = preg_replace('/[-]/', ' ', $oneTagName); // des espaces
            $oneTagName = ucwords($oneTagName); // maj devant chaque mot
            
            // Personnes ayant le tag dans leur profil mais pas dans leurs projets :
            /*$requete = $pdo->prepare('  SELECT numero_PERSONNE FROM depeindre d
                                        INNER JOIN tags t on d.numero_TAGS = t.numero
                                        WHERE t.nom = :nom
                                        LIMIT :affichageLength');*/

            // Personnes ayant le tag soit dans leur profil soit dans leurs projets :
            $requete = $pdo->prepare('  SELECT DISTINCT numero_PERSONNE FROM
                                            (   SELECT numero_PERSONNE,numero_TAGS FROM mz_depeindre
                                                UNION
                                                SELECT numero_PERSONNE,numero_TAGS FROM mz_decrire d2
                                                    INNER JOIN mz_travailler tr ON d2.numero_PROJET = tr.numero_PROJET
                                            ) as d
                                        INNER JOIN mz_tags t ON d.numero_TAGS = t.numero
                                        WHERE t.nom = :nom
                                        LIMIT :affichageLength');
            $requete->execute(array('nom' => $oneTagName, 'affichageLength' => $indexDatas->get_indexLength()+1));
            $resultat = $requete->fetchAll(PDO::FETCH_COLUMN);
            $requete->closeCursor(); $requete=NULL;

            array_push($resultatBrut,$resultat);
        }
        
        
        
        /* si plusieurs tags, on fait l'intersection */
        
        if (count($resultatBrut)>1) {
            
            $intersectionResultats = array();
            
            for ($i=0; $i<count($resultatBrut)-1; $i++) {
                if ($i == 0) { $intersectionResultats = $resultatBrut[$i]; }
                $intersectionResultats = array_intersect($intersectionResultats,$resultatBrut[$i+1]);
            }
            
            $resultat = $intersectionResultats;
            
            
        } else { // sinon on renvoie juste la liste :

            $resultat = $resultatBrut[0];
        }

        $indexDatas->set_selectedPersonnesNumeros($resultat);
        $indexDatas->set_voirPlus(count($resultat));
        
        unset($resultatBrut);
        unset($resultat);
        

        
    /* s'il y a pas de tag dans l'url, on va choisir aléatoirement des personnes à afficher */
    } else {

        $indexDatas->set_titreHtml("Quelques personnes de l'industrie du jeu vidéo");

        /*** compter le nombre total de personnes ***/
        $requete = $pdo->query('SELECT COUNT(ban) FROM mz_personne WHERE ban = 0');
        $resultat = $requete->fetchColumn();
        $requete->closeCursor();
        $nombrePersonnes = $resultat;
        $requete=NULL; unset($resultat);
        
        // choisir des personnes aléatoirement
        $maxRand = $nombrePersonnes-1; 
        $personnesNumList = array();
        for ($i=0; $i<$indexDatas->get_indexLength(); $i++) {
            array_push($personnesNumList,mt_rand(0,$maxRand));
        }
        
        $indexDatas->set_selectedPersonnesNumeros(array_unique($personnesNumList));
        $indexDatas->set_voirPlus($nombrePersonnes);

    }



    /* On récupère le profil des personnes à afficher */
    foreach ($indexDatas->get_selectedPersonnesNumeros() as $onePersonnesNum) {
        
        $requete = $pdo->prepare('SELECT numero,ban,prenom,pseudo,nom,urlAvatar FROM mz_personne WHERE numero = :numero');
        $requete->execute(array('numero' => $onePersonnesNum));
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        $requete->closeCursor(); $requete=NULL;
        
        if ( $resultat['ban'] == 0 ) { // On affiche pas les personnes bannies.
            
            $indexDatas->add_PersonneInfos($resultat);
            
        }
        
        unset($resultat);
        
    }


    $pdo = NULL; // fin de connexion.

?>