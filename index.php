<?php
  $сontent = file_get_contents(__DIR__ . '/Лаб_Парсер.htm');
  
  
  $convertedContent = iconv('Windows-1251', 'UTF-8', $сontent);
  
  $convertedContent = str_replace('&nbsp;', ' ', $convertedContent);
  
  $pattern = '/<td bgcolor="#ffffff">(.*?)<!--End of Main Menu-->/s';

  preg_match($pattern, $convertedContent, $matches);


  $leftMenu = $matches[0];
  
  $pattern = '/(?<=<span class="navText2">)(.*?)(?=<\/span>)/s';

  preg_match_all($pattern, $leftMenu, $menuItems);

  $fd = fopen("parsed.txt", "w");

  foreach ($menuItems[0] as $item) {
    echo "<div>$item</div>";
    fwrite($fd, "$item\n");
  }

  $pattern = '/\b[A-ZА-Я]*\b/u';
  $count = preg_match_all($pattern, join("", $menuItems[0]), $count);
  echo "<h2>Количество слов, напечатанных заглавными буквами: $count</h2>";
  fwrite($fd, "Количество слов, напечатанных заглавными буквами: $count\n");

?>