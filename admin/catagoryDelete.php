<?php
session_start();
$filepath = dirname(__FILE__);
include $filepath . "/../admin/config/data_base.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = trim($_GET['id']);
    $sql = "DELETE FROM catagory WHERE id=:id";
    $stmp = $conn->prepare($sql);
    $stmp->bindparam(':id', $id, PDO::PARAM_INT);
    $stmp->execute();    
    $_SESSION['success'] = 'Catagory delete successfully';
    header('location:catagory.php');
}
