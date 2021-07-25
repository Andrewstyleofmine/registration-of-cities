<?php

// Функция для генерации подготовленного выражения для sql запроса
function db_get_prepare_stmt($link, $sql, $data = []): mysqli_stmt
{
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
        die($errorMsg);
    }
    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            } else if (is_string($value)) {
                $type = 's';
            } else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);

        if (mysqli_errno($link) > 0) {
            $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
            die($errorMsg);
        }
    }

    return $stmt;
}

// Функция для подключения html шаблонов
function renderTemplate($path, $date = [])
{
    $path = "../templates/{$path}";
    $resultHTML = "";
    if (!file_exists($path)) {
        return $resultHTML;
    }
    ob_start();
    extract($date);
    require_once($path);
    return ob_get_clean();
}

// Функция для выполнения sql запроса
function make_query($con, $sql, $query_data = []): array
{
    $result = [];
    $stmt = db_get_prepare_stmt($con, $sql, $query_data);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);
    if ($data) {
        $result = mysqli_fetch_all($data, MYSQLI_ASSOC);
    }
    return $result;
}

// Функция для валидации полей
function validate($con, $fields): array
{
    $errors = [];

    foreach ($fields as $key => $value) {
        if (!$value) {
            $errors[$key] = "Заполните это поле";
        } elseif (preg_match('/\<(.*?)\>/', $value)) {
            $errors[$key] = "Введены некорректные символы (ввод конструкций тэгов запрщён)";
        } elseif (!ctype_digit($value) && ($key == "year_of_foundation" || $key == "population")) {
            $errors[$key] = "Введи число больше 0";
        } elseif ($key == "title" && count(get_city($con, $value)) != 0) {
            $errors[$key] = "Такой город уже существует";
        }
    }
    return $errors;
}

// Функция для добавления города
function add_city($con, $fields)
{
    $add_city_sql = "INSERT INTO cities (title, country, region, year_of_foundation, population) VALUES (?, ?, ?, ?, ?)";
    make_query($con, $add_city_sql, [
            $fields["title"],
            $fields["country"],
            $fields["region"],
            $fields["year_of_foundation"],
            $fields["population"],]
    );
}

// Функция для получения списка городов
function get_cities($con): array
{
    $get_cities_sql = "SELECT * FROM cities";
    return make_query($con, $get_cities_sql);
}

// Функция для получения города по названию
function get_city($con, $title): array
{
    $get_cities_sql = "SELECT title FROM cities WHERE title = ?";
    return make_query($con, $get_cities_sql, [$title]);
}

