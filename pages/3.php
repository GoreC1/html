<link rel='stylesheet' href='styles.css'>
<div class="links">
  <a href="./random.php">Рандомные баннера</a>
</div>

<?php
$page = 3;

if (isset($_GET['fromAction']) == false){
  $fileContent = file_get_contents('/var/www/html/stats.txt');
  $data = json_decode($fileContent, true);
  
  $pageNum = 'Page' . $page;
  
  $data[$pageNum]["AllVisitorsCount"]++;
  
  $fileData = json_encode($data);
  file_put_contents('/var/www/html/stats.txt', $fileData);
}

?>

<form action="../fromSubmit.php" method="POST">
  <div>Заказать</div>
	<input type="submit" name="page" value="<?php echo $page ?>">
	<br>
</form>
<?php

$lines = file("../assets/pageContents/$page.txt");

foreach ($lines as $line) {
  echo "<div>$line</div>";
}

?>