<div>
    <a href="../index.php"> На главную
    </a> 
</div>

<?php

$json = json_decode(file_get_contents("../keyWords.txt"), true);

$json["5"]["views"]++;

file_put_contents("../keyWords.txt", json_encode($json, JSON_PRETTY_PRINT));

$lines = file("../Text/5.txt");

$linesWithCorrectEncode = array_map(
    function($line) {
    return iconv('Windows-1251', 'UTF-8', $line);
    },
    $lines
);

foreach ($linesWithCorrectEncode as $line){
    ?> <div>
        <?php echo $line; ?>
        
    </div> 
<?php
}
?>
