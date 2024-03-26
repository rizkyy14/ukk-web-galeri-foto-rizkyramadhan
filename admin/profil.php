<?php
    session_start();
	include '../config/koneksi.php';
	if($_SESSION['status'] != true){
		echo '<script>window.location="login.php"</script>';
    }
	$query = mysqli_query($koneksi, "SELECT * FROM user WHERE userid ='".$_SESSION['userid']."'");
	$d = mysqli_fetch_object($query);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB Galeri Foto</title>
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-expand-lg fixed-top shadow-md">
  <div class="container">
    <a class="navbar-brand nav-link fw-bold" href="index.php"> <img src="../assets/img/pic.png" alt="picture world" width="60" height="60"> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav mx-auto fw-bold">
        <a href="home.php" class="nav-link me-5">Home</a>
        <a href="album.php" class="nav-link me-5">Album</a>
        <a href="foto.php" class="nav-link me-5"> Foto </a>
        <a href="profil.php" class="nav-link"> Profil </a>
      </div>
    
      <a href="../config/aksi_logout.php" class="btn m-1 py-3 pb-3 pt-3 px-4 text-white ms-auto"> Log Out </a>
       <a href="index.php" class="btn m-1 py-3 pb-3 pt-3 px-4 text-white"> Kembali </a>
    </div>
  </div>
</nav>
    
    <!-- content -->
    <div class="section mt-5 pt-5">
        <div class="container mt-5">
            <h3>Profil</h3>
            <div class="col-md-4">
               <form action="" method="POST">
                   <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control form-control-sm mb-3" value="<?php echo $d->namalengkap ?>" required>
                   <input type="text" name="user" placeholder="Username" class="form-control form-control-sm mb-3" value="<?php echo $d->username ?>" required>
                   <input type="email" name="hp" placeholder="No Hp" class="form-control form-control-sm mb-3" value="<?php echo $d->email ?>" required>
                   <input type="text" name="alamat" placeholder="alamat" class="form-control form-control-sm mb-3" value="<?php echo $d->alamat ?>" required>
                   <input type="submit" name="submit" value="Ubah Profil" class="btn btn-category px-5 py-3">
               </form>
               <?php
                   if(isset($_POST['submit'])){
					   
					   $nama   = $_POST['namalengkap'];
					   $user   = $_POST['username'];
					   $email  = $_POST['email'];
					   $alamat = $_POST['alamat'];
					   
					   $update = mysqli_query($conn, "UPDATE tb_admin SET 
					                 namalengkap = '".$nama."',
									  username = '".$user."',
						
									  email = '".$email."',
									  alamat = '".$alamat."'
									  WHERE userid = '".$d->userid."'");
					   if($update){
						   echo '<script>alert("Ubah data berhasil")</script>';
						   echo '<script>window.location="profil.php"</script>';
					   }else{
						   echo 'gagal '.mysqli_error($conn);
					   }
					   
					}  
			   ?>
            </div>
            
            <h3 class="mt-4">Edit Password</h3>
            <div class="col-md-4">
               <form action="" method="POST">
                   <input type="password" name="pass1" placeholder="Password Baru" class="form-control form-control-sm mb-3" required>
                   <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="form-control form-control-sm mb-3" required>
                   <input type="submit" name="ubah_password" value="Ubah Password" class="btn btn-category px-5 py-3">
               </form>
               <?php
                   if(isset($_POST['ubah_password'])){
					   
					   $pass1   = $_POST['pass1'];
					   $pass2   = $_POST['pass2'];
					   
					   if($pass2 != $pass1){
						   echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
					   }else{
						   $u_pass = mysqli_query($koneksi, "UPDATE user SET 
									  password = '".$pass1."'
									  WHERE userid = '".$d->userid."'");
						   if($u_pass){
							   echo '<script>alert("Ubah data berhasil")</script>';
						       echo '<script>window.location="profil.php"</script>';
						   }else{
							   echo 'gagal '.mysqli_error($koneksi);
						   }
					   }
					  
					}  
			   ?>
            </div>
        </div>
        </div>
    </div>
    
    <!-- footer -->
    <footer> 
        <div class="container">
        </div>
    </footer>
</body>
</html>