<?php
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

// Подготовка и выполнение SQL-запроса
$sql = "INSERT INTO users (name, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $user_password);

if ($stmt->execute()) {
    header("Location: login.html");
    exit();
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

// Закрытие подключения
$stmt->close();
$conn->close();
?>
