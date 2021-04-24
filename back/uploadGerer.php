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
    <title>Randomizer | Gérer les médias</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <?php include('menu_back.inc.php'); ?>
        <div class="liste-users">
            <div class="liste-users-titre">
                <h1>Liste des images</h1>
            </div>
            <div class="liste-tableau">
                <table>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <?php if (($_SESSION['droits']) == "Admin"): ?>
                        <th>Supprimer</th>
                        <?php endif; ?>
                    </tr>
                        <?php 
                            $ligne = $db->query("SELECT * FROM image ORDER BY nom ASC");
                            while ($row = $ligne->fetch()) :

                                echo "<tr>";
                                if ($row['nom'] !== "no-image.jpg"):
                                    echo "<td><img class='medias-image' src='../img_upload/".$row['nom']."' alt='Image' /></td>";
                                    echo "<td>".$row['nom']."</td>";
                                
                                    if($_SESSION['droits'] == "Admin"):
                                        echo "<td><a href='upload-delete.php?id=".$row['id']."&file=".$row['nom']."'><span class='material-icons'>delete</span></a></td>";
                                    endif;
                                endif;
                                echo "</tr>";
                            endwhile;
                        ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>