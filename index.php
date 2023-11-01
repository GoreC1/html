<?php

$json = json_decode(file_get_contents("./keyWords.txt"), true);

$max_count = 0;
$min_count = 0;

foreach ($json as $key){
  
  if ($key["views"] > $max_count){
    $max_count = $key["views"];
  }

  if ($key["views"] < $min_count){
    $min_count = $key["views"];
  }
}

$max_font_size = 45;
$min_font_size = 10;

foreach ($json as $key => $val) {
    
    $font_size = ($val["views"] - $min_count) / ($max_count - $min_count)
                 * ($max_font_size - $min_font_size) + $min_font_size;
    ?>
    <a href="./pages/<?php echo $key ?>.php">
    <div style="font-size:<?php echo $font_size?>px">
      <?php echo $val["words"];?> </div>
    </a>
    <hr>  
<?php
}
?>
