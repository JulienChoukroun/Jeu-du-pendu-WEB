<?php
    /**
     * Ce script PHP s'occupe de donner le mot qui était à deviner. 
     * Il est invoqué par requête Ajax en cas de défaite à jeu.js:138.
     */
    session_start();
    $mot_a_deviner = $_SESSION["mot_a_deviner"];
    echo($mot_a_deviner);
?>