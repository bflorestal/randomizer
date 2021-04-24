<?php
    include('verifLogin.inc.php');
    include('connectPDO.inc.php');

    // Récupération des variables du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $annee = $_POST['annee'];
    $photo = $_POST['photo'];
    $affichage = $_POST['affichage'];

    $requete = $db->prepare("INSERT INTO eleves (nom, prenom, annee, photo, affichage) VALUES (:nom, :prenom, :annee, :photo, :affichage)");

    $requete->execute(array(
        "nom"=>$nom,
        "prenom"=>$prenom,
        "annee"=>$annee,
        "photo"=>$photo,
        "affichage"=>$affichage
    ));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/styles.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Randomizer | Ajouter un élève</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <p><?= $_POST['prenom'] ?> a été ajouté à la liste avec succès.</p>
        <a href="eleves.php">Retourner à la liste</a>
    </section>
</body>
</html>