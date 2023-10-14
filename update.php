<?php
include './config.php';
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

				$sql = "select * from Passengers where Id = ('$id')";

				$passengers = $conn->query($sql);

				foreach ($passengers as $value) {
?>
					<form action="../Controllers/update.php" method="POST">
						<br>
						<input type="hidden" value="Passenger" name="entity">
						<input type="hidden" value="<?= $value['Id'] ?>" name="Id">
						<label for="id">Family name:</label>
						<input type="text" name="FamilyName" value="<?= $value['FamilyName'] ?>">
						<input type="submit" name="submit" value="Save">
						<br>
					</form>
				<?php
				}
			}
			break;

		case 'Flight':
			if (isset($_POST['Id'])) {
				$id = $_POST['Id'];

				$sql = "select * from Flights where Id = ('$id')";

				$flights = $conn->query($sql);

				foreach ($flights as $value) {
				?>
					<form action="../Controllers/update.php" method="POST">
						<br>
						<input type="hidden" value="Flight" name="entity">
						<input type="hidden" value="<?= $value['Id'] ?>" name="Id">
						<label for="Id">Airport:</label>
						<input type="text" name="Airport" value="<?= $value['Airport'] ?>">
						<label for="Id">Price:</label>
						<input type="number" name="Price" value="<?= $value['Price'] ?>">
						<input type="submit" name="submit" value="Save">
						<br>
					</form>
				<?php
				}
			}
			break;

		case 'Ticket':
			if (isset($_POST['Id'])) {
				$id = $_POST['Id'];

				$sql = "SELECT SoldTickets.Id as Id, FlightId, Airport, PassengerId, FamilyName, FlightDate 
					FROM SoldTickets join Passengers on Passengers.Id = SoldTickets.PassengerId join Flights on Flights.Id = SoldTickets.FlightId
					WHERE SoldTickets.Id = ('$id')";

				$soldTickets = $conn->query($sql);

				$sqlPassengers = "SELECT * FROM Passengers";
				$passengers = mysqli_query($conn, $sqlPassengers);

				$sqlFlights = "SELECT * FROM Flights";
				$flights = mysqli_query($conn, $sqlFlights);

				foreach ($soldTickets as $value) {
				?>
					<form action="../Controllers/update.php" method="POST">
						<br>
						<input type="hidden" value="soldTickets" name="entity">
						<select name="FlightId">
							<?php foreach ($flights as $flight) { ?>
								<option value="<?= $flight['Id'] ?>"><?= $flight['Airport'] ?> - <?= $flight['Price'] ?></option>
							<?php } ?>
							<option value="<?= $value['FlightId'] ?>" selected disabled hidden><?= $value['Airport'] ?></option>
						</select>
						<select name="PassengerId">
							<?php foreach ($passengers as $passenger) { ?>
								<option value="<?= $passenger['Id'] ?>"><?= $passenger['FamilyName'] ?></option>
							<?php } ?>
							<option value="<?= $value['PassengerId'] ?>" selected disabled hidden><?= $value['FamilyName'] ?></option>
						</select>
						<input type="date" name="FlightDate" value="<?= $value['FlightDate'] ?>">
						<input type="submit" name="submit" value="Save">
						<br>
					</form>
				<?php
				}
			}
			break;

		default:
			echo "Неизвестная сущность";
	}
}

$conn->close();