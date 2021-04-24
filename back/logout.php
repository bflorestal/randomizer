<?php
    session_start();
    $_SESSION = array();

    // Destruction de la session
    session_destroy();
    header("location:index.php");
    //echo '<meta http-equiv="refresh" content="0; URL=index.php">';
?>