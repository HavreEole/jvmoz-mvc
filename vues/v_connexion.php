            <main>
            <section id='commonStyles'>

                
                
                <!-- Retour -->

                <menu>
                    <a href='index.php'>
                        <h3>◃Accueil</h3>
                    </a>
                </menu>

                
                
                <!-- Titre -->

                <h1><span>Créer ou modifier un profil</span></h1>
                
                
                
                <!-- Message d'erreur -->
                
                <?php if (isset($erreurTxt)) { ?>
                    <article class="formStyle">
                        <div class="wrapper">
                            <p>
                                <?php echo $erreurTxt; ?>
                            </p>
                        </div>
                    </article>
                <?php } ?>
                
                        
                
                <!-- Profil -->

                <article class="formStyle">
                    <div class="wrapper">

                        <div class="col-2-1">
                            <h2>Connexion ou inscription</h2>
                            
                            <form action="compte.php" method="post">
                                <p>
                                    <label for="email">Email</label>
                                    <input type="email" name="email" required="true"/>
                                </p>
                                <p>
                                    <label for="mdp">Mot de passe</label>
                                    <input type="password" name="mdp" required="true"/>
                                </p>
                                <p>
                                    <label for="capcha">Capcha</label>
                                    <input type="password" name="capcha" required="true"/>
                                </p>
                                <!--<input type="hidden" name="co_poivre"/>-->
                                <p>
                                    <input type="submit" value="Se connecter"/>
                                    <input type="submit" value="S'inscrire" name="sinscrire"/>
                                </p>
                            </form>
                            
                        </div>
                        
                        <div class="col-2-1">
                            <h2>Pourquoi faire</h2>
                            <p>S'inscrire permet de créer son propre profil afin de le faire figurer dans l'annuaire.</p>
                            <p>Se connecter permet de modifier ses données, de les supprimer ou de se désinscrire.</p>
                            <h2>Informations</h2>
                            <p><span>Email</span> Il est utilisé pour authentifier votre connexion, et ne sera pas transmis à des tiers.</p>
                            <p><span>Mot de passe</span> Merci d'utiliser des chiffres, des lettres avec et sans majuscules et des caractères spéciaux, par ex une courte phrase.</p>
                        </div>

                    </div>
                </article>
                        
                        

            </section>
        </main>