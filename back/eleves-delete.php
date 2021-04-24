<?php
    include('verifLogin.inc.php');
    include('connectPDO.inc.php');

    if (isset($_GET['id'])) :
        $id_del = $_GET['id'];
    endif;

    // Page inaccessible si l'utilisateur est un visiteur
    if ($_SESSION['droits'] == "Visiteur"):
        header('Location: eleves.php');
    endif;

    // Récupération du nom et du prénom de l'élève dans la base de données
        $recupnom = $db->query("SELECT * FROM eleves WHERE id='".$id_del."'");
        $data = $recupnom -> fetch();
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
    <title>Randomizer | Supprimer une fiche élève</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <?php include('menu_back.inc.php'); ?>
        <div class="confirmation-page-container">
            <div class="confirmation-page-titre">
                <h1>Supprimer un élève</h1>
            </div>
            <div>
                <p>Voulez-vous vraiment supprimer la fiche élève "<?= $data['nom']." ".$data['prenom']; ?>" ?</p>
                <a class="delete-confirmation" href="eleves-deleteOk.php?id=<?= $id_del ?>">Oui</a>
                <a href="eleves.php">Non</a>
            </div>
        </div>
    </section>
</body>
</html>