<?php
// Импорт файла с перечнем функций
require_once  ('functions.php');

// Формирования строки соединения с базой данных
$con = mysqli_connect('', '', '', '');

// Если подлючения нет, генерируется ошибка, иначе - устанавливается кодировка
if (!$con) {
    die ("Ошибка подключения: ".mysqli_connect_error());
}
else {
    mysqli_set_charset($con, "utf8");
}


