# SAEPoney

## SAE 3.02 Web/BD BUT2

Le groupe est constitué de Nathan Randriantsoa *TD2B*, Clémence Bocquet *TD2B* et Ophélie Valin *TD1A*

## Table des matières
- Prérequis
- Lancement du projet

### Prérequis
Avant de lancer le site web, assurez-vous d'avoir les installations PHP nécessaires (driver MySQL). 
Configurez la connexion avec votre base de données avec vos constantes (hôte, nom de la base de données, nom d'utilisateur, mot de passe).
Dans le dossier **utils** (templates/php), modifiez les constantes de connexion à la base de données avec les vôtres dans les fichiers pour les lignes qui contiennent `DBConnector`.
- **calendar-adherent.php**
- **calendar-moniteur.php**
- **calendar.php**
- **constantes.php**
- **DBConnector.php** 
- **UserTools.php** 
Suite à différents problèmes d'implémentation : Assurez-vous que toutes les constantes sont correctes.

### Lancement du projet
Pour lancer le site web :
- Se rendre à la racine du projet, ouvrir templates avec ```cd templates/```
- Dans un terminal, lancer le serveur PHP avec ```php -S localhost:8000```
- Si vous obtenez l'erreur 'Not Found', tapez l'URL suivante : ```http://localhost:8000/index.php```

## Fonctionnalités implémentées 
Voici la liste des fonctionnalités que nous avons implémentées dans ce site :
- Connexion à son espace personnel pour les adhérents et les moniteurs
- Consultation de l'emploi du temps pour les adhérents et les moniteurs
- Consultation de ses factures pour les adhérents
- Connexion à un espace de gestion pour les personnes habilitées au rang d'administrateur
- Inscription d'adhérents et de moniteurs via l'interface de gestion administrateur
- Création d'espace utilisateur pour toutes personnes via l'interface administrateur

## Sécurisation et logiques : 
Voici quelques outils développés qui ont permis l'implémentation de certaines fonctionnalités spécifiques.

### Librairie UserTools
Création d'une librairie UserTools permettant la gestion des utilisateurs du site.
Celle-ci alimente le code principal avec toutes les opérations nécessaires :
- Initialisation de connexion en interrogeant la base de données
- Sécurisation des pages accessibles uniquement en étant connecté
- Vérification des rôles (Droits)

### DBConnector
Création d'une classe DBConnector pour instancier la connexion entre l'application et la base de données ainsi que 
toutes les requêtes pour la base de données.