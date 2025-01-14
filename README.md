# SAEPoney

## SAE 3.02 Web/BD BUT2


Le groupe est constitué de Nathan Randriantsoa *TD2B*, Clemence Bocquet *TD2B* et Ophelie Valin *TD1A*

## Table des matières
- prérequis
- lancement du projet
- fonctionnalités implémentées avant et après soutenance

### Prérequis
Avant de lancer le site web, assurez-vous d'avoir les installations PHP nécessaires (driver mysql)  
Dans le fichier **constantes** (templates/php/utils/constantes+templates/php/utils/UserTools), configurez la connexion avec votre base de données  
Suite à différents problèmes d'implémentations : modifiez aussi la connexion à la ligne 6 dans calendar et calendar-adherent

### Lancement du projet
Pour lancer le site web :
- se rendre à la racine du projet, ouvrir templates avec ```cd templates/```
- dans un terminal, lancer le serveur php avec ```php -S localhost:8000```
- si vous obtenez l'erreur 'Not Found', tapez l'url suivant : ```http://localhost:8000/templates/index.php```

### Fonctionnalités implémentées avant et après soutenance
#### Avant soutenance
Les fonctionnalités implémentées avant la soutenance sont : 
- Page d'accueil avec possibilités de visualiser les tarifs, les poneys, les cours du club, les témoignages, les actualités
- Possibilité de se connecter à son espace client **Adhérent**
- Un adhérent peut voir son planning, ses factures réglées ou non payées
- Possibilité de se connecter à son espace **Moniteur**
- Un moniteur peut voir son planning
- Possibilité de se connecter en tant qu'**administrateur**
- Un administrateur peut ajouter un adhérent et un moniteur, il peut également leur créer un compte

#### Après soutenance
Les fonctionnalités implémentées après la soutenance sont : 
- 
