<?php

/* Tuotteen lisääminen */
session_start();
include('kayttajahallinta.php');
suojaus();
$virhe=false;
/* Yhteys tietokantaan */

/* jos tietokantaan ei pääse */
echo "Virhe tietokantaanyteydessä, yritä myöhemmin uudestaan.<br>";
$tietokantavirhe=true;

if(!$tietokantavirhe){

$kategoriat[] = $rivi['kategoria'];

if(isset($_POST['painike'])){
    $nimi="";
    $virhe=false;
/* suodatukset */
$nimi=suodata($_POST['nimi']);
/* Validointi */
$nimi=validoi($nimi);

/* Virheilmoitukset check function virhe() from screenshot 17.2.*/
/*  */
    if(!$virhe){
    /* Tuotteen lisääminen tietokantaan */
    $query="INSERT INTO tuotteet (..) VALUES (..)";
    /*  */

    }
    include('header.php');
}
}
?>

<!-- html -->
<main>
<form>
<label for="nimi">Nimi</label>
<input name="nimi" required value="<?php echo $nimi; ?>">
<?php virhe('nimi'); ?>

<!-- datalist code  check also screenshot 17.2.-->

<label for="kategoriat">Valitse kategoria:</label>
<input list="kategoriat" id="kategoria" name="kategoria" >
<datalist id="kategoriat" >

<?php 
include('db_connect.php');
$yhteys->set_charset("utf8");

$sql="select * from tuotekategoriat"; 
foreach ($yhteys->query($sql) as $row) {
    $rivi=$row["kategoria"];
    echo  "<option value=\"$rivi\">"; 
}
?>
<?php virhe('kategoria'); ?>

<!-- How do I add a new category and have it added to the tuotekategoriat table??  -->
</datalist>

</form>
</main>
<?php
include('footer.php');
?>