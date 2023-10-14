<h2>Таблица до изменений:</h2>
<?php
    include 'queryFunc.php';
    if (isset($_POST['Airport'])) {
        
        $airport = ($_POST['Airport']);
        
        $priceQuery = "SELECT * From Flights WHERE Airport = '$airport'";

        getQueryResult($priceQuery);

        $query = "UPDATE Flights SET Price = Price * 0.9 WHERE Airport = '$airport'";
        
        renderQueryInfo(10, "Таблица после запроса:", $query);
        mysqli_query($conn, $query);
        getQueryResult($priceQuery);
    }
?>



<div>
    <a href="queries.php"><h4>Back</h4></a>
</div>