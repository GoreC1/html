<?php
include '../config.php';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Ошибка подключения: " . $conn->connect_error);
}

if (isset($_POST['entity'])) {
	$entity = $_POST['entity'];

	switch ($entity) {
		case 'Passenger':
			if (isset($_POST['FamilyName'])) {
				$id = $_POST['Id'];
				$familyName = $_POST['FamilyName'];

				$sql = "UPDATE Passengers SET FamilyName = ('$familyName') WHERE Id = ('$id')";

				$conn->query($sql);
			}
			header('Location: ../passengers.php');
			break;

		case 'Flight':
			if (isset($_POST['Airport']) && isset($_POST['Price'])) {
				$id = $_POST['Id'];
				$airport = $_POST['Airport'];
				$price = $_POST['Price'];

				$sql = "UPDATE Flights SET Airport = ('$airport'), Price = ('$price') WHERE Id = ('$id')";

				$conn->query($sql);
			}
			header('Location: ../flights.php');
			break;

		case 'Ticket':
			if (isset($_POST['FlightId']) && isset($_POST['PassengerId']) && isset($_POST['FlightDate'])) {
				$id = $_POST['Id'];
				$flightId = $_POST['FlightId'];
				$passengerId = $_POST['PassengerId'];
				$flightDate = $_POST['FlightDate'];

				$sql = "UPDATE SoldTickets SET FlightId = ('$flightId'), PassengerId = ('$passengerId'), FlightDate = ('$flightDate'),
				 	WHERE Id = ('$id')";

				$conn->query($sql);
			}
			header('Location: ../soldTickets.php');
			break;


		default:
			echo "Неизвестная сущность";
	}
}

$conn->close();