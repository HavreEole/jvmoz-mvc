<!DOCTYPE html>
<html>
    <head>
        <title>Annuaire JV Mosaïc - <?php echo($titre); ?></title>
        <meta name="description" content="<?php echo($description); ?>" />
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="vues/styles/main.css"/>
    </head>
    <body>

        <header>
            <a href="index.php">JV Mosaic</a>
            <?php if ( isset($_SESSION['numLogged']) ) { ?>
                <a href="profil.php?num=<?php echo $_SESSION['numLogged']; ?>"><?php echo $_SESSION['nomLogged']; ?></a>
                <a href="compte.php">Modifier</a>
                <a href="deco.php">Deconnexion</a>
            
            <?php } else { ?>
                <a href="compte.php">Se connecter</a>
            <?php } ?>
        </header>