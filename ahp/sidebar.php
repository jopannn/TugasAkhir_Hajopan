<style type="text/css">
   a {
   color: #dd4814;
   }
   
   
</style>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="fa fa-dashboard"></span> Dashboard</h3>
    </div>

    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="index.php" class="font"><span class="fa fa-home"></span> Beranda</a></li>

        </ul>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="fa fa-file"></span> Input Data</h3>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="alternatif.php"><span class="fa fa-book"></span> Alternatif</a></li>
        </ul>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="fa fa-cogs"></span> Analisa Data</h3>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="perbandingan_kriteria.php"><span class="fa fa-bolt"></span>
                    Perbandingan Kriteria</a></li>
            <li role="presentation"><a href="perbandingan_alternatif.php"><span class="fa fa-bolt"></span>
                    Perbandingan Alternatif</a></li>
            <ul>
                <?php

                if (getJumlahKriteria() > 0) {
                    for ($i = 0; $i <= (getJumlahKriteria() - 1); $i++) {
                        echo "<li><a class='item' href='perbandingan_alternatif.php?c=" . ($i + 1) . "'>" . getKriteriaNama($i) . "</a></li>";
                    }
                }

                ?>
            </ul>
            <li role="presentation"><a href="hasil.php"><span class="fa fa-bolt"></span> Rangking</a></li>
            <li role="presentation"><a href="laporan.php" target="_blank"><span
                        class="fa fa-file-pdf-o"></span>Laporan</a></li>
        </ul>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="fa fa-cogs"></span> Admin</h3>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="login.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
                    Login</a></li>

        </ul>
    </div>
</div>
<!-- <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-database"></span> Admin Area</h3>
              </div>
              <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                  <li role="presentation"><a href="profil.php"><span class="fa fa-user"></span> Profil</a></li>
                  <li role="presentation"><a href="user.php"><span class="fa fa-users"></span> Pengguna</a></li>
                  <li role="presentation"><a href="logout.php"><span class="fa fa-sign-out"></span> Logout</a></li>
                </ul>
              </div>
            </div> -->