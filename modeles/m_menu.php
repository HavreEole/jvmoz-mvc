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

        /* Récupérer une liste de tags, triés par nb d'affichages. */

        $requete = $pdo->prepare('  SELECT nom,nbUsages FROM mz_tag
                                    ORDER BY nbUsages DESC LIMIT :affichageLength');
        $requete->execute(array('affichageLength' => $affichageLength));
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor(); $requete=NULL; $pdo = NULL;

        return $resultat;
        
    }



    function getOneTag($aName) {
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* Récupérer une liste de tags, triés par nb d'affichages. */

        $requete = $pdo->prepare('SELECT nom,nbUsages FROM mz_tag WHERE nom = :nom');
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
            SELECT DISTINCT nom,count(d.numero_TAG) as cttags FROM tags t
            INNER JOIN (
                SELECT numero_PERSONNE,numero_TAG FROM depeindre
                UNION SELECT numero_PERSONNE,numero_TAG FROM decrire d2
                INNER JOIN travailler tr ON d2.numero_PROJET = tr.numero_PROJET
            ) as d ON d.numero_TAG = t.numero
            GROUP BY t.nom ORDER BY cttags DESC;
        */

    // Nota : les personnes bannies ou qui ne veulent pas être affichées sont toujours comptées.


?>