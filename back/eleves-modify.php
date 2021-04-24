<?php
    include('verifLogin.inc.php');
    include('connectPDO.inc.php');

    $id_modif = $_GET['id'];
    // Récupération du nom et du prénom de l'élève dans la base de données
    $ligne = $db->query("SELECT * FROM eleves WHERE id='".$id_modif."'");
    $data = $ligne -> fetch();

    // Page inaccessible si l'utilisateur est un visiteur
    if ($_SESSION['droits'] == "Visiteur"):
        header('Location: eleves.php');
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
    <title>Randomizer | Modifier une fiche élève</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <?php include('menu_back.inc.php'); ?>
        <div class="liste-users">
            <div class="liste-users-titre">
                <h1>Modification de la fiche élève <?= $data['nom']." ".$data['prenom']; ?></h1>
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
                    <?php
                        if($data['affichage'] == "oui"){
                            $selected_oui = "selected=selected";
                        } else {
                            $selected_oui = "";
                        }
                        if($data['affichage'] == "non"){
                            $selected_non = "selected=selected";
                        } else {
                            $selected_non = "";
                        }

                        // Preview : aucune image
                        $noImage = "";
                        if ($data['photo'] == "Aucune"):
                            $noImage = "";
                        else:
                            $noImage = $data['photo'];
                        endif;
                    ?>
                    <tr>
                        <form action='eleves-modifyOk.php?id=<?= $data['id'] ?>' method='POST'>
                        <td><input type='text' name='nom' id='nom' value='<?= $data['nom'] ?>'></td>
                        <td><input type='text' name='prenom' id='prenom'  value='<?= $data['prenom'] ?>'></td>
                        <td><input type='text' name='annee' id='annee' value='<?= $data['annee'] ?>'></td>
                                
                            <td class='td-add-photo'>
                                <img id='preview' class='photo' src='../img_upload/<?= $noImage ?>' alt='Photo' />
                                
                                <select name="photo" id="photo" onchange="document.getElementById('preview').setAttribute('src','../img_upload/' + this.value);">
                                    <option value='no-image.jpg'>Aucune</option>

                                    <!-- On récupère toutes les photos de la base de données -->
                                    <?php
                                        $ligne = $db->query("SELECT * FROM image ORDER BY nom ASC");

                                        while ($row = $ligne->fetch()) :
                                            if ($data['photo'] == $row['nom']):
                                                $selected_img = "selected=selected";
                                            else:
                                                $selected_img = "";
                                            endif;

                                            if ($row['nom'] !== "no-image.jpg"):
                                    ?>
                                                <option value="<?= $row['nom'] ?>" <?= $selected_img ?>><?= $row['nom'] ?></option>
                                            <?php endif;
                                        endwhile; 
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name='affichage' id='affichage'>
                                    <option value='oui' <?= $selected_oui ?> >oui</option>
                                    <option value='non' <?= $selected_non ?> >non</option>
                                </select>
                            </td>
                            <td>
                                <input type='submit' name='modifier' value='Modifier' /></form>
                            </td>
                        </tr>
                </table>
            </div>
        </div>
        <a href="eleves.php">Annuler et retourner à la liste</a>
    </section>
</body>
</html>