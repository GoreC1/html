<?php
	$lines = file('./OLDBASE.txt');

	function replaceSex($sex) {
		if (isset($sex)) {
			return $sex === 'male' ? '1' : '0';
		}
		
		return null;
	}

    function remakeBirthDate($date) {
        if (!isset($date)){
            return null;
        } 
        $old_date = explode('/', $date);
		if (strlen($old_date[1]) < 2){
			$old_date[1] = "0" . $old_date[1];
		}

		if (strlen($old_date[0]) < 2){
			$old_date[0] = "0" . $old_date[0];
		} 
		
        return $old_date[1].'.'.$old_date[0].'.'.$old_date[2];
    }

	function formatMiddleName($middleName) {
		return isset($middleName) ? $middleName . '.' : null;
	}

	function replacePhone($phone) {
		if (!isset($phone)) {
			return null;
		}

		$phone = str_replace('-','', $phone);

		if (strlen($phone) === 10) {
			$phone = substr_replace($phone, '-', 3, 0);
			$phone = substr_replace($phone, '-', 7, 0);
		} elseif (strlen($phone) === 9) {
			$phone = substr_replace($phone, '-', 2, 0);
			$phone = substr_replace($phone, '-', 6, 0);
		} elseif (strlen($phone) === 8) {
			$phone = substr_replace($phone, '-', 1, 0);
			$phone = substr_replace($phone, '-', 5, 0);
		}

		return $phone;
	}

	function validate($value, $regex) {
		preg_match($regex, $value, $matches);

    return $matches[0] ?? null;
	}

	$arrToFile = [];
	$errorsCount = [
		'id' => 0,
		'name' => 0,
		'middleName' => 0,
		'lastName' => 0,
		'sex' => 0,
		'city' => 0,
		'region' => 0,
		'email' => 0,
		'phone' => 0,
		'birthDay' => 0,
		'position' => 0,
		'company' => 0,
		'weight' => 0,
		'height' => 0,
		'postAddress' => 0,
		'postCode' => 0,
		'countryCode' => 0
	]; //количество ошибок

	foreach ($lines as $line) {
		$values = explode(',', $line);
		$valuesCount = count($values);

		if ($valuesCount === 0) {
      continue; //если вообще нет ничего, пропуск строки
    }

		$validValues = [];

		$id = $values[0] ? validate($values[0], '/^\d+$/') : null; //Целое число
		$name = $valuesCount >= 2 ? validate($values[1], '/^[A-Za-zА-Яа-я]+$/') : null; //Одно слово
		$middleName = $valuesCount >= 3 ? formatMiddleName(validate($values[2], '/^[A-Za-zА-Яа-я]$/')) : null; //Буква и точка (Отчество)
		$lastName = $valuesCount >= 4 ? validate($values[3], '/^[A-Za-zА-Яа-я]+$/') : null; //Одно слово  
		$sex = $valuesCount >= 5 ? replaceSex(validate($values[4], '/^male$|^female$/')) : null; // (female / male)
		$city = $valuesCount >= 6 ? validate($values[5], '/([A-Za-zА-Яа-я]+\s?)+/') : null; //Одно или несколько слов
		$region = $valuesCount >= 7 ? validate($values[6], '/^[A-Za-zА-Яа-я0-9]{2}$/') : null; //Двухсимвольное значение
		$email = $valuesCount >= 8 ? filter_var($values[7], FILTER_VALIDATE_EMAIL) : null;
		$phone = $valuesCount >= 9 ? replacePhone(validate($values[8], '/^\d+-\d+-\d+$/')) : null; // 8,9,10 значный, разделенный дефисами
		$birthDay = $valuesCount >= 10 ? remakeBirthDate(validate($values[9], '/^^\d+\/\d+\/\d+$/')) : null; // m/d/yyyy
		$position = $valuesCount >= 11 ? validate($values[10], '/([A-Za-zА-Яа-я]+\s?)+/') : null; //Одно или несколько слов
		$company = $valuesCount >= 12 ? validate($values[11], '/([A-Za-zА-Яа-я]+\s?)+/') : null; //Одно или несколько слов
		$weight = $valuesCount >= 13 ? round(filter_var($values[12], FILTER_VALIDATE_FLOAT)) : null; //Дробное число
		$height = $valuesCount >= 14 ? filter_var($values[13], FILTER_VALIDATE_INT) : null; //Целое число
		$postAddress = $valuesCount >= 15 ? validate($values[14], '/^\d+ [a-zA-Z]+(?: [a-zA-Z]+)*$/') : null; //Целое число, пробел, одно или несколько слов
		$postCode = $valuesCount >= 16 ? filter_var($values[15], FILTER_VALIDATE_INT) : null; //Целое число
		$countryCode = $valuesCount >= 17 ? validate($values[16], '/^[A-Za-zА-Яа-я]{2}$/') : null; //Двухбуквенный код


		
		if(isset($id)){
			array_push($validValues, $id);
		} else {
			$errorsCount['id']++;
		}
		
		if(isset($name)){
			array_push($validValues, $name);
		} else {
			$errorsCount['name']++;
		}

		if(isset($middleName)){
			array_push($validValues, $middleName);
		} else {
			$errorsCount['middleName']++;	
		}

		if(isset($lastName)){
			array_push($validValues, $lastName);
		} else {
			$errorsCount['lastName']++;	
		}

		if(isset($sex)){
			array_push($validValues, $sex);
		} else {
			$errorsCount['sex']++;	
		}

		if(isset($city)){
			array_push($validValues, $city);
		} else {
			$errorsCount['city']++;	
		}

		if(isset($region)){
			array_push($validValues, $region);
		} else {
			$errorsCount['region']++;	
		}

		if(isset($email)){
			array_push($validValues, $email);
		} else {
			$errorsCount['email']++;	
		}

		if(isset($phone)){
			array_push($validValues, $phone);
		} else {
			$errorsCount['phone']++;
		}

		if(isset($birthDay)){
			array_push($validValues, $birthDay);
		} else {
			$errorsCount['birthDay']++;	
		}

		if(isset($position)){
			array_push($validValues, $position);
		} else {
			$errorsCount['position']++;	
		}

		if(isset($company)){
			array_push($validValues, $company);
		} else {
			$errorsCount['company']++;	
		}

		if(isset($weight)){
			array_push($validValues, $weight);
		} else {
			$errorsCount['weight']++;	
		}

		if(isset($height)){
			array_push($validValues, $height);
		} else {
			$errorsCount['height']++;	
		}

		if(isset($postAddress)){
			array_push($validValues, $postAddress);
		} else {
			$errorsCount['postAddress']++;	
		}

		if(isset($postCode)){
			array_push($validValues, $postCode);
		} else {
			$errorsCount['postCode']++;	
		}

		if(isset($countryCode)){
			array_push($validValues, $countryCode);
		} else {
			$errorsCount['countryCode']++;	
		}
		
		if(count($validValues) > 16) { //если все поля валидные
			$strToArray = implode(';', $validValues) . "\n";

			//запись в файл
			array_push($arrToFile, $strToArray);
		}
	}
	file_put_contents('./NEWBASE.txt', $arrToFile);
?>

<link rel='stylesheet' href='./views/styles.css'>   
<div class="links">
  <a href="./pages/stats.php">Статистика</a>
	<a href="./pages/request.php?region=">Get-запрос</a>
</div>

<div>Errors</div>
<table>
	<?php foreach ($errorsCount as $key => $value): ?>
		<tr>
			<td><?php echo $key; ?></td> 
			<td><?php echo $value; ?></td>
		</tr>
	<?php endforeach; ?>
</table>