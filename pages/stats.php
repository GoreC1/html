<?php
$lines = file("../NEWBASE.txt");

$oldest = date("Y/m/d");
$yongest = date("Y/m/d", strtotime("1800-01-01"));
$mailServers = array();
$phoneOldest = "";
$mailOldest = "";
$phoneYongest = "";
$mailYongest = "";

foreach ($lines as $line) {
    $line = explode(";", $line);
    $lineCount = count($line);

    if ($lineCount < 8) {
        continue;
    }

    $mail = $line[7];
    $mailServer = explode(".",explode("@", $mail)[1])[0];
    echo "$mailServer";

    if (!$mailServers[$mailServer]){
        $mailServers[$mailServer] = 1;
    }
    else{
        $mailServers[$mailServer]++;
    }

    if ($lineCount < 10) {
        continue;
    }

    $age = str_replace('.', '/', $line[9]);

    if ($age > $yongest) {
        $yongest = $age;
        $phoneYongest = $line[8];
        $mailYongest = $mail;
    }

    if ($age < $oldest){
        $oldest = $age;
        $phoneOldest = $line[8];
        $mailOldest = $mail;
    }

}
?>
<div>
   <?php echo "Oldest man/woman born in $oldest his/her phone $phoneOldest his/her email $mailOldest"; ?>
</div>
    
<div>
    <?php echo "Yongest man/woman born in $yongest his/her phone $phoneYongest his/her email $mailYongest";?>
</div>

<?php
foreach ($mailServers as $key => $value) {
    ?>
    <div>
        <?php
        if ($key == ""){
            continue;   
        }
        echo "$key uses $value people";
        ?>
    </div>
    <?php
}
?>