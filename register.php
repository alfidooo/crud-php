<?php
 include_once "config.php";
 
    if(isset($_POST['simpan'])) {
        //ambil data dari form
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];
        $email = htmlspecialchars($_POST['email']);
        //echo $password.'<br>';
        //hash password sebelum menyimpannya ke database (untuk keamanan)
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        //echo $hashed_password;

        
        // Query untk menyimpan data pengguna ke database
        $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
        
        if(mysqli_query($conn, $query)) {
            // Registrasi berhasil, alihkan pengguna ke halaman login
            echo "
            <script>
                alert('Register berhasil!');
            </script>
            ";
            header("Location: login.php");
        } else {
            echo "
            <script>
                alert('Register gagal!');
            </script>
            ";
        }

    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">
        <div class="login-container row mx-auto">
            <div class="col-lg-8 mx-auto col-sm-10 col-md-10">
                <h1 class="text-center">Register</h1>
                <form action="" method="POST">
                    <div class="mb-5">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Isi username anda" required>
                    </div>

                    <div class="mb-5">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <div class="mb-5">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>

                    <a href="index.php" class="btn btn-outline-secondary btn-lg">Back</a>
                    <button type="submit" name="simpan" class="btn btn-outline-success btn-lg col-4">Simpan</button>

                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>