<?php
  $сontent = file_get_contents(__DIR__ . '/Лаб_Парсер.htm');

  $convertedContent = iconv('Windows-1251', 'UTF-8', $сontent);

  $pattern = '/<td bgcolor="#ffffff">(.*?)<!--End of Main Menu-->/s';

  preg_match($pattern, $convertedContent, $matches);

  $leftMenu = $matches[0];
  
  $pattern = '/<span class="navText2">(.*?)<\/span>/s';

  preg_match_all($pattern, $leftMenu, $menuItems);

  foreach ($menuItems[0] as $item) {
    echo "<div>$item</div>";
  }

  $pattern = '/\b[A-ZА-ЯЁ]+\b/';
  $count = preg_match_all($pattern, join("", $menuItems[0]), $count);
  echo "<h2>Количество слов, напечатанных заглавными буквами: $count</h2>";
?>