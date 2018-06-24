 <?php 

    if (extension_loaded("PDO")) {
            
        try {

            /*** Header ***/
            include_once("controleurs/c_header.php");
            
            $erreurTxt = '';
            
            /*** Si un compte est connecté : ***/
            if ( isset($_SESSION['numLogged']) ) {
                
                if ( isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 'OtarieRose') {
                    
                    $safePersonneNum = $_SESSION['numLogged']; // TODO vérifier safitude
                    if ($safePersonneNum != null || $safePersonneNum === 0) { // pas de problèmes avec la session.
                    
                        
                        
                        /*** Récupérer ou créer les informations de recherches ***/
                        $adminDatas = ( isset($_SESSION['adminDatas']) )
                            ? $_SESSION['adminDatas']
                            : array(    'comptes'=>array(),
                                        'comptesOffset'=>0,
                                        'comptesSearch'=>'',
                                        'tags'=>array(),
                                        'tagsOffset'=>0,
                                        'tagsSearch'=>''    );
                        
                        include_once("/modeles/m_admin.php");
                            
                        
                        
                        /*** Si une instruction est envoyée pour gérer les membres ***/
                        if ( Recuperation::testNotEmptyPostFromInput('admin_membres_gerer') ) {

                            
                            /* L'admin cherche une personne */
                            if ( isset($_POST['search_personne']) ) {
                                
                                $adminDatas['comptesSearch'] = Recuperation::getPostFromInput('search_personne','l33tName');
                                $adminDatas['comptesOffset'] = 0;
                                $adminDatas['comptes'] = array();
                                
                            /* L'admin change l'offset */
                            } else if ( $_POST['admin_membres_gerer'] == 'modif_offset' ) {
                                
                                if ( isset($_POST['previous_personne']) ) { $adminDatas['comptesOffset'] -= 12; }
                                else if ( isset($_POST['next_personne']) ) { $adminDatas['comptesOffset'] += 12; }
                                else if ( isset($_POST['raz_personne']) ) {
                                    $adminDatas['comptes'] = array();
                                    $adminDatas['comptesOffset'] = 0;
                                    $adminDatas['comptesSearch'] = '';
                                }
                                
                            /* L'admin modifie un compte */
                            } else {
                                
                                $safeNumCompte = Recuperation::getPostFromInput('admin_membres_gerer','numero');
                                if ( $safeNumCompte != -1 ) {
                                    if ( isset($_POST['admin_personne']) ) { setAdminCompteAdminiser($safeNumCompte); }
                                    else if ( isset($_POST['ban_personne']) ) { setAdminCompteBanniser($safeNumCompte); }
                                }
                                
                            }
                            
                          
                            
                        /*** Si une instruction est envoyée pour gérer les tags ***/
                        } else if ( Recuperation::testNotEmptyPostFromInput('admin_tags_gerer') ) {
                            
                            
                            /* L'admin cherche un tag */
                            if ( isset($_POST['search_tag']) ) {
                                
                                $adminDatas['tagsSearch'] = Recuperation::getPostFromInput('search_tag','tag');
                                $adminDatas['tagsOffset'] = 0;
                                $adminDatas['tags'] = array();
                                
                            /* L'admin change l'offset */
                            } else if ( $_POST['admin_tags_gerer'] == 'modif_offset' ) {
                                
                                if ( isset($_POST['previous_tag']) ) { $adminDatas['tagsOffset'] -= 12; }
                                else if ( isset($_POST['next_tag']) ) { $adminDatas['tagsOffset'] += 12; }
                                else if ( isset($_POST['raz_tags']) ) {
                                    $adminDatas['tags'] = array();
                                    $adminDatas['tagsOffset'] = 0;
                                    $adminDatas['tagsSearch'] = '';
                                }
                                
                            /* L'admin modifie un tag */
                            } else {
                                
                                $safeNumTag = Recuperation::getPostFromInput('admin_tags_gerer','numero');
                                if ( $safeNumTag != -1 ) {
                                    if ( isset($_POST['modif_tag']) ) {

                                        $safeNomTag = Recuperation::getPostFromInput('modif_tag_value','tag');

                                        if ( $safeNomTag != '' ) {

                                            // tout en minuscules et majs en début de mots pour que ça colle dans la bdd.
                                            $safeNomTag = strtolower($safeNomTag); // tout en minuscules
                                            $safeNomTag = ucwords($safeNomTag); // maj devant chaque mot
                                            setAdminTagModif($safeNomTag,$safeNumTag);
                                            $erreurTxt = "Le tag a été modifié.";
                                        }

                                    } else if ( isset($_POST['suppr_tag']) ) {
                                        setAdminTagSuppr($safeNumTag);
                                        $erreurTxt = "Le tag a été supprimé.";
                                    }
                                }
                                
                            }
                            
                        }
                        
                        
                        
                        /*** Résultat des manipulations ***/
                        unset($_POST);
                        $adminDatas = getAdminAllSearch($adminDatas);
                        include_once("/vues/v_admin.php");
                        $_SESSION['adminDatas'] = $adminDatas;
                        
                        
                        
                    } else { $erreurTxt = "NOPE"; }
                } else { $erreurTxt = "NOPE"; }
            } else { $erreurTxt = "NOPE"; }
            
            if ( $erreurTxt == "NOPE" ) {
                
                $erreurTxt = "Erreur - Accès refusé";
                include_once("/vues/v_erreur.php");
                include_once("/controleurs/c_footer.php");
            }
            
            unset($erreurTxt);
            
        } catch (exception $e) {
            $erreurTxt = "Erreur - Accès refusé";
            include_once("/vues/v_erreur.php");
            include_once("/controleurs/c_footer.php");
            unset($erreurTxt);
            // die($e->getMessage());
        }
            
    }

?>