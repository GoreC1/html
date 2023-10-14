<?php
include 'config.php';
$conn = new mysqli($servername, $username, $password, $dbname);

$sqlTickets = "SELECT SoldTickets.id as Id, FlightId, PassengerId, FamilyName, FlightDate, Airport
	 	FROM SoldTickets join Passengers on Passengers.Id = SoldTickets.PassengerId join Flights on Flights.Id = SoldTickets.FlightId";
$tickets = mysqli_query($conn, $sqlTickets);

$sqlPassengers = "SELECT * FROM Passengers";
$passengers = mysqli_query($conn, $sqlPassengers);

$sqlFlights = "SELECT * FROM Flights";
$flights = mysqli_query($conn, $sqlFlights);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0">
	<title>Sold Tickets</title>
	<link href="output.css" rel="stylesheet">
</head>
<body>
	
	
	
	<div class="flex flex-row items-center justify-center">
		<div class="basis-full flex justify-center text-3xl font-bold
					underline bg-slate-500 p-5
					text-blue-300 self-center "> Sold Tickets </div>
		</div>
		<div class="flex flex-row items-center justify-center">
			<a class="basis-1/3" href="passengers.php">
				<div class="flex justify-center bg-slate-300 hover:bg-slate-500">
						Passengers
				</div>
			</a>
			<a class="basis-1/3" href="flights.php">
				<div class="flex justify-center bg-slate-300 hover:bg-slate-500">
						Flights
				</div>
			</a>
			<a class="basis-1/3" href="queries.php">
				<div class="flex justify-center bg-slate-300 hover:bg-slate-500">
						Queries
				</div>
			</a>	
	</div>

<form class="flex w-max mx-auto items-center justify-center bg-amber-400 my-7 rounded-lg"  action="../Controllers/create.php" method="POST">
	<input class="rounded-lg p-1 m-2" type="hidden" value="Ticket" name="entity">
	<select class="p-1 m-2 rounded-lg" name="FlightId">
		<option value="" selected disabled hidden>Flight</option>
		<?php foreach ($flights as $value) { ?>
			<option value="<?= $value['Id'] ?>"><?= $value['Airport'] ?></option>
			<?php } ?>
		</select>
		<select class="p-1 m-2 rounded-lg" name="PassengerId">
			<option value="" selected disabled hidden>Passenger</option>
		<?php foreach ($passengers as $value) {	 ?>
			<option value="<?= $value['Id'] ?>"><?= $value['FamilyName'] ?></option>
		<?php } ?>
	</select>
	<input class="rounded-lg p-1 m-2" type="date" name="FlightDate">
	<input class="cursor-pointer bg-amber-700 p-2 rounded-lg m-2" type="submit" name="submit" value="Add">	
</form>

<table class="flex justify-center p-5"> 
	<tr>
		<td>Id</td>
		<td>Flight Id</td>
		<td>Airport</td>
		<td>Passenger Id</td>
		<td>Passenger family name</td>
		<td>FlightDate</td>
	</tr>
	<?php foreach ($tickets as $value) { ?>
		<tr>
			<td class="p-3"><?= $value['Id'] ?> </td>
			<td class="p-3"><?= $value['FlightId'] ?></td>
			<td class="p-3"><?= $value['Airport'] ?></td>
			<td class="p-3"><?= $value['PassengerId'] ?></td>
			<td class="p-3"><?= $value['FamilyName'] ?></td>
			<td class="p-3"><?= $value['FlightDate'] ?></td>
			<td class="p-3">
				<form action="./update.php" method="POST">
					<input type="hidden" value="Ticket" name="entity">
					<input type="hidden" value="<?= $value['Id'] ?>" name="Id">
					<input class="cursor-pointer bg-green-700 p-1 rounded-lg" type="submit" name="submit" value="Update">
				</form>
			</td>
			<td class="p-3 border-collapse border border-slate-500">
				<form action="../Controllers/delete.php" method="POST">
					<input type="hidden" value="Ticket" name="entity">
					<input type="hidden" value="<?= $value['Id'] ?>" name="Id">
					<input class="cursor-pointer bg-red-700 p-1 rounded-lg" type="submit" name="submit" value="Delete">
				</form>
			</td>
		</tr>
		<?php } ?>
	</table>
	<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>