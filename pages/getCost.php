<?php
$operator = $_GET['operator'];
$city = $_GET['city'];
$time = $_GET['time'];

$lines = file("../var2.csv");
foreach ($lines as $line) {
    $values = explode(";", $line);

    if ($values[0] == $operator & $values[1] == $city){
        $cost = $values[2] * $time;
        echo $cost;
    }
}
?>