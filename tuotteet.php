<?php 
include('db_connect.php');

$yhteys->set_charset("utf8");

include("header.php") 
?>

<main>
    <h1>Tuotteet</h1>
    <p>
        Tuotevalikoimaamme kuuluu sisäkasveja, ulkokasveja sekä työkaluja ja
        muita tarvikkeita kasvien hoitoon.
    </p>

<?php

/* Tuotekategoriat */

$query = "SELECT * FROM tuotekategoriat";

$ktulokset = $yhteys->query($query);

if ($ktulokset->num_rows > 0) {
  echo "<div class=\"kategoriat\">";
  echo "<ul>";
   while($rivi = $ktulokset->fetch_assoc()) {
    $kid = $rivi['id'];
    $knimi = $rivi['kategoria'];
    echo "<li>";
    echo "<form  class=\"kategoria\" method=\"post\">";
    echo "<input type=hidden name=\"newkat\" value=\"$kid\">";
    echo "<input type=\"submit\" name=\"newnimi\" value=\"$knimi\">";
    echo "</form>";
    echo "</li>";   
    }
  echo "</ul>";

  if(isset($_POST["newkat"])){
    $kid = $_POST["newkat"];
    $knimi = $_POST["newnimi"];
  }
} else {
   echo "Ei tuloksia";
}
echo "<div class=\"clear\"></div>";
echo "</div>";

echo "<h2>$knimi</h2>";

/* Tuotteet */

if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$table = "tuotteet";
$no_of_records_per_page = 1;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages_sql = "SELECT COUNT(*) FROM $table";
$result = mysqli_query($yhteys,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
$query = "SELECT * FROM $table WHERE kategoria_id = $kid LIMIT $offset, $no_of_records_per_page";
$res_data = mysqli_query($yhteys,$sql);

while($row = mysqli_fetch_array($res_data)){
echo implode(",",$row);
}

$tulokset = $yhteys->query($query);

// jos tulosrivejä löytyi
if ($tulokset->num_rows > 0) {
  echo "<div class=\"kuvagalleria\">";
   while($rivi = $tulokset->fetch_assoc()) {
    $kuvadir = "upload/";
    $nimi = $rivi['nimi'];
    $kuva = $rivi['kuva'];
    $id = $rivi['id'];
    $kuvatiedosto = $kuvadir.$kuva;

    echo "<div class=\"sailio\">";
    echo     "<a href=\"./yksittainen_tuote.php?id=" . $id . "\">";
    echo      "<img src=\"" . $kuvatiedosto . "\" alt=\"". $nimi . "\" width=\"auto\" height=\"200\">";
    echo     "<div class=\"kuvaus\">" . $nimi . ", " . $id . "</div>";
    echo       "</a>";
    echo "</div>";
}
} else {
   echo "Ei tuloksia";
}
echo "<div class=\"clear\"></div>";
echo "</div>";

mysqli_close($yhteys);
?>

    <div style="width:80%;margin:0 auto;">
        <div>
            <ul class="pagination">
                <li><a href="?pageno=1">First</a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a
                        href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                </li>
                <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
        </div>
        <div>
            <a href="lisaa_tuote.php"><button class="btn btn-dark">Lisää tuote</button></a>
            <a href="lisaa_kategoria.php"><button class="btn btn-dark">Lisää tuotekategoria</button></a>
        </div>
    </div>
</main>



<?php include("footer.php") ?>