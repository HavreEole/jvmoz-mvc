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

                <h1><span>Gérer vos tags</span></h1>
                
                
                
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
                
                     
                
                <!-- supprimer -->
                <?php if (count($compteDatas->get_tagsListNom()) > 0) { ?>
                    <article class="connexion">
                        <div class="wrapper">

                            <div class="soloBox">

                                <h2>Supprimer des tags</h2>

                                <form action="compte.php" method="post">
                                    <p class="tagListForm">
                                        <?php foreach($compteDatas->get_tagsListNom() as $aTagName) { ?>
                                            <span>
                                                <input class="checkbox" type="checkbox" name="suprNum_<?php echo($aTagName); ?>" value="<?php echo($aTagName); ?>"/>
                                                <label for="suprNum_<?php echo($aTagName); ?>"><?php echo($aTagName); ?></label>
                                            </span>
                                        <?php } ?>
                                    </p>
                                    <p>
                                        <input type="submit" value="Supprimer"/>
                                        <input type="hidden" name="tags_gerer" value="supr_tags"/>
                                    </p>
                                </form>

                            </div>

                        </div>
                    </article>
                <?php } ?>
                
                
                <?php if (count($compteDatas->get_tagsListNom()) < 11) { ?>
                
                    <!-- Ajouter -->
                    <article class="connexion">
                        <div class="wrapper">

                            <div class="soloBox">

                                <h2>Ajouter des tags</h2>
                                    <p class="notaBene"><em>♥</em> Choisissez des tags, 10 au maximum, qui vous caractérisent afin d'apparaitre via les recherches dans l'annuaire :</p>

                                <form action="compte.php" method="post">
                                    <p class="tagListForm">
                                        <?php foreach($compteDatas->get_allTags() as $aTag) { 
                                            if ( !in_array($aTag['nom'], $compteDatas->get_tagsListNom()) ) { ?>
                                            <span>
                                                <em><?php echo($aTag['nbUsages']); ?></em>
                                                <input class="checkbox" type="checkbox" name="addNum_<?php echo($aTag['numero']); ?>" value="<?php echo($aTag['numero']); ?>"/>
                                                <label for="addNum_<?php echo($aTag['numero']); ?>"><?php echo($aTag['nom']); ?></label>
                                            </span>
                                        <?php }
                                            } ?>
                                    </p>
                                    <p>
                                        <input type="submit" value="Ajouter"/>
                                        <input type="hidden" name="tags_gerer" value="add_tags"/>
                                    </p>
                                </form>

                            </div>

                        </div>
                    </article>

                    <!-- créer -->

                    <article class="connexion">
                        <div class="wrapper">

                            <div class="soloBox">

                                <h2>Créer et ajouter un tag</h2>

                                <form class="demiForm" action="compte.php" method="post">
                                    <p>
                                        <input type="text" name="create_tagTxt"/>
                                        <input type="submit" value="Créer et ajouter"/>
                                        <input type="hidden" name="tags_gerer" value="create_tag"/>
                                    </p>
                                </form>

                                <p class="notaBene demiForm">Merci de choisir un tag pouvant être utile à plusieurs personnes - un tag peu utilisé vous offrira peu de visibilité. Vous pouvez utiliser des lettres, des chiffres et des espaces.</p>

                            </div>

                        </div>
                    </article>
                
                <?php } ?>
                

            </section>
        </main>