# Dictionnaire des données pour la base de données SAE PONEY


## table PONEY
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| __IDPO__    |  INT AUTO_INCREMENT  | identifiant unique designant un poney, incrementation automatique |
| NOMPO | VARCHAR(15) | nom du poney |
| DDNPO | DATE | date de naissance du poney |
| POIDS_MAX | INT(3) NOT NULL | poids maximum que peut supporter un poney |
| RACE | VARCHAR(20) | race du poney |
| SEXE | enum('F','M') | sexe du poney |


## table COURS
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| __NUMCOURS__    |  INT  | identifiant unique designant un cours, incrementation automatique |
| NOMCOURS | VARCHAR(42) | nom du cours |
| TYPEC | enum('Collectif', 'Individuel') | type de cours, individuel ou collectif |

## table SEANCE
> Une séance n'existe pas sans cours
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| __IDSEANCE__ | INT | identifiant unique designant une seance |
| __NUMCOURS__ | INT | identifiant unique designant un cours  |
| PRIX | DECIMAL(5,2) | le prix de la seance entre 1 et 5 chiffres |
| DUREE | DECIMAL(3,2) | la duree d'une seance **compris entre 1 et 2 heures** |
| NIVEAU | INT | le niveau d'une seance |
| DESCRIPTIF | VARCHAR(50) | description de la seance |
| GROUPE_AGE | VARCHAR(50) | le groupe d'age concerné par cette seance |
| DATE_SEANCE | DATETIME | la date de deroulement de la seance |


## table PERSONNE
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| __IDPER__    |  INT  | identifiant unique designant une personne |
| NOMPER | VARCHAR(42) | nom de la personne |
| PRENOMPER | DECIMAL(3,2) | prenom de la personne |
| EMAIL | VARCHAR(50) | email de la personne |
| POIDS | DECIMAL(5,2) | poids d'une personne |
| ADRESSE | VARCHAR(100) | adresse d'une personne |
| PORTABLE | INT(10) | numero telephone d'une personne |

## table MONITEUR 
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| __IDMON__    |  INT  | identifiant unique designant un moniteur, associe avec une personne |
| TYPECONTRACT | VARCHAR(42) | type de contract (cdd, cdi...) |
| DATEEMBAUCHE | DATE | date d'embauche |

## table ADHERENT 
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| __IDADH__    |  INT  | identifiant unique designant un adherent, associe avec une personne |
| FINCOTISATION | DATE | date a laquelle l'adhérent devra reverser ses cotisations d'inscription |
| NIVEAUGALOT | INT | le niveau galot d'un adherent |

## table FACTURE
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| __IDFACTURE__ | INT AUTO_INCREMENT | identifiant unique d'une facture, incrementation automatique |
| TOTALTTC | DECIMAL(10,2) | le total de la facture |
| DATEEDITION | DATE | date de realisation de la facture |
| IDADH | INT | identifiant unique d'un adherent |

## table TARIFS 
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| __IDTARIF__ | INT | identifiant unique d'un tarif |
| ANNEE | DATE | l'annee de mise en place du tarif |
| PRIX | DECIMAL(7,2) | le prix associé au tarif |


## table ENCADRER
> Un moniteur encadre une séance à une certaine date
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| __IDMON__ | INT | identifiant unique d'un moniteur |
| __NUMCOURS__ | INT | identifiant unique d'un cours |
| __IDSEANCE__ | INT | identifiant unique d'une séance |
| __DATEENC__ | DATETIME | date à laquelle le moniteur encadre la seance |

## table PARTICIPER
> un adherent et et un poney participe à une séance à une certaine date
> Un poney participe avec un seul adherent
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| __NUMCOURS__ | INT | identifiant unique d'un cours |
| __IDPO__ | INT | identifiant unique d'un poney |
| __IDSEANCE__ | INT | identifiant unique d'une séance |
| __IDADH__ | INT | identifiant unique d'un adherent |
| __DATEPART__ | INT | date à laquelle l'adhérent et le poney participe à la séance |
| PAYE | BOOLEAN NOT NULL | false si la séance n'a pas été payé par l'adhérent, sinon true |

## table ETRE_PRESENT
> lorsqu'une facture est faite, elle concerne un ou des tarif.s
|  Nom | type  |  commentaires | 
|-------|---------|-----------|
| __IDFACTURE__ | INT | identifiant unique d'une facture |
| __IDTARIF__ | INT | identifiant unique d'un tarif |










