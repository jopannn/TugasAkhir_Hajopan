<?php
session_start();
if(!isset($_SESSION['username'])){
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
            <li class="active"><span class="fa fa-modx"></span> Alternatif</li>
        </ol>
        <?php
        if ($page == 'form') {
            ?>
            <div class="cell colspan2 align-right">
                <a href="alternatif.php" class="button info">Kembali</a>
            </div>
        </div>
        <p></p>
        <?php
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama'];
            $stmt2 = $db->prepare("insert into smart_alternatif(id_alternatif,nama_alternatif) values('',?)");
            $stmt2->bindParam(1, $nama);
            if ($stmt2->execute()) {
                ?>
                <script type="text/javascript">location.href = 'alternatif.php'</script>
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
            $stmt2 = $db->prepare("update smart_alternatif set nama_alternatif=? where id_alternatif=?");
            $stmt2->bindParam(1, $nama);
            $stmt2->bindParam(2, $id);
            if ($stmt2->execute()) {
                ?>
                <script type="text/javascript">location.href = 'alternatif.php'</script>
                <?php
            } else {
                ?>
                <script type="text/javascript">alert('Gagal mengubah data')</script>
                <?php
            }
        }
        ?>
       <p style="margin-bottom:10px;">
            <strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Alternatif</strong>
        </p>
        
        <div class="panel panel-default col-xs-6 col-md-9">
            <div class="panel-body">

                <form method="post">
                <input type="hidden" class="form-control" id="id" name="id"  value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" >
                    <div class="form-group">
                        <label for="kriteria">Kriteria</label>
                        <input type="text" class="form-control" id="kriteria" name="nama" placeholder="Nama Alternatif"
                    value="<?php echo isset($_GET['nama']) ? $_GET['nama'] : ''; ?>"   required>
                    </div>

                    
                
            

        <?php
        if (isset($_GET['id'])) {
            ?>
            <button type="button" onclick="location.href='alternatif.php'" class="btn btn-success"><span class="fa fa-history"></span> Kembali</button>
            <button type="submit" name="update" class="btn btn-warning"><span class="fa fa-save"></span> Update</button>
            <?php
        } else {
            ?>
            <button type="button" onclick="location.href='alternatif.php'" class="btn btn-success"><span class="fa fa-history"></span> Kembali</button>
            <button type="submit" name="simpan" class="btn btn-primary"><span class="fa fa-save"></span>  Simpan</button>
            <?php
        }
        ?>
        </form>
        </div>
        </div>
        <?php
        } else if ($page == 'hapus') {
            ?>
            <div class="cell colspan2 align-right">
            </div>
        </div>
        </div>
        <?php
        if (isset($_GET['id'])) {
            $stmt = $db->prepare("delete from smart_alternatif where id_alternatif='" . $_GET['id'] . "'");
            if ($stmt->execute()) {
                ?>
                <script type="text/javascript">location.href = 'alternatif.php'</script>
                <?php
            }
        }
        } else {
            ?>

        <form method="post">
            <div class="row">
                <div class="col-md-6 text-left">
                    <strong style="font-size:18pt;"><span class="fa fa-modx"></span>Alternatif</strong>
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
                        <th width="50">ID</th>
                        <th>Alternatif</th>
                        <th width="240">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $db->prepare("select * from smart_alternatif");
                    $stmt->execute();
                    $no = 1;
                    while ($row = $stmt->fetch()) {
                        ?>
                        <tr>
                            <td>
                            <?php echo $no++ ?>
                            </td>
                            <td>
                            <?php echo $row['nama_alternatif'] ?>
                            </td>
                            <td class="align-center">
                                <a href="?page=form&id=<?php echo $row['id_alternatif'] ?>&nama=<?php echo $row['nama_alternatif'] ?>"
                                    class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                <a href="?page=hapus&id=<?php echo $row['id_alternatif'] ?>" class="btn btn-danger"><span
                                        class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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