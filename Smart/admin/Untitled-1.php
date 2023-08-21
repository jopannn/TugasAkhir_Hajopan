<?php
include "header_new.php";
$page = isset($_GET['page'])?$_GET['page']:"";
?>
<div class="row cells4">
	<div class="cell colspan2">
		<h3>Kriteria</h3>
	</div>
<?php
if($page=='form'){
?>
	<div class="cell colspan2 align-right">
		<a href="kriteria.php" class="button info">Kembali</a>
	</div>
</div>
	<p></p>
	<?php
	if(isset($_POST['simpan'])){
		$stmt = $db->prepare("select sum(bobot_kriteria) as bbtk from smart_kriteria");
		$stmt->execute();
		$row = $stmt->fetch();
		if($_POST['bobot']<=100){
			$bbt = $_POST['bobot']/100;
			$bbtk = $bbt+$row['bbtk'];
			if($bbtk<=1){
				$nama = $_POST['nama'];
				$bobot = $_POST['bobot']/100;
				$stmt2 = $db->prepare("insert into smart_kriteria values('',?,?)");
				$stmt2->bindParam(1,$nama);
				$stmt2->bindParam(2,$bobot);
				if($stmt2->execute()){
					?>
					<script type="text/javascript">location.href='kriteria.php'</script>
					<?php
				} else{
					?>
					<script type="text/javascript">alert('Gagal menyimpan data')</script>
					<?php
				}
			} else{
				?>
				<script type="text/javascript">alert('Bobot haruslah 100% jika dijumlahkan semua kriteria')</script>
				<?php
			}
		} else{
			?>
				<script type="text/javascript">alert('Maaf nilai bobot maksimal 100')</script>
			<?php
		}
	}
	if(isset($_POST['update'])){
		$stmt = $db->prepare("select sum(bobot_kriteria) as bbtk from smart_kriteria");
		$stmt->execute();
		$row = $stmt->fetch();
		if($_POST['bobot']<=100){
			$bbt = $_GET['bobot'];
			$bbt2 = $_POST['bobot']/100;
			$bbtk = $row['bbtk']-$bbt;
			$bbtk2 = $bbtk+$bbt2;
			if($bbtk2<=1){
				$id = $_POST['id'];
				$nama = $_POST['nama'];
				$bobot = $_POST['bobot']/100;
				$stmt2 = $db->prepare("update smart_kriteria set nama_kriteria=?, bobot_kriteria=? where id_kriteria=?");
				$stmt2->bindParam(1,$nama);
				$stmt2->bindParam(2,$bobot);
				$stmt2->bindParam(3,$id);
				if($stmt2->execute()){
					?>
					<script type="text/javascript">location.href='kriteria.php'</script>
					<?php
				} else{
					?>
					<script type="text/javascript">alert('Gagal mengubah data')</script>
					<?php
				}
			} else{
				?>
				<script type="text/javascript">alert('Bobot haruslah 100% jika dijumlahkan semua kriteria')</script>
				<?php
			}
		} else{
			?>
				<script type="text/javascript">alert('Maaf nilai bobot maksimal 100')</script>
			<?php
		}
	}
	?>
	<form method="post">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id'])? $_GET['id'] : ''; ?>">
		<label>Kriteria</label>
		<div class="input-control text full-size">
		    <input type="text" name="nama" placeholder="Nama Kriteria" value="<?php echo isset($_GET['nama'])? $_GET['nama'] : ''; ?>">
		</div>
		<label>Bobot</label>
		<div class="input-control text full-size">
		    <input type="text" name="bobot" placeholder="Bobot %" value="<?php echo isset($_GET['bobot'])? $_GET['bobot']*100 : ''; ?>">
		</div>
		<?php
		if (isset($_GET['id'])) {
			?>
			<button type="submit" name="update" class="button warning">Update</button>
			<?php
		} else{
			?>
			<button type="submit" name="simpan" class="button primary">Simpan</button>
			<?php
		}
		?>
	</form>
<?php
} else if($page=='hapus'){
?>
	<div class="cell colspan2 align-right">
	</div>
</div>
<?php
	if(isset($_GET['id'])){
		$stmt = $db->prepare("delete from smart_kriteria where id_kriteria='".$_GET['id']."'");
	 	if($stmt->execute()){
	 		?>
	 		<script type="text/javascript">location.href='kriteria.php'</script>
	 		<?php
	 	}
	}
} else{
?>
	<div class="cell colspan2 align-right">
		<a href="?page=form" class="button primary">Tambah</a>
	</div>
</div>
<table class="table striped hovered cell-hovered border bordered dataTable" data-role="datatable" data-searching="true">
	<thead>
		<tr>
			<th width="50">ID</th>
			<th>Kriteria</th>
			<th width="50">Bobot</th>
			<th width="240">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$stmt = $db->prepare("select * from smart_kriteria");
		$stmt->execute();
        $no = 1;
		while($row = $stmt->fetch()){
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $row['nama_kriteria'] ?></td>
			<td><?php echo $row['bobot_kriteria'] ?></td>
			<td class="align-center">
				<a href="?page=form&id=<?php echo $row['id_kriteria'] ?>&nama=<?php echo $row['nama_kriteria'] ?>&bobot=<?php echo $row['bobot_kriteria'] ?>" class="button warning"><span class="mif-pencil icon"></span> Edit</a>
				<a href="?page=hapus&id=<?php echo $row['id_kriteria'] ?>" class="button danger"><span class="mif-cancel icon"></span> Hapus</a>
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
<p><br/></p>
<?php
}

?>
					
					