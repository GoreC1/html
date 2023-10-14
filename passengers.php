<?php
include 'config.php';
$conn = new mysqli($servername, $username, $password, $dbname);

$sqlPassengers = "SELECT * FROM Passengers";
$passengers = mysqli_query($conn, $sqlPassengers);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0">
	<title>Passengers</title>
	<link href="output.css" rel="stylesheet">
</head>

<body>

	<div class="flex flex-row items-center justify-center">
		<div class="basis-full flex justify-center text-3xl font-bold
			underline bg-slate-500 p-5
			text-blue-300 self-center "> Passenger list </div>
	</div>
	<div class="flex flex-row items-center justify-center">
		<a class="basis-1/3" href="flights.php">
			<div class="flex justify-center bg-slate-300 hover:bg-slate-500">
				Flights
			</div>
		</a>
		<a class="basis-1/3" href="soldTickets.php">
			<div class="flex justify-center bg-slate-300 hover:bg-slate-500">
				Sold Tickets
			</div>
		</a>
		<a class="basis-1/3" href="queries.php">
			<div class="flex justify-center bg-slate-300 hover:bg-slate-500">
				Queries
			</div>
		</a>	
	</div>
		
		
	<form class="flex w-max mx-auto items-center justify-center bg-amber-400 my-7 rounded-lg" 
			action="../Controllers/create.php" method="POST">
		<div class="p-4">
			<input type="hidden" value="Passenger" name="entity">
			<label for="FamilyName">Family name:</label>
			<input class="rounded-lg p-1" type="text" name="FamilyName">
		</div>
		<div class="p-4 ps-3">
			<input class="cursor-pointer bg-amber-700 p-2 rounded-lg" type="submit" name="submit" value="Add">
		</div>
	</form>

		<table class="flex justify-center p-5">
			<tr class="border-collapse border border-slate-500"	>
				<td class="border-collapse border border-slate-500">ID</td>
				<td class="border-collapse border border-slate-500">Airport</td>
				<td>Action</td>
			</tr>
			<?php foreach ($passengers as $value) { ?>
				<tr class="border-collapse border border-slate-500">
					<td class="p-3 border-collapse border border-slate-500"><?= $value['Id'] ?> </td>
					<td class="p-3 border-collapse border border-slate-500"><?= $value['FamilyName'] ?></td>
					<td class="p-4 flex justify-center border-collapse border border-slate-500">
						<form action="./update.php" method="POST">
							<input type="hidden" value="Passenger" name="entity">
							<input type="hidden" value="<?= $value['Id'] ?>" name="Id">
							<input class="cursor-pointer bg-green-700 p-1 rounded-lg" type="submit" name="submit" value="Update">
						</form>
					</td>
					<td class="p-4 flex justify-center border-collapse border border-slate-500">
						<form action="../Controllers/delete.php" method="POST">
							<input type="hidden" value="Passenger" name="entity">
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