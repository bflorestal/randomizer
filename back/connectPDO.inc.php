<?php //Connexion à la base de données
    try {
        $db = new PDO('mysql:host=localhost;dbname=randomizer;charset=utf8', 'root', '');
    }catch(Exception $e){
        echo 'Impossible de se connecter à la base de données.';
        echo $e->getMessage();
        die();
    }
?>