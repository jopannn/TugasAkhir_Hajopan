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

include('header.php');

?>
<div class="row">
    <div class="col-xs-14 col-sm-14 col-md-2">
        <?php

        include_once 'sidebar.php';
        ?>
    </div>
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
                
                
            </section>