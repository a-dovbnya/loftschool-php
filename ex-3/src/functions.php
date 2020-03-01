<?php

function task1()
{
    $fileData = file_get_contents('data.xml');
    $xml = new SimpleXMLElement($fileData);

    echo "
        <div style='font-weight: bold; margin: 20px 0;'>
            <div>OrderNumber: ".$xml->attributes()->PurchaseOrderNumber ."</div>
            <div>OrderDate: ".$xml->attributes()->OrderDate ."</div>
        </div>
    ";

    // Address
    echo "
        <table cellpadding='10' style='border: 1px solid black; border-collapse: collapse;'>
            <tr>
                <td><b>Name</b></td>
                <td><b>Street</b></td>
                <td><b>City</b></td>
                <td><b>State</b></td>
                <td><b>Zip</b></td>
                <td><b>Country</b></td>
                <td><b>Type</b></td>
            </tr>
    ";
    foreach($xml->Address as $address) {
        echo "
            <tr>
                <td>". $address->Name->__toString() ."</td>
                <td>". $address->Street->__toString() ."</td>
                <td>". $address->City->__toString() ."</td>
                <td>". $address->State->__toString() ."</td>
                <td>". $address->Zip->__toString() ."</td>
                <td>". $address->Country->__toString() ."</td>
                <td>". $address->attributes()->Type ."</td>
            </tr>
        ";
    }
    echo "</table>";

    // Items
    echo "
        <table cellpadding='10' style='border: 1px solid black; border-collapse: collapse; margin-top: 20px;'>
            <tr>
                <td><b>PartNumber</b></td>
                <td><b>ProductName</b></td>
                <td><b>Quantity</b></td>
                <td><b>USPrice</b></td>
                <td><b>Comment</b></td>
                <td><b>ShipDate</b></td>
            </tr>
    ";
    foreach($xml->Items->Item as $item) {
        echo "
            <tr>
                <td>". $item->attributes()->PartNumber ."</td>
                <td>". $item->ProductName->__toString() ."</td>
                <td>". $item->Quantity->__toString() ."</td>
                <td>". $item->USPrice->__toString() ."</td>
                <td>". $item->Comment->__toString() ."</td>
                <td>". $item->ShipDate->__toString() ."</td>
            </tr>
        ";
    }
    echo "</table>";

    // Notes
    foreach($xml->DeliveryNotes as $note) {
        echo "
            <p>".$note->__toString()."</p>
        ";
    }
}

function task2()
{
    $arr = [
        'user' => [
            'firstName' => 'Иван',
            'lastName' => 'Иванов',
            'age' => 25,
            'sex' => 'male'
        ],
        'order' => [
            'id' => '39CXV56',
            'date' => '28.02.2020 00:00:00',
            'products' => [
                'name' => 'DOBBY Selfie Drone',
                'art' => 'DB16-100B',
                'group' => 'Квадрокоптеры',
                'price' => 500,
                'currency' => 'USD'
            ]
        ]
    ];

    file_put_contents('output.json', json_encode($arr, JSON_UNESCAPED_UNICODE));

    $file = json_decode(file_get_contents('output.json'), true);

    if ($file && rand(0, 1)) {
        $file['user']['firstName'] = 'Николай';
        $file['user']['lastName'] = 'Николаев';
        $file['user']['age'] = 38;
    }

    file_put_contents('output2.json', json_encode($file, JSON_UNESCAPED_UNICODE));

    $output1 = json_decode(file_get_contents('output.json'), true);
    $output2 = json_decode(file_get_contents('output2.json'), true);

    // output diff
    diff_array($output1, $output2);
}

function diff_array($arr1, $arr2)
{
    forEach($arr1 as $key => $value) {
        if (is_array($arr1[$key]) && is_array($arr2[$key])) {
            diff_array($arr1[$key], $arr2[$key]);
            continue;
        }
        if($arr1[$key] !== $arr2[$key]) {
            echo $arr1[$key] . " !== " .$arr2[$key] ."<br/>";
        }
    }
}

function task3()
{
    $arr = [];

    for ($i = 0; $i < 50; $i++) {
        $arr[] = rand(1, 100);
    }

    $file = fopen('numbers.csv', 'w');
    fputcsv($file, $arr, ';');
    fclose($file);

    // Open file
    $numbers = fopen('numbers.csv', 'r');
    $sum = 0;

    while ($num = fgetcsv($numbers, 1000, ';')) {
        foreach($num as $val) {
            if ($val % 2 === 0) {
                $sum += $val;
            }
        }
    }
    fclose($numbers);

    echo "Сумма четных чисел = $sum";
}

function task4()
{
    $res = file_get_contents("https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json");
    $res = json_decode($res, true, 512, JSON_HEX_TAG);

    echo "title = ". findField($res, 'title') ."<br/>";
    echo "pageid = ". findField($res, 'pageid') ."<br/>";
}

function findField ($arr, $field)
{
    foreach($arr as $key => $value) {
        if($key === $field) {
            return $arr[$key];
        }
        if(is_array($arr[$key])) {
            $res = findField($arr[$key], $field);
            if($res) {
                return $res;
            }
        }
    }
    return false;
}