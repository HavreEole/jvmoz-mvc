 <?php


    function getAdminAllSearch($adminDatas) {

        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** récupérer la liste des personnes avec offset ***/
        
        $mySearch = "%".$adminDatas['comptesSearch']."%";
        $myOffset = $adminDatas['comptesOffset'];
        
        $requete = $pdo->prepare("  SELECT numero,nom,prenom,pseudo,admin,ban FROM mz_personne
                                    WHERE nom LIKE :mySearch
                                    OR prenom LIKE :mySearch1
                                    OR pseudo LIKE :mySearch2
                                    ORDER BY numero DESC LIMIT 12 OFFSET :myOffset ");
        $requete->execute(array('mySearch'=>$mySearch,'mySearch1'=>$mySearch,'mySearch2'=>$mySearch,'myOffset'=>$myOffset));
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        $adminDatas['comptes'] = $resultat;
        $requete->closeCursor(); $requete=NULL; unset($resultat);
        

        /*** récupérer la liste des tags avec offset ***/
        
        $mySearch = "%".$adminDatas['tagsSearch']."%";
        $myOffset = $adminDatas['tagsOffset'];
        
        $requete = $pdo->prepare("  SELECT numero,nom,nbUsages FROM mz_tags
                                    WHERE nom LIKE :mySearch
                                    ORDER BY numero DESC LIMIT 12 OFFSET :myOffset ");
        $requete->execute(array('mySearch'=>$mySearch,'myOffset'=>$myOffset));
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        $adminDatas['tags'] = $resultat;
        $requete->closeCursor(); $requete=NULL; unset($resultat);
        
        $pdo = NULL; // fin de connexion.
        return $adminDatas;
        
    }



    function setAdminCompteAdminiser($numPersonne) {

        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = $pdo->prepare("  UPDATE mz_personne
                                    SET admin = (
                                        CASE admin
                                            WHEN 1 THEN admin -1
                                            WHEN 0 THEN admin +1
                                        END
                                    )
                                    WHERE numero = :numero");
        $requete->execute(array('numero'=>$numPersonne));
        $requete->closeCursor(); $requete=NULL; $pdo = NULL; // fin de connexion.
        
    }



    function setAdminCompteBanniser($numPersonne) {

        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = $pdo->prepare("  UPDATE mz_personne
                                    SET ban = (
                                        CASE ban
                                            WHEN 2 THEN ban -1
                                            WHEN 0 THEN ban +1
                                            WHEN 1 THEN ban -1
                                        END
                                    )
                                    WHERE numero = :numero ");
        $requete->execute(array('numero'=>$numPersonne));
        $requete->closeCursor(); $requete=NULL; $pdo = NULL; // fin de connexion.
        
    }



    function setAdminTagModif($nomTag,$numTag) {

        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        /*** Modifier le nom du tag ***/
        $requete = $pdo->prepare(" UPDATE mz_tags SET nom=:nom WHERE numero = :numero ");
        $requete->execute(array('nom'=>$nomTag,'numero'=>$numTag));
        $requete->closeCursor(); $requete=NULL; $pdo = NULL; // fin de connexion.
        
    }



    function setAdminTagSuppr($numTag) {

        $pdo = new PDO(SERVEUR, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        /*** Supprimer les liaisons avec les personnes ***/
        $requete = $pdo->prepare(" DELETE FROM mz_depeindre WHERE numero_TAGS = :numero ");
        $requete->execute(array('numero'=>$numTag));
        $requete->closeCursor(); $requete=NULL;
        
        /*** Supprimer les liaisons avec les projets ***/
        $requete = $pdo->prepare(" DELETE FROM mz_decrire WHERE numero_TAGS = :numero ");
        $requete->execute(array('numero'=>$numTag));
        $requete->closeCursor(); $requete=NULL;
        
        /*** Supprimer le tag ***/
        $requete = $pdo->prepare(" DELETE FROM mz_tags WHERE numero = :numero ");
        $requete->execute(array('numero'=>$numTag));
        $requete->closeCursor(); $requete=NULL;
        
        $pdo = NULL; // fin de connexion.
        
    }



    



?>