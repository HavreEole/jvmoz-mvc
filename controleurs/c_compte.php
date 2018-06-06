 <?php 

    if (extension_loaded("PDO")) {
            
        try {

            /*** Header ***/
            include_once("controleurs/c_header.php");
            
            
            
            /*** Si un compte est connecté : ***/
            if ( isset($_SESSION['numLogged']) ) {
                
                $safePersonneNum = $_SESSION['numLogged']; // TODO vérifier safitude
                if ($safePersonneNum != null) { // pas de problèmes avec la session.
                    
                    include_once("/librairies/class.projet.php");
                    include_once("/librairies/class.comptedatas.php");
                    $compteDatas = new comptedatas();
                    
                    
                    /* Si la personne veut gérer ses tags, */
                    if ( Recuperation::testNotEmptyPostFromInput('tags_gerer') ) {
                        include_once("controleurs/c_compte_tags.php"); //TODO
                        
                    /* Si la personne veut gérer ses projets, */
                    } else if ( Recuperation::testNotEmptyPostFromInput('projets_gerer') ) {
                        include_once("controleurs/c_compte_projets.php"); //TODO
                        
                        
                    /* Sinon on affiche la gestion générale du profil */
                    } else {
                        
                        include_once("/modeles/m_compte.php");
                        
                        
                        if ( !empty($_POST) ) { // Si un autre formulaire a été rempli,
                            
                            $erreurTxt = '';
                            
                            
                            // verifs et update/insertions de données :
                            include_once("controleurs/c_compte_modifs.php");
                            
                            if ($erreurTxt != '') { // en cas d'erreur on affiche l'erreur.
                                unset($_POST);
                                include_once("/vues/v_compte.php");
                                unset($erreurTxt);
                                
                            } else  { // sinon on redirect pour obtenir un formulaire à jour.
                                unset($erreurTxt);
                                header("location:compte.php");
                            }
                            
                        
                        } else { // sinon on affiche le formulaire.
                            include_once("/vues/v_compte.php");
                            
                        }
                        

                    }
                    
                }
                
                
                
            /*** Si pas de compte connecté : ***/ 
            } else {
                
                
                /* Si le formulaire n'a pas été rempli, on l'affiche. */
                if ( empty($_POST) ) {
                    
                    include_once("/vues/v_connexion.php");
                    
                    
                /* S'il a été rempli, on vérifie les données entrées. */
                } else {
                    
                    $erreurTxt = '';
                    $numCompte;
                    $identiteCompte;
                    
                    if (    Recuperation::testNotEmptyPostFromInput('email')
                            && Recuperation::testNotEmptyPostFromInput('mdp')
                            && Recuperation::testNotEmptyPostFromInput('capcha')   ) {
                    
                        // TESTS filter sanitize etc
                        $safeLogin = Recuperation::getPostFromInput("email","email");
                        $safeMdp = Recuperation::getPostFromInput("mdp","mdp");
                        $safeCapcha = Recuperation::getPostFromInput("capcha","mdp");

                        if ( $safeCapcha == "123" ) { // TEMP capcha en dur.
                        
                            $wantInscription = isset($_POST['sinscrire']);
                            
                            // TESTS avec la DB
                            include_once("/modeles/m_connexion.php");
                            
                            if ($erreurTxt == '') {
                                
                                // si ok on enregistre l'info dans la session,
                                $_SESSION['numLogged'] = $numCompte;
                                $_SESSION['nomLogged'] = $identiteCompte;
                                // puis on redirect pour obtenir un menu à jour.
                                header("location:compte.php");
                                
                            }
                            
                            
                        } else { // erreur capcha
                            $erreurTxt = 'Erreur : vous ne connaissez pas le capcha.';
                        }
                    
                    } else {  // erreur post incomplet
                        $erreurTxt = 'Une erreur est survenue, veuillez réessayer.';
                    }
                    
                    // s'il y a eu une erreur, retry :
                    if ( $erreurTxt != '' ) {
                        unset($_POST);
                        include_once("/vues/v_connexion.php");
                        unset($erreurTxt);
                    }
                    
                }
                
            }
            
            

        } catch (exception $e) {/*
            $erreurTxt = "Erreur - Accès refusé";
            include_once("/vues/v_erreur.php");
            include_once("/controleurs/c_footer.php");
            unset($erreurTxt);*/
            die($e->getMessage());
        }
            
    }

?>