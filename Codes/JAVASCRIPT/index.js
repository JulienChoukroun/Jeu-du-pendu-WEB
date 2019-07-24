var longueurMot;
var longueurMot_chiffre = 3; // Initialisation forcée de la valeur, au cas où l'utilisateur ne touche pas au slider.

window.onload = function () {
  var slider = document.getElementById("slider_longueurMot");
  longueurMot = document.getElementById("longueurMot_accueil");

  // Configuration du slider
  longueurMot.innerHTML = slider.value;
  slider.oninput = function() // À chaque changement de valeur du slider, la valeur affichée s'actualise.
  {
      longueurMot.innerHTML = this.value;
      longueurMot_chiffre = this.value;
  }
};



function debuter() {
  new simpleAjax("generateur_mot.php","post","longueurMot="+longueurMot_chiffre,ok,ko);
}


// La fonction appelée au retour de la requête Ajax, en cas
// de succès.
// Le paramètre 'request' est un objet contenant, entre autre,
// le résultat du script invoqué, via l'attribut 'responseText'
function ok(request) {
  let indiceDepart = document.getElementById("proposition_aide_checkbox").checked; // On regarde si l'utilisateur a demandé une lettre d'aide au départ.
  location.href = 'jeu.php?indiceDepart='+indiceDepart; // On redirige vers la page de jeu, avec comme paramètre GET la variable permettant de savoir si l'utilisateur a demandé une lettre d'aide au départ.
}

// La fonction appelée au retour de la requête Ajax, en cas
// d'echec.
function ko(request) {
  alert("oups, problème !");
}
