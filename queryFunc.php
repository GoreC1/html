<?php
include 'config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
function renderQueryInfo(int $index, string $task, string $query){
    ?>
    <div style="margin-top: 30px;">
      <h2>Запрос <?php echo $index;?></h2>
      <p><?php echo $task;?></p>
      <pre style="background-color: black; color: white; font-weight: bold;"><?php echo $query;?></pre>
      <h3>Результат</h3>
<?php 
}

function getQueryResult(string $query) {

    include 'config.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    $result = mysqli_query($conn, $query);

    $fieldInfo = mysqli_fetch_fields($result);

    echo "<table border=1><thead><tr>
    <th> № </th> 
    ";
    foreach ($fieldInfo as $field) {
        echo "<th>$field->name</th>";
    }

    echo "</tr></thead>";

    $index = 1;


    foreach ($result as $el) {
        echo "<tr> <td>$index</td>";
        foreach($el as $fieldValue) {
          echo "<td>$fieldValue</td>";
        }
        echo "</tr>";
        $index +=1; 
    }
    echo "</table>";
    ?>
  </div>
<?php
    }
    ?>