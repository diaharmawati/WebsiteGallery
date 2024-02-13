<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GALLERY REGISTRASI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background: radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);
            font-family: 'Poppins', sans-serif;
        }
        .container{
            max-width: 500px;
            width: 100%;
        }
        form{
            margin-top: 20px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        h1{
            color: #333;
            font-family: 'Arial',sans-serif;
            text-align: center;
        }
        label{
            text-align: right;
            padding-right: 15px;
            color: #333;
        }
        .btn-primary{
            background-color: #6c757d;
            border-color: #495057;
        }
        .btn-primary:hover{
            background-color: #495057;
            border-color: #495057;
        }
        </style>
</head>
<body class="p-4">
    <div class="container">
        <form id="registrationForm" action="proses_register.php" method="post">
            <h1 class="mb-4">Registrasi</h1>

            <div class="form-group row">
                <label for="username" class="col-sm-4 col-form-label">Username</label>
                <div class="col-sm-8">
                    <input type="text" name="username" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="namalengkap" class="col-sm-4 col-form-label">Nama Lengkap</label>
                <div class="col-sm-8">
                    <input type="text" name="namalengkap" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <input type="text" name="alamat" class="form-control" required>
                </div>
            </div>

            <div class="form-group row text-center">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>