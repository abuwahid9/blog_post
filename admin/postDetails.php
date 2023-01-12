<?php
$title = 'post';
include "layout/head.php";



if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = trim($_GET['id']);
    // echo $id;
    // $sql = "SELECT post.id, post.title, post.image, post.is_published, post.created_at, catagory.name as catagoryName, admin.name as author 
    // FROM post
    // INNER JOIN catagory ON post.catagory_id = catagory.id
    // INNER JOIN admin ON post.admin_id = admin.id
    // WHERE post.id=:id";
    $sql = "SELECT post.*, catagory.name as catagoryName, admin.name as author FROM post 
    INNER JOIN catagory ON post.catagory_id = catagory.id 
    INNER JOIN admin ON post.admin_id = admin.id 
    WHERE post.id=:id";
    $stmp = $conn->prepare($sql);
    $stmp->bindparam(':id', $id, PDO::PARAM_INT);
    $stmp->execute();
    $result = $stmp->fetch(PDO::FETCH_OBJ);
    // print_r($result);
}
?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar start -->

    <?php include "layout/sidebard.php"; ?>

    <!-- Sidebar end -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include "layout/topbar.php"; ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Post</h1>
                    <a href="post.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                        <i class="fas fa-backward text-white"></i> Back To list</a>
                </div>

                <!-- Content Row -->
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Post Details</h6>
                    </div>
                    <div class="card-body">

                        <img src="<?php echo $result->image; ?>" alt="">
                        <hr>
                        <h5 class="text-danger card-title"><?php echo $result->catagoryName; ?></h5>
                        <h1><?php echo $result->title; ?></h1>
                        <ul class="list-inline text-info">
                            <li><?php echo $result->author; ?></li>
                            <li><?php echo $result->created_at; ?></li>
                        </ul>
                        <p class="text-dark"><?php echo $result->description; ?></p>
                        <ul class="list-inline d-flex">
                            <li class="pr-1"><i class="fa fa-tag"></i></li>
                            <?php

                            $sql = "SELECT tag.* FROM tag INNER JOIN post_tag ON tag.id = post_tag.tag_id WHERE
                                post_id=:postId";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':postId', $result->id, PDO::PARAM_INT);
                            $stmt->execute();
                            $resultTag = $stmt->fetchAll(PDO::FETCH_OBJ);
                            if ($resultTag) {
                                foreach ($resultTag as $key => $tag) { ?>
                                    <li class="mr-2 badge border"><?php echo $tag->name; ?></li>
                            <?php
                                }
                            }
                            ?>

                        </ul>
                    </div>
                    <!-- Content Row -->

                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
                <?php
                include "layout/footer.php";
                // include 'layout/_sript.php';
                // include "layout/datatable.php";
                ?>