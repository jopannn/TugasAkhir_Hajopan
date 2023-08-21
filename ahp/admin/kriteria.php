<?php
include('config.php');
include('fungsi.php');

// menjalankan perintah edit
if (isset($_POST['edit'])) {
    $id = $_POST['id'];

    header('Location: edit.php?jenis=kriteria&id=' . $id);
    exit();
}

// menjalankan perintah delete
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    deleteKriteria($id);
}

// menjalankan perintah tambah
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    tambahData('kriteria', $nama);
}
include 'header.php';
$page = isset($_GET['page']) ? $_GET['page'] : "";
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


        <form method="post">
            <div class="row">
                <div class="col-md-6 text-left">
                    <strong style="font-size:18pt;"><span class="fa fa-modx"></span> Kriteria</strong>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" onclick="location.href='tambah.php?jenis=kriteria'"
                        class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data</button>
                    <tr>
                        
                    <tr>

                        </th>
                    </tr>
                </div>
            </div>
            <br />

            <table width="100%" class="table table-striped table-bordered" id="tabeldata">
                <thead>
                    <tr>

                        <th width="10px">No</th>

                        <th>Kriteria</th>

                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th width="10px">No</th>

                        <th>Kriteria</th>

                </tfoot>
                <tbody>

                    <?php
                    // Menampilkan list kriteria
                    $query = "SELECT id,nama FROM kriteria ORDER BY id";
                    $result = mysqli_query($koneksi, $query);

                    $i = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        $i++;
                        ?>
                        <tr>
                            <td>
                                <?php echo $i ?>
                            </td>
                            <td>
                                <?php echo $row['nama'] ?>
                            </td>
                        </tr>


                    <?php } ?>
                </tbody>
            </table>

        </form>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>