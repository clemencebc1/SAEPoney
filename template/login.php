<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/includeHTML.js"></script>
    <title>Login</title>
</head>
<body>
    <header>
        <div include-html="./navbar.php"></div>
    </header>
    <main>
        <div>
            <h1>Login</h1>
            <form action="login.php" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <button type="submit">Login</button>
                </form>
            <?php
            if (isset($_GET['error'])) {
                $error_style = "<style>.error {color: red;}</style>";
                switch ($_GET['error']) {
                    case 1:
                        echo $error_style . '<p class="error">Invalid email or password</p>';
                        break;
                    case 2:
                        echo $error_style . '<p class="error">Login logic unimplemented</p>';
                        break;
                    default:
                        echo $error_style . '<p class="error">Unknown error </p>';
                        break;
                }
            }
            ?>
        </div>
    </main>
</body>
</html>

<?php
// require_once '../include/DBconnector.php'; // ==> connctor de la bd pour les requete sql

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $db = new DBconnector();
    // $status = $db->connectUser($email, $password);
    // if ($status) {
    //     // header('Location: index.php');
    //     echo 'Connected';
    //     header('Location: index.php');
    // } else {
    //     echo 'Error';
    //     header('Location: login.php?error=1');
    // }
    // $_GET['error'] = 2;
    header('Location: login.php?error=2');
}
?>