<!-- upload.php -->
<?php
$pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=photo_gallery', 'root');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ввод информации о пользователе
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    // Загрузка файла
    $filename = $_FILES['photo']['name'];
    $target = 'uploads/' . basename($filename);
    move_uploaded_file($_FILES['photo']['tmp_name'], $target);

    // Сохранение информации о пользователе
    $stmt = $pdo->prepare("INSERT INTO users (username, email) VALUES (?, ?)");
    $stmt->execute([$username, $email]);
    $userId = $pdo->lastInsertId();

    // Сохранение информации о фотографии
    $stmt = $pdo->prepare("INSERT INTO photos (filename, user_id) VALUES (?, ?)");
    $stmt->execute([$filename, $userId]);

    echo "Изображение загружено успешно!";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузить изображение</title>
</head>
<body>
    <a href="index.php" class="button gallery">Галерея</a>
	<a href="upload.php" class="button upload">Загрузка</a>
    <br />
	
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Имя пользователя" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="file" name="photo" accept="image/*" required>
        <button type="submit">Загрузить</button>
    </form>
</body>
</html>