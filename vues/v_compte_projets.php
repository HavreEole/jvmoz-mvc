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
                
                <?php if (isset($erreurTxt) && $erreurTxt != '') { ?>
                    <article class="formStyle">
                        <div class="wrapper">
                            <p>
                                <?php echo $erreurTxt; ?>
                            </p>
                        </div>
                    </article>
                <?php } ?>
                
                
                
                <!-- Créer ou ajouter -->
                
                <?php if (count($compteDatas->get_projetsListNom()) < 11) { ?>
                

                    <article class="formStyle supArticle">
                        <div class="wrapper">

                            
                            <!-- ajouter -->
                            
                            <div class="col-2-1">
                                <h2>Lier un projet existant</h2>

                                <form action="compte.php" method="post">
                                    <p>
                                        <label for="lier_nom">Nom du projet*</label>
                                        <input type="text" name="lier_nom" required/>
                                    </p>
                                    <p>
                                        <label for="lier_mdp">Mot de passe*</label>
                                        <input type="text" name="lier_mdp" required/>
                                    </p>
                                    <p>
                                        <input type="submit" value="Lier le projet"/>
                                        <input type="hidden"  name="projets_gerer" value="lier_projet"/>
                                    </p>
                                </form>
                            </div>
                            
                            
                            <!-- créer -->
                            
                            <div class="col-2-1">
                                <h2>Créer un projet</h2>
                                <form action="compte.php" method="post">
                                    <p>
                                        <label for="creer_nom">Nom*</label>
                                        <input type="text" name="creer_nom" required/>
                                    </p>
                                    <p>
                                        <label for="creer_studio">Studio*</label>
                                        <input type="text" name="creer_studio" required/>
                                    </p>
                                    <p>
                                        <input type="submit" value="Enregistrer"/>
                                        <input type="hidden"  name="projets_gerer" value="creer_projet"/>
                                    </p>
                                </form>
                            </div>
                        
                        </div>
                    </article>
                
                <?php } ?>
                
                
                
                <!-- Modifier ou supprimer -->
                
                <?php if (count($compteDatas->get_projetsListNom()) > 0) {
                    foreach ($compteDatas->get_allProjets() as $aProjectObject) { 
                        $aProject = $aProjectObject->get_projet();
                ?>
                    <article class="formStyle supArticle">
                        <div class="wrapper">

                            <div class="col-3-1">
                                <h2><?php echo($aProject['nom']); ?></h2>
                                <form action="compte.php" method="post">
                                    <p>
                                        <label for="modif_nom">Nom*</label>
                                        <input type="text" name="modif_nom"  value="<?php echo($aProject['nom']); ?>" required/>
                                    </p>
                                    <p>
                                        <label for="modif_studio">Studio*</label>
                                        <input type="text" name="modif_studio" value="<?php echo($aProject['studio']); ?>" required/>
                                    </p>
                                    <p>
                                        <label for="modif_website">Site Web</label>
                                        <input type="text" name="modif_website" value="<?php echo($aProject['website']); ?>"/>
                                    </p>
                                    <p>
                                        <label for="modif_dateSortie">Date de sortie</label>
                                        <input type="date" name="modif_dateSortie" value="<?php echo($aProject['dateSortie']); ?>"/>
                                    </p>
                                    <p>
                                        <input type="submit" name="projet_<?php echo($aProject['numero']); ?>" value="Enregistrer"/>
                                        <input type="hidden"  name="projets_gerer" value="modif_projet_infos"/>
                                    </p>
                                </form>
                            </div>
                            
                            <div class="col-3-1">
                                <h2>Description</h2>
                                <form action="compte.php" method="post">
                                    <textarea name="modif_description"><?php echo($aProject['description']); ?></textarea>
                                    <p>
                                        <input type="submit" name="projet_<?php echo($aProject['numero']); ?>" value="Enregistrer"/>
                                        <input type="hidden"  name="projets_gerer" value="modif_projet_description"/>
                                    </p>
                                </form>
                            </div>
                            
                            <div class="col-3-1 notBlue">
                                <h2>Visuel</h2>
                                <p class="notaBene"><em>⛵︎</em> Merci de choisir un lien vers une image de moins de 500px de largeur, hébergée sur un site qui accepte qu'elle soit affichée par un tiers.</p>
                                <form action="compte.php" method="post">
                                    <p>
                                        <label for="modif_urlVisuel">Lien du visuel</label>
                                        <input type="text" name="modif_urlVisuel" value="<?php echo($aProject['urlVisuel']); ?>"/>
                                    </p>
                                    <p>
                                        <input type="submit" name="projet_<?php echo($aProject['numero']); ?>" value="Enregistrer"/>
                                        <input type="hidden"  name="projets_gerer" value="modif_projet_urlVisuel"/>
                                    </p>
                                </form>
                            </div>
                            
                        </div>
                </article>
                <article class="formStyle subArticle">
                        <div class="wrapper">
                            
                            <div class="col-3-1">
                                <h2>Liste de tags</h2>
                                
                                <p class="notaBene"><em>♥</em> Lorsqu'ils seront recherchés, les tags d'un projet feront apparaître votre profil dans l'annuaire.</p>
                                
                                <?php if (count($aProject['tagList'])>0) { ?>
                                    <p>
                                        <?php foreach($aProject['tagList'] as $aTag) {
                                            echo('<span>'.$aTag.'</span>');
                                        } ?>
                                    </p>
                                <?php } ?>
                                
                                <form action="compte.php" method="post">
                                    <p>
                                        <input type="submit" name="projet_<?php echo($aProject['numero']); ?>" value="Gerer les tags"/>
                                        <input type="hidden"  name="projets_gerer" value="modif_projet_tags"/>
                                    </p>
                                </form>
                            </div>
                            
                            <div class="col-3-1">
                                <h2>Equipe du projet</h2>
                                
                                <?php if (count($aProject['equipe'])>0) { ?>
                                    <p>
                                        <?php foreach($aProject['equipe'] as $aTeam) {
                                            echo('<a href="'.$aTeam['numero'].'"><span>'.$aTeam['identite'].'</span></a>');
                                        } ?>
                                    </p>
                                <?php } ?>
                                
                                <p class="notaBene"><em>⚒︎</em> Vous pouvez transmettre le mot de passe du projet à d'autres membres de votre équipe pour leur permettre d'afficher ce projet sur leur profil :</p>
                                
                                <form action="compte.php" method="post">
                                    <p>
                                        <input type="submit" name="projet_<?php echo($aProject['numero']); ?>" value="Mot de passe"/>
                                        <input type="hidden"  name="projets_gerer" value="modif_projet_mdp"/>
                                    </p>
                                </form>
                            </div>
                            
                            <div class="col-3-1">
                                <h2>Retirer le projet</h2>
                                <p class="notaBene"><em>★</em> Attention, ce projet sera supprimé si personne d'autre ne l'affiche.</p>
                                <form action="compte.php" method="post">
                                    <p>
                                        <input type="submit" name="projet_<?php echo($aProject['numero']); ?>" value="Retirer le projet"/>
                                        <input type="hidden"  name="projets_gerer" value="modif_projet_suppr"/>
                                    </p>
                                </form>
                            </div>

                        </div>
                    </article>
                <?php }
                } ?>
                
                

            </section>
        </main>