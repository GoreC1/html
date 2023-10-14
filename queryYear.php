<?php
    include 'queryFunc.php';

    if (isset($_POST['Year'])) {
        
        $year = $_POST['Year'];

        $query = "SELECT FamilyName from Passengers WHERE 
            NOT EXISTS (SELECT * FROM SoldTickets WHERE SoldTickets.PassengerId = Passengers.Id AND YEAR(SoldTickets.FlightDate) = '$year');";
        
        renderQueryInfo(3, "Список пассажиров, которые не совершали полеты в заданном году;", $query);
        getQueryResult($query);
    }
?>

<div>
    <a href="queries.php"><h4>Back</h4></a>
</div>