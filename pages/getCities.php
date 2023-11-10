<?php

$operator = $_GET['operator'];

$lines = file("../var2.csv");
foreach ($lines as $line) {
    $values = explode(";", $line);

    if ($values[0] == $operator){
        echo '<option value="' . $values[1] . '">' . $values[1] . '</option>';
    }
}

?>