<?php
session_start();

// Проверка, что пользователь авторизован
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

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

// Получение данных пользователя
$user_name = $_SESSION['user'];
$sql = "SELECT * FROM users WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Ошибка: пользователь не найден!";
    exit();
}

// Закрытие подключения
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="231.css">
    <title>Профиль</title>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="header-line">
                <a class="header-logo" href="glav.php">
                    <img src="photo/logo 1.png" alt="">
                </a>
                <div class="nav">
                    <a class="nav-item" href="pokypka.html"><img src="photo/kypit.png" alt=""></a>
                    <a class="nav-item" href="profil.php"><img src="photo/profil.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="left_all">
            <div class="left">
                Жанры
            </div>
            <div class="left_content">
                <p>*Боевик</p>
                <p>*Детектив</p>
                <p>*Триллер</p>
                <p>*Комедия</p>
                <p>*Роман</p>
                <p>*Исторический</p>
                <p>*Драма</p>
                <p>*Приключения</p>
                <p>*Ужасы</p>
            </div>          
        </div>
        <div class="right_all"> 
            <div class="right">
                Рекомендуем
            </div>
            <div class="right_content">
                <p>Ушедший Род. книга 6. Вагант</p>
                <p>Жанр: боевая фантастика,фэнтези</p>
                <p>Цикл: Ушедший Род #6</p>
                <p>Писатель: Листратов Валерий</p>
            </div>
        </div>
        <div class="avatar">
            <!-- Здесь можно добавить отображение аватара пользователя -->
        </div>
        <div class="nick">
            <?php echo htmlspecialchars($user['name']); ?>
        </div>
        <div class="text_nedavno">
            Недавно просмотрено:
        </div>
        <div class="nedavno">
            <a href="film_1.html">
                <div class="nedavno_films_1"></div>
            </a>
            <a href="film_2.html">
                <div class="nedavno_films_2"></div>
            </a>
            <a href="film_3.html">
                <div class="nedavno_films_3"></div>
            </a>
            <a href="film_4.html">
                <div class="nedavno_films_4"></div>
            </a>
        </div>
        <div class="categorii">
            <div class="categorii_1"></div>
            <div class="categorii_2"></div>
            <div class="categorii_3"></div>
            <div class="categorii_4"></div>
            <div class="categorii_5"></div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-line">
            <div class="footer-nav">
                <a class="nav-item-f" href="https://vk.com/tropi4eskiy"><img src="photo/teh.pod.jpg" alt=""></a>
                <a class="nav-item-footer" href="https://vk.com/tropi4eskiy"></a>
            </div>
        </div>
    </div>
</body>
</html>
