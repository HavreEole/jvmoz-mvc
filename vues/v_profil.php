<?php   // Si la personne n'existe pas ou est bannie, on affichera la personne n°0.
        $theProfil = $listes->get_onePersonneInfo( $listes->get_profilPersonneNum() )->get_profil();
?>

<main>
    <section id='profilStyles'>
        
        
        <!-- Retour -->
        
        <menu>
            <a href='index.php'>
                <h3>◃Accueil</h3>
            </a>
        </menu>


        
        <!-- Titre -->

        <h1><span>Profil de <?php echo($theProfil['identite']); ?></span></h1>



        <!-- Profil -->

        <article id="personneProfil">
            <div class="wrapper">

                <div class="col-3-1">
                    <img src="<?php echo('vues/'.$theProfil['urlAvatar']); ?>">
                </div>

                <div class="col-3-1">
                    <p><?php echo($theProfil['description']); ?></p>
                </div>

                <div class="col-3-1">
                    <p class="tagList">
                        <?php foreach( $theProfil['tagList'] as $aTag ) { ?>
                            <span><?php echo($aTag); ?></span>
                        <?php } ?>
                    </p>
                    <p>
                        <span>Twitter</span>
                        <a href="https://twitter.com/<?php echo($theProfil['links']['twitter']); ?>"><?php echo($theProfil['links']['twitter']); ?></a>
                    </p>
                    <p>
                        <span>Linkedin</span>
                        <a href="https://www.linkedin.com/in/<?php echo($theProfil['links']['linkedin']); ?>"><?php echo($theProfil['links']['linkedin']); ?></a>
                    </p>
                    <p>
                        <span>Site web</span>
                        <a href="<?php echo($theProfil['links']['website']); ?>"><?php echo($theProfil['links']['website']); ?></a>
                    </p>
                </div>

            </div>
        </article>



        <!-- Projets -->

        <?php foreach ( $listes->get_profilProjetsNum() as $aProjetNum ) { 

                $theProject = $listes->get_infosProjets($aProjetNum)->get_projet();
        ?>

        <article class="projetProfil">
            <div class="wrapper">
                <div class="col-3-1">
                    <p>
                        <span>Nom</span>
                        <?php echo($theProject['nom']); ?>
                    </p>
                    <p>
                        <span>Studio</span>
                        <?php echo($theProject['studio']); ?>
                    </p>
                    <p>
                        <span>Site web</span>
                        <a href="<?php echo($theProject['website']); ?>"><?php echo($theProject['website']); ?></a>
                    </p>
                    <p>
                        <span>Date de sortie</span>
                        <?php echo($theProject['dateSortie']); ?>
                    </p>

                    <?php // Les membres de l'équipe du projet s'il y en a une :
                        if ( count($theProject['equipe'])>0 ) { ?>
                    
                        <p>
                            <span>Equipe</span>
                            <?php   foreach ( $theProject['equipe'] as $aMember ) { ?>

                                    <a href="profil.php?num=<?php echo($aMember['numero']); ?>"><?php echo($aMember['identite']); ?></a>, 

                            <?php }
                            echo($theProfil['identite']); /*Le profil visité en dernier*/ ?>
                        </p>
                    
                   <?php } ?>

                    <p class="tagList">
                        <?php foreach( $theProject['tagList'] as $aTag ) { ?>
                            <span><?php echo($aTag); ?></span>
                        <?php } ?>
                    </p>
                </div>

                <div class="col-3-1">
                    <p><?php echo($theProject['description']); ?></p>
                </div>

                <div class="col-3-1">
                    <img src="<?php echo('vues/'.$theProject['urlVisuel']); ?>">
                </div>
            </div>
        </article>

        <?php } ?>

        
        
    </section>
</main>