<?php
// Fichier où les tâches sont stockées
$dataFile = "tasks.json";

// Si le fichier n'existe pas → on en crée un
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([]));
}

// Charger les tâches
$tasks = json_decode(file_get_contents($dataFile), true);

// Ajouter une tâche
if (isset($_POST["new_task"]) && !empty($_POST["new_task"])) {
    $tasks[] = ["text" => $_POST["new_task"], "checked" => false];
    file_put_contents($dataFile, json_encode($tasks));
    header("Location: index.php");
    exit;
}

// Cocher / décocher une tâche
if (isset($_GET["toggle"])) {
    $i = intval($_GET["toggle"]);
    $tasks[$i]["checked"] = !$tasks[$i]["checked"];
    file_put_contents($dataFile, json_encode($tasks));
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>To-Do Liste Publique</title>
</head>
<body>

<h2>To-Do liste publique</h2>

<form method="POST">
    <input type="text" name="new_task" placeholder="Nouvelle tâche..." required>
    <button type="submit">Ajouter</button>
</form>

<ul>
<?php foreach ($tasks as $i => $task): ?>
    <li>
        <a href="?toggle=<?=$i?>">
            <input type="checkbox" <?=$task["checked"] ? "checked" : ""?>>
            <?=htmlspecialchars($task["text"])?>
        </a>
    </li>
<?php endforeach; ?>
</ul>

</body>
</html>
