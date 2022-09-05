<?php
//include 'header.php';
include 'inc/header.php';
Session::CheckSession();

?>

<?php
    include('db_connect.php');

    $kategoria = '';
    $errors = array('kategoria' => '');

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

    // tarkistaa kategoria
    $kategoria = $_POST['kategoria'];

    if(array_filter($errors)){
        echo 'errors in form';
    } else {
        // escape sql chars
        $kategoria = mysqli_real_escape_string($yhteys, $_POST['kategoria']);

    }
    // create sql
    $sql = "INSERT INTO tuotekategoriat(kategoria) VALUES('$kategoria')";

    // save to db and check
    if(mysqli_query($yhteys, $sql)){
        // success
        echo "Kiitos!";
        // $nimi = $kuva = $hinta = $kuvaus = $varastossa = '';
        // $errors = array('nimi' => '', 'fileToUpload' => '', 'hinta' => '', 'kuvaus' => '', 'varastossa' => '');
        // header('Location: lisaa_kategoria.php');
    } else {
        echo 'query error: '. mysqli_error($yhteys);
    }
    
    $yhteys->close();
}
?>

<?php include("header.php") ?>
<main>
    <h1>Lisää uusi tuotekategoria:</h1>
<form class="yhteytta" style="margin:60px auto;width: 80%" action="lisaa_kategoria.php" method="POST">
    <label for="kategoria">Lisää tuotekategoria:</label>
    <input text="kategoriat" name="kategoria" id="kategoria">
    <div class="center">
        <input type="submit" name="submit" value="LÄHETÄ">
    </div>
</form>
</main>
<?php include("footer.php") ?>