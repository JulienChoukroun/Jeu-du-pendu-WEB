<?php
    /**
     * Ce script PHP est invoqué par requête Ajax en cas de victoire à jeu.js:135.
     */
    session_start();
    $_SESSION["nb_victoires"]+=1;
?>