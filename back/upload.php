<?php 
    include('verifLogin.inc.php');
    include('connectPDO.inc.php');

    // Page inaccessible si l'utilisateur est un visiteur
    if ($_SESSION['droits'] == "Visiteur"):
        header('Location: index2.php');
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
    <title>Randomizer | Uploader une image</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <?php include('menu_back.inc.php'); ?>
        
        <div class="upload-titre-container">
            <h1>Uploader une image</h1>
            <span>.jpg uniquement, 10 Millions de pixels max</span>
        </div>

        <div class="upload-container">
            <div class="upload-titre">
                <h2>Photos des élèves (.jpg)</h2>
            </div>
            <form action="uploadOk.php" method="POST" enctype="multipart/form-data">
                <div class="explorateur-fichiers">
                    <input type="file" name="media" id="media">
                    <p>Visuels en 320x240 px impérativement</p>
                </div>
                <input class="ajouter-photo" type="submit" name="submit" value="Ajouter une photo">
            </form>
            <div class="autres-visuels">
                <a href="uploadGerer.php">Voir et gérer les autres visuels</a>
            </div>
        </div>
    </section>
</body>
</html>