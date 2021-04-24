<?php
    //include('verifLogin.inc.php');
    include('back/connectPDO.inc.php');

    if(!empty($_POST)) :
        $stackEleves = "";
        foreach ($_POST as $key => $value) : // on récupère toutes les cases cochées en POST
            $presence = strpos($key, 'chb'); // on teste si dans les valeurs du POST on a au moins l'existence de 'chb' (donc d'un name de checkbox)
            if ($presence === false) :
            else :
                $stackEleves .= $value.", "; // On génère la string en concaténant, de tous les noms voulus pour la requête SQL concernée
            endif;
        endforeach;
        $stackEleves = substr($stackEleves, 0, -2); // retourne toute la string sauf les deux derniers caractères (virgule et espace)
    endif;

    // Table eleves
    $reponse1 = $db->query("SELECT id, prenom, photo FROM eleves WHERE affichage = 'oui' ORDER BY prenom ASC");
    $j = 1; $i = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/styles.css" />
    <title>Randomizer</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/slot.js"></script>
</head>
<body>
    <h1>MMI 2 | TD DEV | Session 2021</h1>
        <form class="form-checkbox" action="index.php?defile=ok" method="POST">
            <div class="checkbox-container">
                <?php 

                    while ($resultat1 = $reponse1->fetch()) :

                        // string ID et name
                        $chb = "chb".$j;
                        // string pour vérifier si la case est cochée
                        if (isset($_POST[$chb])) :
                            $checkedChb = "checked";
                        else :
                            $checkedChb = "";
                        endif;
                ?>
                <div>
                    <input type="checkbox" class="checkNames" id="<?= $resultat1['id'] ?>" name="<?= $chb ?>" value="<?= $resultat1['id'] ?>" <?= $checkedChb ?> >
                    <label for="<?= $chb ?>"><?= $resultat1['prenom'] ?></label>
                </div>
                <?php 
                    $j++;
                endwhile;
                $reponse1->closeCursor(); 
                ?>

            </div>

            <div class="checkall-box">
                <input type="checkbox" id="checkAll" name="checkAll" />
                <span class="text12">CHECK ALL</span>
            </div>

            <div class="form-submit">
                <button type="submit" id="fvj" name="submit">Choisir</button>
            </div>
        </form>

        <?php
            if (isset($_GET['defile'])) :
                if ($_GET['defile'] == "ok") : // début de l'affichage de la zone de défilement
                    $reponse2 = $db->query("SELECT id, photo FROM eleves WHERE affichage = 'oui' AND id IN ($stackEleves) ORDER BY nom ASC"); // requête pour l'affichage des avatars des élèves affichés
                    $reponse3 = $db->query("SELECT id, photo FROM eleves WHERE affichage = 'oui' AND id IN ($stackEleves) ORDER BY nom ASC"); // pareil
                    $row = $reponse3->fetchAll();
                    $nombre_lignes = count($row);
        ?>

        <div class="slot-container">
            <div id="slot">
                <ul style="height: <?= $nombre_lignes ?>00%" class="blur liste-img-rand">
                    <?php
                        while ($resultat2 = $reponse2 -> fetch()):
                    ?>
                    <li style="display: inline-block;">
                        <img id="<?= $resultat2['id'] ?>" src="img_upload/<?= $resultat2['photo'] ?>" class="avatar" alt="Photo" />
                    </li>
                    <?php
                        $i++;
                        endwhile;
                        $reponse2->closeCursor();
                    ?>
                </ul>
            </div>
        </div>

        <div id="blockDown">
            <button id="choose" class="bouton">Choisir un étudiant</button>
            <a href="index.php" class="lien">Rafraîchir la page</a>
        </div>

        <?php 
                endif; // fin de la partie défilement
            endif;
         ?>
</body>
</html>