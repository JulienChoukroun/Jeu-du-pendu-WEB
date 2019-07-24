/**
 * Script du fichier jeu.php
 */

var clavier;
window.onload = function(){
    let emplacements_lettres_a_deviner = document.getElementById("emplacements_lettres_a_deviner");  

    clavier = document.querySelectorAll(".lettre"); // On stocke dans le tableau "clavier" chaque lettre (qui a la classe "lettre").
    new simpleAjax("quelleEstLaLettreAuHasard.php","get","",griserLettreAide,ko); // On grise la lettre d'aide donnée en début de partie.
	for( let i = 0; i < clavier.length; i++ )
        {   
            clavier[i].onclick = verifier;   
    }
}

/**
 * On stocke dans ce JS la chaîne de caractères générée par le serveur PHP qui contient les tirets (emplacement des lettres à deviner).
 * Cependant, le PHP génére par défaut une chaîne contenant à son début plusieurs espaces et des caractères newline.
 * Il faut donc "nettoyer" cette chaîne afin d'enlever ces caractères indésirables à son début (d'où l'appel de la fonction enleverEspacesDebut() que l'on a créée).
*/
let tirets = document.getElementById("emplacements_lettres_a_deviner").innerHTML;
tirets = enleverEspacesDebut(tirets);

// Initialisation des compteurs.
let nb_erreurs = 0; // Sert à compter le nombre de mauvaises propositions.

let lettre_proposee; // Initialisation de la variable qui stockera la dernière lettre proposée par l'utilisateur.

/**
 * Fonction executée après un clic sur une lettre.
 * S'occupe de vérifier si la lettre proposée par le joueur est bien dans le mot à deviner et réagit en conséquence.
 */
function verifier(){
    griserLettre(this); // Une fois une lettre cliquée, on la grise pour que l'utilisateur sache quelles lettres il a déjà proposé.
    lettre_proposee = this.innerHTML; 
    new simpleAjax("remplacer_lettres.php","get","lettre_proposee="+ lettre_proposee,ok,ko);
}

/**
 * Grise la lettre proposée par le joueur sur le clavier.
 * @param {document.span} lettre Le span de la lettre à griser.
 */
function griserLettre(lettre){
    lettre.classList.add("lettre-dejaCliquee");
    //lettre.classList.remove("lettre");
}
/**
 * Grise la lettre d'aide de départ sur le clavier.
 * @param {*} request 
 */
function griserLettreAide(request) {
    let lettreAide = request.responseText;
    let lettreAide_index = letterToIndex(lettreAide);
    lettreAide_span = clavier[lettreAide_index];
    griserLettre(lettreAide_span);
}

/**
 * Empêche uniquement de cliquer sur les lettres du clavier (sans les griser).
 */
function noClicClavier(){
    for( let i = 0; i < clavier.length; i++ )
        {   
            clavier[i].classList.add("noClic");   
    }
}

/** 
 * La fonction appelée au retour de la requête Ajax, en cas de succès.
 * @param {object}   request           Objet contenant, entre autres, le résultat du script invoqué, via l'attribut 'responseText'.
*/ 
function ok(request){   
    if (request.responseText == "MAUVAISE PROPOSITION") {
        if (nb_erreurs<6) {
            nb_erreurs++;
            document.getElementById("dessin").src ="ressources/images/"+ nb_erreurs +".png"; // L'image du pendu change (on lui rajoute un membre).
        }
        // AU bout de 6 erreurs, la partie est perdue.
        if (nb_erreurs==6) {
            document.getElementById("dessin").src ="ressources/images/6.png"; // Le pendu est mort.
            finDuJeu(false); //
            
        }
    } 
    // Si la lettre proposée est une bonne proposition.
    else {
        emplacements_lettres_a_deviner.innerHTML = remplacerLettre(lettre_proposee,request.responseText); // La lettre proposée est remplace le tiret correspondant.

        // Si le mot a été deviné en entier.
        if (motTrouvé(emplacements_lettres_a_deviner)) {
            finDuJeu(true);
        }
    }
}
/**
* Remplace les tirets par la lettre proposée aux bons emplacements.
* @return {string} $emplacements Chaîne constituée du nouvel emplacement des lettres et des tirets
*/
function remplacerLettre(lettre, positions) {
    for (let i = 1; i < positions.length; i++) {
        let pos = positions[i]*2; // On multiplie par deux car il y a un espace entre chaque tiret.
        tirets = setCharAt(tirets,pos,lettre);
    }
    return tirets;
}



/**
 * Permet de vérifier si le mot a été deviné ou pas.
 * @return {boolean} true/false si toutes les lettres ont été devinées.
 */
