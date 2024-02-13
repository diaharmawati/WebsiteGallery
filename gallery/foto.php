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
    <title>GALLERY FOTO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        .table th, .table td {
            text-align: justify;
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
        <a class="navbar-brand" href="#">Foto</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
                <li class="nav-item active"><a class="nav-link" href="foto.php">Foto</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="container mt-5">
                <form action="tambah_foto.php" method="post" enctype="multipart/form-data" class="form-container">
                    <div class="form-group row">
                        <label for="judulfoto" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-8">
                            <input type="text" name="judulfoto" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsifoto" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-8">
                            <input type="text" name="deskripsifoto" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasifile" class="col-sm-2 col-form-label">Lokasi File</label>
                        <div class="col-sm-8">
                            <input type="file" name="lokasifile" class="form-control-file">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="albumid" class="col-sm-2 col-form-label">Album</label>
                        <div class="col-sm-8">
                            <select name="albumid" class="form-control">
                                <?php
                                include "koneksi.php";
                                $userid=$_SESSION['userid'];
                                $sql=mysqli_query($conn,"select * from album where userid='$userid'");
                                while($data=mysqli_fetch_array($sql)){
                                ?>
                                    <option value="<?=$data['albumid']?>"><?=$data['namaalbum']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-2">
                            <button type="submit" class="btn btn-secondary">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <div class="container mt-5">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggal Unggah</th>
                <th>Lokasi File</th>
                <th>Album</th>
                <th>Disukai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include "koneksi.php";
                $userid = $_SESSION['userid'];
                $sql = mysqli_query($conn, "SELECT * FROM foto, album WHERE foto.userid='$userid' AND foto.albumid=album.albumid");
                while ($data = mysqli_fetch_array($sql)) {
            ?>
                <tr>
                    <td><?=$data['fotoid']?></td>
                    <td><?=$data['judulfoto']?></td>
                    <td><?=$data['deskripsifoto']?></td>
                    <td><?=$data['tanggalunggah']?></td>
                    <td>
                        <img src="gambar/<?=$data['lokasifile']?>" width="200px" class="rounded">
                    </td>
                    <td><?=$data['namaalbum']?></td>
                    <td>
                        <?php
                            $fotoid = $data['fotoid'];
                            $sql2 = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($sql2);
                        ?>
                    </td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Photo Actions">
                        <a href="hapus_foto.php?fotoid=<?=$data['fotoid']?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus foto ini?')">
                            <i class="fas fa-trash"></i> Hapus
                         </a>
                        <a href="edit_foto.php?fotoid=<?=$data['fotoid']?>" class="btn btn-outline-secondary btn-sm">
                             <i class="fas fa-edit"></i> Edit
                         </a>
                    </div>
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>