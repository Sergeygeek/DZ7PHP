<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="goods">
        {{GOODS}}
    </div>
    <form method="post" action="?page=login&action=login">
        <label>Имя:</label><br>
        <input type="text" name="name"><br>
        <label>Логин:</label><br>
        <input type="text" name="login"><br>
        <label>Пароль:</label><br>
        <input type="password" name="password"><br>
        <input type="submit"><br>
    </form>
</body>
</html>