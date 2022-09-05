<?php

	include('db_connect.php');

	$nimi = $sahkoposti = $aihe = $viesti = $uutiskirje = '';
	$errors = array('nimi' => '', 'sahkoposti' => '', 'aihe' => '', 'viesti' => '', 'uutiskirje' => '');

	if(isset($_POST['submit'])){

		// tarkistaa nimi
		if(empty($_POST['nimi'])){
			$errors['nimi'] = 'Nimi on pakollinen';
		} else{
			$nimi = $_POST['nimi'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $nimi)){
				$errors['nimi'] = 'Nimi on vain kirjaimet ja välit';
			}
		}
		
		// tarkistaa sähköposti
		if(empty($_POST['sahkoposti'])){
			$errors['sahkoposti'] = 'Sähköposti on pakollinen';
		} else{
			$sahkoposti = $_POST['sahkoposti'];
			if(!filter_var($sahkoposti, FILTER_VALIDATE_EMAIL)){
				$errors['sahkoposti'] = 'Sähköposti pitäsi olla oikea sähköposti osoite';
			}
		}

		// tarkistaa aihe
		$aihe = $_POST['aihe'];

		// tarkistaa viesti
		$viesti = $_POST['viesti'];
		
		// tarkistaa checkbox
		if(isset($_POST['uutiskirje'])){
				$uutiskirje = false;
			}
			else
			{
				$uutiskirje = true;
			}


		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
			$nimi = mysqli_real_escape_string($yhteys, $_POST['nimi']);
			$sahkoposti = mysqli_real_escape_string($yhteys, $_POST['sahkoposti']);
			$aihe = mysqli_real_escape_string($yhteys, $_POST['aihe']);
			$viesti = mysqli_real_escape_string($yhteys, $_POST['viesti']);
			$uutiskirje = mysqli_real_escape_string($yhteys, $_POST['uutiskirje']);

			// create sql
			$sql = "INSERT INTO yteydenottolomake(nimi,sahkoposti,aihe,viesti,uutiskirje) VALUES('$nimi','$sahkoposti','$aihe','$viesti','$uutiskirje')";

			// save to db and check
			if(mysqli_query($yhteys, $sql)){
				// success
				echo "Kiitos!";
				$nimi = $sahkoposti = $aihe = $viesti = $uutiskirje = '';
				$errors = array('nimi' => '', 'sahkoposti' => '', 'aihe' => '', 'viesti' => '', 'uutiskirje' => '');
				//header('Location: yhteydenottolomake.php');
			} else {
				echo 'query error: '. mysqli_error($yhteys);
			}

		}

		// $results = $yhteys->query($sql);

		// if($results>0) 
		// { 
		// 	echo "Kiitos!";
		// }
		$yhteys->close();
	} // lopetta POST tarkistus
	
	
?>

<form class="yhteytta" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

    <label>Nimi:</label>
    <input type="text" name="nimi" value="<?php echo htmlspecialchars($nimi) ?>">
    <div class="virhe"><?php echo $errors['nimi']; ?></div>

    <label>Sähköposti:</label>
    <input type="text" name="sahkoposti" value="<?php echo htmlspecialchars($sahkoposti) ?>">
    <div class="virhe"><?php echo $errors['sahkoposti']; ?></div>

    <label>Aihe:</label>
    <input type="text" name="aihe" value="<?php echo htmlspecialchars($aihe) ?>">
    <div class="virhe"><?php echo $errors['aihe']; ?></div>

    <label>Viesti:</label>
    <textarea name="viesti" rows="5" cols="40" value="<?php echo htmlspecialchars($viesti) ?>"></textarea>
    <div class="virhe"><?php echo $errors['viesti']; ?></div>

    <label>Osallistuu uutiskirjeemme listaan:</label>
    <input name="uutiskirje" id="uutiskirje" type="checkbox" checked>
    <div class="virhe"><?php echo $errors['uutiskirje']; ?></div>

    <div class="center">
        <input type="submit" name="submit" value="LÄHETÄ">
    </div>
</form>








