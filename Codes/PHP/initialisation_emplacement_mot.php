<?php
    /**
     * Initialisation de l'emplacement initial des lettres
     * 
     * Ce programme initialise l'emplacement initial des lettres.
     * Si l'utilisateur le décide,  il peut générer l'emplacement intial avec une lettre tirée au hasard. 
     * Exemple : si le mot à deviner est "TABLEAU" et que l'utilisateur veut l'aide de départ, ce programme tire au hasard la lettre "A" et donne la chaîne suivante : "_ A _ _ _ A _ ".
     * Cette chaîne est alors affichée en début de partie.
     * 
     * Ce script est invoqué à jeu.php:3.
     */
    session_start();

    $longueurMot = $_SESSION["longueurMot"];
    $mot_a_deviner = $_SESSION["mot_a_deviner"];
    //$indiceDepart  = $_SESSION["indiceDepart"];
    

    /**
     * Crée une chaîne contenant autant de "_ " qu'il y a de lettres dans le mot à deviner.
     * @param int $longueurMot    La longueur du mot à deviner.
     * @return string tirets      Chaîne de $longueurMot "_ ".
     */
    function initialiserTirets($longueurMot){
        $tirets="";
        for ($i=0; $i < $longueurMot; $i++) { 
            $tirets .= "_ ";
        }
        return $tirets;
    }

    /**
     * Génére une lettre au hasard parmi le mot à deviner.
     * @param string $mot_a_deviner Mot dans lequel piocher une lettre.
     * @return string Une seule lettre sélectionnée au hasard.
     */
    function lettre_au_hasard($mot_a_deviner){
        $random_index = rand(0,strlen($mot_a_deviner)-1);
        return substr($mot_a_deviner,$random_index,1);
    }


    /**
     * Donne les positions d'apparaition d'une lettre dans un mot.
     * @param string $mot     Mot à analyser.
     * @param string $lettre  Lettre à chercher dans $mot.
     * @return array $positions  Tableau contenant TOUTES les positions d'apparation de $lettre dans $mot.
     */
    function trouverLettre($mot, $lettre){
        $offset = 0;
        $positions = array(); // tableau contenant TOUTES les positions d'apparation de $lettre dans $mot.

        while(($pos = strpos($mot, $lettre, $offset)) !== FALSE){
            $offset = $pos +1 ;
            $positions[] = $pos;
        }
        return $positions;
    }

    /**
     * @see trouverLettre() 
     * @return string $emplacements Chaîne constituée du nouvel emplacement des lettres et des tirets
     */
    function remplacerLettre($tirets, $mot, $lettre){
        $positions = trouverLettre($mot, $lettre);
        foreach ($positions as $pos) {
            $new_pos = $pos*2;
            $tirets[$new_pos] = $lettre;
        }
        return $tirets;
    }

    /**
     * Initialise les tirets (emplacement du mot à deviner) en début de partie
    */
     function initialiserEmplacementMot($mot_a_deviner,$longueurMot,$indiceDepart){
        $tirets = initialiserTirets($longueurMot);
        
        if ($indiceDepart=="true") //Si l'utilisateur veut l'indice de départ
        {
            $lettre_au_hasard = lettre_au_hasard($mot_a_deviner);
            $_SESSION["lettre_au_hasard"] = $lettre_au_hasard; // On stocke la lettre qui a été choisie au hasard pour pouvoir ensuite la griser en JavaScript dans jeu.js.
            $tirets_avec_indice = remplacerLettre($tirets,$mot_a_deviner,$lettre_au_hasard);
            return $tirets_avec_indice;
        }
        // Sinon
        return $tirets;
    }

    
?>
