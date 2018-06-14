 <?php 
        
    $pdo = new PDO(SERVEUR, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    /*** récupérer le profil de la personne ***/
    $requete = $pdo->prepare('SELECT * FROM mz_personne WHERE numero = :numero');
    $requete->execute(array('numero' => $safePersonneNum));
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    $compteDatas->set_infos($resultat);
    $requete->closeCursor(); $requete=NULL; unset($resultat);


    /*** récupérer les tags de la personne ***/
    $requete = $pdo->prepare('  SELECT nom FROM mz_tags t
                            INNER JOIN mz_depeindre d ON t.numero = d.numero_TAGS
                            WHERE d.numero_PERSONNE = :numero');
    $requete->execute(array('numero' => $safePersonneNum));
    $resultat = $requete->fetchAll(PDO::FETCH_COLUMN);
    $compteDatas->set_tagsListNom($resultat);
    $requete->closeCursor(); $requete=NULL; unset($resultat);


    /*** récupérer les projets de la personne ***/
    $requete = $pdo->prepare('SELECT p.nom FROM mz_projet p
                            INNER JOIN mz_travailler t ON t.numero_PROJET = p.numero
                            WHERE t.numero_PERSONNE = :numero ORDER BY p.numero DESC');
    $requete->execute(array('numero' => $safePersonneNum));
    $resultat = $requete->fetchAll(PDO::FETCH_COLUMN);
    $compteDatas->set_projetsListNom($resultat);
    $requete->closeCursor(); $requete=NULL; unset($resultat);


    $pdo = NULL; // fin de connexion.

?>