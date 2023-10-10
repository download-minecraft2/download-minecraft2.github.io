<?php
// Имя файла SQL
$sqlFileName = 'money.sql';

// Получаем IP пользователя и значение из аргументов PHP
$user_ip = $_SERVER['REMOTE_ADDR'];
$arg_value = $_GET['аргументы'];

// Чтение содержимого SQL-файла
$sqlContent = file_get_contents($sqlFileName);

// Проверка на существование таблицы, и если она не существует, создаем её
if (strpos($sqlContent, 'CREATE TABLE IF NOT EXISTS ваша_таблица') === false) {
    $sqlContent .= "\nCREATE TABLE IF NOT EXISTS ваша_таблица (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ip VARCHAR(255),
        значение VARCHAR(255)
    );";
}

// Меняем содержимое SQL-файла, добавляя данные
$newSqlContent = $sqlContent . "\nINSERT INTO money (ip, значение) VALUES ('$user_ip', '$arg_value');";

// Записываем обновленное содержимое обратно в файл
file_put_contents($sqlFileName, $newSqlContent);

echo "Данные успешно добавлены в SQL-файл.";
?>
