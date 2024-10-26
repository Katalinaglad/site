<!DOCTYPE html>
<html lang="ru">

<head>
    <link type="image/x-icon" href="img/logo.svg" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="style4.css">
    <title>Академия Знаний</title>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Chicle&family=Jost:ital,wght@0,100..900;1,100..900&family=Raleway:wght@500&display=swap"
        rel="stylesheet">
    <script>
        function updateCourseCost(select) {
            const selectedOption = select.options[select.selectedIndex];
            document.getElementById('course_cost').value = selectedOption.dataset.cost;
        }
    </script>
</head>

<body>
    <div class='header'>
        <div class="nav">
            <a href="index.php" class="button">Главная</a>
            <a href="about-us.php" class="button">О школе</a>
            <a href="teachers.php" class="button">Предметы и преподаватели</a>
            <a href="price.php" class="button">Стоимость обучения</a>
            <a href="contacts.php" class="button">Контактная информация</a>
        </div>
    </div>

    <div class="pricing">
        <h1>Стоимость обучения</h1>
        <div class="courses-container">
            <div class="course">
                <h2>📚 Базовый курс</h2>
                <p>Цена: 20,000 ₽</p>
                <p>Описание: Базовый курс включает в себя изучение основных предметов и навыков, необходимых для успешного обучения.</p>
            </div>
            <div class="course">
                <h2>🎓 Продвинутый курс</h2>
                <p>Цена: 30,000 ₽</p>
                <p>Описание: Продвинутый курс предлагает углубленное изучение предметов и дополнительные занятия с преподавателями.</p>
            </div>
            <div class="course">
                <h2>🌟 Экспертный курс</h2>
                <p>Цена: 50,000 ₽</p>
                <p>Описание: Экспертный курс предназначен для тех, кто хочет получить глубокие знания и навыки в конкретных областях.</p>
            </div>
            <div class="course">
                <h2>📝 Подготовка к экзаменам</h2>
                <p>Цена: 25,000 ₽</p>
                <p>Описание: Курс подготовки к экзаменам включает в себя интенсивные занятия и тестирование.</p>
            </div>
            <div class="course">
                <h2>🤝 Индивидуальные занятия</h2>
                <p>Цена: 1,500 ₽ за час</p>
                <p>Описание: Индивидуальные занятия по запросу, позволяющие сосредоточиться на конкретных вопросах и темах.</p>
            </div>
        </div>

        <div class="calculator">
            <h2>Калькулятор стоимости</h2>
            <form method="POST">
                <label for="course">Выберите курс:</label>
                <select name="course" id="course" onchange="updateCourseCost(this)">
                    <option value="Базовый курс" data-cost="20000">Базовый курс - 20000 ₽</option>
                    <option value="Продвинутый курс" data-cost="30000">Продвинутый курс - 30000 ₽</option>
                    <option value="Экспертный курс" data-cost="50000">Экспертный курс - 50000 ₽</option>
                    <option value="Подготовка к экзаменам" data-cost="25000">Подготовка к экзаменам - 25000 ₽</option>
                    <option value="Индивидуальные занятия" data-cost="1500">Индивидуальные занятия - 1500 ₽ за час</option>
                </select>
                <input type="hidden" name="course_cost" id="course_cost" value="0">

                <label for="services">Дополнительные услуги:</label><br>
                <input type="checkbox" name="services[]" value="1500:Доп. кружки"> Доп. кружки - 1500 ₽<br>
                <input type="checkbox" name="services[]" value="2000:Ежемесячный медосмотр"> Ежемесячный медосмотр - 2000 ₽<br>
                <input type="checkbox" name="services[]" value="2500:Базовая физ.подготовка"> Базовая физ.подготовка - 2500 ₽<br>
                <input type="checkbox" name="services[]" value="1000:3-разовое питание"> 3-разовое питание - 1000 ₽<br>

                <label for="individual_hours">Количество часов индивидуальных занятий:</label>
                <input type="number" name="individual_hours" id="individual_hours" min="0" value="0">

                <button type="submit">РАССЧИТАТЬ</button>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $totalCost = 0;
                $selectedServices = $_POST['services'] ?? [];
                $individualHours = (int)$_POST['individual_hours'] ?? 0;
                $course = $_POST['course'] ?? '';
                $courseCost = (int)$_POST['course_cost'] ?? 0;

                $totalCost += $courseCost; 

                echo "<h3>Выбранные услуги:</h3><ul>";
                echo "<li>{$course} - {$courseCost} ₽</li>"; 

                foreach ($selectedServices as $service) {
                    list($cost, $name) = explode(":", $service);
                    $totalCost += (int)$cost; 
                    echo "<li>{$name} - {$cost} ₽</li>";
                }

                if ($individualHours > 0) {
                    $individualCost = $individualHours * 1500;
                    $totalCost += $individualCost; 
                    echo "<li>Индивидуальные занятия ({$individualHours} ч.) - {$individualCost} ₽</li>";
                }

                echo "</ul>";
                echo "<h3>Итоговая стоимость: " . $totalCost . " ₽</h3>";
            }
            ?>
        </div>
    </div>
</body>

</html>
