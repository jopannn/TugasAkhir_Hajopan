<?php

include 'header.php';
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.9.1/jquery.tablesorter.min.js" type="text/javascript">
</script>

<script type="text/javascript">
$(document).ready(
         function()  
        {$(".rangking").tablesorter();}
                );
</script>

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
		<div id="container2" style="min-width: 100%; height: 400px; margin: 0 auto ">
            <script src="js/Chart.js"></script>
            <canvas id="myChart" style="width:100%;height:400px;"></canvas>
            <script>
                var ctx = document.getElementById("myChart").getContext("2d");
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [
                            <?php
                            $stmt2x = $db->prepare("select * from smart_alternatif");
                            $stmt2x->execute();
                            while ($row2x = $stmt2x->fetch()) {

                                
                                ?>
                "<?php echo $row2x['nama_alternatif'] ?>",
                                <?php
                            }
                            ?>
                        ],
                        datasets: [{
                            label: '# Nilai SPK',
                            data: [
                                <?php
                                $stmt2y = $db->prepare("select * from smart_alternatif");
                                $stmt2y->execute();
                                while ($row2y = $stmt2y->fetch()) {
                                    echo $row2y['hasil_alternatif'] . ',';
                                }
                                ?>
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.8)',
                                'rgba(54, 162, 235, 0.8)',
                                'rgba(255, 206, 86, 0.8)',
                                'rgba(75, 192, 192, 0.8)',
                                'rgba(153, 102, 255, 0.8)',
                                'rgba(245, 159, 64, 0.8)',
                                'rgba(223, 99, 132, 0.8)',
                                'rgba(45, 162, 235, 0.8)',
                                'rgba(211, 206, 86, 0.8)',
                                'rgba(89, 192, 192, 0.8)',
                                'rgba(233, 99, 132, 0.8)',
                                'rgba(67, 167, 235, 0.8)',
                                'rgba(20, 26, 86, 0.8)',
                                'rgba(67, 42, 12, 0.8)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        title: {
                            display: true,
                            text: 'Hasil Akhir Perangkingan'
                        }
                    }
                });
            </script>
        </div>
        <br/>
		<br>
		<br/>
		<br><br/>
		<br>
		<br/>		<br/>
		<br><br/>
	
	
        <table width="100%" class="table table-striped table-bordered rangking" id="tabeldata ">
	<thead>
		<tr>
			<th width="50">No</th>
			<th>Alternatif/Bobot</th>

            <?php
            $stmt2x = $db->prepare("select * from smart_kriteria");
            $stmt2x->execute();
            while($row2x = $stmt2x->fetch()){
            ?>
			<th><?php echo $row2x['nama_kriteria'] ?> ( <?php echo $row2x['bobot_kriteria'] ?>) </th>
            <?php
            }
            ?>
			<th>Hasil</th>
			
		</tr>
	</thead>
    <tfoot>
		<tr>
			<th width="50">No</th>
			<th>Alternatif/Bobot</th>
            <?php
            $stmt2x = $db->prepare("select * from smart_kriteria");
            $stmt2x->execute();
            while($row2x = $stmt2x->fetch()){
            ?>
			<th><?php echo $row2x['nama_kriteria'] ?> ( <?php echo $row2x['bobot_kriteria'] ?>)</th>
            <?php
            }
            ?>
			<th>Hasil</th>
			
		</tr>
	</tfoot>
	<tbody>
		
		<?php
		$stmtx = $db->prepare("select * from smart_alternatif");
		$noxx = 1;
		$stmtx->execute();
		while($rowx = $stmtx->fetch()){
		?>
		<tr>
			<td><?php echo $noxx++ ?></td>
			<td><?php echo $rowx['nama_alternatif'] ?></td>
            <?php
            $stmt3x = $db->prepare("select * from smart_kriteria");
            $stmt3x->execute();
            while($row3x = $stmt3x->fetch()){
            ?>
			<td>
                <?php
                $stmt4x = $db->prepare("select * from smart_alternatif_kriteria where id_kriteria='".$row3x['id_kriteria']."' and id_alternatif='".$rowx['id_alternatif']."'");
                $stmt4x->execute();
                while($row4x = $stmt4x->fetch()){
                	$ida = $row4x['id_alternatif'];
                	$idk = $row4x['id_kriteria'];
                    echo $kal = $row4x['nilai_alternatif_kriteria']*$row3x['bobot_kriteria'];
                    $stmt2x3 = $db->prepare("update smart_alternatif_kriteria set bobot_alternatif_kriteria=? where id_alternatif=? and id_kriteria=?");
					$stmt2x3->bindParam(1,$kal);
					$stmt2x3->bindParam(2,$ida);
					$stmt2x3->bindParam(3,$idk);
					$stmt2x3->execute();
                }
                ?>
            </td>
            <?php
            }
            ?>
            <td>
            	<?php
            	$stmt3x2 = $db->prepare("select sum(bobot_alternatif_kriteria) as bak from smart_alternatif_kriteria where id_alternatif='".$rowx['id_alternatif']."'");
	            $stmt3x2->execute();
	            $row3x2 = $stmt3x2->fetch();
	            $ideas = $rowx['id_alternatif'];
	            echo $hsl = $row3x2['bak'];
	            if($hsl>=80){
	            	$ket = "Sangat Layak";
	            } else if($hsl>=55){
	            	$ket = "Layak";
	            } else if($hsl>=35){
	            	$ket = "Dipertimbangkan";
	            } else{
	            	$ket = "Tidak Layak";
	            }
	            $stmt2x3y = $db->prepare("update smart_alternatif set hasil_alternatif=?, ket_alternatif=? where id_alternatif=?");
				$stmt2x3y->bindParam(1,$hsl);
				$stmt2x3y->bindParam(2,$ket);
				$stmt2x3y->bindParam(3,$ideas);
				$stmt2x3y->execute();
            	?>
            </td>
           
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
    </div>