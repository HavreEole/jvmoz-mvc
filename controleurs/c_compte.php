 <?php 

    if (extension_loaded("PDO")) {
            
        try {

            if ( 1!=1 ) { // compte connecté
                
                // infos SESSION pour gérer le header
                // include_once("/modeles/m_compte.php");
                // include_once("/vues/v_profil.php");
                
                
                
            } else { // compte non connecté
                
                
                if ( !empty($_POST) ) {
                    
                    
                    
                    // Essai de connexion :
                    if (    !Recuperation::testNotEmptyPostFromInput("co_login")
                            && !Recuperation::testNotEmptyPostFromInput("co_mdp")   ) {
                        
                    
                        // TESTS filter sanitize

                        include_once("/modeles/m_connexion.php");

                        // si ok : session
                        // puis on redirect ?
                            // ou on affiche le contenu de compte connecté
                    
                        
                        
                    // Essai d'inscription :
                    } else if ( !empty($_POST['in_nom'])
                                && !empty($_POST['in_email'])
                                && !empty($_POST['in_mdp'])
                                && !empty($_POST['in_capcha'])   ) {
                    
                        // TESTS filter sanitize

                        include_once("/modeles/m_connexion.php");

                        // si ok : inscription, puis session
                        // puis on redirect ?
                            // ou on affiche le contenu de compte connecté
                        
                        
                        
                    // Sinon erreur :
                    } else {
                        
                        unset($_POST);
                        
                    }
                    
                    
                    
                } else { // formulaires se connecter, s'inscrire.
                    
                    include_once("/vues/v_connexion.php");
                    
                }
                
                
            }

        } catch (exception $e) {
            $erreurTxt = "Erreur - Accès refusé";
            include_once("/vues/v_erreur.php");
            include_once("/controleurs/c_footer.php");
            unset($erreurTxt);
            die();
        }
            
    }

?>