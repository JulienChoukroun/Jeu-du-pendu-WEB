<?php
    /**
     * Ce script PHP s'occupe de tirer au sort un mot de longueur donnée. 
     * Il est invoqué par requête Ajax en cas de défaite à index.php:73.
     */
    session_start();

    $longueurMot = $_SESSION["longueurMot"] = $_POST["longueurMot"];
    

    // Choix d'un mot de bonne longueur au hasard 
    $liste_noms_communs = file("ressources/noms_communs.txt", FILE_IGNORE_NEW_LINES);
    $liste_noms_de_bonne_longueur = array();
    foreach ($liste_noms_communs as $mot) { 
        if (strlen($mot)==$longueurMot) // Si le mot selectionné est de la longeur voulue, on l'ajoute à la liste des mots convenables
        {
            array_push($liste_noms_de_bonne_longueur,$mot); 
        }
    }
    
    $index_mot_au_hasard = array_rand($liste_noms_de_bonne_longueur); // donne l'index d'un mot de bonne longueur au hasard
    
    $mot_a_deviner = $liste_noms_de_bonne_longueur[$index_mot_au_hasard];  // parmi les mots de bonne longueur, on en choisit 1

    // On stocke le mot selectionné en SESSION
    $_SESSION["mot_a_deviner"] = $mot_a_deviner;

?>