<?php

    class recuperation {
        
        
        public function _construct() {}

        
        /* (URL) vérifie uniquement que ce n'est pas vide. */
        public static function testNotEmptyGetFromUrl ($aThing) {

            if (isset($_GET[$aThing])) { // éviter des erreurs avec certains hébergeurs.

                if (!empty($_GET[$aThing])) {
                    return true;

                } else { // but empty return false if 0 :
                    return ($_GET[$aThing] == 0) ? true : false;

                }

            } else { return false; }

        }


        /* (URL) retourne un résultat secure depuis les GET. */
        public static function getGetFromUrl ($aThing) {

            $safeGetThing = $_GET[$aThing];

            if ($aThing == "num") {

                $safeGetThing = preg_replace('/[^0-9]/', '', $safeGetThing); // retire tout non-digit
                $safeGetThing = preg_replace('/\A[0+]/', '', $safeGetThing); // puis retire les 0 au début
                if ( $safeGetThing == "" ) { $safeGetThing = "0"; } // s'il ne reste rien on en fait un 0.

            } else if ($aThing == "tag") {

                // Any single character except : the range a-z or A-Z or 0-9 or , -
                $safeGetThing = preg_replace('/[^a-zA-Z0-9,-]/', '', $safeGetThing);

            }

            return $safeGetThing;

        }


        
        /* (ALL) vérifie qu'une valeur est bien un numero. */
        public static function testValueNumero ($aValue) {
            if (!empty($aValue)) {
                
                // signale la présence de tout non digit
                $isItUnsafe = preg_match('/\D/',$aValue);
                
                if ($isItUnsafe) {
                    // signale la présence de 0 avant d'autres chiffres
                    $isItUnsafe = preg_match('/\A0+/',$aValue);
                    
                    // mais on vérifie que ce n'est pas juste un seul 0
                    if ($isItUnsafe) { $isItUnsafe = ($aValue == 0) ? false : true; }
                }
                
                // /!\ on inverse la bool pour rendre un false en cas de problème.
                return ($isItUnsafe) ? false : true;
            } else { return false; }
        }
        
        
        
        /* (INPUT) vérifie uniquement que ce n'est pas vide. */
        public static function testNotEmptyPostFromInput ($aThing) {

            if (isset($_POST[$aThing])) { // éviter des erreurs avec certains hébergeurs.

                if (!empty($_POST[$aThing])) {
                    return true;

                } else { // but empty return false if 0 :
                    return ($_POST[$aThing] == 0) ? true : false;

                }

            } else { return false; }

        }


        
        /* (INPUT) vérifie que ce n'est pas vide ET que ça correspond à une valeur. */
        public static function testValueFromInput ($aThing,$aValue) {

            if (isset($_POST[$aThing])) { // éviter des erreurs avec certains hébergeurs.

                if (!empty($_POST[$aThing])) {
                    
                    if ( $_POST[$aThing] == $aValue ) { return true; }
                    else { return false; }

                } else { // but empty return false if 0 :
                    
                    if ( $aValue == 0 ) { return ($_POST[$aThing] == 0) ? true : false; }
                    else { return false; }
                    
                }
                
            } else { return false; }
        }
        
        
        
        /* (INPUT) retourne un résultat secure depuis les POST. */
        public static function getPostFromInput ($aThing,$aMode) {

            $safeGetThing = $_POST[$aThing];
            
            switch ($aMode) {
                    
                case 'numero' :
                    
                    // note :
                        // On veut un numéro utilisable comme clef unique dans la BDD.
                        // On veut le numero exact recherché, et pas un numero dummy (0),
                        // sans quoi on pourrait modifier ou supprimer l'entrée 0...
                        // donc pas de remplacement ici, on renvoie -1 s'il y a un problème.
                    
                    $isItUnsafe = preg_match('/(^0+(?=[0-9]))|(\D)/',$safeGetThing);
                    return (!$isItUnsafe) ? $safeGetThing : '-1' ;
                    
                    // signale la présence :
                        // de multiples 0 avant un autre chiffre (ex: 0123 ou 000023)
                        // ça inclue 0000 mais laissera un 0 seul tranquille.
                            // (^0+(?=[1-9]))
                            // (^0+ -> s'il y a 1 ou plusieurs 0 au début de la ligne
                            // (?=[0-9]) -> suivis par un chiffre de 1 à 9
                        // de tout non digit
                            // (\D)
                    
                    break;
                    
                case 'identite' :
                    
                    // notes :
                        // on permet les noms courts, ex: Yu.
                        // on permet les ' ex: N'guyen.
                        // on permet les espaces ex: De Lagrange.
                        // on permet les - ex: Jeanne-Claude.
                    
                    // Any single character except : the range a-zA-Z or ' - and space.
                    $safeGetThing = trim($safeGetThing);
                    $safeGetThing = substr($safeGetThing,0,20);
                    $safeGetThing = preg_replace("/[^a-zA-Z'\- ]/", '', $safeGetThing);
                        
                    return $safeGetThing;
                    break;
                    
                case 'l33tName' :
                    
                    // notes :
                        // Utilisé pour les pseudo, nom de projet ou de studio
                        // donc on permet des caractères plus funky.
                    
                    $safeGetThing = trim($safeGetThing);
                    $safeGetThing = substr($safeGetThing,0,20);
                    $safeGetThing = preg_replace("/[^a-zA-Z0-9?!#'\-_ ]/", '', $safeGetThing);
                    
                    return $safeGetThing;
                    break;
                    
                case 'email' :
                    
                    $safeGetThing = substr($safeGetThing,0,255);
                    $safeGetThing = filter_var($safeGetThing, FILTER_SANITIZE_EMAIL);
                    
                    return $safeGetThing;
                    break;
                    
                case 'link' :
                    
                    $safeGetThing = substr($safeGetThing,0,255);
                    $safeGetThing = filter_var($safeGetThing, FILTER_SANITIZE_URL);
                    
                    // on supprime le lien s'il contient onclick= (/i -> case insensitive).
                    // je sais pas si c'est vraiment suffisant comme protection..
                    $verifImg = preg_match("/onclick=/i", $safeGetThing);
                    if ($verifImg) { $safeGetThing = ''; }
                    
                    return $safeGetThing;
                    break;
                    
                case 'desc' :
                    
                    // il faudrait aussi préparer :
                    // ... where descr= ? .... pass= ? ...    
                    // $requete->bindValue(1, $descr, PDO::PARAM_STR);
                    // $requete->bindValue(2, $pass, PDO::PARAM_STR);
                    
                    $safeGetThing = substr($safeGetThing,0,255);
                    $safeGetThing = strip_tags($safeGetThing);
                    $safeGetThing = htmlentities($safeGetThing);
                    
                    return $safeGetThing;
                    break;
                    
                case 'date' :
                    
                    // Vérifier que le format obtenu est bien xxxx-xx-xx où x est un chiffre.
                        // ^(   )$ -> exactement du début à la fin de la string
                        // \d{4} -> 4 chiffres
                        // \- -> suivis par un tiret
                        // \d{2}\-\d{2} -> puis 2 chiffres, un tiret, 2 chiffres.
                        // i love regex quand ça fonctionne \o/
                    $verifDate = preg_match("/^(\d{4}\-\d{2}\-\d{2})$/", $safeGetThing);
                    if (!$verifDate) { $safeGetThing = NULL; }
                    
                    return $safeGetThing;
                    break;
                    
                case 'tag' :
                    
                    $safeGetThing = trim($safeGetThing);
                    $safeGetThing = substr($safeGetThing,0,20);
                    $safeGetThing = preg_replace("/[^a-zA-Z0-9 ]/", '', $safeGetThing);
                    
                    return $safeGetThing;
                    break;
                    
                case 'passProjet' : 
                    
                    $safeGetThing = substr($safeGetThing,0,20);
                    $verifPass = preg_match("/[^b-zB-Z0-9&_]/", $safeGetThing);
                    if ($verifPass) { $safeGetThing = ''; }
                    
                    return $safeGetThing;
                    break;
                    
                case 'passCapcha' : 
                    
                    $safeGetThing = substr($safeGetThing,0,20);
                    $verifPass = preg_match("/[^0-9]/", $safeGetThing);
                    if ($verifPass) { $safeGetThing = ''; }
                    
                    return $safeGetThing;
                    break;
                    
                case 'mdp' : 
  
                    // MDP
                        // mdp faire un hash et ne jamais le décoder.
                        // comparer avec la tentative de mdp hashée de l'user quand il veut se connecter.
                        // https://secure.php.net/manual/fr/faq.passwords.php#faq.passwords.fasthash
                    
                    if ($safeGetThing != '') {
                        // https://secure.php.net/manual/fr/function.password-hash.php
                        $safeGetThing = password_hash($safeGetThing, PASSWORD_BCRYPT);
                    }
                    
                    // pour vérifier on utilisera :
                    // https://secure.php.net/manual/fr/function.password-verify.php
                    // password_verify($mdpTesté,$mdpDeBDD) -> renvoie true si ok.
                    
                    return $safeGetThing;
                    break;
                    
                default: return ''; break;
                    
            }
        }
        
        
    }



