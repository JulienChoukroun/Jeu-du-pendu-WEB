# Le Pendu

Le Pendu est un jeu consistant à trouver un mot en devinant quelles sont les lettres qui le composent. C'est un jeu du type humain contre machine simple car il n'y a aucune stratégie à implémenter côté machine, le code que vous devez écrire ne servant qu'à permettre au joueur de jouer.

## Principe
A chaque coup, le joueur propose une lettre. Si cette lettre est dans le mot au moins une fois, elle est affichée à son ou ses emplacements corrects dans le mot, sinon le programme fait apparaître un élément supplémentaire du pendu. Si le joueur arrive à proposer toutes les lettres qui constituent le mot (donc, devine le mot) avant que le pendu soit constitué, il gagne. Dès que le pendu est constitué la partie est perdue.

## Fonctionnalités
Votre site web doit :
- comporter une page d'accueil : la page doit présenter brièvement le jeu et grâce à un clic on doit pouvoir jouer
- permettre de choisir la longueur du mot à deviner
- la page de jeu : cette page se réactualise à chaque coup joué

A la fin d'une partie, le joueur doit être redirigé vers la page d'accueil. Sur la page de jeu, si l'utilisateur saisit autre chose qu'une lettre de l'alphabet, une erreur doit être signalée. Le jeu doit être insensible à la casse (donc, il est équivalent d'utiliser des lettres minuscules ou majuscules).

## Mise en oeuvre
On peut utiliser les sessions pour stocker le mot à deviner, le mot partiel proposé par le joueur ainsi que le nombre de coups restants au joueur. 
Au début de la partie, un mot est tiré au hasard parmi tous les mots d'une longueur donnée. Tous les mots possibles sont stockés dans un fichier de texte contenant un mot par ligne. Au début du jeu, le script doit lire le fichier, collecter les mots ayant la bonne longueur et en tirer un hasard.
