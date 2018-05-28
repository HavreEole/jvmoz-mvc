<?php

    class recuperation {
        
        
        public function _construct() {}

        
        /* vérifie uniquement que ce n'est pas vide. */
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

                // Any single character except : the range a-z or A-Z or 0-9 or ,
                $safeGetThing = preg_replace('/[^a-zA-Z0-9,-]/', '', $safeGetThing);

            }

            return $safeGetThing;

        }


        
        /* vérifie uniquement que ce n'est pas vide. */
        public static function testNotEmptyPostFromInput ($aThing) {

            if (isset($_POST[$aThing])) { // éviter des erreurs avec certains hébergeurs.

                if (!empty($_POST[$aThing])) {
                    return true;

                } else { // but empty return false if 0 :
                    return ($_POST[$aThing] == 0) ? true : false;

                }

            } else { return false; }

        }
        
        
        
        /* (INPUT) retourne un résultat secure depuis les POST. */
        public static function getPostFromInput () {

            // -> htmlspecialchars pour qqchose qui va être affiché en html
            // -> + sanitization lib, mais en attendant je vais juste retirer les trucs louches.
            // <>~%'{([-|_\^)]=}+$*!:;.?é`çà@$£/§#& ,

            /* ... */

            /*
                htmlspecialchars($_GET[$aThing], ENT_QUOTES);
                htmlentities($safeGetThing);
                strip_tags($safeGetThing);
                filter_var($safeGetThing, FILTER_SANITIZE_ENCODED);
                https://secure.php.net/manual/en/function.urlencode.php <- pas sur get !!
            */

            // MDP
            // mdp faire un hashtag et ne jamais le décoder.
            // comparer avec la tentative de mdp hashée de l'user quand il veut se connecter.
            // sha1($password) pour crypter le mdp dans la base
            // https://secure.php.net/manual/fr/faq.passwords.php#faq.passwords.fasthash
            // voir wikipedia plutôt pour l'explication du salt.

            // TAGS (création)
            // ! on autorisera QUE les alphas, digits et espaces. Pas d'espaces multiples, pas de "".

            // Twitter -> placer un @ devant; verif les caractères permis dans les @ twitter.
            // linkedin -> placer l'url normale devant; autoriser les - pour linkedin.
            // website : autoriser / _ - . et ?

            // messages d'avertissement :
            // ne pas entrer son mail ou tel
            // reflechir avant d'indiquer sa ville dans les tags
            // message habituel mdp fort

            // captchas : pour l'instant juste mettre un mot de passe fort, en dur.

        }
    }


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