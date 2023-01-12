<?php
$title = 'post';
include "layout/head.php";



if (isset($_POST['submit'])) {

    $title       = inputValidate($_POST['title']);
    $slug        = inputValidate($_POST['slug']);
    $description = $_POST['description'];
    $catagory    = @$_POST['catagory'];
    $tags        = @$_POST['tag'];
    $status      = @$_POST['status'];

    /*post id & post old image*/
    $postId       = $_POST['postId'];
    $postOldImage = $_POST['postOldImage'];

    $fileName    = $_FILES['image']['name'];
    $fileTmp     = $_FILES['image']['tmp_name'];
    $fileSize    = $_FILES['image']['size'];


    if (empty($title)) {
        $error['title'] = 'Post title is required';
    } else {
        $data['title'] = $title;
    }
    if (empty($slug)) {
        $error['slug'] = 'Post slug is required';
    } else {
        $data['slug'] = $slug;
    }
    if (empty($description)) {
        $error['description'] = 'Post description is required';
    } else {
        $data['description'] = $description;
    }
    if (empty($catagory)) {
        $error['catagory'] = 'catagory is required';
    } else {
        $data['catagory'] = $catagory;
    }

    if (is_array_empty($tags)) {
        $data['tags'] = $tags;
    } else {
        $error['tag'] = 'Tag is required';
    }

    if (empty($status)) {
        $error['status'] = 'Status is required';
    } else {
        $data['status'] = $status;
    }

      if ($fileName) {
        $ext           = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowItem     = array('jpg', 'jpeg', 'png', 'webp');
        $uniqueImgName = uniqid() . rand(1000, 99999) . '.' . $ext;
        $upload_Image  = 'uploads/post/' . $uniqueImgName;

        if (in_array($ext, $allowItem)) {
            if ($fileSize < 1048576) {
                unlink($postOldImage);
                move_uploaded_file($fileTmp, $upload_Image);
            } else {
                $photoErr = "Image size less then 1mb required";
            }
        } else {
            $photoErr = "Only jpg,jpeg, png & webp allow";
        }
    } else {
        $upload_Image = $postOldImage;
    }

 

    if (empty($error['title']) && empty($error['slug']) && 
    empty($error['description']) && 
    empty($error['catagory']) && empty($error['tag']) && 
    empty($error['image']) && empty($error['status'])) {

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
                $stmt->bindParam(':image', $upload_Image, PDO::PARAM_STR);
                $stmt->bindParam(':is_published', $data['status'], PDO::PARAM_STR);
                $stmt->bindParam(':updated_at', $cdTime, PDO::PARAM_STR);
                $stmt->bindParam(':id', $postId, PDO::PARAM_INT);
                $stmt->execute();

                $lastId = $conn->lastInsertId();

                /* select existing post tags */
                $query = "SELECT * FROM post_tag WHERE post_id=:postId";
                $stmtForTag = $conn->prepare($query);
                $stmtForTag->bindParam('postId', $postId,PDO::PARAM_INT);
                $stmtForTag->execute();
                $tagIds = $stmtForTag->fetchAll(PDO::FETCH_ASSOC);
                /*Delete existing post tags*/
                if ($tagIds){
                    foreach ($tagIds as $tagId){
                        $sql ="DELETE FROM post_tag WHERE post_id=:postId";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam('postId', $postId,PDO::PARAM_INT);
                        $stmt->execute();
                    }
                }
                /* update post tags */
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

                $_SESSION['success'] = "Post update successfully";
                header('Location:post.php');

            }
        } catch (PDOException $e) {
            die('ERROR: Could not able to prepare/execute query: ' . $sql . $e->getMessage());
        }
    }
}

/* get url  id */
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = trim($_GET['id']);
    $sql = "SELECT * FROM post WHERE id=:id";
    $stmp = $conn->prepare($sql);
    $stmp->bindParam(':id', $id, PDO::PARAM_INT);
    $stmp->execute();
    $post = $stmp->fetch(PDO::FETCH_OBJ);
}

?>



