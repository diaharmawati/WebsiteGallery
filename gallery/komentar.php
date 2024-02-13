<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GALLERY KOMENTAR</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">

    <style>
        body {
            background: radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #495057;
            height: 100px;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        .navbar-toggler-icon {
            background-color: #fff;
        }

        .container {
            margin-top: 20px;
        }

        .form-container,
        .card {
            border-radius: 20px;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
            border-radius: 15px 15px 0 0;
        }

        .list-group-item {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 15px;
            margin-bottom: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .list-group-item:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .mt-0 {
            color: #343a40;
        }

        .text-muted {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Komentar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
                    <li class="nav-item"><a class="nav-link" href="foto.php">Foto</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="form-container">
                    <form action="tambah_komentar.php" method="post" onsubmit="return validateForm()">
                        <?php
                        include "koneksi.php";
                        $fotoid = $_GET['fotoid'];
                        $sql = mysqli_query($conn, "select * from foto where fotoid='$fotoid'");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <input type="text" name="fotoid" value="<?= $data['fotoid'] ?>" hidden>
                            <div class="form-group row">
                                <label for="judulfoto" class="col-sm-4 col-form-label">Judul</label>
                                <div class="col-sm-8">
                                    <input type="text" name="judulfoto" value="<?= $data['judulfoto'] ?>"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deskripsifoto" class="col-sm-4 col-form-label">Deskripsi</label>
                                <div class="col-sm-8">
                                    <input type="text" name="deskripsifoto" value="<?= $data['deskripsifoto'] ?>"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lokasifile" class="col-sm-4 col-form-label">Foto</label>
                                <div class="col-sm-8">
                                    <img src="gambar/<?= $data['lokasifile'] ?>" width="200px" class="rounded">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="isikomentar" class="col-sm-4 col-form-label">Komentar</label>
                                <div class="col-sm-8">
                                    <input type="text" name="isikomentar" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-8 offset-sm-4">
                                    <button type="submit" class="btn btn-secondary">Tambah</button>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Komentar
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php
                        include "koneksi.php";
                        $userid=$_SESSION['userid'];
                        $sql=mysqli_query($conn,"select * from komentarfoto,user where komentarfoto.userid=user.userid");
                        while($data=mysqli_fetch_array($sql)){
                        ?>
                            <li class="list-group-item">
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-0"><?= $data['namalengkap'] ?></h5>
                                        <p><?= $data['isikomentar'] ?></p>
                                        <small class="text-muted"><?= $data['tanggalkomentar'] ?></small>
                                    </div>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function validateForm() {
            var isikomentar = document.getElementsByName("isikomentar")[0].value;
            var errorElement = document.getElementById("isikomentarError");

            if (isikomentar.trim() === "") {
                errorElement.innerHTML = "Komentar tidak boleh kosong";
                return false;
            } else {
                errorElement.innerHTML = "";
                return true;
            }
        }
    </script>
</body>

</html>
