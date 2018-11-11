<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Здравствуйте {{USER}}</h1>
<a href="?page=index">Главная</a>
<h2>Корзина</h2>
    <ul>
        {{CART}}
    </ul>
<a href="?page=login&action=logout">Выход</a>
</body>
</html>