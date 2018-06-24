 <?php 


    function wantAfficherProfil($aNum) {

        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $requete = $pdo->prepare('UPDATE mz_personne SET ban=:ban');
        $requete->execute(array('ban' => $aNum));
        $requete->closeCursor(); $requete=NULL; $pdo = NULL; // fin de connexion.
        
    }



    function wantIdentite($numero,$nom,$prenom,$pseudo) {

        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = $pdo->prepare('  UPDATE mz_personne
                                    SET nom=:nom,prenom=:prenom,pseudo=:pseudo
                                    WHERE numero=:numero');
        $requete->execute(array('nom'=>$nom,'prenom'=>$prenom,'pseudo'=>$pseudo,'numero'=>$numero));
        $requete->closeCursor(); $requete=NULL; $pdo = NULL; // fin de connexion.
    }



    function wantConfidentiel($numero,$email0,$mdpCru,$email='',$mdp='') {
        
        $erreurTxt = '';
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // vérifier l'ancien email et mdp
        $requete = $pdo->prepare('  SELECT email,mdp FROM mz_personne WHERE numero=:numero');
        $requete->execute(array('numero'=>$numero));
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        $requete->closeCursor(); $requete=NULL;
        
        if (    $resultat['email'] == $email0
                && password_verify($mdpCru,$resultat['mdp'])    ) {
            
            // Notes sur password_verify() :
                // https://secure.php.net/manual/fr/function.password-verify.php
                // password_verify($mdpTesté,$mdpDeBDD) -> renvoie true si ok.
            // S'utilise en combinaison avec :
                // https://secure.php.net/manual/fr/function.password-hash.php
                // $safeGetThing = password_hash($safeGetThing, PASSWORD_BCRYPT);
            
            if ($email != '') { // remplacer l'email
                $requete = $pdo->prepare('  UPDATE mz_personne
                                            SET email=:email
                                            WHERE numero=:numero');
                $requete->execute(array('email'=>$email,'numero'=>$numero));
                $requete->closeCursor(); $requete=NULL;
                
                $erreurTxt .= 'Votre email a été mis à jour. ';
            }

            if ($mdp != '') { // remplacer le mdp
                $requete = $pdo->prepare('  UPDATE mz_personne
                                            SET mdp=:mdp
                                            WHERE numero=:numero');
                $requete->execute(array('mdp'=>$mdp,'numero'=>$numero));
                $requete->closeCursor(); $requete=NULL;
                
                $erreurTxt .= 'Votre mot de passe a été mis à jour.';
            }
            
            
        } else {
            $erreurTxt = 'Erreur : mauvais email ou mot de passe.';
        }
        
        unset($resultat);
        $pdo = NULL; // fin de connexion.
        return $erreurTxt;
        
    }



    function wantDescription($numero,$description) {
        
        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = $pdo->prepare('  UPDATE mz_personne
                                    SET description=:description
                                    WHERE numero=:numero');
        $requete->execute(array('description'=>$description,'numero'=>$numero));
        $requete->closeCursor(); $requete=NULL; $pdo = NULL; // fin de connexion.
    }



    function wantLiens($numero,$linkedin,$twitter,$website,$urlAvatar) {

        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = $pdo->prepare('  UPDATE mz_personne
                                    SET linkedin=:linkedin,twitter=:twitter,website=:website,urlAvatar=:urlAvatar
                                    WHERE numero=:numero');
        $requete->execute(array('linkedin'=>$linkedin,'twitter'=>$twitter,'website'=>$website,'urlAvatar'=>$urlAvatar,'numero'=>$numero));
        $requete->closeCursor(); $requete=NULL; $pdo = NULL; // fin de connexion.
    }

?>