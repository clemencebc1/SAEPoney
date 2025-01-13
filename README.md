# SAEPoney

## SAE 3.02 Web/BD BUT2


Le groupe est constitué de Nathan Randriantsoa *TD2B*, Clemence Bocquet *TD2B* et Ophelie Valin *TD1A*

## Table des matières
- prérequis
- lancement du projet

### Prérequis
Avant de lancer le site web, assurez-vous d'avoir les installations PHP nécessaires (driver mysql)  
Dans le fichier **constantes** (templates/php/utils/constantes+templates/php/utils/UserTools), configurez la connexion avec votre base de données  
Suite à différents problèmes d'implémentations : modifiez aussi la connexion à la ligne 6 dans calendar et calendar-adherent

### Lancement du projet
Pour lancer le site web :
- se rendre à la racine du projet, ouvrir templates avec ```cd templates/```
- dans un terminal, lancer le serveur php avec ```php -S localhost:8000```
- si vous obtenez l'erreur 'Not Found', tapez l'url suivant : ```http://localhost:8000/templates/index.php```