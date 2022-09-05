<?php
include('db_connect.php');

$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$nimi = $kuva = $hinta = $kuvaus = $varastossa = '';
$errors = array('nimi' => '', 'fileToUpload' => '', 'hinta' => '', 'kuvaus' => '', 'varastossa' => '');




// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

    // tarkistaa nimi
      if(empty($_POST['nimi'])){
        $errors['nimi'] = 'Nimi on pakollinen';
    } else{
        $nimi = $_POST['nimi'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $nimi)){
            $errors['nimi'] = 'Nimi on vain kirjaimet ja välit';
        }
    }

    // tarkistaa kuva
    $kuva = ($_FILES['fileToUpload']['tmp_name']);

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename($_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }


    // tarkistaa hinta
    $hinta = $_POST['hinta'];

    // tarkistaa kuvaus
    $kuvaus = $_POST['kuvaus'];
    
    // tarkistaa varastossa
    $varastossa = $_POST['varastossa'];

    // tarkistaa kategoria
    $kategoria = $_POST['kategoria'];

    if(array_filter($errors)){

        //echo 'errors in form';
    } else {
        // escape sql chars
        $nimi = mysqli_real_escape_string($yhteys, $_POST['nimi']);
        $kuva = mysqli_real_escape_string($yhteys, ($_FILES['fileToUpload']['name']));
        $hinta = mysqli_real_escape_string($yhteys, $_POST['hinta']);
        $kuvaus = mysqli_real_escape_string($yhteys, $_POST['kuvaus']);
        $varastossa = mysqli_real_escape_string($yhteys, $_POST['varastossa']);
        $kategoria = mysqli_real_escape_string($yhteys, $_POST['kategoria']);
    }
    // create sql
    // $kategoria = inputfilter($_POST['kategoria']);

   
    $sql1 = "SELECT id FROM tuotekategoriat WHERE kategoria = '$kategoria'";

    $tulokset = $yhteys->query($sql1);
    if ($tulokset->num_rows > 0) {
       while($rivi = $tulokset->fetch_assoc()) {
          $sql = "INSERT INTO tuotteet(nimi,kuva,hinta,kuvaus,varastossa,kategoria_id) VALUES('$nimi','$kuva','$hinta','$kuvaus','$varastossa','$rivi[id]')";
          echo "Id: " . $rivi["id"] . "<br><br>";
       }
    } elseif($tulokset->num_rows == 0) {
      $sql2 = "INSERT INTO tuotekategoriat (kategoria) VALUES ('$kategoria')";
      $kategoria_id = $yhteys->insert_id;
      $tulokset2 = $yhteys->query($sql2);
      while($rivi = $tulokset2->fetch_assoc()) {
        $sql = "INSERT INTO tuotteet(nimi,kuva,hinta,kuvaus,varastossa,kategoria_id) VALUES('$nimi','$kuva','$hinta','$kuvaus','$varastossa','$rivi[id]')";
        echo "Id: " . $rivi["id"] . "<br><br>";
     }
    } else {
       echo "Ei tuloksia";
    }


    // $sql = "INSERT INTO tuotteet(nimi,kuva,hinta,kuvaus,varastossa) VALUES('$nimi','$kuva','$hinta','$kuvaus','$varastossa')";
    // $sql = "INSERT INTO tuotteet(nimi,kuva,hinta,kuvaus,varastossa,kategoria_id) VALUES('$nimi','$kuva','$hinta','$kuvaus','$varastossa','$kategoria_id')";

    // save to db and check
    if(mysqli_query($yhteys, $sql)){
        // success
        echo $kategoria;
        echo $kategoria_id;
        echo "Kiitos!";
        // $nimi = $kuva = $hinta = $kuvaus = $varastossa = '';
        // $errors = array('nimi' => '', 'fileToUpload' => '', 'hinta' => '', 'kuvaus' => '', 'varastossa' => '');
        // header('Location: tuotteet_lomake.php');
    } else {
        echo 'query error: '. mysqli_error($yhteys);
    }
    
    $yhteys->close();
}
?>




