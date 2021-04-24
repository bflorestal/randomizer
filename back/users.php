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
    <title>Randomizer | Utilisateurs</title>
</head>
<body>
    <?php include('entete.inc.php'); ?>
    <section>
        <?php include('menu_back.inc.php'); ?>
        
        <div class="liste-users">
            <div class="liste-users-titre">
                <h1>Liste des utilisateurs</h1>
            </div>
            <div class="liste-tableau">
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Login</th>
                        <th>Password</th>
                        <th>Droits</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                    <?php 
                        $ligne = $db->query("SELECT * FROM users ORDER BY nom ASC");
                        while ($row = $ligne->fetch()) :
                    ?>
                    <tr>
                        <td><?= $row['nom'] ?></td>
                        <td><?= $row['prenom'] ?></td>
                        <td><?= $row['login'] ?></td>
                        <td><?= $row['mdp'] ?></td>
                        <td><?= $row['droits'] ?></td>
                        <td><a href="users-modify.php?id=<?= $row['id'] ?>&login=<?= $row['login'] ?>"><span class='material-icons'>edit</span></a></td>
                        <?php
                            // Empêcher l'administrateur connecté de supprimer son propre compte
                                if($_SESSION['login'] != $row['login']): ?>
                                    <td>
                                        <a href="users-delete.php?id=<?= $row['id'] ?>&login=<?= $row['login'] ?>">
                                            <span class='material-icons'>delete</span>
                                        </a>
                                    </td>
                                <?php endif; ?>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <a href="users-add.php">Ajouter un utilisateur</a>
        </div>
    </section>
</body>
</html>