<?php
//include 'header.php';
include 'inc/header.php';
Session::CheckSession();

?>

<?php include("header.php") ?>
<main>
    <h1>Lisää uusi tuote:</h1>
<form class="yhteytta" style="margin:60px auto;width: 80%" action="tuotteet_lomake.php" method="POST"
    enctype="multipart/form-data">

    <label>Tuote:</label>
    <input type="text" name="nimi" style="width: 80%" value="<?php echo htmlspecialchars($nimi) ?>">
    <div class="virhe"><?php echo $errors['nimi']; ?></div>

    <label>Kuva:</label>
    <!-- <input type="hidden" name="size" value="350000"> -->
    <input style="width: 80%" type="file" name="fileToUpload" id="fileToUpload">
    <div></div>

    <label>Hinta:</label>
    <input type="text" name="hinta" style="width: 80%" value="<?php echo htmlspecialchars($sahkoposti) ?>">
    <div class="virhe"><?php echo $errors['hinta']; ?></div>

    <label style="float:left">Kuvaus:</label>
    <textarea name="kuvaus" rows="5" cols="40" value="<?php echo htmlspecialchars($viesti) ?>"></textarea>
    <div class="virhe"><?php echo $errors['kuvaus']; ?></div>

    <label>Varastossa:</label>
    <input type="text" name="varastossa" style="width: 70%" value="<?php echo htmlspecialchars($sahkoposti) ?>">
    <div class="virhe"><?php echo $errors['varastossa']; ?></div>

    <label for="kategoriat">Valitse kategoria:</label>
    <input list="kategoriat" id="kategoria" name="kategoria">
    <datalist id="kategoriat">

<?php 
    include('db_connect.php');
    $yhteys->set_charset("utf8");

    $sql="select * from tuotekategoriat"; 
    foreach ($yhteys->query($sql) as $row) {
        $rivi=$row["kategoria"];
        echo  "<option value=\"$rivi\">"; 
    }
?>
        <!-- How do I add a new category and have it added to the tuotekategoriat table??  -->
    </datalist>

    <div class="center">
        <input type="submit" name="submit" value="LÄHETÄ">
    </div>
</form>
</main>
<?php include("footer.php") ?>