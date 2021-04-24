<?php
    include('verifLogin.inc.php');
    include('connectPDO.inc.php');

    // Récupération du nom et du prénom des élèves dans la base de données
    $ligne = $db->query("SELECT * FROM eleves ORDER BY prenom ASC");
    $data = $ligne->fetch();
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
    <title>Randomizer | Ajouter un élève</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <?php include('menu_back.inc.php'); ?>
        <div class="liste-users">
            <div class="liste-users-titre">
                <h1>Ajouter un élève</h1>
            </div>
            <div class="liste-tableau">
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Année</th>
                        <th>Photo</th>
                        <th>Affichage</th>
                        <th></th>
                    </tr>

                    <tr>
                        <form action="eleves-addOk.php" method="POST">
                            <td><input type="text" name="nom" id="nom" required></td>
                            <td><input type="text" name="prenom" id="prenom" required></td>
                            <td><input type="text" name="annee" id="annee" required></td>
                            <td class="td-add-photo">
                                
                                <img id="preview" class="photo" src="../img_upload/no-image.jpg" alt="Photo" />
                                    <select name="photo" id="photo" onchange="document.getElementById('preview').setAttribute('src','../img_upload/' + this.value);">
                                        <option value='no-image.jpg' selected=selected>Aucune</option>
                                        <!-- On récupère toutes les photos de la base de données -->
                                        <?php
                                            // <?= $data['photo'] ? dans le src"../img_upload/
                                            $ligne2 = $db->query("SELECT * FROM image ORDER BY nom ASC");

                                            while ($row = $ligne2->fetch()) :
                                                if ($row['nom'] !== "no-image.jpg"):
                                        ?>
                                                    <option value="<?= $row['nom'] ?>"><?= $row['nom'] ?></option>
                                                <?php endif;
                                            endwhile;
                                        ?>

                                    </select>
                            </td>
                            <td>
                                <select name='affichage' id='affichage'>       
                                    <option value='oui' selected='selected'>oui</option>
                                    <option value='non'>non</option>
                                </select>
                            </td>
                            <td><input type='submit' name='ajouter' value='Ajouter' /></td>
                        </form>
                    </tr>
                </table>
            </div>
        </div>
        <a href="eleves.php">Annuler et retourner à la liste</a>
    </section>
</body>
</html>