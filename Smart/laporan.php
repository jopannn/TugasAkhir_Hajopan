<?php
include "config.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>SPK Metode SMART</title>
    <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/metro-schemes.css" rel="stylesheet">
    <link href="css/metro-responsive.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h2 style="text-align:center;">LAPORAN PERANGKINGAN SISTEM PENDUKUNG KEPUTUSAN METODE SMART</h2>
        <!-- <p>Tanggal/Waktu: 
            <?php echo date('m/j/Y '); ?>
        </p> -->
        <p style="font-size:20px">Tanggal/Waktu: <span id="tanggalwaktu"></span></p>
        <div class="panel panel-default col-xs-6 col-md-9">
        <div class="panel-body">
            <section class="content">
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
        <br><br>
        <br><br>
        <br><br>
        <br><br><br><br><br>

        <p><strong>Nilai Dasar</strong></p>
        <table class="table striped hovered cell-hovered border bordered">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Alternatif</th>
                    <?php
                    $stmt2 = $db->prepare("select * from smart_kriteria");
                    $stmt2->execute();
                    while ($row2 = $stmt2->fetch()) {
                        ?>
                        <th>
                            <?php echo $row2['nama_kriteria'] ?>
                        </th>
                        <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $db->prepare("select * from smart_alternatif");
                $nox = 1;
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $nox++ ?>
                        </td>
                        <td>
                            <?php echo $row['nama_alternatif'] ?>
                        </td>
                        <?php
                        $stmt3 = $db->prepare("select * from smart_kriteria");
                        $stmt3->execute();
                        while ($row3 = $stmt3->fetch()) {
                            ?>
                            <td>
                                <?php
                                $stmt4 = $db->prepare("select * from smart_alternatif_kriteria where id_kriteria='" . $row3['id_kriteria'] . "' and id_alternatif='" . $row['id_alternatif'] . "'");
                                $stmt4->execute();
                                while ($row4 = $stmt4->fetch()) {
                                    echo $row4['nilai_alternatif_kriteria'];
                                    ?>
                                    <!--<a href="?page=form&alt=<?php echo $row['id_alternatif'] ?>&kri=<?php echo $row3['id_kriteria'] ?>&nilai=<?php echo $row4['nilai_alternatif_kriteria'] ?>" style="color:orange"><span class="mif-pencil icon"></span></a>-->
                                    <?php
                                }
                                ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <br />
        <p><strong>Nilai Perangkingan</strong></p>
        <table class="table striped hovered cell-hovered border bordered">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Alternatif</th>
                    <?php
                    $stmt2x = $db->prepare("select * from smart_kriteria");
                    $stmt2x->execute();
                    while ($row2x = $stmt2x->fetch()) {
                        ?>
                        <th>
                            <?php echo $row2x['nama_kriteria'] ?>
                        </th>
                        <?php
                    }
                    ?>
                    <th>Hasil</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>-</td>
                    <td>Bobot</td>
                    <?php
                    $stmt2x1 = $db->prepare("select * from smart_kriteria");
                    $stmt2x1->execute();
                    while ($row2x1 = $stmt2x1->fetch()) {
                        ?>
                        <td>
                            <?php echo $row2x1['bobot_kriteria'] ?>
                        </td>
                        <?php
                    }
                    ?>
                    <td>-</td>
                   
                </tr>
                <?php
                $stmtx = $db->prepare("select * from smart_alternatif");
                $noxx = 1;
                $stmtx->execute();
                while ($rowx = $stmtx->fetch()) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $noxx++ ?>
                        </td>
                        <td>
                            <?php echo $rowx['nama_alternatif'] ?>
                        </td>
                        <?php
                        $stmt3x = $db->prepare("select * from smart_kriteria");
                        $stmt3x->execute();
                        while ($row3x = $stmt3x->fetch()) {
                            ?>
                            <td>
                                <?php
                                $stmt4x = $db->prepare("select * from smart_alternatif_kriteria where id_kriteria='" . $row3x['id_kriteria'] . "' and id_alternatif='" . $rowx['id_alternatif'] . "'");
                                $stmt4x->execute();
                                while ($row4x = $stmt4x->fetch()) {
                                    $ida = $row4x['id_alternatif'];
                                    $idk = $row4x['id_kriteria'];
                                    echo $kal = $row4x['nilai_alternatif_kriteria'] * $row3x['bobot_kriteria'];
                                    $stmt2x3 = $db->prepare("update smart_alternatif_kriteria set bobot_alternatif_kriteria=? where id_alternatif=? and id_kriteria=?");
                                    $stmt2x3->bindParam(1, $kal);
                                    $stmt2x3->bindParam(2, $ida);
                                    $stmt2x3->bindParam(3, $idk);
                                    $stmt2x3->execute();
                                }
                                ?>
                            </td>
                            <?php
                        }
                        ?>
                        <td>
                            <?php
                            $stmt3x2 = $db->prepare("select sum(bobot_alternatif_kriteria) as bak from smart_alternatif_kriteria where id_alternatif='" . $rowx['id_alternatif'] . "'");
                            $stmt3x2->execute();
                            $row3x2 = $stmt3x2->fetch();
                            $ideas = $rowx['id_alternatif'];
                            echo $hsl = $row3x2['bak'];
                            if ($hsl >= 80) {
                                $ket = "Sangat Layak";
                            } else if ($hsl >= 60) {
                                $ket = "Layak";
                            } else if ($hsl >= 40) {
                                $ket = "Dipertimbangkan";
                            } else {
                                $ket = "Tidak Layak";
                            }
                            ?>
                        </td>
                       
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <button type="button" onclick="location.href='cetakpdf.php'" class="btn btn-primary"><span
                class="fa fa-clone"></span>Cetak Pdf</button>
        <p><br /></p>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/metro.js"></script>
    <script>
        var tw = new Date();
        if (tw.getTimezoneOffset() == 0) (a = tw.getTime() + (7 * 60 * 60 * 1000))
        else (a = tw.getTime());
        tw.setTime(a);
        var tahun = tw.getFullYear();
        var hari = tw.getDay();
        var bulan = tw.getMonth();
        var tanggal = tw.getDate();
        var hariarray = new Array("Minggu,", "Senin,", "Selasa,", "Rabu,", "Kamis,", "Jum'at,", "Sabtu,");
        var bulanarray = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember");
        document.getElementById("tanggalwaktu").innerHTML = hariarray[hari] + " " + tanggal + " " + bulanarray[bulan] + " " + tahun;
    </script>
</body>

</html>