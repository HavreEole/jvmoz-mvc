            <main>
            <section id='commonStyles'>

                
                
                <!-- Retour -->

                <menu>
                    <a href='index.php'>
                        <h3>◃Accueil</h3>
                    </a>
                </menu>

                
                
                <!-- Titre -->

                <h1><span>/!\ Zone Admin /!\</span></h1>
                
                
                
                <!-- Message d'erreur -->
                
                <?php if (isset($erreurTxt) && $erreurTxt != '') { ?>
                    <article class="formStyle">
                        <div class="wrapper">
                            <p>
                                <?php echo $erreurTxt; ?>
                            </p>
                        </div>
                    </article>
                <?php } ?>
                
                        
                
                <!-- Membres -->

                <article class="formStyle supArticle">
                    <div class="wrapper">
                        
                        <div class="soloBox">
                            <h2>Gérer les comptes</h2>
                            
                            <p class="notaBene"><em>☙</em> Vous pouvez rechercher une personne via son nom, prénom ou pseudonyme. La bouton Admin permet de lui attribuer des droits d'admin. Le bouton Bannir permet de la bannir. Ces deux états sont réversibles.</p>
                            
                            <form action="admin.php" method="post">
                                <p>
                                    <input type="text" name="search_personne" value="<?php echo($adminDatas['comptesSearch']); ?>"/>
                                    <input type="submit" value="Rechercher" name="admin_membres_gerer"/>
                                </p>
                            </form>
                            
                        </div>
                        
                        <div class="soloBox adminList">
                            
                            <?php if ( $adminDatas['comptesSearch'] != '' ) { ?>
                                <h4>Vos résultats pour la recherche "<?php echo($adminDatas['comptesSearch']); ?>"<?php if ( count($adminDatas['comptes']) == 0 ) { echo(' : aucun résultat.'); } ?></h4>
                            <?php } ?>
                            
                            <?php if ( count($adminDatas['comptes']) > 0 ) { ?>
                                <div class="tagListForm">
                                    <?php foreach ($adminDatas['comptes'] as $unCompte) { ?>
                                
                                        <form action="admin.php" method="post">
                                            <p>
                                                <a href="profil.php?num=<?php echo($unCompte['numero']); ?>">
                                                    <span>
                                                        <?php if ($unCompte['admin'] == 1) { ?>
                                                            <em class="adminEm">★</em>
                                                        <?php } else if ($unCompte['ban'] == 1) { ?>
                                                            <em class="banEm">⚑</em>
                                                        <?php } ?>
                                                        <?php   
                                                                echo($unCompte['prenom']);
                                                                if ( $unCompte['pseudo'] != '' ) {
                                                                    echo(' ('.$unCompte['pseudo'].')');
                                                                }                        
                                                                echo(' '.$unCompte['nom']);
                                                        ?>
                                                    </span>
                                                </a>
                                                <input type="hidden" name="admin_membres_gerer"
                                                       value="<?php echo($unCompte['numero']); ?>" />

                                                <input type="submit" value="Admin" name="admin_personne"
                                                       <?php if ($unCompte['admin'] == 1) { echo('class="adminEm"'); } ?>
                                                       <?php if ($unCompte['ban'] == 1) { echo("disabled"); } ?> />

                                                <input type="submit" value="Bannir" name="ban_personne"
                                                       id="<?php echo($unCompte['numero']); ?>"
                                                       <?php if ($unCompte['ban'] == 1) { echo('class="banEm"'); } ?>
                                                       <?php if ($unCompte['admin'] == 1) { echo("disabled"); } ?> />
                                            </p>
                                        </form>
                                
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        
                        <div class="soloBox notBlue">
                            <form action="admin.php" method="post">
                                <p>
                                    
                                    <input type="submit" value="Précédent" name="previous_personne"
                                           <?php if ( $adminDatas['comptesOffset'] == 0 ) { echo("disabled"); } ?> />
                                    <input type="submit" value="Suivant" name="next_personne"
                                           <?php if ( count($adminDatas['comptes']) != 12 ) { echo("disabled"); } ?> />
                                    <input type="hidden" name="admin_membres_gerer" value="modif_offset"/>
                                </p>
                                <p>
                                        <input type="submit" value="Remise à zéro" name="raz_personne"/>
                                </p>
                            </form>
                        </div>

                    </div>
                </article>

                
                
                <!-- Tags -->
                <article class="formStyle subArticle" id="tags">
                    <div class="wrapper">
                        
                        <div class="soloBox">
                            <h2>Gérer les Tags</h2>
                            
                            <p class="notaBene"><em>☙</em> Vous pouvez rechercher un tag via son nom. Le bouton modifier permet de le renommer; le bouton supprimer permet de le retirer de tous les profils et projets, ce qui entraîne sa suppression.</p>
                            
                            <form action="admin.php#tags" method="post">
                                <p>
                                    <input type="text" name="search_tag" value="<?php echo($adminDatas['tagsSearch']); ?>" />
                                    <input type="submit" value="Rechercher" name="admin_tags_gerer"/>
                                </p>
                            </form>
                            
                        </div>
                        
                        <div class="soloBox adminList">
                            
                            <?php if ( $adminDatas['tagsSearch'] != '' ) { ?>
                                <h4>Vos résultats pour la recherche "<?php echo($adminDatas['tagsSearch']); ?>"
                                    <?php if ( count($adminDatas['tags']) == 0 ) { echo(' : aucun résultat.'); } ?></h4>
                            <?php } ?>
                            
                            <?php if ( count($adminDatas['tags']) > 0 ) { ?>
                                <div class="tagListForm">
                                    <?php foreach ($adminDatas['tags'] as $unTag) { ?>
                                    
                                        <form action="admin.php" method="post">
                                            <p>
                                                <span>
                                                    <em><?php echo($unTag['nbUsages']); ?></em>
                                                    <?php echo($unTag['nom']); ?>
                                                </span>
                                                <input type="hidden" value="<?php echo($unTag['numero']); ?>"
                                                       name="admin_tags_gerer"/>
                                                <input type="hidden" value="" name="modif_tag_value"
                                                       id="mod_<?php echo($unTag['numero']); ?>" />
                                                <input type="submit" value="Modifier" name="modif_tag"
                                                       onclick="modifTag('mod_<?php echo($unTag['numero']); ?>')" />
                                                <input type="submit" value="Supprimer" name="suppr_tag"/>
                                            </p>
                                        </form>
                                
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        
                        <div class="soloBox">
                            <form action="admin.php#tags" method="post">
                                <p>
                                    
                                    <input type="submit" value="Précédent" name="previous_tag"
                                           <?php if ( $adminDatas['tagsOffset'] == 0 ) { echo("disabled"); } ?> />
                                    <input type="submit" value="Suivant" name="next_tag"
                                           <?php if ( count($adminDatas['tags']) != 12 ) { echo("disabled"); } ?> />
                                    <input type="hidden" name="admin_tags_gerer" value="modif_offset"/>
                                </p>
                                <p>
                                        <input type="submit" value="Remise à zéro" name="raz_tags"/>
                                </p>
                            </form>
                        </div>

                    </div>
                </article>
                        
                        

            </section>
        </main>