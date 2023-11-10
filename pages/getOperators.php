<?php
foreach ($lines as $line) {
    $values = explode(";", $line);

    $info[$values[0]][$values[1]] = $values[2];
}
?>