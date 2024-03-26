<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Picture World | Login</title>
    <link rel="stylesheet" href="assets/css/stylelogin.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg fixed-top shadow-md">
      <div class="container">
        <a class="navbar-brand nav-link fw-bold" href="index.php"> <img src="assets/img/pic.png" alt="picture world" width="60" height="60" /> </a>
        <a href="index.php" class="btn m-1 py-3 px-4 ms-auto"> Kembali </a>
      </div>
    </nav>

    <div class="container py-5 mt-5 mb-5">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="bungkuslogin px-5 py-2">
            <div class="card-body">
              <div class="text-center">
                <h5 class="pt-3">Login User</h5>
              </div>
              <form action="config/aksi_login.php" method="POST" class="mt-5">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control form-control-sm mb-3" required />
                <label class="form-label me-5 pe-4">Password</label>
                <span toggle="#pwd" class="fa-solid fa-eye field-icon toggle-password ms-5 ps-5 "></span>
                <input type="password" id="pwd" name="password" class="form-control form-control-sm" required />
                <div class="d-grid mt-2">
                  <button class="btn py-3 mt-2 btn-login" type="submit" name="kirim">Log In</button>
                </div>
              </form>
              <hr />
              <small>Belum Memiliki akun? <a href="register.php" class="btn m-1 py-3 px-4 ms-2 pe-4 btn-login"> Daftar </a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="d-flex justify-content-center mt-3 py-3 mx-auto fixed-bottom">
      <p class="my-2"></p>
    </footer>

    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      const togglePassword = document.querySelector('.toggle-password');
const password = document.querySelector('#pwd');

togglePassword.addEventListener('click', function (e) {
  // toggle the type attribute
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);

  // toggle the eye icon
  this.classList.toggle('fa-eye');
  this.classList.toggle('fa-eye-slash');
});

    </script>
  </body>
</html>
