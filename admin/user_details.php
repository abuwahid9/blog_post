<?php
$title = 'user';
include "layout/head.php";
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
                    <h1 class="h3 mb-0 text-gray-800">Users</h1>
                    <!-- <a href="postCreate.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus-circle fa-md text-white">
                        </i> Add new Post</a> -->
                </div>

                <!-- Content Row -->
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> <?php echo $_SESSION['success'] ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                            unset($_SESSION['success']);
                        }
                        ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Create Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM admin";
                                    $stmt = $conn->query($sql);
                                    $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
                                    if ($posts) {
                                        foreach ($posts as $key => $post) { ?>
                                            <tr>
                                                <td><?php echo $post->id; ?></td>
                                                <td><?php echo $post->name; ?></td>
                                                <td><?php echo $post->email; ?></td>
                                                <td><?php echo $post->status; ?></td>
                                                <td>
                                                    <a href="#">
                                                        <?php
                                                        $printDate = date_create($post->created_time);
                                                        echo $printDate->format("d-m-Y");
                                                        ?>
                                                    </a>
                                                </td>
                                                <!-- <td>
                                                    <?php //if ($post->is_published == 'Published') { ?>
                                                        <span class="badge badge-success">Published</span>
                                                    <?php //} else { ?>
                                                        <span class="badge badge-danger">Draft</span>
                                                    <?php
                                                   // }
                                                    ?>
                                                </td> -->
                                                <!-- <td>
                                                    <a href="postDetails.php?id=<?php //echo $post->id ?>" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="postEdit.php?id=<?php //echo $post->id ?>" class="btn btn-success btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="postDelete.php?id=<?php //echo $post->id ?>" onclick="return confirm('Are you sure to delete this post?')" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td> -->
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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