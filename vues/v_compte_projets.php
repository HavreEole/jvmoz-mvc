            <main>
            <section id='commonStyles'>

                
                
                <!-- Retour -->

                <menu>
                    <a href='index.php'>
                        <h3>◃Accueil</h3>
                    </a>
                    <a href='compte.php'>
                        <h4>◃Modifications générales</h4>
                    </a>
                </menu>

                
                
                <!-- Titre -->

                <h1><span>Gérer vos projets</span></h1>
                
                
                
                <!-- Message d'erreur -->
                
                <?php if (isset($erreurTxt)) { ?>
                    <article class="connexion">
                        <div class="wrapper">
                            <p>
                                <?php echo $erreurTxt; ?>
                            </p>
                        </div>
                    </article>
                <?php } ?>
                
                     
                
                <!-- Modifier ou supprimer -->
                
                <?php /*if (count($compteDatas->get_tagsListNom()) > 0) {
                 foreach projet .... bla bla */ 
                ?>
                    <article class="projetProfil">
                        <div class="wrapper">

                            <div class="col-3-1">

                                <h2>Projet : blabla</h2>

                                <form action="compte.php" method="post">
                                    <p>
                                        <input type="submit" value="....."/>
                                        <input type="hidden" name="tags_gerer" value="supr_tags"/>
                                    </p>
                                </form>

                            </div>
                            
                            <div class="col-3-1">

                                <p>description</p>

                            </div>
                            
                            <div class="col-3-1">

                                visuel

                            </div>

                        </div>
                    </article>
                <?php /*}*/ ?>
                
                
                <?php /*if (count($compteDatas->get_tagsListNom()) < 11) {*/ ?>

                    <!-- créer -->

                    <article class="projetProfil">
                        <div class="wrapper">

                            <div class="col-3-1">

                                <h2>Créer et ajouter un projet</h2>

                                <form action="compte.php" method="post">
                                    <p>
                                        <input type="submit" value="....."/>
                                        <input type="hidden" name="tags_gerer" value="supr_tags"/>
                                    </p>
                                </form>

                            </div>
                            
                            <div class="col-3-1">

                                <p>description</p>

                            </div>
                            
                            <div class="col-3-1">

                                visuel

                            </div>

                        </div>
                    </article>
                
                <?php /*}*/ ?>
                

            </section>
        </main>