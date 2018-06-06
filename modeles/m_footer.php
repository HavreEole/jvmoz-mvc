<?php 

    $pdo = new PDO(SERVEUR, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Footer : trouver tous les admins du site.
    $requete = $pdo->query('SELECT numero,prenom,pseudo,nom FROM mz_personne WHERE admin=1');
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    $footerInfos = $resultat;
    $requete->closeCursor(); $requete=NULL; unset($resultat);
    $pdo = NULL;

?>