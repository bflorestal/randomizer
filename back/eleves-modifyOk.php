<?php
    include('verifLogin.inc.php');
    include('connectPDO.inc.php');

    // Page inaccessible si l'utilisateur est un visiteur
    if ($_SESSION['droits'] !== "Admin"):
        header('Location: eleves.php');
    else:
        // Récupération des variables du formulaire
        $id_modif = $_GET['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $annee = $_POST['annee'];
        $photo = $_POST['photo'];
        $affichage = $_POST['affichage'];

        $requete = $db->prepare("UPDATE eleves SET nom=:nom, prenom=:prenom, annee=:annee, photo=:photo, affichage=:affichage WHERE id=:id");

        $requete->execute(array(
            "id"=>$id_modif,
            "nom"=>$nom,
            "prenom"=>$prenom,
            "annee"=>$annee,
            "photo"=>$photo,
            "affichage"=>$affichage
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
    <title>Randomizer | Modifier une fiche élève</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <p>La fiche élève a été modifiée avec succès.</p>
        <a href="eleves.php">Retourner à la liste</a>
    </section>
</body>
</html>