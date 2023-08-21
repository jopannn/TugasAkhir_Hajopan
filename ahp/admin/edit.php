<?php
include('config.php');
include('fungsi.php');

// mendapatkan data edit
if (isset($_GET['jenis']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $jenis = $_GET['jenis'];

    // hapus record
    $query = "SELECT nama FROM $jenis WHERE id=$id";
    $result = mysqli_query($koneksi, $query);

    while ($row = mysqli_fetch_array($result)) {
        $nama = $row['nama'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $jenis = $_POST['jenis'];
    $nama = $_POST['nama'];

    $query = "UPDATE $jenis SET nama='$nama' WHERE id=$id";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Update gagal";
        exit();
    } else {
        header('Location: ' . $jenis . '.php');
        exit();
    }
}
include 'header.php';
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-2">
        <?php

        include_once 'sidebar.php';
        ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-10">
        <ol class="breadcrumb">
            <li><a href="index.php"><span class="fa fa-home"></span> Beranda</a></li>
            <li class="active"><span class="fa fa-modx"></span> Nilai</li>
        </ol>
        <!-- Start -->
        <section class="content">
            <h2>Edit
                <?php echo $jenis ?>
            </h2>

            <form class="ui form" method="post" action="edit.php">
                <div class="inline field">
                    <label>Nama
                        <?php echo $jenis ?>
                    </label>
                    <input type="text" name="nama" value="<?php echo $nama?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden" name="jenis" value="<?php echo $jenis ?>">
                </div>
                <br>
                <input class="ui green button" type="submit" name="update" value="UPDATE">
            </form>
        </section>

        <!-- Finish -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>