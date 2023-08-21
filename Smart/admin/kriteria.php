<?php
session_start();
if (!isset($_SESSION['username'])) {
    ?>
    <script>window.location.assign("../login.php")</script>
    <?php
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
        <?php
        if ($page == 'form') {
            ?>

        </div>
        <p></p>
        <?php
        if (isset($_POST['simpan'])) {
            $stmt = $db->prepare("select sum(bobot_kriteria) as bbtk from smart_kriteria");
            $stmt->execute();
            $row = $stmt->fetch();
            if ($_POST['bobot'] <= 100) {
                $bbt = $_POST['bobot'] / 100;
                $bbtk = $bbt + $row['bbtk'];
                if ($bbtk <= 1) {
                    $nama = $_POST['nama'];
                    $bobot = $_POST['bobot'] / 100;
                    $stmt2 = $db->prepare("insert into smart_kriteria values('',?,?)");
                    $stmt2->bindParam(1, $nama);
                    $stmt2->bindParam(2, $bobot);
                    if ($stmt2->execute()) {
                        ?>
                        <script type="text/javascript">location.href = 'kriteria.php'</script>
                        <?php
                    } else {
                        ?>
                        <script type="text/javascript">alert('Gagal menyimpan data')</script>
                        <?php
                    }
                } else {
                    ?>
        <script type="text/javascript">alert('Bobot haruslah 100% jika dijumlahkan semua kriteria')</script>
        <?php
                }
            } else {
                ?>
        <script type="text/javascript">alert('Maaf nilai bobot maksimal 100')</script>
        <?php
            }
        }
        if (isset($_POST['update'])) {
            $stmt = $db->prepare("select sum(bobot_kriteria) as bbtk from smart_kriteria");
            $stmt->execute();
            $row = $stmt->fetch();
            if ($_POST['bobot'] <= 100) {
                $bbt = $_GET['bobot'];
                $bbt2 = $_POST['bobot'] / 100;
                $bbtk = $row['bbtk'] - $bbt;
                $bbtk2 = $bbtk + $bbt2;
                if ($bbtk2 <= 1) {
                    $id = $_POST['id'];
                    $nama = $_POST['nama'];
                    $bobot = $_POST['bobot'] / 100;
                    $stmt2 = $db->prepare("update smart_kriteria set nama_kriteria=?, bobot_kriteria=? where id_kriteria=?");
                    $stmt2->bindParam(1, $nama);
                    $stmt2->bindParam(2, $bobot);
                    $stmt2->bindParam(3, $id);
                    if ($stmt2->execute()) {
                        ?>
                    <script type="text/javascript">location.href = 'kriteria.php'</script>
                    <?php
                    } else {
                        ?>
                        <script type="text/javascript">alert('Gagal mengubah data')</script>
                       
                        <?php
                    }
                } else {
                    ?>
        <script type="text/javascript">alert('Bobot haruslah 100% jika dijumlahkan semua kriteria')</script>
        <?php
                }
            } else {
                ?>
        <script type="text/javascript">alert('Maaf nilai bobot maksimal 100')</script>
        <?php
            }
        }
        ?>
        <p style="margin-bottom:10px;">
            <strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Nilai Kriteria</strong>
        </p>

        <div class="panel panel-default col-xs-6 col-md-9">
            <div class="panel-body">

                <form method="post">
                    <input type="hidden" class="form-control" id="id" name="id"
                        value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                    <div class="form-group">
                        <label for="kriteria">Kriteria</label>
                        <input type="text" class="form-control" id="kriteria" name="nama" placeholder="Nama Kriteria"
                            value="<?php echo isset($_GET['nama']) ? $_GET['nama'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="bobot">Bobot Nilai</label>
                        <input type="text" class="form-control" id="bobot" name="bobot" placeholder="Bobot"
                            value="<?php echo isset($_GET['bobot']) ? $_GET['bobot'] * 100 : ''; ?>" required>
                    </div>
                    <?php
                    if (isset($_GET['id'])) {
                        ?>
                        <button type="button" onclick="location.href='kriteria.php'" class="btn btn-success"><span
                                class="fa fa-history"></span> Kembali</button>
                        <button type="submit" name="update" class="btn btn-warning"><span class="fa fa-save"></span>
                            Update</button>
                        <?php
                    } else {
                        ?>
                        <button type="button" onclick="location.href='kriteria.php'" class="btn btn-success"><span
                                class="fa fa-history"></span> Kembali</button>
                        <button type="submit" name="simpan" class="btn btn-primary"><span class="fa fa-save"></span>
                            Simpan</button>
                        <?php
                    }
                    ?>
                </form>
            </div>
        </div>

    </div>
    </div>


    <!-- <div class="panel panel-default">
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                    </div>
                    <div class="form-group col-auto ">
                        <label for="nm">Nama Kriteria</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Kriteria"
                            value="<?php echo isset($_GET['nama']) ? $_GET['nama'] : ''; ?>">
                    </div>
                    <div class="form-group col-auto">
                        <label for="nm">Bobot Kriteria</label>
                        <input type="text" class="form-control" name="bobot" placeholder="Bobot %"
                            value="<?php echo isset($_GET['bobot']) ? $_GET['bobot'] * 100 : ''; ?>">
                    </div>
                    <?php
                    if (isset($_GET['id'])) {
                        ?>
                        <button type="submit" class="btn btn-primary" name="update" class="button warning">Update</button>
                        <?php
                    } else {
                        ?>
                        <button type="submit" lass="btn btn-success" name="simpan" class="button primary">Simpan</button>
                        <?php
                    }
                    ?>
                </form> -->


    <?php
        } else if ($page == 'hapus') {
            ?>
        <div class="cell colspan2 align-right">
        </div>
        </div>
        <?php
        if (isset($_GET['id'])) {
            $stmt = $db->prepare("delete from smart_kriteria where id_kriteria='" . $_GET['id'] . "'");
            if ($stmt->execute()) {
                ?>
                <script type="text/javascript">location.href = 'kriteria.php'</script>
                <?php
            }
        }
        } else {
            ?>

        <form method="post">
            <div class="row">
                <div class="col-md-6 text-left">
                    <strong style="font-size:18pt;"><span class="fa fa-modx"></span> Kriteria</strong>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" onclick="location.href='?page=form'" class="btn btn-primary"><span
                            class="fa fa-clone"></span> Tambah Data</button>
                </div>
            </div>
            <br />

            <table width="100%" class="table table-striped table-bordered" id="tabeldata">
                <thead>
                    <tr>
                        <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>

                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th><input type="checkbox" name="select-all2" id="select-all2" /></th>

                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                </tfoot>
                <?php
                $stmt = $db->prepare("select * from smart_kriteria");
                $stmt->execute();
                $no = 1;
                while ($row = $stmt->fetch()) {
                    ?>
                    <tr>
                        <td>
                        <?php echo $no++ ?>
                        </td>
                        <td>
                        <?php echo $row['nama_kriteria'] ?>
                        </td>
                        <td>
                        <?php echo $row['bobot_kriteria'] ?>
                        </td>
                        <!-- <td class="align-center">
                <a href="?page=form&id=<?php echo $row['id_kriteria'] ?>&nama=<?php echo $row['nama_kriteria'] ?>&bobot=<?php echo $row['bobot_kriteria'] ?>" class="button warning"><span class="mif-pencil icon"></span> Edit</a>
                <a href="?page=hapus&id=<?php echo $row['id_kriteria'] ?>" class="button danger"><span class="mif-cancel icon"></span> Hapus</a>
            </td> -->
                        <td class="text-center" style="vertical-align:middle;">
                            <a href="?page=form&id=<?php echo $row['id_kriteria'] ?>&nama=<?php echo $row['nama_kriteria'] ?>&bobot=<?php echo $row['bobot_kriteria'] ?>"
                                class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            <a href="?page=hapus&id=<?php echo $row['id_kriteria'] ?>"
                                onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span
                                    class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <!-- <tbody>
            <tr>
                <td>
                  1
                </td>
                <td>
                    asdfa
                </td>
                <td>
                    asdfa
                </td>
                <td>
                    asdfa
                </td>
                <td class="text-center" style="vertical-align:middle;">
                        <a href="" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a href="" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    </td>
            </tr>
        </tbody>

    </table> -->
        </form>

        <?php
        }

        ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
