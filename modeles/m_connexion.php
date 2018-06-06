<?php 


    $pdo = new PDO(SERVEUR, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    // on vérifie si le login correspond à qqun.
    $requete = $pdo->prepare('SELECT numero,ban,admin,mdp,nom,prenom,pseudo FROM mz_personne WHERE email = :email');
    $requete->execute(array('email' => $safeLogin));
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    $requete->closeCursor(); $requete=NULL;



    /* Si la personne n'existe pas. */
    if ( $resultat === false ) {

        if ($wantInscription) {
            // -> si bouton inscription on va l'inscrire dans la BDD.
            // Ban=2 car le compte n'apparaitra pas dans l'annuaire pour l'instant.
            
            $numCompte = $resultat['numero'];
            
            $requete = $pdo->prepare('  INSERT INTO mz_personne(email,mdp,admin,ban,urlAvatar)
                                        VALUES (:email,:mdp,0,2,"vues/img/avatars/0.jpg")');
            $requete->execute(array('email' => $safeLogin,'mdp' => $safeMdp));
            $requete->closeCursor(); $requete=NULL;
            
            
        } else {
            // -> sinon on va afficher une erreur de login.
            $erreurTxt = 'Erreur : cet email n\'est pas enregistré.';
        }
        
        

    /* Si la personne existe, mdp ok, et elle n'est pas bannie. */
    } else if ( $resultat['mdp'] == $safeMdp && $resultat['ban'] != 1 ) {

        $numCompte = $resultat['numero'];
        $identiteCompte = ($resultat['pseudo'] != '') ? $resultat['pseudo'] : $resultat['prenom']." ".$resultat['nom'];
        // isAdmin ... TODO
        

    /* Si la personne existe, mdp ok, mais bannie. */
    } else if ( $resultat['mdp'] == $safeMdp ) {
        $erreurTxt = 'Erreur : veuillez contacter l\'administration.';

        
        
    /* La personne existe et n'est pas bannie, mais mauvais mdp. */
    } else {
        if ($wantInscription) { $erreurTxt = 'Erreur : cet email est déjà enregistré.'; }
        else { $erreurTxt = 'Erreur : ce mot de passe n\'est pas valide.'; }
    }



    unset($resultat);
    $pdo = NULL; // fin de connexion.
        

?>