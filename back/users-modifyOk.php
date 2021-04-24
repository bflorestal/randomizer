<?php
    include('verifLogin.inc.php');
    include('connectPDO.inc.php');

    // Page inaccessible si l'utilisateur est un "visiteur"
    if ($_SESSION['droits'] !== "Admin"):
        header('Location: index2.php');
    else:
        // Récupération des variables du formulaire
        $id_modif = $_GET['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $droits = $_POST['droits'];

        $requete = $db->prepare("UPDATE users SET nom=:nom, prenom=:prenom, login=:login, mdp=:mdp, droits=:droits WHERE id=:id");
        $requete->execute(array(
            "id"=>$id_modif,
            "nom"=>$nom,
            "prenom"=>$prenom,
            "login"=>$login,
            "mdp"=>$mdp,
            "droits"=>$droits
        ));
    endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/styles.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Randomizer | Modifier un utilisateur</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <p>L'utilisateur <?= $login ?> a été modifié avec succès.</p>
        <a href="users.php">Retourner à la liste</a>
    </section>
</body>
</html>