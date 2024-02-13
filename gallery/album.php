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
    <title>GALLERY ALBUM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background: radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);
            font-family: 'Poppins', sans-serif;
        }
        .navbar-brand{
            font-size: 1.5rem;
        }
        .navbar{
            background-color: #495057;
            height: 100px;
        }
        .navbar-toggler-icon{
            background-color: #fff;
        }
        .form-container{
            margin-top: 50px;
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
        .album-card{
            margin-bottom: 50px;
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
            <a class="navbar-brand" href="#">Album</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item active"><a class="nav-link" href="album.php">Album</a></li>
                    <li class="nav-item"><a class="nav-link" href="foto.php">Foto</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="tambah_album.php" method="post" class="mt-4 form-container">
                    <div class="form-group row">
                        <label for="namaalbum" class="col-sm-4 col-form-label">Nama Album</label>
                        <div class="col-sm-8">
                            <input type="text" name="namaalbum" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-4 col-form-label">Deskripsi</label>
                        <div class="col-sm-8">
                            <input type="text" name="deskripsi" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-4">
                            <button type="submit" class="btn btn-secondary">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container mt-4">
        <div class="row">
            <?php
            include "koneksi.php";
            $userid = $_SESSION['userid'];
            $sql = mysqli_query($conn, "select * from album where userid='$userid'");
            while ($data = mysqli_fetch_array($sql)) {
            ?>
            <div class="col-md-4 album-card">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?=$data['namaalbum']?></h5>
                        <p class="card-text"><?=$data['deskripsi']?></p>
                        <p class="card-text"><small class="text-muted">Tanggal dibuat: <?=$data['tanggaldibuat']?></small></p>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group" role="group" aria-label="Album Actions">
                            <a href="hapus_album.php?albumid=<?=$data['albumid']?>" class="btn btn-outline-danger" onclick="return confirm('Anda yakin ingin menghapus foto ini?')">
                            <i class="fas fa-trash"></i> Hapus
                         </a>
                            <a href="edit_album.php?albumid=<?=$data['albumid']?>"  class="btn btn-outline-secondary">
                             <i class="fas fa-edit"></i> Edit
                         </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>