<?php
$title = 'tag';
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
                    <h1 class="h3 mb-0 text-gray-800">Tags</h1>
                    <a href="tagCreate.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-md text-white"></i>
                        Add new Tag</a>
                </div>

                <!-- Content Row -->
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tag List</h6>
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
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM tag";
                                    $statement = $conn->query($sql);
                                    $tags = $statement->fetchAll(PDO::FETCH_OBJ);
                                    // print_r($tags);
                                    if ($tags) {
                                        foreach ($tags as $key => $tag) { ?>
                                            <tr>
                                                <td> <?php echo $key + 1; ?> </td>
                                                <td> <?php echo $tag->name; ?> </td>
                                                <td> <?php echo $tag->slug; ?> </td>
                                                <td>
                                                    <a href="tagEdit.php?id=<?php echo $tag->id; ?>" class="btn btn-success">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="tagDelete.php?id=<?php echo $tag->id; ?>" onclick="return confirm('Are you sure to Delele?')" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
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