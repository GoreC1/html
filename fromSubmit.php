<?php

if (isset($_POST['page'])) {
	$fileContent = file_get_contents('/var/www/html/stats.txt');
    $data = json_decode($fileContent, true);
	$page = $_POST['page'];

    $data["Page$page"]['SumbitVisitorsCount']++;

    $fileData = json_encode($data);
    file_put_contents('/var/www/html/stats.txt', $fileData);
	
    header("Location: ./pages/$page.php?fromAction=True");

}

?>