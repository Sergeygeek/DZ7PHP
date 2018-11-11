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
    <h1>Здравствуйте {{USER}}</h1>
    <h2>Товары</h2>
    <div class="goods">
        {{GOODS}}
    </div>
    <a href="?page=cart">Корзина</a><br>
    <a href="?page=login&action=logout">Выход</a>
</body>
</html>