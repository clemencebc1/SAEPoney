<?php 
session_start();
require_once 'php/autoloader.php';
Autoloader::register();
use utils\UserTools;
UserTools::requireLogin();?>

<!DOCTYPE html>
<html lang="fr">
<?php include('global/head.php'); 
title_html('Niveau');?>
<body>
    <?php include('global/header_connected.php'); ?>
    <main>
      <h1>Non implémenté </h1>
    </main>
    <?php include('global/footer.php'); ?>
</body>
</html>
