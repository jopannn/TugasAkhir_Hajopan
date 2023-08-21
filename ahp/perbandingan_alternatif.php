<?php
include('config.php');
include('fungsi.php');

$jenis = $_GET['c'];
include 'header.php';
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
        <section class="content">
            <h2 class="ui header">Perbandingan Alternatif &rarr;
                <?php echo getKriteriaNama($jenis - 1) ?>
            </h2>
            <?php showTabelPerbandingan($jenis, 'alternatif'); ?>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>