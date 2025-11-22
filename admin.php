<?php
session_start();
$admin = json_decode(file_get_contents(__DIR__ . '/data/admin.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['password'] === $admin['password']) {
        $_SESSION['logged'] = true;
        header('Location: dashboard.php');
        exit;
    }
    $error = "Mot de passe incorrect";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Admin</title>
<link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
<h1>🎅 Connexion Admin</h1>
<form method="post">
<input type="password" name="password" placeholder="Mot de passe" required><br>
<button>Connexion</button>
</form>
<p><?= $error ?? '' ?></p>
</body>
</html>
