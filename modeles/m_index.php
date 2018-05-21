<?php 

    $pdo = new PDO(SERVEUR, USER, PASS);

    // https://secure.php.net/manual/fr/pdo.connections.php (+ 1er commentaire)
    // https://www.upguard.com/articles/top-11-ways-to-improve-mysql-security
    // https://stackoverflow.com/questions/45018620/is-pdo-database-connection-secure#45018660

    // https://stackoverflow.com/a/60496 :
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // when using PDO to access a MySQL database real prepared statements are not used by default. To fix this you have to disable the emulation of prepared statements.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // the script will not stop with a Fatal Error when something goes wrong; it gives the developer the chance to catch any error(s) which are thrown as PDOExceptions.



    /* REFs :
        fetch() -> retourne seulement la première ligne, sous forme d'array.
        fetchAll() -> retourne toutes les lignes, chacune sous forme d'arrays dans un array.
        fetchColumn() -> retourne juste une colonne. Ex: "SELECT COUNT('nom') FROM..." rendra juste un nombre.
        
        fetch...(PDO::FETCH_NUM) -> rendra un array avec index numérique.
        fetch...(PDO::FETCH_ASSOC) -> rendra un array avec index associatif (key=>value).
        -> Par défaut on obtient FETCH_BOTH qui renvoie chaque valeur dubliquée avec une clef numérique puis associative.
        
        fetch...(PDO::FETCH_COLUMN) -> rendra un array simple de la colonne (0=>'a',1=>'b',2=>'c'),
            au lieu d'un array avec juste une valeur dans un array, ce qui est bof :
            array( 0 => array( 0=>'a'), 1 => array( 0=>'b'), 2 => array( 0=>'c'),).
            
        Une requête complète :
            $requete = $pdo->query('SELECT * FROM table');
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
            $requete->closeCursor(); $requete=NULL; // fin de requête.
            return $resultat;

        Une requête préparée :
            $monNumero = 2;
            $requete = $pdo->prepare('SELECT * FROM table WHERE numero = :numero');
            $requete->execute(array('numero' => $monNumero));
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
            $requete->closeCursor(); $requete=NULL; return $resultat;
    */



    /*** Vérification de présence de tags dans l'url ***/

    if ($recuperation->testNotEmptyGetFromUrl("tag")) { // s'il y a des tags dans l'url,

        $safeTag = $recuperation->getGetFromUrl("tag"); // récupérer les tags dans l'url,
        $multiTags = explode(",",$safeTag); // en faire un array.
        $tagListArray = array();
        $tagListTxt = '';
        
        // Comparer les tags de l'url aux tags de la db.
        foreach ( $multiTags as $oneTag ) {

            // Verifier que ce tag existe,
            
                // faire correspondre l'url au tag :
                $aName = preg_replace('/[-]/', ' ', $oneTag); // des espaces
                $aName = ucwords($aName); // maj devant chaque mot

                $requete = $pdo->prepare('SELECT nom FROM mz_tags WHERE nom = :nom');
                $requete->execute(array('nom' => $aName));
                $resultat = $requete->fetchColumn();
                $requete->closeCursor(); $requete=NULL;

            // si le tag existe, l'ajouter :
            
                if ($resultat) {
                    $tagListTxt .= $oneTag.", ";
                    array_push($tagListArray,$oneTag);
                } unset($resultat);

        }
        $tagListTxt = preg_replace('/[-]/', ' ', $tagListTxt);
        $tagListTxt = rtrim($tagListTxt,', ');
        
        $listes->set_tagsFromUrl($tagListTxt,$tagListArray);
    }



    $pdo = NULL; // fin de connexion.

?>