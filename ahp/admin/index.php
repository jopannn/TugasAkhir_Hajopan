<?php
include('config.php');
include('fungsi.php');

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
    <p style="margin-bottom:10px;">
            <strong style="font-size:20pt;">Decision Support System with Analytical Hierarcy Process (AHP) Method</strong>
        </p>
        <div class="panel panel-default col-xs-6 col-md-12">
            <img src="images/ayamm.png" srcset="" class="img-responsive" alt="Responsive image">
            <div class="panel-body">

                <p style="font-size:15pt; text-align: justify;">
                    Analytical Hierachy Process (AHP) merupakan suatu model pendukung keputusan yang dikembangkan oleh
                    Thomas L. Saaty sekitar tahun 1970. Proses pengambilan keputusan pada dasarnya terdiri dari memilih
                    opsi terbaik. Seperti menstrukturkan masalah, menentukan alternatif, menentukan kemungkinan nilai
                    variabel peluang, menetapkan nilai, persyaratan waktu, dan menentukan risiko
                </p>
                <br>
                <p style="font-size:15pt; text-align: justify;">
                    Kelebihan AHP : <br>
                    1. Struktur yang berhirarki, sebagai konsekwensi dari kriteria yang dipilih, sampai pada subkriteria
                    yang paling dalam <br>
                    2. Memperhitungkan validitas sampai dengan batas toleransi inkosistensi berbagai kriteria dan
                    alternatif yang dipilih oleh para pengambil keputusan <br>
                    3. Memperhitungkan daya tahan atau ketahanan output analisis sensitivitas pengambilan keputusan.<br>
                    4. Memecahkan masalah yang multi obyektif dan multi-kriteria yang berdasarkan pada perbandingan
                    preferensi dari setiap elemen dalam hirarki

                </p>
                <br>
                <p style="font-size:15pt; text-align: justify;">
                    Salah satu strategi yang dapat digunakan untuk menentukan pemilihan pakan ternak ayam broiler adalah
                    dengan membandingkan beberapa pakan ayam, lalu melakukan perhitungan untuk mengetahui pakan mana
                    yang paling bagus berdasarkan jenis pakan, harga, kandungan nutrisi, bahan baku. Strategi yang
                    dilakukan ini akan menggunakan metode Analytical Hierachy Process (AHP) yang termasuk kedalam metode
                    SPK (Sistem Pendukung Keputusan).
                </p>
            </div>
        </div>
        <br />
    </div>
</div>
        
    </div>
</div>