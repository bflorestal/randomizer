<?php
    include('verifLogin.inc.php');
    include('connectPDO.inc.php');

    // Page inaccessible si l'utilisateur est un visiteur
    if ($_SESSION['droits'] !== "Admin"):
        header('Location: index2.php');
    endif;

    $login_modif = $_GET['login'];
    $id_modif = $_GET['id'];
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
    <title>Randomizer | Modifier un utilisateur</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <?php include('menu_back.inc.php'); ?>
        <div class="liste-users">
            <div class="liste-users-titre">
                <h1>Modifier un utilisateur</h1>
            </div>
            <div class="liste-tableau">
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Login</th>
                        <th>Password</th>
                        <th>Droits</th>
                        <th></th>
                    </tr>
                        <?php 
                            $ligne = $db->query("SELECT * FROM users WHERE id='".$id_modif."'");
                            $resultat = $ligne -> fetch();
                            
                            if($resultat['droits'] == "Admin"){
                                $selected_admin = "selected=selected";
                            } else {
                                $selected_admin = "";
                            }
                            if($resultat['droits'] == "Visiteur"){
                                $selected_visiteur = "selected=selected";
                            } else {
                                $selected_visiteur = "";
                            }
                            ?>
                                <tr><form action="users-modifyOk.php?id=<?= $resultat['id'] ?>" method="POST">
                                <td><input type="text" name="nom" id="nom" value="<?= $resultat['nom'] ?>"></td>
                                <td><input type="text" name="prenom" id="prenom"  value="<?= $resultat['prenom'] ?>"></td>
                                <td><input type="text" name="login" id="login" value="<?= $resultat['login'] ?>"></td>
                                <td><input type="text" name="mdp" id="mdp" value="<?= $resultat['mdp'] ?>"></td>
                                <td><select name="droits" id="droits">
                                        
                                        <option value="Admin" <?= $selected_admin ?> >Admin</option>
                                        <?php 
                                            // Empêcher l'administrateur connecté de s'enlever les droits admin 
                                            if($_SESSION['login'] != $resultat['login']):
                                        ?>
                                                <option value="Visiteur" <?= $selected_visiteur ?> >Visiteur</option>
                                            <?php endif; ?>
                                        
                                </select></td>
                                <td><input type='submit' name='modifier' value='Modifier' /></form></td></tr>
                        
                </table>
            </div>
        </div>
        <a href="users.php">Annuler et retourner à la liste</a>
    </section>
</body>
</html>