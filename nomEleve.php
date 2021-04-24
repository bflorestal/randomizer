<?php

    require_once "back/connectPDO.inc.php" ;

    $idEleve = $_POST['id'];

    $request = $db->prepare("SELECT prenom FROM eleves WHERE id = :id");
    $request->execute(array(
        'id' => $idEleve,
    ));

    $resultat = $request->fetchAll(PDO::FETCH_ASSOC);

    $nomEleve = $resultat[0]['prenom'];

    echo $nomEleve; // echo("<p class='liste-align-centre'>" utf8_decode($nomEleve) "</p>");

?>