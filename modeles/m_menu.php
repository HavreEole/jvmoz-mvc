<?php 


    function getNbTags() {
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* Récupérer le nb total de tags. */

        $requete = $pdo->query('SELECT count(numero) FROM mz_tag');
        $resultat = $requete->fetchColumn();
        $requete->closeCursor(); $requete=NULL; $pdo = NULL;

        return $resultat;
        
    }


    function getListTags($affichageLength) {
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* Récupérer une liste de tags, triés par nb d'affichages, avec ban = 0 */

        $requete = $pdo->prepare('  SELECT DISTINCT t.nom,count(d.numero_TAG) as nbUsages FROM mz_tag t
                                    INNER JOIN (
                                        SELECT numero_PERSONNE,numero_TAG FROM mz_depeindre d1
                                        UNION SELECT numero_PERSONNE,numero_TAG FROM mz_decrire d2
                                        INNER JOIN mz_travailler tr ON d2.numero_PROJET = tr.numero_PROJET
                                    ) as d ON d.numero_TAG = t.numero
                                    INNER JOIN mz_personne p ON d.numero_PERSONNE = p.numero
                                    WHERE p.ban = 0
                                    GROUP BY t.nom ORDER BY nbUsages DESC LIMIT :affichageLength    ');
        $requete->execute(array('affichageLength' => $affichageLength));
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor(); $requete=NULL; $pdo = NULL;

        return $resultat;
        
    }



    function getOneTag($aName) {
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* Récupérer un tag, son nb d'affichages, avec ban = 0 */

        // $requete = $pdo->prepare('SELECT nom,nbUsages FROM mz_tag WHERE nom = :nom');
        $requete = $pdo->prepare('SELECT DISTINCT t.nom,count(d.numero_TAG) as nbUsages FROM mz_tag t
                                    INNER JOIN (
                                        SELECT numero_PERSONNE,numero_TAG FROM mz_depeindre d1
                                        UNION SELECT numero_PERSONNE,numero_TAG FROM mz_decrire d2
                                        INNER JOIN mz_travailler tr ON d2.numero_PROJET = tr.numero_PROJET
                                    ) as d ON d.numero_TAG = t.numero
                                    INNER JOIN mz_personne p ON d.numero_PERSONNE = p.numero
                                    WHERE p.ban = 0 AND t.nom = :nom');
        $requete->execute(array('nom' => $aName));
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        $requete->closeCursor(); $requete=NULL; $pdo = NULL;

        return $resultat;
        
    }



    // calculer et trier le nombre d'utilisations des tags en temps réel :

        // Usages par personnes :
        /*
            SELECT t.nom,count(d.numero_TAG) as cttags FROM tags t
            INNER JOIN depeindre d ON t.numero = d.numero_TAG
            GROUP BY t.nom ORDER BY cttags DESC
        */

        // Usages par personnes ET projets :
        /*
            SELECT DISTINCT nom,count(d.numero_TAG) as nbUsages FROM mz_tag t
            INNER JOIN (
                SELECT numero_PERSONNE,numero_TAG FROM mz_depeindre
                UNION SELECT numero_PERSONNE,numero_TAG FROM mz_decrire d2
                INNER JOIN mz_travailler tr ON d2.numero_PROJET = tr.numero_PROJET
            ) as d ON d.numero_TAG = t.numero
            GROUP BY t.nom ORDER BY nbUsages DESC LIMIT :affichageLength
        */

        // Usages par personnes ET projets, ban = 0 :
        /*
            SELECT DISTINCT t.nom,count(d.numero_TAG) as nbUsages FROM mz_tag t
            INNER JOIN (
                SELECT numero_PERSONNE,numero_TAG FROM mz_depeindre d1
                UNION SELECT numero_PERSONNE,numero_TAG FROM mz_decrire d2
                INNER JOIN mz_travailler tr ON d2.numero_PROJET = tr.numero_PROJET
            ) as d ON d.numero_TAG = t.numero
            INNER JOIN mz_personne p ON d.numero_PERSONNE = p.numero
            WHERE p.ban = 0
            GROUP BY t.nom ORDER BY nbUsages DESC LIMIT :affichageLength
        */

    // Nota : les personnes bannies ou qui ne veulent pas être affichées sont toujours comptées.


?>