<?php
// Импорт инициалихирующего файла
require_once('../init.php');

// Инициализация массива ошибок и получение списка городов
$errors = [];
$cities = get_cities($con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Валидация полей
    $errors = validate($con, $_POST);

    // Если ошибок нет, добавить город и осуществить переадресацию
    if (count($errors) == 0) {
        add_city($con, $_POST);
        header("location: /");
    }
}

// Подключение шаблонов
$citiesList = renderTemplate('cities.php', [
    'cities' => $cities,
    'errors' => $errors
]);

$indexContent = renderTemplate('layout.php', [
    "content" => $citiesList,
]);

print($indexContent);