/*
    htmlentities($safeGetThing);
    strip_tags($safeGetThing);
    filter_var($safeGetThing, FILTER_SANITIZE_ENCODED);
    https://secure.php.net/manual/en/function.urlencode.php <- pas sur get !!
*/


// messages d'avertissement :
    // ne pas entrer son mail ou tel
    // reflechir avant d'indiquer sa ville dans les tags
    // message habituel mdp fort


/* About sql injections, xss.. : http://kunststube.net/escapism/ */

// URL TAGS
    // filter_sanitize_encoded pour les url, -> pour comparer les tags de la bdd avec ceux de l'url ?
    // js : window.location.href = '?tag=' + encodeURIComponent(title); Replace ampersands with &amp; blank space is equivalent to “%20” : with %3A / with %2F https://perishablepress.com/url-character-codes/

// SQL
    // the mysql_ prefix / DB-handler is outdated, deprecated and should not be used at all. The safest way is to use either mysqli_ or PDO, and use prepared statements.
    // -> https://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php?rq=1
    // http://www.bitrepository.com/sanitize-data-to-prevent-sql-injection-attacks.html
    // notamment mais pas que, dans $query = sprintf("SELECT * FROM `members` WHERE username='%s' AND password='%s'", $username, $password); The %s from the sprintf() function indicates that the argument is treated as and presented as a string.

        /* $requete = $pdo->prepare('SELECT nom FROM personne WHERE numero = :numero');
           $requete->execute(array('numero' => $numero))
                     or die(print_r($requete->errorInfo()));
                     // récupérer une erreur, pas trop l'impression que ça marche. :?*/

// REFS
    // https://www.owasp.org/index.php/Cross-site_Scripting_%28XSS%29
    // http://wisercoder.com/check-for-integer-in-php/

// FILTERS
    // https://secure.php.net/manual/en/book.filter.php
    // https://www.w3schools.com/php/php_filter.asp
    // Remember to trim() the $_POST before your filters are applied
    // To include multiple flags, simply separate the flags with vertical pipe symbols.

// CAPTCHAS : https://www.w3.org/TR/turingtest/
// ASTUCE ? Pass a random generated string ( hashed ) as a hidden element in your form each time your form is rendered, save the string on generation in your session and on form sumbit check for that first, if they don't match then you don't eaven need to bother checking the id or other elements sent


?>