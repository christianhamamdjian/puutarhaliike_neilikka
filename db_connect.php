<?php 

	$palvelin = "localhost";
	$kayttaja = "root";  // tämä on tietokannan käyttäjä, ei tekemäsi järjestelmän
	$salasana = "root";
	$tietokanta = "puutarhaliikke";
	
	// luo yhteys
	$yhteys = new mysqli($palvelin, $kayttaja, $salasana, $tietokanta);
	
	// jos yhteyden muodostaminen ei onnistunut, keskeytä
	if ($yhteys->connect_error) {
	   die("Yhteyden muodostaminen epäonnistui: " . $yhteys->connect_error);
	}

?>