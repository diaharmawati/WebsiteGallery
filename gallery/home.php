<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GALLERY HOME</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
            body {
        background: radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);
        font-family: 'Poppins', sans-serif;
    }
    .navbar-brand {
        font-size: 1.5rem;
    }
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }
    .card {
        width: 300px;
        margin: 20px;
        height: 100%;
        transition: transform 0.3s ease-in-out;
    }
    .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            transition: background-color 0.3s ease-in-out;
        }

        .card:hover .card-body {
            background-color: rgba(255, 255, 255, 0.8);
        }
    .btn-like,
    .btn-komentar {
        margin: 5px;
    }
    .navbar {
        background-color: #495057;
        height: 100px;
        height: 100px;
    } 
        
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <?php
                        session_start();
                        if (!isset($_SESSION['userid'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-secondary" href="register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-secondary" href="login.php">Login</a>
                        </li>
                    <?php
                        } else {
                    ?>   
                        
                        <li class="nav-item active"><a class="nav-link" href="home.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
                        <li class="nav-item"><a class="nav-link" href="foto.php">Foto</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 card-container">
        <?php
            include "koneksi.php";
            $sql = mysqli_query($conn, "SELECT * FROM foto, user WHERE foto.userid=user.userid");
            while ($data = mysqli_fetch_array($sql)) {
        ?>
            <div class="card">
                <img src="gambar/<?= $data['lokasifile'] ?>" class="card-img-top img-square" alt="<?= $data['judulfoto'] ?>">
                <div class="card-body">
                <p class="card-text"><strong>@<?= $data['namalengkap'] ?></strong></p>
                    <h5 class="card-title"><?= $data['judulfoto'] ?></h5>
                    <p class="card-text"><?= $data['deskripsifoto'] ?></p>
                    <p class="mt-2">Like: <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='" . $data['fotoid'] . "'")); ?></p>
                    <div class="btn-group" role="group" aria-label="Photo Actions">
                        <a href="like.php?fotoid=<?= $data['fotoid'] ?>" class="btn-outline-danger btn-like">
                            <i class="fas fa-heart"></i>
                        </a>
                        <a href="komentar.php?fotoid=<?= $data['fotoid'] ?>" class="btn-outline-secondary btn-komentar">
                            <i class="fas fa-comment"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
