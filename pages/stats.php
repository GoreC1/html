<?php

$fileContent = file_get_contents('/var/www/html/stats.txt');
$counters = json_decode($fileContent, true);

$CTR = [];
$CTI = [];
$CTB = [];

for ($i = 1; $i <= 5; $i++) {
  $CTR[$i] = round($counters["Page$i"]["FromBannerVisitorsCount"] / $counters["Page$i"]["BannerSeenCount"], 2) * 100;
  $CTI[$i] = round($counters["Page$i"]["FromBannerVisitorsCount"]/ ($counters["Page$i"]["AllVisitorsCount"] ?? 0), 3);
  $CTB[$i] = round($counters["Page$i"]["SumbitVisitorsCount"] / $counters["Page$i"]["AllVisitorsCount"], 3);
}
?>

<link rel='stylesheet' href='styles.css'>
<div class="links">
  <a href="./random.php">Рандомные баннера</a>
</div>

<?php for ($i = 1; $i <= 5; $i++) { ?>
  <div> CTR <?php echo $i ?>: <?php echo $CTR[$i] ?>%</div>
  <div> CTI <?php echo $i ?>: <?php echo $CTI[$i] ?></div>
  <div> CTB <?php echo $i ?>: <?php echo $CTB[$i] ?></div>
  <hr>
<?php } ?>