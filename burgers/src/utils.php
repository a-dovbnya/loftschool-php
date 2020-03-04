<?php

function getAddress($street, $home, $part, $appt, $floor)
{
    $address = "";

    if($street) {
        $address .= "Улица $street";
    }
    if($home) {
        $address .= ", дом № $home";
    }
    if($part) {
        $address .= ", корпус $part";
    }
    if($appt) {
        $address .= ", квартира $appt";
    }
    if($floor) {
        $address .= ", этаж $floor";
    }

    return $address;
}

function getPayment ($payment) {
    if ($payment == 1) {
        $payment = 'Потребуется сдача';
    } else if ($payment == 2) {
        $payment = 'Оплата по карте';
    } else {
        $payment = '';
    }
    return $payment;
}

function saveOrderToFile($order, $total) {

    $id = $order['id'];
    $path = "orders/".$id.".txt";
    $text = "Номер Заказа: $id; \n";
    $text .= "Ваш заказ будет доставлен по адресу: ". $order['address'] .";\n";
    $text .= "Состав заказа: DarkBeefBurger за 500 рублей, 1 шт;\n";

    if ($order['comment']) {
        $text .= "Комментарий: ". $order['comment'] .";\n";
    }

    $text .= "Спасибо, это ваш ". sizeof($total) ." заказ!";

    file_put_contents($path, $text);
}