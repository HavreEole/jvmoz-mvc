            <section class="col-5-4"> 
                <header>
                    Dans l'industrie du jeu vidéo, il est parfois difficile de retrouver certains profils lorsqu'on organise des conférences, qu'on travaille dans le journalisme ou qu'on réalise des chroniques; Et cette difficulté est parfois réciproque, lorsqu'on travaille sur un jeu qu'on voudrait faire connaître. L'objectif de cet annuaire est donc de faciliter la prise de contacts en listant ces différentes personnes, leurs spécificités et leurs projets. Bienvenue !
                </header>
                <div id="personnesListe">

                    <h1>
                        <span><?php echo $stockDatas->get_titreHtml(); ?></span>
                    </h1>

                    <?php foreach ( $stockDatas->get_infosPersonnes() as $oneNumber=>$onePersonne ) { ?>
                    <?php $theInfos = $onePersonne->get_listInfos(); ?>
                        <article>
                            <a href="profil.php?num=<?php echo $oneNumber ?>">
                                <div>
                                    <img src="<?php echo $theInfos['urlAvatar'] ?>" alt="Avatar de <?php echo $theInfos['identite'] ?>">
                                    <span><?php echo $theInfos['identite'] ?></span>
                                </div>
                            </a>
                        </article>
                    <?php } ?>

                    <?php if ($stockDatas->get_voirPlus()) { ?>
                        <p>
                            <a href="">Voir plus</a>
                        </p>
                    <?php } ?>

                </div>
            </section>
        </div>
    </div>
</main>