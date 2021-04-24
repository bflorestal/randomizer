<?php
    require_once "connectPDO.inc.php" ;

    if (isset($_GET['login'])) :
        if ($_GET['login'] == "attempt") :
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];
            include ("login.php");
        endif;
    endif;

    /* en cas d'urgence, le login.php va ici */

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../CSS/styles.css" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <title>Randomizer</title>
    </head>
    <body>
        <?php 
            if (isset($_GET['e'])) :
                if ($_GET['e'] == "1") :
                    echo '<p class="access-error">Accès refusé.</p>';
                endif;
            endif;
        ?>
        <header>
            <div>
                <h2 class="titreback">BACKOFFICE</h2>
            </div>
        </header>
        <h1>Se connecter</h1>

        <form action="index.php?login=attempt" method="POST" class="form-login">
            <div class="form-input"><input type="text" name="login" id="login" placeholder="Nom d'utilisateur..." required=""></div>
            <div class="form-input"><input type="password" name="mdp" id="mdp" placeholder="Mot de passe..." required=""></div>
            <?php 
                if(isset($message)): 
                    echo $message; 
                endif; 
            ?>
            <div class="form-submit"><input type="submit" name="submit" value="Connexion"></div>
        </form>
    </body>
</html>