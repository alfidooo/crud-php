<?php 
    include "config.php";

    if(!isset($_COOKIE["username"]) && !isset($_SESSION["username"])){
        header("Location: login.php");
    }
    
    $id = $_GET['id'];
    $book = mysqli_query($conn,"SELECT * FROM books WHERE id=$id");
    $qBook = mysqli_fetch_assoc($book);
    
    if(isset($_POST['simpan'])) {
        $judul = htmlspecialchars($_POST['judul']);
        $gambar = htmlspecialchars($_POST['gambar']);
        $isi = htmlspecialchars($_POST['isi']);
        $kategori = htmlspecialchars($_POST['kategori']);

        // query update
        $sql = "UPDATE books SET judul= '$judul', gambar='$gambar', isi='$isi', kategori='$kategori' WHERE id=$id";
        $query = mysqli_query($conn,$sql);

        // jika update berhasil
        if($query) {
            echo '<script language="javascript">';
            echo 'alert("Successfully Update"); location.href="index.php"';
            echo '</script>';
        }else {
            // kalau gagal tampilkan pesan
            die("Gagal menyimpan perubahan...");
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT</title>
    <!-- css link boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- form start -->
    <div class="container mt-5">
        <div class="row">
            <h1>Halaman EDIT</h1>
        </div>
        <div class="row my-5">
            <div class="col-8">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-5">
                        <label for="judul" class="form-label">Judul Postingan</label>
                        <input type="text" class="form-control" name="judul" id="judul" value="<?=$qBook['judul']?>">
                    </div>


                    <div class="mb-5">
                        <label for="judul" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="judul" value="<?=$qBook['gambar']?>"> 
                        <p><?= $qBook["gambar"]; ?></p>
                    </div>


                    <div class="mb-5">
                        <label for="Isi" class="form-label">Isi Postingan</label>
                        <textarea class="form-control" id="Isi" name="isi" rows="3">
                            <?=$qBook['isi']?>
                        </textarea>
                    </div>


                    <div class="mb-5">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select">
                            <option value="<?=$qBook['kategori'];?>"><?=$qBook['kategori'];?></option>
                            <option value="Coding">Coding</option>
                            <option value="Design">Design</option>
                            <option value="Personal">Personal</option>
                        </select>
                    </div>


                    <a href="index.php" class="btn btn-outline-secondary btn-lg">Back</a>
                    <button type="submit" name="simpan" class="btn btn-outline-success btn-lg col-4">Simpan</button>

                </form>
            </div>
        </div>
    </div>
    <!-- form end -->

    <!-- link javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>