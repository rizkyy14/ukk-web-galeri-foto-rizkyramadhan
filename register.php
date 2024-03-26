<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Picture World | Register</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/stylelogin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top shadow-md">
  <div class="container">
    <a class="navbar-brand nav-link fw-bold" href="index.php"> <img src="assets/img/pic.png" alt="picture world" width="60" height="60"> </a>
    <a href="index.php" class="btn m-1 py-3 px-4 ms-auto"> Kembali </a>
  </div>
</nav>

<div class="container py-5 px-4 mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="bungkusregis px-5 py-4">
                <div class="card-body">
                    <div class="text-center">
                        <h5>Daftar Pengguna Baru</h5>
                    </div>
                    <form action="config/aksi_register.php" method="POST">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control form-control-sm" required>
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control form-control-sm" required>
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-control-sm" required>
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="namalengkap" class="form-control form-control-sm" required>
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control form-control-sm" required>
                        <div class="d-grid mt-2">
                            <button class="btn btn-primary btn-login py-3" type="submit" name="kirim">Daftar</button>
                        </div>
                    </form>
                    <hr>
                    <small>Sudah Memiliki akun? <a href="login.php" class="btn m-1 py-3 px-4 ms-2 btn-login"> Log In </a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="d-flex justify-content-center mt-3 py-3 mx-auto fixed-bottom">
  <p class="my-1"></p>
  
  </footer>

    
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>