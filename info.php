<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Системна інформація</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .info-box { background: #f4f4f4; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Системна інформація</h2>
    
    <div class="info-box">
        <p><strong>Операційна система сервера:</strong> <?php echo $_SERVER['SERVER_SOFTWARE']; ?></p>
        <p><strong>Ваша IP-адреса:</strong> <?php echo $_SERVER['REMOTE_ADDR']; ?></p>
        <p><strong>Ваш браузер (User Agent):</strong> <?php echo $_SERVER['HTTP_USER_AGENT']; ?></p>
        <p><strong>Версія PHP:</strong> <?php echo phpversion(); ?></p>
    </div>

    <h3>Повна інформація (phpinfo)</h3>
    <?php
    // Виводимо повну таблицю конфігурації
    phpinfo();
    ?>
</body>
</html>