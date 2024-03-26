<?php
session_start();
$userid = $_SESSION['userid'];
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
  echo "<script>
    alert('Anda Belum Login!');
    location.href='../index.php';
  </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title> Picture World | Home </title>
   <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="../assets/css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>
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

<div class="container mt-5 pt-5">
  Album :
  <?php
  $album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
  while($row = mysqli_fetch_array($album)){ ?>
  <a href="home.php?albumid=<?php echo $row['albumid']?>" class="btn btn-category px-4 py-2"><?php echo $row['namaalbum']?></a>

  <?php } ?>

	<div class="row">
    <?php
    if (isset($_GET['albumid'])) { 
      $albumid = $_GET['albumid'];
      $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid ='$userid' AND albumid='$albumid'");
      while($data = mysqli_fetch_array($query)){ ?>
      <div class="col-md-3 mt-2">
			<div class="card mb-2 mt-5 bg-dark border-0" style="color: #e8d5c1;" >
            <img src="../assets/img/<?php echo $data['lokasifile']?>" class="img-fluid w-102 rounded" title="<?php echo $data['judulfoto']?>" style="height: 12rem;">
			<div class="card-footer text-center">
				
      <?php
                    $fotoid = $data['fotoid']; 
                    $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                   
                    if (mysqli_num_rows($ceksuka) == 1) { ?>
                      <a href="../config/proses_like.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" class="pic-link" name="batalsuka"><i class="fa-solid fa-heart m-1"></i></a>

                    <?php } else { ?>
                      <a href="../config/proses_like.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" class="pic-link" name="suka"><i class="fa-regular fa-heart m-1"></i></a>

                    <?php }
                    $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($like). ' ';
                    ?>
                   <br>
				<a href="#" type="button" class="pic-link" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i> </a>
        <?php  
        $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
        echo mysqli_num_rows($jmlkomen).' Komentar';
        ?>
				</div>
			</div>
		</div>
    <?php } }else{
$query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
while($data = mysqli_fetch_array($query)){
?>
<div class="col-md-3 mt-2">
			<div class="card">
            <img src="../assets/img/<?php echo $data['lokasifile']?>" class="card-img-top" title="<?php echo $data['judulfoto']?>" style="height: 12rem;">
			<div class="card-footer text-center text-white">
				
      <?php
                    $fotoid = $data['fotoid'];
                    $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                   
                    if (mysqli_num_rows($ceksuka) == 1) { ?>
                      <a href="../config/proses_like.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" class="pic-link" name="batalsuka"><i class="fa-solid fa-heart m-1"></i></a>

                    <?php } else { ?>
                      <a href="../config/proses_like.php?fotoid=<?php echo $data ['fotoid'] ?>" type="submit" class="pic-link" name="suka"><i class="fa-regular fa-heart m-1"></i></a>

                    <?php }
                    $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($like). ' ';
                    ?>
				</div>
			</div>
		</div>
<?php } } ?>
</div>
 </div>



<script type="text/javascript" src="../assets/js/boostrap.min.js"></script>
</body>
</html> 