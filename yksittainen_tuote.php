<?php 

include('db_connect.php');

$yhteys->set_charset("utf8");

include("header.php") 

?>

<main>

    <?php

/* Kysely */
if (isset($_GET['id'])) {

$table = "tuotteet";
$kid = 1 ;
$tid = $_GET['id'];
$query = "SELECT * FROM $table WHERE id = $tid";
$res_data = mysqli_query($yhteys,$query);

$tulokset = $yhteys->query($query);

if ($tulokset->num_rows > 0) {
echo "<div>";
   while($rivi = $tulokset->fetch_assoc()) {
    $kuvadir = "upload/";
    $nimi = $rivi['nimi'];
    $kuva = $rivi['kuva'];
    $kuvaus = $rivi['kuvaus'];
    $id = $rivi['id'];
    $kuvatiedosto = $kuvadir.$kuva;

echo    "<h1>$nimi</h1>";
echo    "<div class=\"left-column\">";
echo    "<p>";
echo    "<div>$kuvaus</div>";
echo    "</p>";
echo    "</div>";
echo    "<div class=\"right-column\">";
echo    "<img src=\"" . $kuvatiedosto . "\" alt=\"". $nimi . "\" width=\"auto\" height=\"200\">";
echo    "</div>";
echo    "<div class=\"clear\"></div>";
echo    "<a style=\"float:right\" href=\"tuotteet.php\"><< Kaikki tuotteet</a>";

}

} else {
    echo "Ei tuloksia";
}
} else {
    echo "Ei tuotteitta";
}

mysqli_close($yhteys);

?>

</main>

<?php
include("footer.php") 
?>