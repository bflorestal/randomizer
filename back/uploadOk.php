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

        <?php

            // Initialisation d'un variable qui autorisera ou non l'enregistrement dans la base
            $uploaded=0;

            $taille_fichier = $_FILES['media']['size'];
            $nom_fichier = $_FILES['media']['name'];
            $fichier_tmp  = $_FILES['media']['tmp_name'];

            //Si le fichier a une taille
            if($taille_fichier>0) {
                
                //Répertoire où sera stocké ce fichier (le répertoire doit avoir les droits 0777) -- $varFolder est set dans verifLogin
                $rep="../img_upload/";

                //On remplace les éventuels espaces et dans le nom du fichier par des underscore
                $nom_fichier = str_replace (" ", "_", $nom_fichier);
                $nom_fichier = str_replace ("'", "_", $nom_fichier);

                //On remplace les A, E, I, O, U avec accent par un A, E, I, O, U normal
                $a = array("ä", "â", "à");
                $nom_fichier = str_replace ($a, "a", $nom_fichier);

                $e = array("é", "è", "ê", "ë");
                $nom_fichier = str_replace ($e, "e", $nom_fichier);
                
                $i = array("ï", "î");
                $nom_fichier = str_replace ($i, "i", $nom_fichier);
                
                $o = array("ö", "ô");
                $nom_fichier = str_replace ($o, "o", $nom_fichier);
                
                $u = array("ù", "û", "ü");
                $nom_fichier = str_replace ($u, "u", $nom_fichier);
                
                // On met le nom du fichier dans la variable $newfichier
                $newfichier=$nom_fichier;

                // On sépare en deux le nom et l'extension
                list($nomFichier, $ext) = explode(".", $newfichier);

                // On place en minuscules les extensions
                $ext = strtolower($ext);

                // On rajoute le type pour éviter l'écrasement de fichiers
                $nomFichier = "Eleve_".$nomFichier;

                // On lui rajoute l'extension pour la copie dans le dossier
                $savefile= $rep.$nomFichier.".".$ext;

                

                // SI IMAGE JPG il faut la retailler, l'uploader et ensuite insérer dans la base
                $extensions_autorisees = array('jpg', 'jpeg');
                if (in_array($ext, $extensions_autorisees)) {

                    // si Retaillage de l'image
                    if(preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $nom_fichier)) {
                            exit("<p>Erreur : Nom de fichier non valide (Vérifiez les apostrophes et guillemets)</p>");
                        }
                    $taillePaysage=320;
                    $taillePortrait=240;
                    $donnees=getimagesize($fichier_tmp);

                    // Vérification de la taille de l'image
                    if (($donnees[0] != 320) || ($donnees[1] != 240)) {
                        exit("<p>Erreur : Taille de fichier non valide (320x240 px obligatoire)</p><a href='upload.php'>Retour à la page d'upload de fichiers</a>");
                    }

                    $image = imagecreatefromjpeg($fichier_tmp);
                    
                    // Portrait
                    if ($donnees[0] < $donnees[1]) {
                        $largeur_finale=round(($taillePortrait/$donnees[1])*$donnees[0]);
                        $hauteur_finale=$taillePortrait;
                    }
                    else
                    {// Paysage
                        $hauteur_finale=round(($taillePaysage/$donnees[0])*$donnees[1]);
                        $largeur_finale=$taillePaysage;
                    }
                    $imageResized = imagecreatetruecolor($largeur_finale, $hauteur_finale); // Création image finale retaillée
                    imagecopyresampled($imageResized, $image, 0, 0, 0, 0, $largeur_finale, $hauteur_finale, $donnees[0], $donnees[1]); // Copie avec redimensionnement

                    if (imagejpeg ($imageResized, $savefile, 80)) { // La fonction envoie l'image avec la compression
                        imagedestroy ($image);
                        // On passe la variable à 1
                        $uploaded=1;

                        $annee = date("Y");
                        
                        // Requête PDO
                        $requete = $db->prepare("INSERT INTO image (nom, annee) VALUES (:nom, :annee)");

                        $requete->execute(array(
                            "nom"=>$nomFichier.".".$ext,
                            "annee"=>$annee
                        ));

                        echo "<div class='upload-succes'>
                                <p>Votre fichier a été uploadé correctement.</p>
                                <p>Vous l'avez appelé <font color='red'><strong>";
                                echo ("$nomFichier."."$ext");
                                echo "</strong></font> afin de le choisir dans le menu déroulant prévu à cet effet.</p>
                            </div>";
                    }
                }
            } else { // Si le fichier n'a pas de taille, la variable reste à zéro pour empêcher l'écriture dans la base
                $uploaded = 0;
                echo ('<p>Votre fichier ne semble pas conforme.</p>');
            }
	?> 
        <a href="upload.php">Retourner à la page upload</a>
    </section>
</body>
</html>