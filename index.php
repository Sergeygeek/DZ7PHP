<?php
    session_start();
    $link = mysqli_connect('localhost', 'root', '', 'galleryTest') or die(mysqli_error($link));

    $page = empty($_GET['page']) ? 'login' : $_GET['page'];
    $action = empty($_GET['action']) ? 'index' : $_GET['action'];
    $content = '';

    include('model.php');

    if ($page == 'login' && $action == 'index'){
        $goods = getGoods($link);
        $content .= file_get_contents($page . '.tpl');
        $content = str_replace('{{GOODS}}', $goods, $content);
    }

    if ($page == 'login' &&  $action == 'login') {
        $user = $action($link);
        if ($user == 'admin') {
            $page = 'adminPanel';
            $goods = getGoods($link);
            $content .= file_get_contents($page . '.tpl');
            $content = str_replace('{{GOODS}}', $goods, $content);
        }
        if ($user == 'user') {
            $page = 'index';
            $user = getUser();
            $goods = getGoods($link);
            $content .= file_get_contents($page . '.tpl');
            $content = str_replace('{{GOODS}}', $goods, $content);
            $content = str_replace('{{USER}}', $user, $content);
            echo $content;
            exit;
        }
    }

    if($_GET['action'] == 'addGood'){
        $action($link);
        $goods = getGoods($link);
        $content .= file_get_contents($page . '.tpl');
        $content = str_replace('{{GOODS}}', $goods, $content);
    }

    if($_GET['page'] == 'index'){
        $user = getUser($link);
        $goods = getGoods($link);
        $content .= file_get_contents($page . '.tpl');
        $content = str_replace('{{GOODS}}', $goods, $content);
        $content = str_replace('{{USER}}', $user, $content);
        if($_GET['action'] == 'addToCart'){
            $action($link);
        }
    }

    if($_GET['page'] == 'cart'){
        if($_GET['action']){
            $action($link);
        }
        $user = getUser($link);
        $cart = getCart($link);
        $content .= file_get_contents($page . '.tpl');
        $content = str_replace('{{CART}}', $cart, $content);
        $content = str_replace('{{USER}}', $user, $content);
    }

    if($_GET['action'] == 'logout'){
        $action($link);
    }


    echo $content;