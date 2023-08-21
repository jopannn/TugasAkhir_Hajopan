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
        <div id="container2" style="min-width: 100%; height: 400px; margin: 0 auto">
        <div class="col-xs-12 col-sm-12 col-md-10">
    <p style="margin-bottom:10px;">
            <strong style="font-size:20pt;">Decision Support System with Simple Multi Attribute Rating Technique (SMART) Method</strong>
        </p>
        
    <div class="panel panel-default col-xs-6 col-md-12">
        <img src="../images/ayamm.png"  srcset="" class="img-responsive" alt="Responsive image">
            <div class="panel-body">
                          
        <p style="font-size:15pt; text-align: justify;">
        Metode Simple Multi Attribute Rating Technique adalah metode pengambilan keputusan multi kriteria yang dikembangkan oleh Edward pada tahun 1997. Metode SMART didasarkan pada teori yang terdiri dari seperangkat kriteria di mana setiap pilihan memiliki nilai, dan setiap kriteria memiliki bobot yang menunjukkan seberapa penting nilai  bobot tersebut dibandingkan dengan kriteria lainnya
        </p>
        <br>
        <p style="font-size:15pt; text-align: justify;">
        Metode SMART lebih umum digunakan karena dapat dengan mudah menjawab kebutuhan dan menganalisis tanggapan pembuat keputusan. SMART menggunakan model aditif linier untuk memprediksi nilai setiap alternatif dan fleksibel dalam cara pengambilan keputusan. Metode ini memahami masalah dengan lebih baik dan diterima oleh pengambil keputusan
        </p>
        <br>
        <p  style="font-size:15pt; text-align: justify;">
        Salah satu strategi yang dapat digunakan untuk menentukan pemilihan pakan ternak ayam broiler adalah dengan membandingkan beberapa pakan ayam, lalu melakukan perhitungan untuk mengetahui pakan mana yang paling bagus berdasarkan jenis pakan, harga, kandungan nutrisi, bahan baku. Strategi yang dilakukan ini akan menggunakan metode  SMART (Simple Multi-Atrribute Rating Technique) yang termasuk kedalam metode SPK (Sistem Pendukung Keputusan).
        </p>
        </div>
    </div>
        <br />
    </div>
        </div>
        <br />
    </div>
</div>