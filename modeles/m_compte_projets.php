 <?php 

    function getTagsInfos($safePersonneNum,$compteDatas) {

        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // infos du projet
        $requete = $pdo->prepare('SELECT numero,nom,studio,description,dateSortie,website,urlVisuel FROM mz_projet WHERE numero = :numero');
        $requete->execute(array('numero' => $numProjet));
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        $compteDatas->add_ProjetInfos($numProjet,$resultat);
        $requete->closeCursor(); $requete=NULL; unset($resultat);

        // récupérer les tags qui décrivent le projet
        $requete = $pdo->prepare('  SELECT nom FROM mz_tags t
                                    INNER JOIN mz_decrire d ON t.numero = d.numero_TAGS
                                    WHERE d.numero_PROJET = :numero');
        $requete->execute(array('numero' => $numProjet));
        $resultat = $requete->fetchAll(PDO::FETCH_COLUMN);
        $compteDatas->add_ProjetInfos($numProjet,$resultat);
        $requete->closeCursor(); $requete=NULL; unset($resultat);

        // liste des gens qui travaillent sur le même projet
        $requete = $pdo->prepare('  SELECT p.numero,nom,prenom,pseudo FROM mz_personne p
                                    INNER JOIN mz_travailler t ON p.numero = t.numero_PERSONNE
                                    WHERE t.numero_PROJET = :projNum
                                    AND p.ban = 0
                                    AND p.numero != :persNum');
        $requete->execute(array('projNum' => $numProjet,'persNum' => $safePersonneNum));
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        $compteDatas->add_ProjetInfos($numProjet,$resultat);
        $requete->closeCursor(); $requete=NULL; unset($resultat);

        $pdo = NULL; // fin de connexion.
        
    }


?>