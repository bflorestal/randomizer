<?php
    include('verifLogin.inc.php');
    include('connectPDO.inc.php');

    // Page inaccessible si l'utilisateur est un visiteur
    if ($_SESSION['droits'] == "Visiteur"):
        header('Location: index2.php');
    endif;

    if (isset($_GET['id']) && isset($_GET['login'])) :
        $login_del = $_GET['login'];
        $id_del = $_GET['id'];
    else:
        header('Location: users.php');
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <title>Randomizer | Supprimer un utilisateur</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <?php include('menu_back.inc.php'); ?>
        <div class="confirmation-page-container">
            <div class="confirmation-page-titre">
                <h1>Supprimer un utilisateur</h1>
            </div>
            <div>
                <?php if ($login_del !== $_SESSION['login']): ?>

                <p>Voulez-vous vraiment supprimer le compte de <?= $login_del ?> ?</p>
                <a class="delete-confirmation" href="users-deleteOk.php?id=<?= $id_del ?>">Oui</a>
                <a href="users.php">Non</a>

                <?php else: ?>

                <p>Vous ne pouvez pas supprimer ce compte.</p>
                <a href="users.php">Retourner à la liste</a>
                
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>