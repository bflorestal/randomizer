<?php 
    session_start();
    /* 
    si la variable de session login n'existe pas cela signifie que le visiteur
    n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
    accéder à l'espace membres
    */
    if(!isset($_SESSION['login'])) :
        header("location:index.php?e=1");
        exit;
    endif;

?>