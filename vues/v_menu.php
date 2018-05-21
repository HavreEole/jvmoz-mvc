<main>
    <div id="menuListStyles">
        <menu class="col-5-1">
    
            <?php if (empty($listes->get_tagsFromUrlTxt())) { ?>
                <h3>Filtrer</h3>
            <?php } else { ?>
                <a href='index.php'><h3>Défiltrer</h3></a>
            <?php } ?>

            <ul>

            <?php
                
                foreach ($listes->get_tagsListeAffichee() as $aTagInfos) {

                    // préparer un event au clic sur le lien :
                    $tagOnclick = 'addTag(event,\''.$aTagInfos['nomPourUrl'].'\')';

                    // Si le tag est selectionné :
                    $tagClass= '';
                    if (in_array($aTagInfos['nomPourUrl'],$listes->get_tagsFromUrlArray())) {
                        $tagOnclick = 'removeTag(event,\''.$aTagInfos['nomPourUrl'].'\')'; // on change l'event.
                        $tagClass= " class='tagSelect' "; // on ajoute une classe.
                    } ?>
                
                    <li>
                        <a href="?tag=<?php echo($aTagInfos['nomPourUrl']); ?>"
                           onclick="<?php echo($tagOnclick); ?>"
                           <?php echo($tagClass); ?>    >
                            
                            <span><?php echo($aTagInfos['nbUsages']); ?></span>
                            <?php echo($aTagInfos['nom']); ?>
                        </a>
                    </li>

                <?php } ?>
                
                <p> <a href=''>Voir plus</a> </p>

            </ul>
        </menu>