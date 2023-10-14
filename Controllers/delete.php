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
			if (isset($_POST['Id'])) {
				$id = $_POST['Id'];

				$sql = "DELETE FROM Passengers WHERE Id = ('$id')";

				$conn->query($sql);
			}
			header('Location: ../passengers.php');
			break;

		case 'Flight':
			if (isset($_POST['Id'])) {
				$id = $_POST['Id'];

				$sql = "DELETE FROM Flights WHERE Id = ('$id')";

				$conn->query($sql);
			}
			header('Location: ../flights.php');
			break;

		case 'SoldTickets':
			if (isset($_POST['Id'])) {
				$id = $_POST['Id'];

				$sql = "DELETE FROM SoldTickets WHERE Id = ('$id')";

				$conn->query($sql);
			}
			header('Location: ../soldTickets.php');
			break;
		default:
			echo "Неизвестная сущность";
	}
}

$conn->close();