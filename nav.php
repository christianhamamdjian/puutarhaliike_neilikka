<?php
$sivu = $_SERVER['PHP_SELF'];
$loppuosa = substr($sivu,strrpos($sivu,"/") + 1);
$osoite = substr($loppuosa,0,strpos($loppuosa,"."));
$valittu="class=\"valittu\" ";
?>
<nav class="header">
      <a href="index.php" class="logo">
        <img class="logo" src="Puutarhaliikke.svg" alt="" />
      </a>
      <input class="menu-btn" type="checkbox" id="menu-btn" />
      <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
      <ul class="menu">
        <li><a <?php if($osoite == "index") echo $valittu; ?> href="index.php">Etusivu</a></li>
        <li><a <?php if($osoite == "tuotteet") echo $valittu; ?> href="tuotteet.php">Tuotteet</a></li>
        <li><a <?php if($osoite == "myymalat") echo $valittu; ?> href="myymalat.php">Myymälät</a></li>
        <li><a <?php if($osoite == "tietoa_meista") echo $valittu; ?> href="tietoa_meista.php">Tietoa meistä</a></li>
        <li><a <?php if($osoite == "ota_yhteytta") echo $valittu; ?> href="ota_yhteytta.php">Ota yheteyttä</a></li>
        <li><a <?php if($osoite == "ota_yhteytta") echo $valittu; ?> href="admin.php">Admin</a></li>
      </ul>
  </nav>