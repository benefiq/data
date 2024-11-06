<?php
$daysArray = [];
$errorMessage = '';

If ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];

    $startDate = new DateTime($date1);
    $endDate = new DateTime($date2);

    If ($endDate < $startDate) {
        $errorMessage = 'Дата 2 не может быть раньше даты 1.';
    } elseif ($endDate->diff($startDate)->days < 15) {
        $errorMessage = 'Количество дней между датами должно быть не менее 15.';
    } else {
        For ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
            $daysArray[] = $date->format('Y-m-d');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Выбор дат</title>
</head>
<body>
    <h1>Выбор двух дат</h1>
    <form method="post">
        <label for="date1">Дата 1:</label>
        <input type="date" id="date1" name="date1" required>
        <br>
        <label for="date2">Дата 2:</label>
        <input type="date" id="date2" name="date2" required>
        <br>
        <input type="submit" value="Показать дни">
    </form>

    <?php if ($errorMessage): ?>
        <p style="color: red;"><?= htmlspecialchars($errorMessage) ?></p>
    <?php elseif (!empty($daysArray)): ?>
        <h2>Массив дней:</h2>
        <pre><?php print_r($daysArray); ?></pre>
    <?php endif; ?>
</body>
</html>