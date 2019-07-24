<?php
    $indiceDepart = $_GET["indiceDepart"]; // On voit si l'utilisateur a demandé un indice de départ.
    include("initialisation_emplacement_mot.php");

    // -------- STATISTIQUES DE JEU ---------
    $nb_parties = $_SESSION["nb_parties"]; // Compte le nombre de victoires.
    // Si l'utilisateur a déjà remporté des parties.
    if(isset($_SESSION["nb_victoires"])){
        $nb_victoires = $_SESSION["nb_victoires"];
    }
    // Si c'est la première partie du joueur, nb_victoires = 0.
    else {
        $nb_victoires = $_SESSION["nb_victoires"]= 0;
    } 
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
		<title>Jeu du pendu</title>
		<meta name="author" content="Amad Salmon & Julien Choukroun">
        <link rel="icon" type="image/png" sizes="32x32" href="ressources/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="ressources/favicons/favicon-16x16.png">
        <link rel="manifest" href="ressources/favicons/site.webmanifest">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,600,700&amp;subset=latin-ext" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/style_page_jeu.css" />
        <script src="simpleajax.js"></script>
    </head>
    <body>
		<div class="header"><a href="index.php">Jeu du pendu</a></div>
        
        <div id="indication">
            Tentez de deviner ce mot de <strong><span id="longueurMot_span"><?php echo($longueurMot);?></span></strong> lettres. 
        </div>
        <!--
            La section de jeu "centre" est divisée d'abord en deux parties : "gauche" et "droite".
            * "gauche" est elle même divisée en plusieurs sous-parties, incluant la div contenant l'emplacement du mot à deviner, les messages de fin de partie ou encore la div contenant le clavier.
            * "droite" ne contient que l'image du pendu.
        -->
        <!-- DÉBUT SECTION CENTRALE-->
        <div id="centre">
            <!-- DÉBUT SECTION GAUCHE-->
            <div id="gauche">
                
                <div id="emplacements_lettres_a_deviner">
                    <?php echo(initialiserEmplacementMot($mot_a_deviner,$longueurMot,$indiceDepart));?>
                </div>
                <div class="message" id="message1" style="visibility:hidden">
                    <!--Emplacement pour afficher un message en fin de partie-->
                </div>
                <div class="message" id="message2" style="visibility:hidden">
                    <!--Emplacement pour afficher le mot qui était à deviner en fin de partie-->
                </div>
                <div id="gif_container" alt="GIF" style="visibility:hidden"> 
                    <!--Emplacement du GIF de fin de partie-->
                </div>
                
                
                <div id="clavier">
                    <span class="lettre">A</span>
                    <span class="lettre">B</span>
                    <span class="lettre">C</span>
                    <span class="lettre">D</span>
                    <span class="lettre">E</span>
                    <span class="lettre">F</span>
                    <span class="lettre">G</span>
                    <span class="lettre">H</span>
                    <span class="lettre">I</span>
                    <span class="lettre">J</span>
                    <span class="lettre">K</span>
                    <span class="lettre">L</span>
                    <span class="lettre">M</span>
                    <span class="lettre">N</span>
                    <span class="lettre">O</span>
                    <span class="lettre">P</span>
                    <span class="lettre">Q</span>
                    <span class="lettre">R</span>
                    <span class="lettre">S</span>
                    <span class="lettre">T</span>
                    <span class="lettre">U</span>
                    <span class="lettre">V</span>
                    <span class="lettre">W</span>
                    <span class="lettre">X</span>
                    <span class="lettre">Y</span>
                    <span class="lettre">Z</span>
                </div>
            </div> <!-- FIN SECTION GAUCHE-->
            
            <!-- DÉBUT SECTION DROITE-->
            <div id="droite">
                <!-- Emplacement de l'image du pendu -->
                <img id="dessin" alt="Dessin du pendu" src="ressources/images/0.png">
            </div> 
            <!-- FIN SECTION DROITE-->
        </div> <!-- FIN SECTION CENTRALE-->


        <!-- AFFICHAGE DES STATISTIQUES DE JEU-->
        <div id="stats">
            Parties : <span id="nbParties">
            <?php echo($nb_parties);?>
            </span>
            <br />
            Victoires : <span id="nbVictoires"><?php echo($nb_victoires);?></span>
        </div>
        <!-- PROPOSITION DE NOUVEAU JEU -->
        <div id="boutonRejouer">
            <span>Encore une partie ?</span>
            <input type="button" value="Oui" onclick="location.href='index.php';" />
            <input type="button" id="button24" value="Non" onclick="nePasRejouer()") />
        </div>
        
    </body>
    <script src="jeu.js"></script> <!-- Ce script n'est invoqué qu'après avoir fermé la balise body afin de pouvoir accèder à tout le contenu créé par body.-->
</html>

