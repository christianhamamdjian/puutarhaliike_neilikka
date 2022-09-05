<html>
<head>
    <title>Pagination</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        $palvelin = "localhost";
        $kayttaja = "root";  // tämä on tietokannan käyttäjä, ei tekemäsi järjestelmän
        $salasana = "jukka1";
        $tietokanta = "autokanta";
        $table = "auto";
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;
        $conn=mysqli_connect($palvelin,$kayttaja,$salasana,$tietokanta);
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }
        $total_pages_sql = "SELECT COUNT(*) FROM $table";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
        $sql = "SELECT * FROM $table LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($res_data)){
            echo implode(",",$row);
        }
        mysqli_close($conn);
    ?>
    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="?pageno=1">
        <i class="fa fa-fast-backward"></i>
        </a></li>
        <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">
            <i class="fa fa-backward"></i></a>
        </li>
        <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">
            <i class="fa fa-forward"></i></a>
        </li>
        <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">
        <i class="fa fa-fast-forward"></i></a></li>
    </ul>
    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="?pageno=1">
        <i class="fa fa-angle-double-left"></i>
        </a></li>
        <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">
            <i class="fa fa-angle-left"></i></a>
        </li>
        <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">
            <i class="fa fa-angle-right"></i></a>
        </li>
        <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">
        <i class="fa fa-angle-double-right"></i></a></li>
    </ul>
    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="?pageno=1">
        <i class="fa fa-angle-double-left"></i>
        </a></li>
        <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">
            <i class="fa fa-caret-left"></i></a>
        </li>
        <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">
            <i class="fa fa-caret-right"></i></a>
        </li>
        <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">
        <i class="fa fa-angle-double-right"></i></a></li>
    </ul>
</body>
</html>