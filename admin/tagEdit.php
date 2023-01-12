<?php
$title = 'tag';
include "layout/head.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tag_name = $_POST['tag_name'];
    // $tag_slug = $_POST['tag_slug'];
    $tagId = $_POST['tagId'];
    // echo $tag_name, $tag_slug;

    if (empty($tag_name)) {
        $error['tagNameErro'] = "tag name is required.";
    } else {
        $data['tagName'] = $tag_name;
    }
    // if (empty($tag_slug)) {
    //     $error['tagSlugErro'] = "tag slug is required.";
    // } else {
    //     $data['tagSlug'] = $tag_slug;
    // }

    if (empty($error['tagNameErro'])) {

       try {
        $sql = "UPDATE tag SET name=:name,slug=:slug WHERE id=:id";
        if ($stmpt = $conn->prepare($sql)) {
            $stmpt->bindparam(':name', $data['tagName'], PDO::PARAM_STR);
            // $stmpt->bindparam(':slug', $data['tagSlug'], PDO::PARAM_STR);
            $stmpt->bindparam(':id', $tagId, PDO::PARAM_INT);
            if ($stmpt->execute()) {
                $_SESSION['success'] = 'tag UPDATE successfully';
                header('location:tag.php');
            }
        }
       } catch (PDOException $e) {
            die('Could insert tag'.$sql.$e->getMessage());
       }

    }
}

/* get URL id */
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = trim($_GET['id']);
    // echo $id;
    $sql = "SELECT * FROM tag WHERE id=:id";
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
                    <h1 class="h3 mb-0 text-gray-800">tag</h1>
                    <a href="tag.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-backward text-white"></i> Back To list</a>
                </div>

                <!-- Content Row -->
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">tag List</h6>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                            <div class="form-group">
                                <label for="tag_name">tag Name</label>
                                <input type="text" name="tag_name" value="<?php echo $result->name ??'';?>" class="form-control" id="tag_name">
                                <small id="emailHelp" class="form-text text-danger">
                                    <?php
                                    echo ($error['tagNameErro']) ?? '';
                                    ?>

                                </small>
                            </div>
                            <!-- <div class="form-group">
                                <label for="tag_slug">Slug</label>
                                <input type="text" name="tag_slug" value="<?php echo $result->slug ??'';?>" class="form-control" id="tag_slug">
                                <small id="emailHelp" class="form-text text-danger">
                                    <?php
                                    echo ($error['tagSlugErro']) ?? '';
                                    ?>
                                </small>
                            </div> -->
                                <input type="hidden" name="tagId" value="<?php echo $result->id??''?>">                
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

            <!-- <script>
                $('#tag_name').on('keyup', function() {
                    $('#tag_slug').val('')
                    let tag = $(this).val();
                    // console.log(catagoty);
                    tag = tag.toLowerCase();
                    tag = tag.replace(/[^a-zA-Z0-9]+/g, '-');

                    $('#tag_slug').val(tag);
                });

                function convertToSlug(Text) {
                    return Text.toLowerCase()
                        .replace(/ /g, '-')
                        .replace(/[^\w-]+/g, '');
                }
            </script> -->

            </body>

            </html>