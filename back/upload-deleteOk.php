<?php
    include('verifLogin.inc.php');
    include('connectPDO.inc.php');

    // Page inaccessible si l'utilisateur est un visiteur
    if ($_SESSION['droits'] == "Visiteur"):
        header('Location: index2.php');
    endif;

    // Récupération des variables du formulaire
    $id_del = $_GET['id'];
    $nomFichier = $_GET['file'];
    echo $nomFichier;
    $requete = $db->query("DELETE FROM image WHERE id=$id_del");

    if (file_exists($nomFichier)):
        unlink($nomFichier);
    else:
        echo "il y a un problème";
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
    <title>Randomizer | Supprimer une image</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <p>L'image a été supprimée avec succès.</p>
        <a href="uploadGerer.php">Retourner à la liste</a>
    </section>
</body>
</html>