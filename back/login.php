<?php 
    require_once "connectPDO.inc.php" ;

    if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['mdp'])) {
        extract($_POST);
        // On récupère le mdp de la table qui correspond au login du visiteur

        $requete = $db->query("SELECT * FROM users WHERE login='".$login."'");
        $data = $requete -> fetch();

        if($data['mdp'] != $mdp) {
        
            $message = "<p class='access-error'>Mauvais login/password. Merci de recommencer.</p>";

        } else {
            //Authentification
            session_start();
            $_SESSION['login'] = $login;
            $_SESSION['mdp'] = $data['mdp'];
            $_SESSION['prenom'] = $data['prenom'];
            $_SESSION['nom'] = $data['nom'];
            $_SESSION['droits'] = $data['droits'];
            $_SESSION['id'] = $data['id'];
            echo '<meta http-equiv="refresh" content="0; URL=index2.php">';
            // ici vous pouvez afficher un lien pour renvoyer
            // vers la page d'accueil de votre espace membres
        }
    } else {
        $message = '<p id="message">Vous avez oublié de remplir un champ.</p>';
    }
?>