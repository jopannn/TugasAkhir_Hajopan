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
            <li class="active"><span class="fa fa-modx"></span> Sub Kriteria</li>
        </ol>

        <?php
        if ($page == 'form') {
            ?>

        </div>
        <p></p>
        <?php
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama'];
            $nilai = $_POST['nilai'];
            $kriteria = $_POST['kriteria'];
            $stmt2 = $db->prepare("insert into smart_sub_kriteria values('',?,?,?)");
            $stmt2->bindParam(1, $nama);
            $stmt2->bindParam(2, $nilai);
            $stmt2->bindParam(3, $kriteria);
            if ($stmt2->execute()) {
                ?>
                <script type="text/javascript">location.href = 'sub_kriteria.php'</script>
                <?php
            } else {
                ?>
                <script type="text/javascript">alert('Gagal menyimpan data')</script>
                <?php
            }
        }
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $nilai = $_POST['nilai'];
            $kriteria = $_POST['kriteria'];
            $stmt2 = $db->prepare("update smart_sub_kriteria set nama_sub_kriteria=?, nilai_sub_kriteria=?, id_kriteria=? where id_sub_kriteria=?");
            $stmt2->bindParam(1, $nama);
            $stmt2->bindParam(2, $nilai);
            $stmt2->bindParam(3, $kriteria);
            $stmt2->bindParam(4, $id);
            if ($stmt2->execute()) {
                ?>
                <script type="text/javascript">location.href = 'subkriteria.php'</script>
                <?php
            } else {
                ?>
                <script type="text/javascript">alert('Gagal mengubah data')</script>
                <?php
            }
        }
        ?>
        <p style="margin-bottom:10px;">
            <strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Sub Kriteria</strong>
        </p>
        <div class="panel panel-default col-xs-6 col-md-9">
            <div class="panel-body">

                <form method="post">
                    <input type="hidden" class="form-control" id="id" name="id"
                        value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">

                    <div class="form-group">
                        <label for="bobot">Kriteria</label>
                        <select name="kriteria" id="bobot" class="form-control">
                            <option value="<?php echo isset($_GET['kriteria']) ? $_GET['kriteria'] : ''; ?>"><?php echo isset($_GET['kriteria']) ? $_GET['kriteria'] : ''; ?></option>
                            <?php
                            $stmt3 = $db->prepare("select * from smart_kriteria");
                            $stmt3->execute();
                            while ($row3 = $stmt3->fetch()) {
                                ?>
                                <option value="<?php echo $row3['id_kriteria'] ?>"><?php echo $row3['nama_kriteria'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kriteria">Sub Kriteria</label>
                        <input type="text" class="form-control" id="kriteria" name="nama"  placeholder="Nama Sub Kriteria"
                value="<?php echo isset($_GET['nama']) ? $_GET['nama'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="bobot">Nilai</label>
                        <input type="text" class="form-control" id="bobot" name="nilai" placeholder="Nilai Sub Kriteria"
                value="<?php echo isset($_GET['nilai']) ? $_GET['nilai'] : ''; ?>" required>
                    </div>


                


                <?php
                if (isset($_GET['id'])) {
                    ?>
                    <button type="button" onclick="location.href='sub_kriteria.php'" class="btn btn-success"><span
                            class="fa fa-history"></span> Kembali</button>
                    <button type="submit" name="update" class="btn btn-warning"><span class="fa fa-save"></span> Update</button>
                    <?php
                } else {
                    ?>
                    <button type="button" onclick="location.href='sub_kriteria.php'" class="btn btn-success"><span
                            class="fa fa-history"></span> Kembali</button>
                    <button type="submit" name="simpan" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
                    <?php
                }
                ?>
                </form>
            </div>
        </div>
    </div>
    <?php
        } else if ($page == 'hapus') {
            ?>
        <div class="cell colspan2 align-right">
        </div>
        </div>
        <?php
        if (isset($_GET['id'])) {
            $stmt = $db->prepare("delete from smart_sub_kriteria where id_sub_kriteria='" . $_GET['id'] . "'");
            if ($stmt->execute()) {
                ?>
                <script type="text/javascript">location.href = 'subkriteria.php'</script>
                <?php
            }
        }
        } else {
            ?>
        <!-- <div class="cell colspan2 align-right">
        <a href="?page=form" class="button primary">Tambah</a>
    </div>
</div> -->
        <div class="row">
            <div class="col-md-6 text-left">
                <strong style="font-size:18pt;"><span class="fa fa-modx"></span>Sub Kriteria</strong>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" onclick="location.href='?page=form'" class="btn btn-primary"><span
                        class="fa fa-clone"></span> Tambah Data</button>
            </div>
        </div>
        <form method="post">

            <br />

            <table width="100%" class="table table-striped table-bordered" id="tabeldata">
                <thead>
                    <tr>
                        <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>
                        <th>Kriteria</th>
                        <th>Sub Kriteria</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th><input type="checkbox" name="select-all2" id="select-all2" /></th>
                        <th>Kriteria</th>
                        <th>Sub Kriteria</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
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
                            <?php
                            //$stmt2 = $db->prepare("select * from smart_sub_kriteria a left join smart_kriteria b on a.id_kriteria=b.id_kriteria");
                            $stmt2 = $db->prepare("select * from smart_sub_kriteria where id_kriteria='" . $row['id_kriteria'] . "'");
                            $stmt2->execute();
                            while ($row2 = $stmt2->fetch()) {
                                ?>

                            <?php echo $row2['nama_sub_kriteria'] ?>&nbsp;
                                <br><br>

                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            //$stmt2 = $db->prepare("select * from smart_sub_kriteria a left join smart_kriteria b on a.id_kriteria=b.id_kriteria");
                            $stmt2 = $db->prepare("select * from smart_sub_kriteria where id_kriteria='" . $row['id_kriteria'] . "'");
                            $stmt2->execute();
                            while ($row2 = $stmt2->fetch()) {
                                ?>
                            <?php echo $row2['nilai_sub_kriteria'] ?>&nbsp;
                                <br><br>
                                <?php
                            }
                            ?>

                        </td>
                        <td>
                            <?php
                            //$stmt2 = $db->prepare("select * from smart_sub_kriteria a left join smart_kriteria b on a.id_kriteria=b.id_kriteria");
                            $stmt2 = $db->prepare("select * from smart_sub_kriteria where id_kriteria='" . $row['id_kriteria'] . "'");
                            $stmt2->execute();
                            while ($row2 = $stmt2->fetch()) {
                                ?>
                                <a href="?page=form&id=<?php echo $row2['id_sub_kriteria'] ?>&nama=<?php echo $row2['nama_sub_kriteria'] ?>&nilai=<?php echo $row2['nilai_sub_kriteria'] ?>&kriteria=<?php echo $row2['id_kriteria'] ?>"
                                    class="btn btn-warning"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                <a href="?page=hapus&id=<?php echo $row2['id_sub_kriteria'] ?>" class="btn btn-danger "> <span
                                        class="glyphicon glyphicon-trash" aria-hidden="true"></a><br />
                                <?php
                            }
                            ?>

                        </td>


                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </form>
        <?php
        }

        ?>

