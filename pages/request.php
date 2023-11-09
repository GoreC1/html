<?php
$lines = file('../NEWBASE.txt');
$regionName = $_GET['region'];
$sortedResidents = [];

function sortResidentsByLastName($residents) {
	$lastNames = array_column($residents, 'lastName');
	array_multisort($lastNames, SORT_ASC, $residents);
	return $residents;
}

if($regionName) {
	$residents = [];

	foreach ($lines as $line) {
		$values = explode(';', $line);  
		if ($values[6] == $regionName) {
			$name = $values[1];
			$lastName = $values[3];
			$sex = $values[4];
			$birthDate = $values[9];
			$postAddress = $values[14];
			$age = date_diff(date_create(str_replace(".", "-", $birthDate)), date_create('today'))->y;
			$nameColor = ($sex == '0') ? 'pink' : 'blue';

			$residents[] = [
				'firstName' => $name,
				'lastName' => $lastName,
				'age' => $age,
				'postAddress' => $postAddress,
				'nameColor' => $nameColor
			];
		}
	}
	$sortedResidents = sortResidentsByLastName($residents);
} else {
	echo 'Need two digits region code';
}
?>

<link rel='stylesheet' href='../styles.css'>

<?php foreach ($sortedResidents as $resident) { ?>
	<div class="resident">
		<div class="<?= $resident['nameColor']?>">
			<?= $resident['lastName'] ?> <?= $resident['firstName'] ?> Возраст: <?= ($resident['age']) ?> Почтовый адрес: <?= $resident['postAddress'] ?>
		</div>
	</div>
<?php } ?>