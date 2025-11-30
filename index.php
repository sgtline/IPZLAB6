<?php
// Налаштування підключення до БД
$host = 'localhost';
$user = 'root';
$pass = ''; // За замовчуванням в XAMPP пароль порожній
$db_name = 'university_lab';

$conn = new mysqli($host, $user, $pass, $db_name);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}

// Обробка форми (якщо натиснули кнопку "Додати")
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $f_name = $conn->real_escape_string($_POST['first_name']);
    $l_name = $conn->real_escape_string($_POST['last_name']);
    $group = $conn->real_escape_string($_POST['group']);
    $hobby = $conn->real_escape_string($_POST['hobby']);
    $langs = $conn->real_escape_string($_POST['programming_languages']);

    $sql = "INSERT INTO students (first_name, last_name, group_name, hobby, programming_languages) 
            VALUES ('$f_name', '$l_name', '$group', '$hobby', '$langs')";

    if ($conn->query($sql) === TRUE) {
        echo "<div style='color:green; padding:10px;'>Студента успішно додано!</div>";
    } else {
        echo "Помилка: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>База студентів</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 30px; background: #fafafa; padding: 20px; border: 1px solid #ddd; }
        input { margin-bottom: 10px; display: block; width: 300px; padding: 5px; }
    </style>
</head>
<body>

<h1>Реєстрація студентів</h1>

<form method="post" action="">
    <label>Ім'я:</label>
    <input type="text" name="first_name" required>
    
    <label>Прізвище:</label>
    <input type="text" name="last_name" required>
    
    <label>Група:</label>
    <input type="text" name="group" required>
    
    <label>Хобі:</label>
    <input type="text" name="hobby">
    
    <label>Мови програмування:</label>
    <input type="text" name="programming_languages" placeholder="PHP, C++, Python...">
    
    <button type="submit">Додати студента</button>
</form>

<hr>

<h2>Список студентів</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Ім'я</th>
        <th>Прізвище</th>
        <th>Група</th>
        <th>Хобі</th>
        <th>Мови програмування</th>
    </tr>
    <?php
    // Вибірка даних з БД
    $sql_select = "SELECT * FROM students";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["student_id"] . "</td>
                    <td>" . $row["first_name"] . "</td>
                    <td>" . $row["last_name"] . "</td>
                    <td>" . $row["group_name"] . "</td>
                    <td>" . $row["hobby"] . "</td>
                    <td>" . $row["programming_languages"] . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Поки що немає записів</td></tr>";
    }
    $conn->close();
    ?>
</table>

</body>
</html>