<?php
    $page =  $_GET['page'];

    $fileContent = file_get_contents('stats.txt');
    $data = json_decode($fileContent, true);

    $data["Page$page"]['FromBannerVisitorsCount']++;

    $fileData = json_encode($data);
    file_put_contents('/stats.txt', $fileData);

    header("Location: ./pages/$page.php");
?>