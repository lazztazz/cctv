<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "root";

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение данных из формы
$name = $_POST['name'];
$user_password = $_POST['password'];

// Подготовка и выполнение SQL-запроса для получения пользователя
$sql = "SELECT * FROM users WHERE name = ? AND password = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Ошибка подготовки запроса: " . $conn->error);
}

$stmt->bind_param("ss", $name, $user_password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['user'] = $row['name'];
    header("Location: profil.php");
    exit();
} else {
    echo "Неверное имя или пароль!";
}

// Закрытие подключения
$stmt->close();
$conn->close();
?>
