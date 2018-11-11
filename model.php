<?php
    function login($link){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['name']) || empty($_POST['password'] || empty($_POST['login']))) {
                header('Location: /');
                exit;
            }
            $login = $_POST['login'];
            $sql = "SELECT id, name, login, password, isAdmin FROM users WHERE login = '$login'";
            $res = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($res);
            $password = md5($_POST['password']);
            if ($password === $row['password'] && $login === $row['login']){
                if ($row['isAdmin']) {
                    $_SESSION = [
                        'user_id' => $row['id'],
                        'isAdmin' => true,
                        'name' => $row['name'],
                        'login' => $row['login'],
                    ];
                    return 'admin';
                } else {
                    $_SESSION = [
                        'user_id' => $row['id'],
                        'isAdmin' => false,
                        'name' => $row['name'],
                        'login' => $row['login'],
                    ];
                    return 'user';
                }
            }
            return NULL;
        }
    }

    function addGood ($link){
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $price = (int)$_POST['price'];
        $sql = "INSERT INTO goods (title, description, price) VALUES ('$title', '$desc', $price)";
        return mysqli_query($link, $sql) ? 'Товар добавлен' : 'Что-то пошло не так';
    }

    function getGoods ($link){
        $goods = '';
        $sql = "SELECT id, title, description, price FROM goods";
        $res = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($res)){
            $goods .=<<<php
            <div class="good">
                <img src="http://place-hold.it/150" alt=""><br>
                <p><a href="">{$row['title']}</a></p>
                <p>Цена: {$row['price']} руб.</p>
                <a href="?page=index&action=addToCart&goodId={$row['id']}&userId={$_SESSION['user_id']}">Добавить в корзину</a>
            </div>        
php;
        }
        return $goods;
    }

    function getUser(){
        return $user = <<<php
            $_SESSION[name]      
php;
    }

    function addToCart($link){
        $goodId = $_GET['goodId'];
        $userId = $_GET['userId'];
        $sql = "SELECT id, good_id, user_id FROM cart";
        $res = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($res)){
            if(($row['good_id'] == $goodId) && ($row['user_id'] == $userId)){
                $sql = "UPDATE cart SET count = count + 1 WHERE id = " . $row['id'];
                mysqli_query($link, $sql);
                return;
            }
        }
        if(($row['good_id'] != $goodId) && ($row['user_id'] != $userId)){
            $count = 1;
            $sql = "INSERT INTO cart (good_id, user_id, count) VALUES ('$goodId', '$userId', $count)";
            mysqli_query($link, $sql);
        }

    }

    function delFromCart($link){
        $id = $_GET['id'];
        $sql = "SELECT id, count FROM cart";
        $res = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($res)){
            if($row['count'] == 1){
                $sql = "DELETE FROM cart WHERE id = " . $id;
                mysqli_query($link, $sql);
            } else {
                $sql = "UPDATE cart SET count = count - 1 WHERE id = " . $id;
                mysqli_query($link, $sql);
                return;
            }
        }
    }

    function logout($link){
        session_destroy();
        header('Location: /');
        exit;
    }

    function getCart($link){
        $cart = '';
        $sql = "SELECT cart.id, title, price, good_id, `count`, price * `count` as total_price 
                FROM cart INNER JOIN goods ON cart.good_id = goods.id 
                WHERE user_id = " . $_SESSION['user_id'];
        $res = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($res)){
            $cart .=<<<php
            <li>
                <a href="">{$row['title']} </a>
                <span>Цена: {$row['price']} </span>
                <span>Количество: {$row['count']} </span>
                <a href="?page=cart&action=addToCart&goodId={$row['good_id']}&userId={$_SESSION['user_id']}"> Ещё </a>
                <a href="?page=cart&action=delFromCart&id={$row['id']}&userId={$_SESSION['user_id']}"> Удалить </a>
            </li>
php;
        }
        $sql = "SELECT sum(price * `count`) as total_price 
                FROM cart INNER JOIN goods ON cart.good_id = goods.id 
                WHERE user_id = " . $_SESSION['user_id'];
        $res = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($res);
        $totalPrice = $row['total_price'];
        $cart .= "<li>Общая стоимость: $totalPrice</li>";
        return $cart;
    }