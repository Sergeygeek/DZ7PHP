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
<h1>Товары</h1>
    <div class="goods">
        {{GOODS}}
    </div>
<form method="post" action="?page=adminPanel&action=addGood">
    <label>Название:</label><br>
    <input type="text" name="title"><br>
    <label>Описание:</label><br>
    <textarea name="desc" id="" cols="30" rows="10"></textarea><br>
    <label>Цена:</label><br>
    <input type="number" name="price"><br>
    <input type="submit" value="Добавить товар"><br>
    <a href="?page=login&action=logout">Выход</a>
</form>
</body>
</html>