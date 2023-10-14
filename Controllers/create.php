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
				$familyName = $_POST['FamilyName'];

				$sql = "INSERT INTO Passengers (FamilyName) VALUES ('$familyName')";

				$conn->query($sql);
			}
			header('Location: ../passengers.php');
			break;

		case 'Flight':
			if (isset($_POST['Airport']) && isset($_POST['Price'])) {
				$airport = $_POST['Airport'];
				$price = $_POST['Price'];

				$sql = "INSERT INTO Flights (Airport, Price) VALUES ('$airport', $price)";

				$conn->query($sql);
			}
			header('Location: ../flights.php');
			break;

		case 'Ticket':
			if (isset($_POST['PassengerId']) && isset($_POST['FlightDate']) && isset($_POST['FlightId'])) {
				$flightId = $_POST['FlightId'];
				$passengerId = $_POST['PassengerId'];
				$flightDate = $_POST['FlightDate'];

				$sql = "INSERT INTO SoldTickets (FlightId, PassengerId, FlightDate)
                    VALUES ('$flightId', '$passengerId', '$flightDate')";

				$conn->query($sql);
			}
			header('Location: ../soldTickets.php');
			break;


		default:
			echo "Unknown entity";
	}
}

$conn->close();