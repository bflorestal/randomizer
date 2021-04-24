<?php
    include('verifLogin.inc.php');
    include('connectPDO.inc.php');

    // Page inaccessible si l'utilisateur est un visiteur
    if ($_SESSION['droits'] !== "Admin"):
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
    <title>Randomizer | Ajouter un utilisateur</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <?php include('menu_back.inc.php'); ?>
        <div class="liste-users">
            <div class="liste-users-titre">
                <h1>Ajouter un utilisateur</h1>
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
                    <tr>
                        <form action='users-addOk.php' method='POST'>
                            <td><input type='text' name='nom' id='nom' required></td>
                            <td><input type='text' name='prenom' id='prenom' required></td>
                            <td><input type='text' name='login' id='login' required></td>
                            <td><input type='text' name='mdp' id='mdp' required></td>
                            <td>
                                <select name='droits' id='droits'>
                                    <option value='Admin'>Admin</option>
                                    <option value='Visiteur' selected='selected'>Visiteur</option>    
                                </select>
                            </td>
                            <td>
                                <input type='submit' name='ajouter' value='Ajouter' />
                            </td>
                        </form>
                    </tr>
                        
                </table>
            </div>
        </div>
        <a href="users.php">Annuler et retourner à la liste</a>
    </section>
</body>
</html>