<?php
$lines = file("var2.csv");
$operators = [];
$counter = 0;
foreach ($lines as $line) {
    if ($counter++ == 0) continue;
    $values = explode(";", $line);
    $operators[] = $values[0];
}

$operators = array_unique($operators);
?>
<script>
  function getCities(operator) {
    if (operator) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("city").disabled = false;
          document.getElementById("city").innerHTML = this.responseText;
          getCost();
        }
      };
      xmlhttp.open("GET", "./pages/getCities.php?operator=" + operator, true);
      xmlhttp.send();
    }
  }

  function getCost() {
    const operator = document.getElementById('operator').value;
    const city = document.getElementById('city').value;
    const time = document.getElementById('time').value;

    if (operator && city && time) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("cost").value = this.responseText;
        }
      };
      xmlhttp.open("GET", "./pages/getCost.php?operator=" + operator + "&city=" + city + "&time=" + time, true);
      xmlhttp.send();
    }
  }
</script>

<form action="">
  <label for="operator">Оператор:</label>
  <select id="operator" onchange="getCities(this.value)">
    <option value="" selected disabled hidden>выберите</option>
    <?php foreach ($operators as $operator) { ?>
      <option value="<?= $operator?>"><?= $operator?></option>
    <?php } ?>
  </select>

  <label for="city">Город:</label>
  <select id="city" disabled onchange="getCost()">
    <option value="" selected disabled hidden>выберите</option>
  </select>

  <label for="time">Время разговора в роуминге (в минутах):</label>
  <input type="number" id="time" min="0" onchange="getCost()">

  <label for="cost">Стоимость:</label>
  <input disabled id="cost">
</form>