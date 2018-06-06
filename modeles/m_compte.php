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

    // récupérer les numeros de projets d'une personne
    $requete = $pdo->prepare('SELECT numero_PROJET FROM mz_travailler WHERE numero_PERSONNE = :numero');
    $requete->execute(array('numero' => $safePersonneNum));
    $resultat = $requete->fetchAll(PDO::FETCH_COLUMN);
    $compteDatas->set_projetsListNum($resultat);
    $requete->closeCursor(); $requete=NULL; unset($resultat);


    // récupérer les noms de chaque projet
    foreach( $compteDatas->get_projetsListNum() as $aProjectNum ) {

        $requete = $pdo->prepare('SELECT nom FROM mz_projet WHERE numero = :numero');
        $requete->execute(array('numero' => $aProjectNum));
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        $compteDatas->add_projetsListNom($aProjectNum,$resultat);
        $requete->closeCursor(); $requete=NULL; unset($resultat);

    }

    $pdo = NULL; // fin de connexion.

?>