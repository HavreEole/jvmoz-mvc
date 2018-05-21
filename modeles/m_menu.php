<?php 

    $pdo = new PDO(SERVEUR, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    /* Récupérer une liste de tags, triés par nb d'affichages. */

    $requete = $pdo->prepare('SELECT nom,nbUsages FROM mz_tags ORDER BY nbUsages DESC LIMIT :affichageLength');
        $requete->execute(array('affichageLength' => $listes->get_menuLength()));
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor(); $requete=NULL;
        
        foreach ($resultat as &$oneResultat) { // Faire correspondre le nom à l'url :

            $nomTagPourUrl = strtolower($oneResultat['nom']); // pas de majs
            $nomTagPourUrl = preg_replace('/[ ]/', '-', $nomTagPourUrl); // les espaces sont des -.
            // ! on autorisera que a-zA-Z0-9 et - dans la création de tags.
            
            $oneResultat['nomPourUrl'] = $nomTagPourUrl;
            
            /* /!\ On ne peut faire un array_push sur une valeur ($oneResultat) du tableau ($resultat) passé en foreach que grace au & -> &$oneResultat. https://stackoverflow.com/questions/9920619/changing-value-inside-foreach-loop-doesnt-change-value-in-the-array-being-itera#9920684 "In order to be able to directly modify array elements within the loop precede $value with &. In that case the value will be assigned by reference." */ // Elle m'aura bien fait patiner celle là... -_-
        }
        
        // calculer et trier le nombre d'utilisations des tags en temps réel ?
        // Juste usages par personnes : SELECT t.nom,count(d.numero_TAGS) ct FROM `tags` t inner join depeindre d on t.numero = d.numero_TAGS group by t.nom ORDER BY `ct` DESC
        // Ou usages par personnes ET projets : // SELECT DISTINCT nom,count(d.numero_TAGS) ct from tags t INNER JOIN ( SELECT numero_PERSONNE,numero_TAGS FROM depeindre UNION SELECT numero_PERSONNE,numero_TAGS FROM decrire d2 INNER JOIN travailler tr ON d2.numero_PROJET = tr.numero_PROJET ) as d ON d.numero_TAGS = t.numero group by t.nom ORDER BY ct DESC;

    $tags = $resultat;
    unset($resultat);



    /* si des tags sont dans l'url, ils devront forcément apparaitre dans la liste */

    if (!empty($listes->get_tagsFromUrlArray())) {
        
            $tagsFromUrl = $listes->get_tagsFromUrlArray();
            $tagExistAlready = array(); $tagsToAdd = array();

            // retirer ceux déjà dans la liste des tags à ajouter,
            foreach($tags as $aTag) {
                foreach($tagsFromUrl as $aTagsFromUrl) {
                    if ($aTag['nomPourUrl'] == $aTagsFromUrl) {
                        array_push($tagExistAlready,$aTagsFromUrl);
                    }
                }
            }
        
            $tagsToAdd = array_diff($tagsFromUrl,$tagExistAlready);
        
            // puis ajouter ..les tags à ajouter.. dans la liste des tags :
            foreach($tagsToAdd as $aTagToAdd) {
                
                //faire correspondre l'url au tag
                $aName = preg_replace('/[-]/', ' ', $aTagToAdd); // des espaces
                $aName = ucwords($aName); // maj devant chaque mot
                // /!\ ne marche pas pour "2D" par exemple, maj après la première lettre.

                $requete = $pdo->prepare('SELECT nom,nbUsages FROM mz_tags WHERE nom = :nom');
                $requete->execute(array('nom' => $aName));
                $resultat = $requete->fetch(PDO::FETCH_ASSOC);
                $requete->closeCursor(); $requete=NULL;

                $resultat['nomPourUrl'] = $aTagToAdd;
                
                array_push($tags,$resultat);
            }

    }

    $listes->set_tagsListeAffichee($tags);

    $pdo = NULL;

?>