<?php
// Fix sessions OVH
ini_set('session.save_path', __DIR__ . '/sessions');
if (!is_dir(__DIR__ . '/sessions')) mkdir(__DIR__ . '/sessions');
session_start();

if (!($_SESSION['logged'] ?? false)) {
    header('Location: admin.php');
    exit;
}

$path = __DIR__ . '/data/gifts.json';
$gifts = json_decode(file_get_contents($path), true);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link rel="stylesheet" href="assets/css/admin.css">
<script defer src="assets/js/admin.js"></script>
</head>
<body>
<h1>🎁 Gestion de la liste</h1>

<form id="addForm">
<input name="name" placeholder="Nom du cadeau" required><br>
<textarea name="description" placeholder="Description"></textarea><br>
<input name="url" placeholder="Lien"><br>
<button type="submit">Ajouter</button>
</form>

<h2>Cadeaux existants</h2>
<ul id="giftList">
<?php foreach ($gifts as $i => $g): ?>
<li>
<?= htmlspecialchars($g['name']) ?>
<button class="delete-btn" data-id="<?= $i ?>">Supprimer</button>
</li>
<?php endforeach; ?>
</ul>

</body>
</html>
