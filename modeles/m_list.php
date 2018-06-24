<?php 



    function getListPersonnesParTag($oneTagName) {
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Personnes ayant le tag dans leur profil mais pas dans leurs projets :
        /*$requete = $pdo->prepare('  SELECT numero_PERSONNE FROM depeindre d
                                    INNER JOIN tags t on d.numero_TAG = t.numero
                                    WHERE t.nom = :nom
                                    LIMIT :affichageLength');*/

        // Personnes ayant le tag soit dans leur profil soit dans leurs projets :
        $requete = $pdo->prepare('  SELECT DISTINCT numero_PERSONNE FROM
                                        (   SELECT numero_PERSONNE,numero_TAG FROM mz_depeindre
                                            UNION
                                            SELECT numero_PERSONNE,numero_TAG FROM mz_decrire d2
                                                INNER JOIN mz_travailler tr ON d2.numero_PROJET = tr.numero_PROJET
                                        ) as d
                                    INNER JOIN mz_tag t ON d.numero_TAG = t.numero
                                    WHERE t.nom = :nom  ');
        
        $requete->execute(array('nom' => $oneTagName));
        $resultat = $requete->fetchAll(PDO::FETCH_COLUMN);
        $requete->closeCursor(); $requete=NULL; $pdo = NULL; // fin de connexion.
        
        return $resultat;
    }



    function getNumPersonnesNonBan() {
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** compter le nombre total de personnes, non bannies ***/
        $requete = $pdo->query('SELECT numero FROM mz_personne WHERE ban = 0');
        $resultat = $requete->fetchAll(PDO::FETCH_COLUMN);
        $requete->closeCursor(); $requete=NULL; $pdo = NULL; // fin de connexion.
        
        return $resultat;
    }



    function getPersonneProfilInfos($onePersonnesNum) {
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = $pdo->prepare('  SELECT numero,prenom,pseudo,nom,urlAvatar FROM mz_personne
                                    WHERE numero = :numero AND ban = 0');
        $requete->execute(array('numero' => $onePersonnesNum));
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        $requete->closeCursor(); $requete=NULL; $pdo = NULL; // fin de connexion.

        return $resultat;
    }

    

?>