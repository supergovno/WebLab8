<!-- index.php -->
<?php
$pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=photo_gallery', 'root');

$query = $pdo->query("SELECT p.*, u.username FROM photos p JOIN users u ON p.user_id = u.id ORDER BY p.views DESC");
$photos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Галерея</title>
    <style>
        img {
            width: 150px;
            height: auto;
            margin: 10px;
        }
    </style>
</head>
<body>
    <a href="index.php" class="button gallery">Галерея</a>
	<a href="upload.php" class="button upload">Загрузка</a>
    <br />
	
    <?php foreach ($photos as $photo): ?>
        <a href="photo.php?id=<?= $photo['id'] ?>">
            <img src="uploads/<?= $photo['filename'] ?>" alt="Photo">
        </a>
    <?php endforeach; ?>
</body>
</html>