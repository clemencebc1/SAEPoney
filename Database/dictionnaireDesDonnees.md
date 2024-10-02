# Dictionnaire des données pour la base de données SAE PONEY

## table PONEY
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| IDPO    |  INT AUTO_INCREMENT  | identifiant unique designant un poney, incrementation automatique |
| NOMPO | VARCHAR(15) | nom du poney |
| DDNPO | DATE | date de naissance du poney |
| POIDS_MAX | INT(3) NOT NULL | poids maximum que peut supporter un poney |
| RACE | VARCHAR(20) | race du poney |
| SEXE | enum('F','M') | sexe du poney |


## table COURS
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| NUMCOURS    |  INT AUTO_INCREMENT  | identifiant unique designant un cours, incrementation automatique |
| NOMCOURS | VARCHAR(42) | nom du cours |
| DUREE | DECIMAL(3,2) | duree du cours compris entre 1 et 2 heures |
| TYPEC | enum('Collectif', 'Individuel') | type de cours, individuel ou collectif |


## table PERSONNE
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| IDPER    |  INT  | identifiant unique designant une personne |
| NOMPER | VARCHAR(42) | nom de la personne |
| PRENOMPER | DECIMAL(3,2) | prenom de la personne |
| EMAIL | VARCHAR(50) | email de la personne |
| POIDS | DECIMAL(5,2) | poids d'une personne |
| ADRESSE | VARCHAR(100) | adresse d'une personne |
| PORTABLE | INT(10) | numero telephone d'une personne |

## table MONITEUR 
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| IDMON    |  INT  | identifiant unique designant un moniteur, associe avec une personne |
| TYPECONTRACT | VARCHAR(42) | type de contract (cdd, cdi...) |
| DATEEMBAUCHE | DATE | date d'embauche |

## table ADHERENT 
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| IDADH    |  INT  | identifiant unique designant un adherent, associe avec une personne |
| FINCOTISATION | DATE) | date a laquelle l'adhérent devra reverser ses cotisations d'inscription |





