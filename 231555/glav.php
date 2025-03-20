<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="222/555.css">
    <title>Главная</title>
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
      
        <div class="main-content">
            <!-- Форма поиска -->
            <div class="search-container">
                <form method="GET" action="glav.php">
                    <input type="text" name="search" placeholder="Поиск по названию...">
                    <button type="submit">Поиск</button>
                </form>
            </div>

            <div class="films">
                <?php
                // Подключение к базе данных
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "root";

                // Создание подключения
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Проверка подключения
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Получение запроса поиска
                $search = isset($_GET['search']) ? $_GET['search'] : '';

                // Запрос на получение данных из таблицы films
                $sql = "SELECT photo, name FROM films";
                if (!empty($search)) {
                    $sql .= " WHERE name LIKE '%" . $conn->real_escape_string($search) . "%'";
                }
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Вывод данных каждой строки
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="film-item">';
                        echo '<a href="film_1.html">';
                        echo '<img src="' . $row["photo"] . '" alt="' . $row["name"] . '">';
                        echo '<p class="film-name">' . $row["name"] . '</p>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "Нет результатов";
                }

                // Закрытие подключения
                $conn->close();
                ?>
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
