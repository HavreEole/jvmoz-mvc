            <main>
            <section id='commonStyles'>

                <!-- Retour -->

                <menu>
                    <a href='index.php'>
                        <h3>◃Accueil</h3>
                    </a>
                </menu>

                <!-- Titre -->

                <h1><span>Connexion ou inscription</span></h1>
                
                
                <!-- Profil -->

                <article class="connexion">
                    <div class="wrapper">

                        <div class="col-2-1">
                            <h2>Se connecter</h2>
                            
                            <form action="compte.php" method="post">
                                <p>
                                    <label for="co_login">Email</label>
                                    <input type="email" name="co_login" required="true"/>
                                </p>
                                <p>
                                    <label for="co_mdp">Mot de passe</label>
                                    <input type="password" name="co_mdp" required="true"/>
                                </p>
                                <!--<input type="hidden" name="co_poivre"/>-->
                                <p>
                                    <input type="submit" value="Se connecter"/>
                                </p>
                            </form>
                            
                        </div>
                        
                        <div class="col-2-1">
                            <h2>S'inscrire</h2>
                            
                            <form action="compte.php" method="post">
                                <p>
                                    <label for="in_nom">Nom</label>
                                    <input type="text" name="in_nom" required="true"/>
                                </p>
                                <p>
                                    <label for="in_email">Email</label>
                                    <input type="email" name="in_email" required="true"/>
                                </p>
                                <p>
                                    <label for="in_mdp">Mot de passe</label>
                                    <input type="password" name="in_mdp" required="true"/>
                                </p>
                                <p>
                                    <label for="in_capcha">Capcha</label>
                                    <input type="text" name="in_capcha" required="true"/>
                                </p>
                                <!--<input type="hidden" name="in_poivre"/>-->
                                <p>
                                    <input type="submit" value="S'inscrire"/>
                                </p>
                            </form>
                            
                        </div>

                    </div>
                </article>

            </section>
        </main>