function motTrouvé(emplacements_lettres_a_deviner) {
    let tirets = emplacements_lettres_a_deviner.innerHTML;
   if (tirets.includes("_")) // Il reste encore des "_" : il reste donc des lettres à deviner.
   {
       return false; 
   } 
   // Il ne reste plus de "_", le mot a été deviné.
   else {
       return true;
   }
}

/**
 * Éxecute les comportements de victoire/défaite de fin de partie.
 * @param {boolean} bool 
 * @fires simpleAjax
 */
function finDuJeu(bool){
    if (bool==true) // EN CAS DE VICTOIRE.
    {
        
        new simpleAjax("victoire.php","get","",victoire,ko);
    } else // EN CAS DE DÉFAITE.
    {
        new simpleAjax("defaite.php","get","",defaite,ko);
    }
}
var gif_container = document.getElementById("gif_container"); // On stocke l'élement DOM contenant le GIF de fin

/**
 * Affiche un message de félicitations.
 * Affiche un GIF de félicitations.
 */
function victoire() {
    noClicClavier(); // On désactive les clics sur le clavier.

    document.getElementById("message1").innerHTML = "Bravo, vous avez gagné !";
    document.getElementById("message1").style.visibility = "visible";

    DOMaddImage(gif_container,"victoire.gif"); // On ajoute le GIF au HTML
    gif_container.style.visibility = "visible"; // On rend visible ce GIF
}
/**
 * Affiche un message de défaite.
 * Affiche un GIF de défaite.
 */
function defaite(request){
    noClicClavier(); // On désactive les clics sur le clavier afin que le joueur ne puisse pas tricher et continuer à jouer malgré sa défaite.

    let motADeviner = request.responseText; // Le mot qui était à deviner est contenu dans la réponse de la requête Ajax.
    document.getElementById("message1").innerHTML = "Vous avez perdu... Le mot à deviner était : ";
    document.getElementById("message2").innerHTML = motADeviner;
    document.getElementById("message1").style.visibility = "visible";
    document.getElementById("message2").style.visibility = "visible";

    DOMaddImage(gif_container,"defaite.gif"); // On ajoute le GIF au HTML
    gif_container.style.visibility = "visible"; // On rend visible ce GIF
}

/**
 * Fonction appelée lorsque l'utilisateur clique sur le bouton "Non" à la question "Rejouer ?".
 * Enlève toutes les div liées au jeu.
 * Agrandit la div des stats.
 */
function nePasRejouer(){
    let sectionCentrale = document.getElementById("centre");
    let indication = document.getElementById("indication");
    let boutonRejouer = document.getElementById("boutonRejouer");
    let stats_div = document.getElementById("stats");

    // Enlève toutes les div liées au jeu.
    indication.innerHTML = "Voici vos statistiques de jeu.";
    sectionCentrale.parentNode.removeChild(sectionCentrale);
    boutonRejouer.parentNode.removeChild(boutonRejouer);

    stats_div.classList.add("stats-fin"); // Agrandit la div des stats.
}


// ------------ FONCTIONS OUTIL ------------
/**
 * Donne l'index de l'alphabet d'une lettre.
 * Exemple 1 : si on lui donne "A", la fonction retournera 0.
 * Exemple 2 : si on lui donne "C", la fonction retournera 2.
 * @param {char} lettre     Lettre majuscule. 
 * @returns {int} index     L'index de l'alphabet d'unne lettre (de 0 à 25). 
 */
function letterToIndex(lettre){
    var alphabet = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","X","Y","Z"];
    index = alphabet.indexOf(lettre);
    return index;
}

/**
 * Nettoie la chaîne de caractères passée en paramètre en lui enlevant tous les espaces ou newline en debut de chaîne.
 * @param {String} str Chaîne à nettoyer.
 * @return {String} Chaîne nettoyée, sans espaces à son début.
 */
function enleverEspacesDebut(str) {
    while(str.charAt(0)==" " || str.charAt(0)=="\n"){
        str = str.slice(1);
    }
    return str;
}
/**
 * Remplace le caractère à l'index index de str par le caractère char
 * @param {string} str 
 * @param {string} index 
 * @param {string} char 
 * @return {string} chaîne originale modifiée comme souhaité
 */
function setCharAt(str,index,char) {
    if(index > str.length-1){return str;}
    return str.substr(0,index) + char + str.substr(index+1);
}

/**
 * Pour ajouter l'image de chemin "reference" au conteneur "parent".
 * Enlève avant toutes les images contenues dans "parent".
 */
function DOMaddImage(parent,reference){
    while (parent.hasChildNodes()) {  
        parent.removeChild(parent.firstChild);
    } 
    var DOM_img = document.createElement("img");
    DOM_img.src = "ressources/images/"+reference;
    parent.appendChild(DOM_img);
}


/** 
 * La fonction appelée au retour des requêtes Ajax, en cas d'échec.
 * */ 
function ko(request) {
    alert("Oups, problème ! Veuillez redémarrer le jeu.");
}



