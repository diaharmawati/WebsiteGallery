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
    <title>GALLERY EDIT FOTO</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">

<style>
        body {
            background: radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);
            font-family: 'Poppins', sans-serif;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        .form-container {
            margin-top: 50px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        label {
            text-align: right;
            padding-right: 15px;
            color: #333;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #495057;
            border-color: #495057;
        }
        .navbar{
            background-color: #495057;
            height: 100px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Edit Foto</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="album.php">Album</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="foto.php">Foto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="update_foto.php" method="post" enctype="multipart/form-data" class="form-container">
                    <?php
                    include "koneksi.php";
                    $fotoid = $_GET['fotoid'];
                    $sql = mysqli_query($conn, "select * from foto where fotoid='$fotoid'");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                        <input type="text" name="fotoid" value="<?= $data['fotoid'] ?>" hidden>
                        <div class="form-group row">
                            <label for="judulfoto" class="col-sm-3 col-form-label">Judul</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="judulfoto" value="<?= $data['judulfoto'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsifoto" class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="deskripsifoto" value="<?= $data['deskripsifoto'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lokasifile" class="col-sm-3 col-form-label">Lokasi File</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" name="lokasifile">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="albumid" class="col-sm-3 col-form-label">Album</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="albumid">
                                    <?php
                                    $userid = $_SESSION['userid'];
                                    $sql2 = mysqli_query($conn, "select * from album where userid='$userid'");
                                    while ($data2 = mysqli_fetch_array($sql2)) {
                                    ?>
                                        <option value="<?= $data2['albumid'] ?>" <?php if ($data2['albumid'] == $data['albumid']) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $data2['namaalbum'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-secondary">Ubah</button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>


    <!-- Add Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
