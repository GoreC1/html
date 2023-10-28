<?php
$number = random_int(1, 5);

$fileContent = file_get_contents('/var/www/html/stats.txt');
$data = json_decode($fileContent, true);

$pageNum = 'Page' . $number;

$data[$pageNum]["BannerSeenCount"]++;

$fileData = json_encode($data);
file_put_contents('/var/www/html/stats.txt', $fileData);

$bannerPath =  "../assets/banners/$number.gif";
?>
<div class="link">
    <a href="./stats.php">Статистика</a>
    <br>
    <a href="../fromBanner.php?page=<?php echo $number ?>">
    <img src=<?php echo $bannerPath ?> alt="" />
    </a>
</div>