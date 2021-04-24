<?php 
    include('verifLogin.inc.php');
    include('connectPDO.inc.php');
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
    <title>Randomizer | Élèves</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <?php include('menu_back.inc.php'); ?>
        
        <div class="liste-users">
            <div class="liste-users-titre">
                <h1>Élèves</h1>
            </div>
            <a href="eleves-add.php">Ajouter un élève</a>
            <div class="liste-tableau">
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Année</th>
                        <th>Photo</th>
                        <?php if (($_SESSION['droits']) == "Admin"): ?>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        <?php endif; ?>
                    </tr>
                    <?php 
                        $ligne = $db->query("SELECT * FROM eleves ORDER BY nom ASC");
                        while ($row = $ligne->fetch()) :

                            // Griser les élèves non affichés
                            if ($row['affichage'] == "non") :
                                $affichage_non = "affichage-non" ;
                            else :
                                $affichage_non = "" ;
                            endif;
                            
                    ?>
                    <tr class="<?= $affichage_non ?>">
                        <td><?= $row['nom'] ?></td>
                        <td><?= $row['prenom'] ?></td>
                        <td><?= $row['annee'] ?></td>
                        <td><img class="photo" src="../img_upload/<?= $row['photo'] ?>" alt="Photo" /> </td>
                        <?php if($_SESSION['droits'] == "Admin"): ?>
                            <td>
                                <a href="eleves-modify.php?id=<?= $row['id'] ?>">
                                    <span class='material-icons'>edit</span>
                                </a>
                            </td>
                            <td>
                                <a href="eleves-delete.php?id=<?= $row['id'] ?>">
                                    <span class='material-icons'>delete</span>
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                        <?php endwhile; ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>