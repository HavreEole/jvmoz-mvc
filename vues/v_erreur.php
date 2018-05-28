<!DOCTYPE html>
<html>
    <head>
        <title>Annuaire JV Mosaïc - Page d'erreur</title>
        <meta name="description" content="" />
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="vues/styles/main.css"/>
    </head>
    <body>

        <header>
            <a href="index.php">JV Mosaic</a>
            <a href="#">Se connecter</a>
        </header>
        
        <main>
            <section id='commonStyles'>

                <!-- Retour -->

                <menu>
                    <a href='index.php'>
                        <h3>◃Accueil</h3>
                    </a>
                </menu>

                <!-- Titre -->

                <h1><span><?php echo($erreurTxt); ?></span></h1>

            </section>
        </main>