<?php
namespace components;
class ActionForm {
    private string $type;

    public function __construct(string $type) {
        $this->type = $type;
    }

    private function personneBlock(): string {
        return '
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" required>
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" required>
        <label for="mail">Mail</label>
        <input type="email" id="mail" name="mail" required> 
        <label for="date_naissance">Date de naissance</label>
        <input type="date" id="date_naissance" name="date_naissance" required>
        <label for="poids">Poids</label>
        <input type="number" id="poids" name="poids" required>
        <label for="adresse">Adresse</label>
        <input type="text" id="adresse" name="adresse" required>
        <label for="tel">Téléphone</label>
        <input type="tel" id="tel" name="tel" required>      
        ';
    }

    private function registerAdherentForm(): string {
        return '
        <form action="administrator_control_pannel.php?action=registerAdherent&submit=true" method="post">'
         . $this->personneBlock() . '
        <label for="fincotisation">Fin de cotisation</label>
        <input type="date" id="fincotisation" name="fincotisation" required>
        <label for="niveau">Niveau</label>
        <select name="niveau" id="niveau">
            <option value="1">Débutant (1)</option>
            <option value="2">Intermédiaire (2)</option>
        </select>
        <input type="submit" value="inscrire">
        </form>';
    }

    private function registerMoniteurForm(): string {
        return '<form action="administrator_control_pannel.php?action=registerMoniteur&submit=true" method="post">
        ' . $this->personneBlock() . '
        <label for="typecontrat">Type de contrat</label>
        <select name="typecontrat" id="typecontrat">
            <option value="CDI">CDI</option>
            <option value="CDD">CDD</option>
            <option value="INTERIM">Interim</option>
        </select>
        <label for="dateembauche">Date d\'embauche</label>
        <input type="date" id="dateembauche" name="dateembauche" required>
        <input type="submit" value="inscrire">
        </form>';
    }

    private function registerCoursForm(): string {return '';}

    private function registerPoney(): string {return '';}

    private function registerSeanceForm(): string {return '';}

    private function registerUserForm(): string {
        return '<form action="administrator_control_pannel.php?action=registerUser&submit=true" method="post">
        <label for="email">email de la personne</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Mot de passe temporaire</label>
        <input type="password" id="password" name="password" required>
        <label for="confirmPassword">Confirmer le mot de passe</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>
        <label for="role">Role</label>
        <select name="role" id="role">
            <option value="ADHERENT">Adherent</option>
            <option value="MONITEUR">Moniteur</option>
            <option value="ADMIN">Admin</option>
        </select>
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
                $render =   $this->registerPoney();
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