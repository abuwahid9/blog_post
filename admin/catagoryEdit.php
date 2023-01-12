<?php
$title = 'catagory';
include "layout/head.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catagory_name = $_POST['catagory_name'];
    $catagory_slug = $_POST['catagory_slug'];
    $catagoryId = $_POST['catagoryId'];
    // echo $catagory_name, $catagory_slug;

    if (empty($catagory_name)) {
        $error['catagoryNameErro'] = "catagory name is required.";
    } else {
        $data['catagoryName'] = $catagory_name;
    }
    if (empty($catagory_slug)) {
        $error['catagorySlugErro'] = "catagory slug is required.";
    } else {
        $data['catagorySlug'] = $catagory_slug;
    }

    if (empty($error['catagoryNameErro']) || empty($error['catagorySlugErro'])) {

       try {
        $sql = "UPDATE catagory SET name=:name,slug=:slug WHERE id=:id";
        if ($stmpt = $conn->prepare($sql)) {
            $stmpt->bindparam(':name', $data['catagoryName'], PDO::PARAM_STR);
            $stmpt->bindparam(':slug', $data['catagorySlug'], PDO::PARAM_STR);
            $stmpt->bindparam(':id', $catagoryId, PDO::PARAM_INT);
            if ($stmpt->execute()) {
                $_SESSION['success'] = 'Catagory UPDATE successfully';
                header('location:catagory.php');
            }
        }
       } catch (PDOException $e) {
            die('Could insert catagory'.$sql.$e->getMessage());
       }

    }
}

/* get URL id */
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = trim($_GET['id']);
    // echo $id;
    $sql = "SELECT * FROM catagory WHERE id=:id";
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
                    <h1 class="h3 mb-0 text-gray-800">Catagory</h1>
                    <a href="catagory.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                        <i class="fas fa-backward text-white"></i> Back To list</a>
                </div>

                <!-- Content Row -->
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Catagory List</h6>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                            <div class="form-group">
                                <label for="catagory_name">Catagory Name</label>
                                <input type="text" name="catagory_name" value="<?php echo $result->name ??'';?>" class="form-control" id="catagory_name">
                                <small id="emailHelp" class="form-text text-danger">
                                    <?php
                                    echo ($error['catagoryNameErro']) ?? '';
                                    ?>

                                </small>
                            </div>
                            <div class="form-group">
                                <label for="catagory_slug">Slug</label>
                                <input type="text" name="catagory_slug" value="<?php echo $result->slug ??'';?>" class="form-control" id="catagory_slug">
                                <small id="emailHelp" class="form-text text-danger">
                                    <?php
                                    echo ($error['catagorySlugErro']) ?? '';
                                    ?>
                                </small>
                            </div>
                                <input type="hidden" name="catagoryId" value="<?php echo $result->id??''?>">                
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
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

            <script>
                $('#catagory_name').on('keyup', function() {
                    $('#catagory_slug').val('')
                    var catagory = $(this).val();
                    // console.log(catagoty);
                    // catagory = catagory.toLowerCase();
                    // catagory = catagory.replace(/[^a-zA-Z0-9]+/g, '-');
                    catagory = slugify(catagory)
                    $('#catagory_slug').val(catagory);
                });
                // function convertToSlug(Text){
                //     return Text.toLowerCase()
                //     .replace(/ /g, '-')
                //     .replace(/[^\w-]+/g, '');
                // }
                function slugify(text) {
                    return text.toLowerCase()
                        .replace(text, text)
                        .replace(/^-+|-+$/g, '')
                        .replace(/\s/g, '-')
                        .replace(/\-\+/g, '-');
                }
            </script>

            </body>

            </html>