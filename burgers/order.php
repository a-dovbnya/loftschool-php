<?php
require "src/utils.php";
require "src/db.php";

/**
 * Данные формы
 */
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = getAddress($_POST['street'], $_POST['home'], $_POST['part'], $_POST['appt'], $_POST['floor']);
$payment = getPayment($_POST['payment']);
$comment = $_POST['comment'] ? $_POST['comment'] : '';
$callback = $_POST['callback'] ? 1 : 0;
$date = date('d.m.yy', time());

/**
 * Получаем/создаём пользователя с полученным email
 */
$user = getUserByEmail($email, $mysql);

if (!$user) {
    createUser($name, $email, $phone, $mysql);
    $user = getUserByEmail($email, $mysql);
}

/**
 * Добавляем заказ
 */
createOrder($user['id'], $address, $comment, $payment, $callback, $date, $mysql);

/**
 * Записываем заказ в файл
 */
$lastOrder = getLastOrder($user['id'], $mysql);
$totalOrders = getAllOrdersOfUser($user['id'], $mysql);
saveOrderToFile($lastOrder, $totalOrders);

?>

<!doctype html>
<html>
    <head>
        <style>
            .wrapper {
                font-family: Arial, sans-serif;
                width: 800px;
                min-height: 200px;
                border: 1px solid #c1c1c1;
                padding: 30px;
                margin: 100px auto;
            }
            .title {
                text-align: center;
            }
            .info {
                font-size: 16px;
                margin-top: 30px;
                text-align: center;
            }
        </style>
        <title>Спасибо за заказ</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="box">
                <h3 class="title">Спасибо! Ваш заказ принят</h3>
                <div class="info">Это ваш <?= sizeof($totalOrders) ?> заказ!</div>
                <div class="info">Вы будете перенаправлены на главную страницу через <span id="time">4</span> секунды</div>
            </div>
        </div>
        <script>

            let time = 3;
            const timeNode = document.getElementById('time')

            timeNode.innerHTML = time;

            const timer = setInterval(function(){
                if (time > 0) {
                    timeNode.innerHTML = time;
                    time = time - 1;
                } else {
                    clearInterval(timer);
                    location.href = '/burgers';
                }
            }, 1000);
        </script>
    </body>
</html>