<!-- photo.php -->
<?php
$pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=photo_gallery', 'root');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Увеличение количества просмотров
    $stmt = $pdo->prepare("UPDATE photos SET views = views + 1 WHERE id = ?");
    $stmt->execute([$id]);

    // Получение информации о фотографии
    $stmt = $pdo->prepare("SELECT p.*, u.username FROM photos p JOIN users u ON p.user_id = u.id WHERE p.id = ?");
    $stmt->execute([$id]);
    $photo = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $photo['filename'] ?></title>
</head>
<body>
    <h1><?= $photo['filename'] ?></h1>
    <img src="uploads/<?= $photo['filename'] ?>" alt="Photo">
    <p>Добавил: <?= $photo['username'] ?></p>
    <p>Просмотры: <?= $photo['views'] ?></p>
    <a href="index.php">Назад к галерее</a>
</body>
</html>