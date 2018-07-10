            <section class="col-5-4">
                
                <?php if ( !isset($_SESSION['numLogged']) ) { ?>
                    <header>
                        Dans l'industrie du jeu vidéo, il est parfois difficile de retrouver certains profils lorsqu'on organise des conférences, qu'on travaille dans le journalisme ou qu'on réalise des chroniques; Et cette difficulté est parfois réciproque, lorsqu'on travaille sur un jeu qu'on voudrait faire connaître. L'objectif de cet annuaire est donc de faciliter la prise de contacts en listant ces différentes personnes, leurs spécificités et leurs projets. Bienvenue !
                    </header>
                <?php } ?>
                
                <div id="personnesListe">

                    <h1>
                        <span><?php echo $indexDatas->get_titreHtml(); ?></span>
                    </h1>

                    <?php foreach ( $indexDatas->get_infosPersonnes() as $oneNumber=>$onePersonne ) { ?>
                    <?php $theInfos = $onePersonne->get_listInfos(); ?>
                        <article>
                            <a href="profil.php?num=<?php echo $oneNumber ?>">
                                <div>
                                    <img src="<?php echo $theInfos['urlAvatar'] ?>" alt="Avatar de <?php echo $theInfos['identite'] ?>">
                                    <span><?php echo $theInfos['identite'] ?></span>
                                    <span class="myDescr"><?php echo $theInfos['description'] ?></span>
                                </div>
                            </a>
                        </article>
                    <?php } ?>

                        <?php if( $indexSessionDatas['listOffset'][0] < $indexSessionDatas['listOffset'][1] ) { ?>
                            <form method="post">
                                <input type="submit" value="Voir plus" name="list_voir_plus"/>
                            </form>
                        <?php } else if( $indexSessionDatas['listOffset'][1] > 8 ) { ?>
                            <form method="post">
                                <input type="submit" value="Remise à zéro" name="list_raz"/>
                            </form>
                        <?php } ?>

                </div>
            </section>
        </div>
    </div>
</main>