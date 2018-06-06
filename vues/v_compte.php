            <main>
            <section id='commonStyles'>

                
                
                <!-- Retour -->

                <menu>
                    <a href='index.php'>
                        <h3>◃Accueil</h3>
                    </a>
                </menu>

                
                
                <!-- Titre -->

                <h1><span>Gérer votre compte</span></h1>
                
                
                
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
                
                        
                
                <!-- Afficher le profil -->

                <article class="connexion">
                    <div class="wrapper">

                        <div class="soloBox">
                            
                            <h2>Affichage dans l'annuaire</h2>
                            
                            <form class="demiForm" action="compte.php" method="post">
                                <p>
                                    <input class="checkbox" type="checkbox" name="true_afficher"
                                           <?php if($compteDatas->get_ban()==0) { echo('checked="checked"'); } ?>
                                    />
                                    <input type="submit" value="Afficher le profil"/>
                                    <input type="hidden" name="mod_afficher"/>
                                </p>
                            </form>
                            
                            <p class="notaBene demiForm"><em>☙</em> Pour pouvoir figurer dans l'annuaire, vous devez avoir au minimum enregistré votre nom et une description.</p>
                            
                        </div>

                    </div>
                </article>
                
                        
                
                <!-- Identité et connexion -->

                <article class="connexion">
                    <div class="wrapper">

                        <div class="col-2-1">
                            
                            <h2>Identité</h2>
                            
                            <p class="notaBene"><em>★</em> Votre pseudonyme sera affiché à la place de vos prénom et nom si vous l'indiquez. Si vous n'indiquez pas de prénom, seul votre nom sera affiché.</p>
                            
                            <form action="compte.php" method="post">
                                <p>
                                    <label for="mod_nom">Nom*</label>
                                    <input type="text" name="mod_nom" required="true" value="<?php echo($compteDatas->get_nom()); ?>"/>
                                </p>
                                <p>
                                    <label for="mod_prenom">Prénom</label>
                                    <input type="text" name="mod_prenom" value="<?php echo($compteDatas->get_prenom()); ?>"/>
                                </p>
                                <p>
                                    <label for="mod_pseudo">Pseudonyme</label>
                                    <input type="text" name="mod_pseudo" value="<?php echo($compteDatas->get_pseudo()); ?>"/>
                                </p>
                                <p>
                                    <input type="submit" value="Enregistrer"/>
                                    <input type="hidden" name="mod_identite"/>
                                </p>
                            </form>
                            
                            
                        </div>

                        <div class="col-2-1">
                            <h2>Données confidentielles</h2>
                            
                            <p class="notaBene"><em>☂</em> Pour votre mot de passe, merci d'utiliser des chiffres, des lettres avec et sans majuscules et des caractères spéciaux : par exemple une courte phrase.</p>
                            
                            <form action="compte.php" method="post">
                                <p>
                                    <label for="mod_email0">Email*</label>
                                    <input type="email" name="mod_email0" required="true" />
                                    <label for="mod_mdp0">Mot de passe*</label>
                                    <input type="password" name="mod_mdp0" required="true" />
                                </p>
                                <p>
                                    <label for="mod_email1">Nouvel email</label>
                                    <input type="email" name="mod_email1"/>
                                    <label for="mod_email2">Confirmer email</label>
                                    <input type="email" name="mod_email2"/>
                                </p>
                                <p>
                                    <label for="mod_mdp1">Nouveau mdp</label>
                                    <input type="password" name="mod_mdp1"/>
                                    <label for="mod_mdp2">Confirmer mdp</label>
                                    <input type="password" name="mod_mdp2"/>
                                </p>
                                <p>
                                    <input type="submit" value="Enregistrer"/>
                                    <input type="hidden" name="mod_confidentiel"/>
                                </p>
                            </form>
                            
                        </div>

                    </div>
                </article>
                
                        
                
                <!-- Liens, description et avatar -->

                <article class="connexion">
                    <div class="wrapper">

                        <div class="col-2-1">
                            <h2>Description</h2>
                            
                            <p class="notaBene"><em>☕︎</em> Votre description est très importante pour que les gens qui visitent votre profil puissent comprendre rapidement qui vous êtes et ce que vous faites.</p>
                            
                            <form action="compte.php" method="post">
                                <textarea name="mod_description"><?php echo($compteDatas->get_description()); ?></textarea>
                                <p>
                                    <input type="submit" value="Enregistrer"/>
                                </p>
                            </form>
                            
                        </div>
                    
                        <div class="col-2-1">
                            <h2>Liens</h2>
                            
                            <p class="notaBene"><em>⛵︎</em> Pour votre avatar, merci de choisir un lien vers une image de moins de 500px de largeur, hébergée sur un site qui accepte qu'elle soit affichée par un tiers.</p>
                            
                            <form action="compte.php" method="post">
                                <p>
                                    <label for="mod_linkedin">Linkedin</label>
                                    <input type="text" name="mod_linkedin"  value="<?php echo($compteDatas->get_linkedin()); ?>"/>
                                </p>
                                <p>
                                    <label for="mod_twitter">Twitter</label>
                                    <input type="text" name="mod_twitter" value="<?php echo($compteDatas->get_twitter()); ?>"/>
                                </p>
                                <p>
                                    <label for="mod_website">Site Web</label>
                                    <input type="text" name="mod_website" value="<?php echo($compteDatas->get_website()); ?>"/>
                                </p>
                                <p>
                                    <label for="mod_urlAvatar">Lien d'avatar</label>
                                    <input type="text" name="mod_urlAvatar" value="<?php echo($compteDatas->get_urlAvatar()); ?>"/>
                                </p>
                                <p>
                                    <input type="submit" value="Enregistrer"/>
                                    <input type="hidden" name="mod_liens"/>
                                </p>
                            </form>
                            
                        </div>
                            
                    </div>
                </article>
                
                        
                
                <!-- Tags et projets -->

                <article class="connexion">
                    <div class="wrapper">

                        <div class="col-2-1">
                            <h2>Tags</h2>
                            
                            <p class="notaBene"><em>♥</em> Choisissez des tags (10 max) qui vous caractérisent afin d'apparaitre dans l'index. Plus ces tags seront utilisés, plus vos chances d'apparaitre seront grandes.</p>
                            
                            <p>
                                 <?php foreach($compteDatas->get_tagsListNom() as $aTagName) {
                                    echo '<span>'.$aTagName.'</span>';
                                 } ?>
                            </p>
                            
                            <form action="compte.php" method="post">
                                <p>
                                    <input type="submit" value="Gérer vos tags" name="tags_gerer"/>
                                </p>
                            </form>
                            
                        </div>

                        <div class="col-2-1">
                            <h2>Projets</h2>
                            
                            <p class="notaBene"><em>⚒︎</em> Vous pouvez créer ou lier des projets existants à votre profil (10 max) afin que les personnes qui le visiteront sachent sur quoi vous avez travaillé.</p>
                            
                            <p>
                                 <?php foreach($compteDatas->get_projetsListNom() as $aProjetName) {
                                    echo '<span>'.$aProjetName.'</span>';
                                 } ?>
                            </p>
                            
                            <form action="compte.php" method="post">
                                <p>
                                    <input type="submit" value="Gérer vos projets" name="projets_gerer"/>
                                </p>
                            </form>
                            
                        </div>

                    </div>
                </article>
                        
                        

            </section>
        </main>