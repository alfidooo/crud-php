<?php 
    // crud -> create, read, update, delete
    // database -> mysql => untuk menyimpan data
    // database -> rak buku
        // table -> buku
            // field -> 
            // Auto Increment -> otomatis akan bertambah sendiri id nya
    
    // cara menghubungkan coding/project dengan database

    // menghubungkan koneksi kedatabase melalui dile config.php
    include_once "config.php";
    if (!isset($_COOKIE["username"]) && !isset($_COOKIE["username"])){
        //header("Location: login.php");
        echo '<script language="javascript">';
        echo 'alert("Anda harus login terlebih dahulu"); location.href="login.php"';
        echo '</script>';
    }
    $books = [];
    


    // ketika button search di tekan
    if (isset($_POST["search"])) {
        $search = htmlspecialchars($_POST["searchPost"]);
        
        $queryBlog = mysqli_query($conn, "SELECT * FROM books 
                                        WHERE judul LIKE '%$search%' 
                                        OR kategori LIKE '%$search%'");
    
        while ($blog = mysqli_fetch_assoc($queryBlog)) {
            $blogs[] = $blog;
        }
    }else {
        // If no search is performed, you can display all blog posts here.
        $queryBooks = mysqli_query($conn, "SELECT * FROM books");

        while($book = mysqli_fetch_assoc($queryBooks)) {
            $books[] = $book;
            // var_dump($blog[] = $blog);
        }
        
        $limit = 5;
        $totalbooks = count($books);
            $totalPages = ceil($totalbooks / $limit);
            
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($currentPage - 1) * $limit;
             
        // modifed query with pagination
            $querybooks = mysqli_query($conn, "SELECT * FROM books LIMIT $limit OFFSET $offset");

        // Reset $books array before fetching paginated data
        $books = [];
        while ($book = mysqli_fetch_assoc($querybooks)) {
            $books[] = $book;
      }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blogs</title>
    <!-- css link boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- style start -->
    <style>
        body {
            background-image : url("img/back.jpg") ;
            background-size: cover;
            background-position: center;
        }
    </style>

     <!-- style end -->
    
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
                <a class="nav-link" href="logout.php">Logout</a>
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

    <!-- blog start -->
    <div class="container mt-5">
        <h1 class="text-white">Daftar Postingan</h1>
        <a href="tambah.php" class="btn btn-outline-light btn-lg mt-5">Tambah Postingan</a>

        <!-- searching menu start-->
        <form action="" method="POST">
            <div class="row mt-5">
                <div class="col-lg-6 col-sm-10">
                    <input type="text" class="form-control" name="searchPost">
                </div>
                <div class="col-4">
                    <button type="submit" name="search" class="btn btn-success">Search</button>
                </div>
            </div>
        </form>
        <!-- searching menu end-->

        <table class="table mt-5">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Gambar</th>
                    <th>Isi</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($books as $row) : ?>
             <tr>
                <td><?= $row["judul"];?></td>
                <td>
                    <img src="<?=$row['gambar'];?>" alt="images" width="200px">
                </td>
                <td><?= $row["isi"];?></td>
                <td><?= $row["kategori"];?></td>
                <td>
                    <a href="delete.php?id=<?=$row['id'];?>" class="btn btn-danger" onclick="return confirm('do you want to delete?')">Delete</a>

                    <a href="edit.php?id=<?=$row['id']; ?>" class="btn btn-warning">Edit</a>
                </td>
             </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <!-- Pagination Controls -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
                    <li class="page-item <?php if ($page == $currentPage) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?= $page; ?>"><?= $page; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
    <!-- blog end -->

    


    <!-- link javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>