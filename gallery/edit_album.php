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
    <title>GALLERY EDIT ALBUM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <style>

        body {
            background: radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);
            font-family: 'Poppins', sans-serif;
        }
        .navbar-brand{
            font: 1.5rem;
        }
        .form-container{
            margin-top: 2opx;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        label{
            text-align: right;
            padding-right: 15px;
            color: #333;
        }
        .btn-secondary{
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover{
            background-color: #495057;
            border-color: #495057;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #495057; height: 100px;">
        <div class="container">
            <a class="navbar-brand" href="#">Edit Album</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
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
            <div class="col-md-6">
                <form action="update_album.php" method="post" class="form-container">
                    <?php
                        include "koneksi.php";
                        $albumid = $_GET['albumid'];
                        $sql = mysqli_query($conn, "select * from album where albumid='$albumid'");
                        while ($data = mysqli_fetch_array($sql)) {
                    ?>
                        <input type="text" name="albumid" value="<?= $data['albumid'] ?>" hidden>
                        <div class="form-group row">
                            <label for="namaalbum" class="col-sm-4 col-form-label">Nama Album</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="namaalbum" name="namaalbum" value="<?= $data['namaalbum'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-4 col-form-label">Deskripsi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $data['deskripsi'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-4">
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
    
</body>
</html>