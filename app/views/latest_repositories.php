<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Последние 10 обновлений репозиториев Github</title>
</head>
<body>
<h1>Последние 10 обновлений репозиториев Github</h1>
<ul>
    <?php foreach ($repos as $repo): ?>
        <li>
            <?= htmlspecialchars($repo['github_username']) ?> /
            <?= htmlspecialchars($repo['name']) ?>
            (обновлен: <?= $repo['updated_at'] ?>)
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>