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
