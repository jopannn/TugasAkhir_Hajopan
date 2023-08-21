<?php

include('config.php');
include('fungsi.php');


// menghitung perangkingan
$jmlKriteria = getJumlahKriteria();
$jmlAlternatif = getJumlahAlternatif();
$nilai = array();

// mendapatkan nilai tiap alternatif
for ($x = 0; $x <= ($jmlAlternatif - 1); $x++) {
    // inisialisasi
    $nilai[$x] = 0;

    for ($y = 0; $y <= ($jmlKriteria - 1); $y++) {
        $id_alternatif = getAlternatifID($x);
        $id_kriteria = getKriteriaID($y);

        $pv_alternatif = getAlternatifPV($id_alternatif, $id_kriteria);
        $pv_kriteria = getKriteriaPV($id_kriteria);

        $nilai[$x] += ($pv_alternatif * $pv_kriteria);
    }
}

// update nilai ranking
for ($i = 0; $i <= ($jmlAlternatif - 1); $i++) {
    $id_alternatif = getAlternatifID($i);
    $query = "INSERT INTO ranking VALUES ($id_alternatif,$nilai[$i]) ON DUPLICATE KEY UPDATE nilai=$nilai[$i]";
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        echo "Gagal mengupdate ranking";
        exit();
    }
}



?>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>AHP</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="css/jquery.toastmessage.css" rel="stylesheet"/>
	<link rel="stylesheet" href="css/font-awesome.min.css">



	<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
</head>

<div class="container">

<h2 style="text-align:center;">LAPORAN PERANGKINGAN SISTEM PENDUKUNG KEPUTUSAN METODE AHP</h2>
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
                                    $query = "SELECT id,nama,id_alternatif,nilai FROM alternatif,ranking WHERE alternatif.id = ranking.id_alternatif ORDER BY nilai DESC";
                                    $result = mysqli_query($koneksi, $query);

                                    $i = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        $i++;
                                        ?>
                                "<?php echo $row['nama'] ?>",
                                <?php
                                    }


                                    ?>

                                ],
                                datasets: [{
                                    label: '# Nilai SPK',
                                    data: [
                                        <?php
                                    $query = "SELECT id,nama,id_alternatif,nilai FROM alternatif,ranking WHERE alternatif.id = ranking.id_alternatif ORDER BY nilai DESC";
                                    $result = mysqli_query($koneksi, $query);

                                    $i = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        $i++;
                                        ?>
                                "<?php echo $row['nilai'] ?>",
                                <?php
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
                


                <h2 class="ui header">Hasil Perhitungan</h2>
                <table class="ui celled table">
                    <thead>
                        <tr>
                            <th>Overall Composite Height</th>
                            <th>Priority Vector (rata-rata)</th>
                            <?php
                            for ($i = 0; $i <= (getJumlahAlternatif() - 1); $i++) {
                                echo "<th>" . getAlternatifNama($i) . "</th>\n";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        for ($x = 0; $x <= (getJumlahKriteria() - 1); $x++) {
                            echo "<tr>";
                            echo "<td>" . getKriteriaNama($x) . "</td>";
                            echo "<td>" . round(getKriteriaPV(getKriteriaID($x)), 5) . "</td>";

                            for ($y = 0; $y <= (getJumlahAlternatif() - 1); $y++) {
                                echo "<td>" . round(getAlternatifPV(getAlternatifID($y), getKriteriaID($x)), 5) . "</td>";
                            }


                            echo "</tr>";
                        }
                        ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <?php
                            for ($i = 0; $i <= ($jmlAlternatif - 1); $i++) {
                                echo "<th>" . round($nilai[$i], 5) . "</th>";
                            }
                            ?>
                        </tr>
                    </tfoot>

                </table>


                <h2 class="ui header">Perangkingan</h2>

                <table class="ui celled collapsing table">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Alternatif</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT id,nama,id_alternatif,nilai FROM alternatif,ranking WHERE alternatif.id = ranking.id_alternatif ORDER BY nilai DESC";
                        $result = mysqli_query($koneksi, $query);

                        $i = 0;
                        while ($row = mysqli_fetch_array($result)) {
                            $i++;
                            ?>
                            <tr>
                                <?php if ($i == 1) {
                                    echo "<td><div class=\"ui ribbon label\">Pertama</div></td>";
                                } else {
                                    echo "<td>" . $i . "</td>";
                                }

                                ?>

                                <td>
                                    <?php echo $row['nama'] ?>
                                </td>
                                <td>
                                    <?php echo $row['nilai'] ?>
                                </td>
                            </tr>

                            <?php
                        }


                        ?>
                    </tbody>
                </table>
                <a href="cetakpdf.php" target="_blank" class="tombol">cetak pdf</a href="cetakpdf.php" target="_blank">
            </section>
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