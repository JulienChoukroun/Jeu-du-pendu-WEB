<?php
/**
 * Ce script PHP s'occupe de dire quelle est la lettre au hasard qui a été donnée par le jeu en guise d'indice.
 * Il est invoqué par requête Ajax en cas de défaite à jeu.js:10.
 */

session_start();
$lettre_au_hasard = $_SESSION["lettre_au_hasard"];
echo($lettre_au_hasard);

?>