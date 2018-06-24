<?php 

    if (extension_loaded("PDO")) {
            
        try {
            
            include_once("/modeles/m_menu.php");
            
            
            
            /* Récupérer l'offset du menu. */
            if ( isset($_POST['menu_voir_plus']) ) {
                $indexSessionDatas['menuOffset'][0] += 6;
                unset($_POST['menu_voir_plus']);
                
            } else if ( isset($_POST['menu_raz']) ) {
                $indexSessionDatas['menuOffset'][0] = 6;
                unset($_POST['menu_raz']);
                
            }
            $indexSessionDatas['menuOffset'][1] = getNbTags();
            $menuLength = $indexSessionDatas['menuOffset'][0];
            
            
            
            /* Récupérer une liste de tags, triés par nb d'affichages. */

            $listTags = getListTags($menuLength);

            foreach ($listTags as &$oneResultat) { // Faire correspondre le nom à l'url :

                $nomTagPourUrl = strtolower($oneResultat['nom']); // pas de majs
                $nomTagPourUrl = preg_replace('/[ ]/', '-', $nomTagPourUrl); // les espaces sont des -.
                // ! on autorisera que a-zA-Z0-9 et - dans la création de tags.

                $oneResultat['nomPourUrl'] = $nomTagPourUrl;

                /* /!\ On ne peut faire un array_push sur une valeur ($oneResultat) du tableau ($listTags) passé en foreach que grace au & -> &$oneResultat. https://stackoverflow.com/questions/9920619/changing-value-inside-foreach-loop-doesnt-change-value-in-the-array-being-itera#9920684 "In order to be able to directly modify array elements within the loop precede $value with &. In that case the value will be assigned by reference." */ // Elle m'aura bien fait patiner celle là... -_-
            }

            

            /* si des tags sont dans l'url, ils devront forcément apparaitre dans la liste */

            if (!empty($indexDatas->get_tagsFromUrlArray())) {

                    $tagsFromUrl = $indexDatas->get_tagsFromUrlArray();
                    $tagExistAlready = array(); $tagsToAdd = array();

                    // retirer ceux déjà dans la liste des tags à ajouter,
                    foreach($listTags as $aTag) {
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

                        $aNewTag = getOneTag($aName);
                        $aNewTag['nomPourUrl'] = $aTagToAdd;

                        array_push($listTags,$aNewTag);
                    }

            }

            $indexDatas->set_tagsListeAffichee($listTags);
            
            
            
            /* Afficher le menu */
            
            include_once("/vues/v_menu.php");
            
            
            

        } catch (exception $e) {
            $erreurTxt = "Erreur - Accès refusé";
            include_once("/vues/v_erreur.php");
            include_once("/controleurs/c_footer.php");
            unset($erreurTxt);
            die();
        }
            
    }

?>