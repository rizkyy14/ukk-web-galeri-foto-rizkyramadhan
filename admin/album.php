<?php
session_start();
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
    <title>Picture World | Category</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top shadow-md">
        <div class="container">
            <a class="navbar-brand nav-link fw-bold" href="index.php">
                <img src="../assets/img/pic.png" alt="picture world" width="60" height="60">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto fw-bold">
                    <a href="home.php" class="nav-link me-5">Home</a>
                    <a href="album.php" class="nav-link me-5">Album</a>
                    <a href="foto.php" class="nav-link me-5">Foto</a>
                    <a href="profil.php" class="nav-link">Profil</a>
                </div>
                <a href="../config/aksi_logout.php" class="btn m-1 py-3 pb-3 pt-3 px-4 text-white ms-auto">Log Out</a>
                <a href="index.php" class="btn m-1 py-3 pb-3 pt-3 px-4 text-white">Kembali</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4 mt-5 pt-5 ms-auto me-auto">
                <div class="card mt-2">
                    <div class="card-header bg-dark" style="color: #e8d5c1;">Tambah Album</div>
                    <div class="card-body">
                        <form action="../config/aksi_album.php" method="POST">
                            <label class="form-label">Nama Album</label>
                            <input type="text" name="namaalbum" class="form-control form-control-sm mb-3" required>
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control form-control-sm" name="deskripsi" required></textarea>
                            <button type="submit" class="btn mt-3 px-5 py-3 btn-album ms-5" name="tambah">Tambahkan Album</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-5 pt-5 me-auto">
                <div class="card mt-2">
                    <div class="card-header bg-dark" style="color: #e8d5c1;">Data Album</div>
                    <div class="card-body">
                        <div class="card">
                            <?php
                            $no = 1;
                            $userid = $_SESSION['userid'];
                            $sql = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                            while ($data = mysqli_fetch_array($sql)) {
                            ?>
                                <div class="card-body">
                                    <h3><?php echo $data['namaalbum'] ?><small>&nbsp;&nbsp;&nbsp;<?php echo $data['tanggaldibuat'] ?></small></h3>
                                    <p><?php echo $data['deskripsi'] ?></p>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-primary px-4 py-2 btn-album" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['albumid'] ?>">Edit</button>
                                        </div>
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-dark" style="color: #e8d5c1;">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Album</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../config/aksi_album.php" method="POST">
                                                            <input type="hidden" name="albumid" value="<?php echo $data['albumid'] ?>">
                                                            <label class="form-label">Nama Album</label>
                                                            <input type="text" name="namaalbum" value="<?php echo $data['namaalbum'] ?>" class="form-control form-control-sm" required>
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea class="form-control form-control-sm" name="deskripsi" required><?php echo $data['deskripsi']; ?></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="edit" class="btn btn-primary px-5 py-3">Edit Data</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <button type="button" class="btn btn-danger px-4 py-2 btn-album" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['albumid'] ?>">Hapus</button>
                                        </div>
                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="hapus<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-dark" style="color: #e8d5c1;">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Album</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../config/aksi_album.php" method="POST">
                                                            <input type="hidden" name="albumid" value="<?php echo $data['albumid'] ?>">
                                                            Apakah anda yakin ingin menghapus album <strong><?php echo $data['namaalbum'] ?> ?</strong>
                                                    </div> 
                                                    <div class="modal-footer">
                                                        <button type="submit" name="hapus" class="btn btn-primary px-5 py-2">Hapus Album</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>