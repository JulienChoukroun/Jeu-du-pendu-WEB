<?php
    session_start();

    // -------- STATISTIQUES DE JEU ---------
    // Si le $_SESSION["nb_parties"] existe, c'est que des parties ont déjà été jouées.
    if(isset($_SESSION["nb_parties"])){
        $_SESSION["nb_parties"]+=1;
    }
    // Sinon, c'est que l'utilisateur s'apprête à jouer sa première partie.
    else {
        $_SESSION["nb_parties"]=0;
    }
    
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Jeu du pendu</title>
        <meta name="author" content="Amad Salmon & Julien Choukroun">
        <link rel="apple-touch-icon" sizes="180x180" href="ressources/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="ressources/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="ressources/favicons/favicon-16x16.png">
        <link rel="manifest" href="ressources/favicons/site.webmanifest">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/style_index.css" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700&amp;subset=latin-ext" rel="stylesheet">
        <script src="index.js"></script>
        <script src="simpleajax.js"></script>
    </head>
    <body>
        <!-- HAUT DE PAGE -->
        <div class="header">Jeu du pendu</div>

        <!-- CORPS DE PAGE -->
        <div id="consignes">
            <h4> Le Pendu est un jeu consistant à trouver un mot en devinant quelles sont les lettres qui le composent. </h4>
            <div id="reglesDuJeu">
                <h4>Règles du jeu :</h4>
                <p> 
                    À chaque coup, le joueur propose une lettre. 
                </p>
                <p>
                    Si cette lettre est dans le mot au moins une fois, elle est affichée à son/ses emplacement(s) correct(s) dans le mot.
                </p>
                <p>
                    Sinon, le programme fait apparaître un élément supplémentaire du pendu. Si le joueur arrive à proposer toutes les lettres qui constituent le mot avant que le pendu soit constitué, il gagne. 
                </p>
                <p>    
                    6 mauvais essais sont permis avant de perdre la partie.
                </p> 
            </div>
        </div>

        <h4> 
            Choisissez la longueur du mot à deviner : 
        </h4>
        <!-- Slider pour choisir la longueur du mot à deviner -->
        <div class="slidecontainer">
            <p>
                <span id="longueurMot_accueil"></span> <!-- Affichage de la valeur selectionnée par la position actuelle du slider -->
                lettres
            </p>
            <input type="range" min="3" max="9" value="1" class="slider" id="slider_longueurMot">
        </div>
        <div id="proposition_aide">
            Indice de départ
            <input id="proposition_aide_checkbox" type="checkbox" name="aide" value="Oui">
        </div>
        <p>
            <input id="bouton" type="button" value="Jouer" onclick="debuter()"/>
        </p>


        <!-- BAS DE PAGE -->
        <div class="footer">
            <p>
                Projet de Amad Salmon & Julien Choukroun (Groupe 4)
                -
                <a href="ressources/rapport.pdf" download>
                    Rapport
                </a>
            </p>
            <p> 
                <!-- Badge validation HTML -->
                <a href="http://jigsaw.w3.org/html-validator/check/referer">
                    <img class="badge" 
                    src="https://www.w3.org/Icons/valid-html401-blue.png"
                    alt="Valid HTML!" />
                </a>
                <!-- Badge validation CSS -->
                <a href="http://jigsaw.w3.org/css-validator/check/referer">
                    <img class="badge"
                    src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
                    alt="Valid CSS!" />
                </a>
            </p>
        </div>
    </body>

</html>
        