<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include "layout/sidebard.php"; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php
            include "layout/topbar.php"
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Post</h1>
                    <a href="post.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                        <i class="fas fa-reply"></i>
                        Back to list
                    </a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Post Create</h6>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title">Post title</label>
                                        <input type="text" name="title" value="<?php echo $post->title ?? ''; ?>" class="form-control" id="title">
                                        <small id="title" class="form-text text-danger">
                                            <?php echo  $error['title'] ?? ''; ?>
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Post Slug</label>
                                        <input type="text" name="slug" value="<?php echo $post->slug ?? ''; ?>" class="form-control" id="slug">
                                        <small id="emailHelp" class="form-text text-danger">
                                            <?php echo  $error['slug'] ?? ''; ?>
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Post Description</label>

                                        <textarea name="description" class="form-control" id="description">
                                       <?php echo $post->description ?? ''; ?>
                                        </textarea>
                                        <small id="description" class="form-text text-danger">
                                            <?php echo  $error['description'] ?? ''; ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Post Image</label>
                                        <input type="file" name="image" class="form-control dropify" data-allowed-file-extensions="jpg jpeg png webp" data-default-file=<?php echo $post->image ?? ''; ?> data-max-file-size="2M" id="image">
                                        <small id="image" class="form-text text-danger">
                                            <?php echo  $error['image'] ?? ''; ?>
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="catagory">Select catagory</label>
                                        <select class="custom-select" name="catagory">
                                            <option selected disabled>Select catagory</option>
                                            <?php
                                            $sql = "SELECT * FROM catagory";
                                            $statement = $conn->query($sql);
                                            $categories = $statement->fetchAll(PDO::FETCH_OBJ);
                                            if ($categories) {
                                                foreach ($categories as $catagory) { ?>
                                                    <option <?php echo $post->catagory_id == $catagory->id ? 'selected' : '' ?> value="<?php echo $catagory->id; ?>"><?php echo $catagory->name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <small id="catagory" class="form-text text-danger">
                                            <?php echo  $error['catagory'] ?? ''; ?>
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Select Tags</label>
                                        <select class="custom-select" multiple id="tag" name="tag[]">
                                            <option disabled>Select tags</option>
                                            <?php

                                            /*get post tags id*/
                                            $query = "SELECT * FROM post_tag WHERE post_id=:postId";
                                            $stmtForTag = $conn->prepare($query);
                                            $stmtForTag->bindParam('postId', $post->id, PDO::PARAM_INT);
                                            $stmtForTag->execute();
                                            $tagIds = $stmtForTag->fetchAll(PDO::FETCH_OBJ);


                                            $sql = "SELECT * FROM tag";
                                            $statement = $conn->query($sql);
                                            $tags = $statement->fetchAll(PDO::FETCH_OBJ);
                                            if ($tags) {
                                                foreach ($tags as $tag) { ?>
                                                    <option <?php
                                                            foreach ($tagIds as $tagId) {
                                                                if ($tagId->tag_id == $tag->id) {
                                                                    echo "selected";
                                                                }
                                                            }
                                                            ?> value="<?php echo $tag->id; ?>"><?php echo $tag->name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <small id="image" class="form-text text-danger">
                                            <?php echo  $error['tag'] ?? ''; ?>
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Post Status</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="published" <?php echo  $post->is_published == 'Published' ? 'checked' : '' ?> name="status" value="Published" class="custom-control-input">
                                            <label class="custom-control-label" for="published">Published</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="draft" name="status" <?php echo  $post->is_published == 'Draft' ? 'checked' : '' ?> value="Draft" class="custom-control-input">
                                            <label class="custom-control-label" for="draft">Draft</label>
                                        </div>

                                        <small id="image" class="form-text text-danger">
                                            <?php echo  $error['status'] ?? ''; ?>
                                        </small>

                                    </div>

                                </div>
                            </div>
                            <input type="hidden" name="postId" value="<?php echo $post->id; ?>">
                            <input type="hidden" name="postOldImage" value="<?php echo $post->image ?? ''; ?>">

                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- footer page link -->
        <?php
        include "layout/footer.php";
        ?>


        <!-- include summernote css/js -->

        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script src="vendor/dropify/dist/js/dropify.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#description').summernote({
                    height: 300
                });
                $('.dropify').dropify();

                $('#tag').select2();
            });

            $('#title').on('keyup', function() {

                $('#slug').val('')
                var catagory = $(this).val();
                catagory = slugify(catagory)
                $('#slug').val(catagory)
            });

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