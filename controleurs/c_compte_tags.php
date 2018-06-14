<?php

    include_once("/modeles/m_compte_tags.php");

    
        
    /*** La personne veut supprimer des tags ***/
    if ( $_POST['tags_gerer'] == 'supr_tags' ) { // TODO safiser ?
        foreach ($_POST as $aPostKey=>$aPostValue) { // TODO safiser ?
            if (strpos($aPostKey,"suprNum_") === 0) { // S'il y a un suprNum_xxx dans post,
                suprTags ($safePersonneNum, $aPostValue); // c'est un tag à supprimer.
            }
        }
    }

    /*** La personne veut ajouter des tags ***/
    if ( $_POST['tags_gerer'] == 'add_tags' ) { // TODO safiser ?
        foreach ($_POST as $aPostKey=>$aPostValue) { // TODO safiser ?
            if (strpos($aPostKey,"addNum_") === 0) { // S'il y a un addNum_xxx dans post,
                addTags($safePersonneNum, $aPostValue); // c'est un tag à ajouter.
            }
        }
    }

    /*** La personne veut créer un tag ***/
    if ( $_POST['tags_gerer'] == 'create_tag' ) { // TODO safiser ?

        $newTag = $_POST['create_tagTxt']; // TODO safiser.

        if( strlen($newTag) > 20 ) { 
            $erreurTxt = 'Erreur : ce tag est trop long.';

        } else if ( preg_match('/[^a-zA-Z0-9 ]/',$newTag) ) {
            $erreurTxt = 'Erreur : ce tag contient des caractères non autorisés.';

        } else { // si pas de problèmes, créer et ajouter le tag.

            // tout en minuscules et majs en début de mots pour que ça colle dans la bdd.
            $newTag = strtolower($newTag); // tout en minuscules
            $newTag = ucwords($newTag); // maj devant chaque mot

            $tagAlreadyExist = createTag($safePersonneNum, $newTag);
            if ($tagAlreadyExist) { $erreurTxt = 'Erreur : ce tag existe déjà.'; }

        }
    }
        
    

    /*** Afficher le formulaire ***/
    getTagsInfos($safePersonneNum,$compteDatas);
    include_once("/vues/v_compte_tags.php");

?>