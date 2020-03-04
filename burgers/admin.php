<?php
require "src/db.php";

    $users = getAllUsers($mysql);
    $orders = getAllOrders($mysql);
?>

<!doctype html>
<html>
    <head>
        <style>
            .wrapper {
                font-family: Arial, sans-serif;
                width: 900px;
                min-height: 200px;
                padding: 20px;
                margin: 50px auto;
            }
            .box + .box {
                margin-top: 40px;
            }
            .title {
                text-align: center;
            }
            .info {
                font-size: 16px;
                margin-top: 30px;
                text-align: center;
            }

            table {
                border-collapse: collapse;
                margin: 0 auto;
            }

            td, th {
                padding: 5px 15px;
                border: 1px solid black;
            }
        </style>
        <title>Спасибо за заказ</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="box">
                <h3 class="title">Пользователи</h3>

                <table>
                    <tr>
                        <th>id</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Телефон</th>
                    </tr>
                    <?php
                        foreach($users as $user) {
                            echo "<tr>";
                                foreach($user as $value) {
                                    echo "<td>". $value ."</td>";
                                }
                            echo "<tr>";
                        }
                    ?>
                </table>
            </div>

            <div class="box">
                <h3 class="title">Заказы</h3>
                <table>
                    <tr>
                        <th>id</th>
                        <th>user_id</th>
                        <th>Адрес</th>
                        <th>Комментарий</th>
                        <th>Оплата</th>
                        <th>Не перезванивать</th>
                        <th>Дата</th>
                    </tr>
                    <?php
                        foreach($orders as $order) {
                            echo "<tr>";
                                foreach($order as $value) {
                                    echo "<td>". $value ."</td>";
                                }
                            echo "<tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>