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
    <title>Picture World | Photo</title>
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
                <div class="navbar-nav ms-auto fw-bold">
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
            <div class="col-md-4 mt-5 pt-5">
                <div class="card mt-2">
                    <div class="card-header bg-dark" style="color: #e8d5c1;">Tambah Foto</div>
                    <div class="card-body">
                        <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                            <label class="form-label">Judul Foto</label>
                            <input type="text" name="judulfoto" class="form-control form-control-sm mb-3" required>
                            <label class="form-label">Deskripsi Foto</label>
                            <textarea class="form-control form-control-sm mb-3" name="deskripsifoto" required></textarea>
                            <label class="form-label">Album</label>
                            <select class="form-select form-control-sm mb-3" name="albumid" required>
                                <?php
                                $userid = $_SESSION['userid'];
                                $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                                while ($data_album = mysqli_fetch_array($sql_album)) { 
                                ?>
                                    <option value="<?php echo $data_album['albumid'] ?>"><?php echo $data_album['namaalbum'] ?></option>
                                <?php } ?>
                            </select>
                            <label class="form-label">File</label>
                            <input type="file" class="form-control form-control-sm mb-3" name="lokasifile" required>
                            <button type="submit" class="btn mt-3 px-5 ms-5 py-3 btn-foto" name="tambah">Tambah Foto</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-5 pt-5 me-auto">
                <div class="card mt-2">
                    <div class="card-header bg-dark" style="color: #e8d5c1;">Data Album</div>
                    <div class="card-body">
                        <div class="card">
                            <div>
                                <?php
                                $no = 1;
                                $userid = $_SESSION['userid'];
                                $sql = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                    <div class="card-body">
                                        <img src="../assets/img/<?php echo $data['lokasifile'] ?>" width="200">
                                        <h5><?php echo $data['judulfoto'] ?></h5>
                                        <p class="mt-1"><?php echo $data['deskripsifoto'] ?></p>
                                        <p class="mb-1"><?php echo $data['tanggalunggah'] ?></p>
                                    </div>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-primary btn-foto ms-2" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['fotoid'] ?>">Edit</button>
                                    </div>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="edit<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-dark" style="color: #e8d5c1;">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Foto</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                        <label class="form-label">Judul Foto</label>
                                                        <input type="text" name="judulfoto" value="<?php echo $data['judulfoto'] ?>" class="form-control form-control-sm mb-3" required>
                                                        <label class="form-label">Deskripsi Foto</label>
                                                        <textarea class="form-control form-control-sm mb-3" name="deskripsifoto" required><?php echo $data['deskripsifoto']; ?></textarea>
                                                        <label class="form-label">Album</label>
                                                        <select class="form-control form-control-sm mb-3" name="albumid">
                                                            <?php
                                                            $userid = $_SESSION['userid'];
                                                            $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                                                            while ($data_album = mysqli_fetch_array($sql_album)) {
                                                            ?>
                                                                <option <?php if ($data_album['albumid'] == $data['albumid']) { ?> selected="selected" <?php } ?> value="<?php echo $data_album['albumid'] ?>"><?php echo $data_album['namaalbum'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label class="form-label">Foto</label>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <img src="../assets/img/<?php echo $data['lokasifile'] ?>" width="100">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <label class="form-label">Ganti File</label>
                                                                <input type="file" class="form-control form-control-sm" name="lokasifile">
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="edit" class="btn btn-primary px-5 py-2">Edit Foto</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <button type="button" class="btn btn-danger btn-foto mb-5 ms-2" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['fotoid'] ?>">Hapus</button>
                                    </div>

                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapus<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-dark" style="color: #e8d5c1;">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Foto</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../config/aksi_foto.php" method="POST">
                                                        <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                        Apakah anda yakin ingin menghapus foto <strong><?php echo $data['judulfoto'] ?> ?</strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="hapus" class="btn btn-primary px-5 py-2">Hapus Foto</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>