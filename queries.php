<?php
    include 'queryFunc.php';

    $query = 'SELECT Airport, AVG(Price) AS averagePrice, COUNT(*) as flightCount from Flights GROUP BY Airport';
    renderQueryInfo(1,"Средняя цена авиабилета и количество рейсов до каждого аэропорта;", $query);
    getQueryResult($query);

    $query = 'SELECT DISTINCT Airport FROM SoldTickets JOIN Flights on Flights.Id = SoldTickets.FlightId';
    renderQueryInfo(2,"Список аэропортов, до которых совершались полеты (без повторов);", $query);
    getQueryResult($query);
    
    // $query = 'SELECT FamilyName from Passengers WHERE NOT 
    // EXISTS (SELECT * FROM SoldTickets WHERE SoldTickets.PassengerId = Passengers.Id AND YEAR(SoldTickets.FlightDate) = 2022);';
    // renderQueryInfo(3, "Список пассажиров, которые не совершали полеты в заданном году;", $query);
    // getQueryResult($query);
?>
<h2>Запрос 3</h2>
<form action="queryYear.php" method="POST">
    <h4>Список пассажиров, которые не совершали полеты в заданном году;</h4>
    <label for="year">Year</label>
    <input type="number" name="Year" min="1990" value="2023">
    <input type="submit" value="Get result">
</form>

<?php

    $query = 'SELECT Passengers.Id, FamilyName, COUNT(*) AS flightCount 
    From Passengers JOIN SoldTickets ON Passengers.Id = SoldTickets.PassengerId GROUP BY Passengers.Id, FamilyName;';
    renderQueryInfo(4, "Список пассажиров с информацией о количестве совершенных полетов;", $query);
    getQueryResult($query);

    $query = 'SELECT FamilyName, GROUP_CONCAT(DISTINCT Airport SEPARATOR \', \') AS airports, COUNT(*) AS flightCount FROM Passengers JOIN SoldTickets ON 
    Passengers.Id = SoldTickets.PassengerId JOIN Flights on SoldTickets.FlightId = Flights.Id GROUP BY Passengers.Id, FamilyName; ';
    renderQueryInfo(5, "Список пассажиров с указанием аэропортов, до которых они совершали полеты, и количество таких полетов;", $query);   
    getQueryResult($query);

    $query = 'SELECT FamilyName, COUNT(*) AS flightCount FROM Passengers JOIN SoldTickets ON Passengers.Id = SoldTickets.PassengerId 
    JOIN Flights on SoldTickets.FlightId = Flights.Id WHERE Airport = \'Domodedovo\' GROUP BY Passengers.Id, FamilyName HAVING COUNT(*) > 5';
    renderQueryInfo(6, "Список пассажиров, совершивших более 5 полетов до заданного аэропорта;", $query);
    getQueryResult($query);
    
    $query = 'SELECT FamilyName, (SELECT COUNT(*) FROM SoldTickets WHERE PassengerId = Passengers.Id) AS flightCount From Passengers';
    renderQueryInfo(7, "Список пассажиров с полем, содержащим количество полётов;", $query);
    getQueryResult($query);

    $query = 'SELECT Airport, COUNT(DISTINCT SoldTickets.PassengerId) AS passengerCount 
    From Flights JOIN SoldTickets ON Flights.Id = SoldTickets.FlightId GROUP BY Airport';
    renderQueryInfo(8, "Список аэропортов, с указанием, сколько пассажиров совершили до него полеты (повторные полеты не учитывать);", $query);
    getQueryResult($query);

    $query = 'SELECT Airport, FamilyName, COUNT(*) AS flightCount from Flights JOIN SoldTickets ON Flights.Id = SoldTickets.FlightId
    JOIN Passengers ON Passengers.Id = SoldTickets.PassengerId GROUP BY Airport, SoldTickets.PassengerId HAVING COUNT(*) > 5';
    renderQueryInfo(9, "Список пассажиров, совершивших полёт в один аэропорт более 5 раз. В списке отобразить название аэропорта и количество полетов;", $query);
    getQueryResult($query);

    // getQueryResult(
    //   'SELECT Airport, FamilyName, COUNT(*) AS flightCount from Flights JOIN SoldTickets ON Flights.Id = SoldTickets.FlightId
    //   JOIN Passengers ON Passengers.Id = SoldTickets.PassengerId GROUP BY Airport, SoldTickets.PassengerId HAVING COUNT(*) > 5',
    //   10,
    //   "Список книг, которые брались более 10 раз на срок не менее 30 дней."
    // );

    ?>
    <h2> Запрос 10</h2>
    <?php

    $query = "SELECT DISTINCT Airport From Flights";
    $flights = mysqli_query($conn, $query);
?>
    <form action="queryDecrease.php" method="POST">
        <h4>Уменьшить полёты до заданного аэропорта на 10%</h4>
            <select class="p-1 m-2 rounded-lg" name="Airport">
                <option value="" selected disabled hidden>Flight</option>
                <?php foreach ($flights as $value) { ?>
                    <option value="<?= $value['Airport'] ?>"><?= $value['Airport'] ?></option>
                    <?php } ?>
                </select>
                <input type="submit" name="submit" value="Query">	
    </form>