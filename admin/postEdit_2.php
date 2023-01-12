<?php
$title = 'post';
include "layout/head.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title =    inputValidate($_POST['title']);
    $slug =     inputValidate($_POST['slug']);

    $description =  $_POST['description'];
    $catagory =     @$_POST['catagory'];
    $tags =         @$_POST['tag'];
    $status =       @$_POST['status'];
    // post id & post old image
    $postId         =  $_POST['postId'];
    $postOldImage   =  $_POST['postOldImage'];


    $fileName =     $_FILES['image']['name'];
    $fileTmp =      $_FILES['image']['tmp_name'];
    $fileSize =     $_FILES['image']['size'];

    // echo $title, $slug;

    if (empty($title)) {
        $error['title'] = "Post title is required.";
    } else {
        $data['title'] = $title;
    }
    if (empty($slug)) {
        $error['slug'] = "Post slug is required.";
    } else {
        $data['slug'] = $slug;
    }
    if (empty($description)) {
        $error['description'] = "Post description is required.";
    } else {
        $data['description'] = $description;
    }
    if (empty($catagory)) {
        $error['catagory'] = "Post catagory is required.";
    } else {
        $data['catagory'] = $catagory;
    }
    if (is_array_empty($tags)) {
        $data['tags'] = $tags;
    } else {
        $error['tag'] = "Tag is required.";
    }
    if (empty($status)) {
        $error['status'] = "Post status is required.";
    } else {
        $data['status'] = $status;
    }

    //Updating image section
    if ($fileName) {
        $fileExt        = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowExt       = array('jpg', 'jpeg', 'png', 'webp');
        $uniqueFileName = uniqid() . rand(1000, 99999) . '.' . $fileExt;
        $uploadDir      = 'uploads/post/' . $uniqueFileName;

        if (in_array($fileExt, $allowExt)) {
            if ($fileSize < 1048576) {
                unlink($postOldImage);
                move_uploaded_file($fileTmp, $uploadDir);
            } else {
                $photoErr = "Image size must be less than 1MB.";
            }
        } else {
            $photoErr = "Only jpg, jpeg, png and webp images are allowed.";
        }
    } else {
        $uploadDir  = $postOldImage;
    }

    if (
        empty($error['title']) && empty($error['slug'])
        && empty($error['description']) && empty($error['status'])
        && empty($error['catagory']) && empty($error['tag'])
        && empty($error['image'])
    ) {

        // print_r($data);

        $cdTime = date('Y-m-d H:i:s');

        try {

            $sql = "UPDATE post SET admin_id=:admin_id, 
            catagory_id=:catagory_id, title=:title,slug=:slug, 
            description=:description, image=:image, 
            is_published=:is_published, updated_at=:updated_at 
            WHERE id=:id";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bindParam(':admin_id', $_SESSION['id'], PDO::PARAM_INT);
                $stmt->bindParam(':catagory_id', $data['catagory'], PDO::PARAM_INT);
                $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
                $stmt->bindParam(':slug', $data['slug'], PDO::PARAM_STR);
                $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
                $stmt->bindParam(':image', $uploadDir, PDO::PARAM_STR);
                $stmt->bindParam(':is_published', $data['status'], PDO::PARAM_STR);
                $stmt->bindParam(':updated_at', $cdTime, PDO::PARAM_STR);
                $stmt->bindParam(':id', $postId, PDO::PARAM_INT);
                $stmt->execute();

                $lastId = $conn->lastInsertId();

                /*select existing post tags*/
                $query = "SELECT * FROM post_tag WHERE post_id=:postId";
                $stmtForTag = $conn->prepare($query);
                $stmtForTag->bindParam('postId', $postId, PDO::PARAM_INT);
                $stmtForTag->execute();
                $tagIds = $stmtForTag->fetchAll(PDO::FETCH_ASSOC);

                /*Delete existing post tags*/
                if ($tagIds) {
                    foreach ($tagIds as $tagId) {
                        $sql = "DELETE FROM post_tag WHERE post_id=:postId";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam('postId', $postId, PDO::PARAM_INT);
                        $stmt->execute();
                    }
                }

                // update post tags
                if ($data['tags']) {
                    foreach ($tags as $key => $tag) {
                        $sql = "INSERT INTO post_tag(post_id,tag_id)VALUES(:post_id,:tag_id)";
                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
                            $stmt->bindParam(':tag_id', $tags[$key], PDO::PARAM_INT);
                            $stmt->execute();
                        }
                    }
                }

                $_SESSION['success'] = "Post Updated successfully";
                header('location:post.php');
            }
        } catch (PDOException $e) {
            die('Error: Could not able to prepare/execute qurey: ' . $sql . $e->getMessage());
        }
    }
}
/* get post url id */
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = trim($_GET['id']);
    $sql = "SELECT * FROM post WHERE id=:id";
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
                    <a href="post.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-backward text-white"></i> Back To list</a>
                </div>

                <!-- Content Row -->
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Post Edit</h6>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title">Post Title</label>
                                        <input type="text" name="title" value="<?php echo $result->title ?? ''; ?>" class="form-control" id="title">
                                        <small id="title" class="form-text text-danger">
                                            <?php
                                            echo $error['title'] ?? '';
                                            ?>

                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Post Slug</label>
                                        <input type="text" name="slug" value="<?php echo $result->slug ?? ''; ?>" class="form-control" id="slug">
                                        <small id="emailHelp" class="form-text text-danger">
                                            <?php
                                            echo $error['slug'] ?? '';
                                            ?>
                                        </small>

                                    </div>
                                    <div class="form-group">
                                        <label for="description">Post Dicription</label>
                                        <textarea name="description" value="" class="form-control" id="description">
                                            <?php echo $result->description ?? ''; ?>
                                        </textarea>
                                        <small id="description" class="form-text text-danger">
                                            <?php echo ($error['description']) ?? ''; ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="image">Post Image</label>
                                        <input type="file" name="image" id="image" class="form-control dropify" data-default-file="<?php echo $result->image ?? ''; ?>" data-allowed-file-extensions="jpg jepg png webp" data-max-file-size="2M">
                                        <small id="image" class="form-text text-danger">
                                            <?php
                                            echo $error['image'] ?? '';
                                            ?>
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="catagory">Select Catagory</label>
                                        <select class="custom-select" name="catagory">
                                            <option disabled>Select Catagory</option>
                                            <?php
                                            $sql = "SELECT * FROM catagory";
                                            $statement = $conn->query($sql);
                                            $catagories = $statement->fetchAll(PDO::FETCH_OBJ);
                                            // print_r($catagories);
                                            if ($catagories) {
                                                foreach ($catagories as $catagory) { ?>
                                                    <option <?php echo $result->catagory_id == $catagory->id ? 'selected' : '' ?> value="<?php echo $catagory->id; ?>">
                                                        <?php echo $catagory->name; ?>
                                                    </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <small id="catagory" class="form-text text-danger">
                                            <?php
                                            echo $error['catagory'] ?? '';
                                            ?>
                                        </small>
                                        <div class="nav justify-content-end">
                                            <a href="catagory.php" class="btn btn-primary">To catagory list</a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tag">Select Tags</label>
                                        <select class="custom-select" multiple id="tag" name="tag[]">
                                            <option disabled>Select Tags</option>
                                            <?php
                                            /*get post tags id */
                                            $query = "SELECT * FROM post_tag WHERE post_id=:postId";
                                            $stmtForTag = $conn->prepare($query);
                                            $stmtForTag->bindParam('postId', $result->id, PDO::PARAM_INT);
                                            $stmtForTag->execute();
                                            $tagIds = $stmtForTag->fetchAll(PDO::FETCH_OBJ);

                                            $sql = "SELECT * FROM tag";
                                            $statement = $conn->query($sql);
                                            $tags = $statement->fetchAll(PDO::FETCH_OBJ);
                                            // print_r($tags);
                                            if ($tags) {
                                                foreach ($tags as $tag) { ?>
                                                    <option <?php
                                                            foreach ($tagIds as $tagId) {
                                                                if ($tagId->tag_id == $tag->id) {
                                                                    echo "selected";
                                                                }
                                                            }
                                                            ?> value="<?php echo $tag->id; ?>">
                                                        <?php echo $tag->name; ?>
                                                    </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <small id="tag" class="form-text text-danger">
                                            <?php
                                            echo $error['tag'] ?? '';
                                            ?>
                                        </small>
                                        <div class="nav justify-content-end">
                                            <a href="tag.php" class="btn btn-primary">To tag list</a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="d-block">Post Status</label>
                                        <div class="custom-control custom-radio custom-control-inline">

                                            <input type="radio" id="published" name="status" value="Published" <?php echo $result->is_published == "Published" ? 'checked' : '' ?> class="custom-control-input">

                                            <label class="custom-control-label" for="published">Published</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">

                                            <input type="radio" id="draft" name="status" value="Draft" <?php echo $result->is_published == "Draft" ? 'checked' : '' ?> class="custom-control-input">

                                            <label class="custom-control-label" for="draft">Draft</label>
                                        </div>
                                        <small id="status" class="form-text text-danger">
                                            <?php
                                            echo $error['status'] ?? '';
                                            ?>
                                        </small>
                                    </div>

                                </div>
                            </div>

                            <input type="hidden" name="postId" value="<?php echo $result->id; ?>">
                            <input type="hidden" name="postOldImage" value="<?php echo $result->image ?? ''; ?>">

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- Content Row -->

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <?php
            include "layout/footer.php";
            include 'layout/_sript.php';
            // include "layout/datatable.php";
            ?>

            <!-- Text Editor links JS -->
            <!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->
            <script src="vendor/summernote-0.8.18-dist/summernote.min.js"></script>
            <!-- <script src="js/summernote/summernote.min.js"></script> -->

            <!-- Image upload fiuld -->
            <script src="vendor/dropify/dist/js/dropify.min.js"></script>

            <!-- tag selection -->
            <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
            <!-- <script src="vendor/select2-develop/dist/js/select2.min.js"></script> -->
            <script src="js/select/select2.min.js"></script>


            <script>
                $(document).ready(function() {
                    $('#description').summernote({
                        height: 300
                    });
                    // Image new function.
                    $('.dropify').dropify();

                    $('#tag').select2();
                });

                $('#title').on('keyup', function() {
                    $('#slug').val('')
                    var catagory = $(this).val();
                    catagory = slugify(catagory)
                    $('#slug').val(catagory);
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
                        .replace(/\-\-+/g, '-');
                }
            </script>

            </body>

            </html>