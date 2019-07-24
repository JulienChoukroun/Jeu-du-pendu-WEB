<?php
    /**
     * Programme qui réagit en fonction d'une lettre proposée
     * Par requête Ajax, la lettre proposée par l'utilisateur est transmise à ce programme.
     * La lettre proposée est récupérée dans le tableau $_GET.
     * 
     * Ce script est invoqué par requête Ajax à jeu.js:37.
     */

    session_start();

    $longueurMot = $_SESSION["longueurMot"];
    $mot_a_deviner = $_SESSION["mot_a_deviner"];
    $lettre_proposee = $_GET["lettre_proposee"];

    /**
     * Donne les positions d'apparaition d'une lettre dans un mot.
     * @param string $mot     Mot à analyser.
     * @param string $lettre  Lettre à chercher dans $mot.
     * @return array $positions  Tableau contenant TOUTES les positions d'apparation de $lettre dans $mot.
     */
    function trouverLettre($mot, $lettre){
        $offset = 0;
        $positions = array(); // tableau contenant TOUTES les positions d'apparation de $lettre dans $mot

        while(($pos = strpos($mot, $lettre, $offset)) !== FALSE){
            $offset = $pos +1 ;
            $positions[] = $pos;
        }
        return $positions;
    }

    if (strpos($mot_a_deviner, $lettre_proposee) !== FALSE) // BONNE PROPOSITION
    {
        echo($longueurMot.implode(trouverLettre($mot_a_deviner, $lettre_proposee))); //Donne une chaîne qui a pour caractère la longueur du mot à deviner suivi des positions d'apparition de la lettre proposée dans le mot à deviner. 
    } 
    else // MAUVAISE PROPOSITION
    {
        echo("MAUVAISE PROPOSITION");
    }


?>
