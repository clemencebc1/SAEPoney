<?php
namespace components;
class ActionForm {
    private string $type;

    public function __construct(string $type) {
        $this->type = $type;
    }

    private function personneBlock(): string {
        return '
        <div class="side-container">
        <div id="personal-form">
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" placeholder="Nom" required>
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" placeholder="Prenom" required>
        <label for="mail">Mail</label>
        <input type="email" id="mail" name="mail" placeholder="mail@mail.fr" required> 
        <label for="date_naissance">Date de naissance</label>
        <input type="date" id="date_naissance" name="date_naissance" required>
        <label for="poids">Poids en Kg</label>
        <input type="number" id="poids" name="poids" placeholder="30" required>
        <label for="adresse">Adresse</label>
        <input type="text" id="adresse" name="adresse" placeholder="Adresse postale" required>
        <label for="tel">Téléphone</label>
        <input type="tel" id="tel" name="tel" placeholder="Numéro de portable" required>
        </div>
        </div>      
        ';
    }

    private function registerAdherentForm(): string {
        return '
        <form action="administrator_control_pannel.php?action=registerAdherent&submit=true" method="post">
        <div id="title">
        <h1> Inscription d\'un Adhérent </h1>
        </div>
        <div id="container">
        ' . $this->personneBlock() . '
        <div class="side-container">
        <div id="custom-form">
        <label for="fincotisation">Fin de cotisation</label>
        <input type="date" id="fincotisation" name="fincotisation" required>
        <label for="niveau">Niveau</label>
        <select name="niveau" id="niveau">
            <option value="1">Débutant (1)</option>
            <option value="2">Intermédiaire (2)</option>
        </select>
        </div>
        </div>
        </div>  
        <input type="submit" value="inscrire">
        </form>';
    }

    private function registerMoniteurForm(): string {
        return '
        <form action="administrator_control_pannel.php?action=registerMoniteur&submit=true" method="post">
        <div id="title">
        <h1> Inscription d\'un Moniteur </h1>
        </div>
        <div id="container">
        ' . $this->personneBlock() . '
        <div class="side-container">
        <div id="custom-form">
        <label for="typecontrat">Type de contrat</label>
        <select name="typecontrat" id="typecontrat">
            <option value="CDI">CDI</option>
            <option value="CDD">CDD</option>
            <option value="INTERIM">Interim</option>
        </select>
        <label for="dateembauche">Date d\'embauche</label>
        <input type="date" id="dateembauche" name="dateembauche" required>
        </div>
        </div>
        </div> 
        <input type="submit" value="inscrire">
        </form>';
    }

    private function registerCoursForm(): string {return '<h1> Fonction bientôt disponible </h1>';}

    private function registerPoneyForm(): string {return '<h1> Fonction bientôt disponible </h1>';}

    private function registerSeanceForm(): string {return '<h1> Fonction bientôt disponible </h1>';}

    private function registerUserForm(): string {
        return '
        <form action="administrator_control_pannel.php?action=registerUser&submit=true" method="post">
        <div id="title">
        <h1> Inscription d\'un utilisateur pour une Personne </h1>
        </div>
        <div id="custom-form">
        <label for="email">Email de la personne</label>
        <input type="email" id="email" name="email" placeholder="exemple@mail.fr"required>
        <label for="password">Mot de passe temporaire</label>
        <input type="password" id="password" name="password" placeholder="Mot de passe" required>
        <label for="confirmPassword">Confirmer le mot de passe</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmer mot de passe" required>
        <label for="role">Role</label>
        <select name="role" id="role">
            <option value="ADHERENT">Adherent</option>
            <option value="MONITEUR">Moniteur</option>
            <option value="ADMIN">Admin</option>
        </select>
        </div>
        <input type="submit" value="inscrire">
        </form>';

    }

    public function render(): string {
        switch ($this->type) {
            case 'registerAdherent':
                $render = $this->registerAdherentForm();
                break;
            case 'registerMoniteur':
                $render =   $this->registerMoniteurForm();
                break;
            case 'registerCours':
                $render =   $this->registerCoursForm();
                break;
            case 'action=registerPoney':
                $render =   $this->registerPoneyForm();
                break;
            case 'registerSeance':
                $render =   $this->registerSeanceForm();
                break;
            case 'registerUser':
                $render =  $this->registerUserForm();
                break;
            default:
                $render = "default";
                break;
            }
        return $render;
    }
}
?> 