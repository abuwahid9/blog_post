<?php
session_start();
$filepath = dirname(__FILE__);
include $filepath . "/../admin/config/data_base.php";

if (isset($_GET['id']) && !empty($_GET['id'])){

    $id = $_GET['id'];
    
    /*select post image for delete */
    $sql = "SELECT * FROM post WHERE id=:id";
    $selectStmt = $conn->prepare($sql);
    $selectStmt->bindParam(':id', $id, PDO::PARAM_INT);
    $selectStmt->execute();
    $row = $selectStmt->fetch(PDO::FETCH_OBJ);
    if (isset($row->image)){
        unlink($row->image);
    }
    /*Delete record*/
    try {
        $sql = "DELETE FROM post WHERE id=:id";
        $deleteStmt = $conn->prepare($sql);
        $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($deleteStmt->execute()) {
            session_start();
            $_SESSION['success'] = "Post delete successfully";
            header("location:post.php");
        }
    }catch (PDOException $e) {
        die("ERROR: Could not prepare/execute query: $sql. " . $e->getMessage());
    }
}



// if (isset($_GET['id']) && !empty($_GET['id'])) {
//     $id = $_GET['id'];
//     $sql = "DELETE FROM post WHERE id=:id";
//     $stmp = $conn->prepare($sql);
//     $stmp->bindparam(':id', $id, PDO::PARAM_INT);
//     $stmp->execute();
//     $_SESSION['success'] = 'post delete successfully';
//     header('location:post.php');
// }
?>