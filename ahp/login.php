<?php
include "../smart/config.php";

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
    <script src="js/jquery.js"></script>
    <script src="js/metro.js"></script>
</head>

<body onload="runPB1()">
    <div class="app-bar" style="background-color: #dd4814;">
        <a class="app-bar-element" href="login.php">SMART AHP</a>
    </div>

    <h2 style="text-align:center;margin:100px auto 0 auto;">Login Admin</h2>
    <div style="margin:15px auto;width:320px;background:#eee;border:1px solid #ddd;padding:20px;">
        <?php
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $user = $_POST['username'];
            $pass = md5($_POST['password']);
            $stmt = $db->prepare("SELECT * from smart_admin where username='$user' and password='$pass' limit 0,1");
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row['username'] == $user && $row['password'] = $pass) {
                session_start();
                $_SESSION['id'] = $row['id_admin'];
                $_SESSION['nama'] = $row['nama_admin'];
                $_SESSION['username'] = $row['username'];
                ?>
                <div class="progress ani large" id="pb1" data-animate="500" data-color="ribbed-amber" data-role="progress">
                </div>
                <script>
                    var interval1;
                    function runPB1() {
                        clearInterval(interval1);
                        var pb = $("#pb1").data('progress');
                        var val = 0;
                        interval1 = setInterval(function () {
                            val += 10;
                            pb.set(val);
                            if (val >= 100) {
                                location.href = 'admin/index.php';
                                val = 0;
                                clearInterval(interval1);
                            }
                        }, 100);
                    }
                </script>
                <?php
            } else {
                ?>
                <script>
                    $.Notify({
                        caption: 'Maaf',
                        content: 'Anda mungkin salah memasukkan username dan password, silahkan coba lagi!',
                        type: 'alert'
                    });
                </script>
                <?php
            }
        }
        ?>
        <form method="post">
            <p></p>
            <!-- input[type=text] -->
            <div class="input-control text full-size">
                <label>Username</label>
                <span class="mif-user prepend-icon"></span>
                <input type="text" name="username" placeholder="admin untuk dasar username" required>
            </div>
            <p></p>
            <!-- input[type=password] -->
            <div class="input-control password full-size">
                <label>Password</label>
                <span class="mif-key prepend-icon"></span>
                <input type="password" name="password" placeholder="admin untuk dasar password" required>
            </div>
            <button type="submit" class="button primary" style="text-align:center;">Masuk</button>
        </form>
    </div>

</body>

</html>