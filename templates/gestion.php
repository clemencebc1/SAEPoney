<?php
session_start();
require_once 'php/autoloader.php';
Autoloader::register();
use utils\UserTools;
UserTools::requireLogin();
require('php/utils/constantes.php');
?>
<!DOCTYPE html>
<html lang="fr">
<?php include('global/head.php'); 
title_html('Gestion');
link_to_css('static/admin/gestion.css');?>
<body>
    <?php include('global/header_connected.php'); ?>
    <main>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $cours = $connexion->get_cours();
        foreach ($cours as $cour): ?>
            <tr>
                <td><?php echo htmlspecialchars($cour['NUMCOURS']); ?></td>
                <td><?php echo htmlspecialchars($cour['NOMCOURS']); ?></td>
                <td><?php echo htmlspecialchars($cour['TYPEC']); ?></td>
                <td>
                    <a href="">Modifier</a>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $cour['NUMCOURS']; ?>">
                        <input type="submit" value="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?');">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</main>
<?php include('global/footer.php'); ?>
</body>
</html>
