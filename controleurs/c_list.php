<?php 

    if (extension_loaded("PDO")) {
            
        try {
            
            include_once("/modeles/m_list.php");
            
            
            
            /* Récupérer l'offset de la liste. */
            if ( isset($_POST['list_voir_plus']) ) {
                $indexSessionDatas['listOffset'][0] += 8;
                unset($_POST['list_voir_plus']);

            } else if ( isset($_POST['list_raz']) ) {
                $indexSessionDatas['listOffset'][0] = 8;
                $indexSessionDatas['list'] = array();
                unset($_POST['list_raz']);

            }
            $listLength = $indexSessionDatas['listOffset'][0];
            
            
            
            /*** s'il y a un tag dans l'url, on va afficher les personnes qui y sont liées ***/
            if ($indexDatas->get_tagsFromUrlTxt() != '') {
                
                $indexDatas->set_titreHtml("Les résultats pour votre recherche : ".$indexDatas->get_tagsFromUrlTxt());

                $resultatBrut = array();
                $resultat = array();



                /* liste des personnes pour chaque tag */

                foreach ($indexDatas->get_tagsFromUrlArray() as $oneTagName) {

                    //faire correspondre l'url au tag
                    $oneTagName = preg_replace('/[-]/', ' ', $oneTagName); // des espaces
                    $oneTagName = ucwords($oneTagName); // maj devant chaque mot

                    $listPersonnesParTag = getListPersonnesParTag($oneTagName,$listLength);
                    
                    array_push($resultatBrut,$listPersonnesParTag);
                }



                /* si plusieurs tags, on fait l'intersection */

                if (count($resultatBrut)>1) {

                    $intersectionResultats = array();

                    for ($i=0; $i<count($resultatBrut)-1; $i++) {
                        if ($i == 0) { $intersectionResultats = $resultatBrut[$i]; }
                        $intersectionResultats = array_intersect($intersectionResultats,$resultatBrut[$i+1]);
                    }

                    $resultat = $intersectionResultats;


                } else { // sinon on renvoie juste la liste :

                    $resultat = $resultatBrut[0];
                }

                $indexDatas->set_selectedPersonnesNumeros($resultat);
                $indexSessionDatas['listOffset'][1] = count($resultat)+1;

                unset($resultatBrut);
                unset($resultat);



            /*** s'il y a pas de tag dans l'url, on va choisir aléatoirement des personnes à afficher ***/
            } else {
                
                $indexDatas->set_titreHtml("Quelques personnes de l'industrie du jeu vidéo");
                
                
                if ( count($indexSessionDatas['list']) == 0 ) {
                    
                    $allNumPersonnes = getNumPersonnesNonBan();
                    shuffle($allNumPersonnes);
                    $indexSessionDatas['list'] = $allNumPersonnes;
                    
                    $allNbPersonnes = count($allNumPersonnes);
                    $indexSessionDatas['listOffset'][1] = $allNbPersonnes;
                    
                }
                
                $personnesNumList = array_slice(    $indexSessionDatas['list'],
                                                    0, $indexSessionDatas['listOffset'][0]  );
                
                $indexDatas->set_selectedPersonnesNumeros($personnesNumList);
                
                
                
            }



            /*** On récupère le profil des personnes à afficher ***/
            foreach ($indexDatas->get_selectedPersonnesNumeros() as $onePersonnesNum) {

                $resultat = getPersonneProfilInfos($onePersonnesNum);

                if ($resultat != false) { // la personne existe et n'est pas bannie.
                    $indexDatas->add_PersonneInfos($resultat);
                    
                } else {
                    //$indexSessionDatas['listOffset'][0] -= 1;
                }

                unset($resultat);

            }

            
            
            /*** On affiche la liste. ***/
            include_once("/vues/v_list.php");
            
            

            
        } catch (exception $e) {
            die("<section><header>Erreur - Accès refusé</header></section>");
        }
            
    }

?>