<?php 
    include "config.php";
    if(!isset($_SESSION["username"])){
        header("Location: login.php");
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $queryDelete = "DELETE FROM books  WHERE id=$id";

        if(mysqli_query($conn, $queryDelete)) {
            header("location:index.php");
        }else {
            echo "data is failed to delete :" .mysqli_error($conn);
        }
    }

?>