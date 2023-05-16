<!DOCTYPE html>
<html lang="en">

<head>

<?php $title = 'catagory posts';?>
  <?php include "layout/head.php" ?>
</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="preloader">
    <div class="jumper">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- Header -->
  <?php include "layout/hearder.php" ?>
  <?php
  if (isset($_GET['slug'])) {
    $catagorySlug = $_GET['slug'];

    $sql = "SELECT * FROM catagory WHERE slug=:catagorySlug";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':catagorySlug', $catagorySlug, PDO::PARAM_STR);
    $stmt->execute();
    $catagory = $stmt->fetch(PDO::FETCH_OBJ);
    // print_r($catagory);
  }
  ?>
  <!-- Page Content -->

  <!-- Banner Starts Here -->
  <div class="heading-page header-text">
    <section class="page-heading">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-content text-center">
              <h2><?php echo $catagory->name;?> Posts</h2>
              
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Banner Ends Here -->


  <section class="blog-posts grid-system">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="all-blog-posts">
            <div class="row">
              <?php
              $sql = "SELECT post.*, catagory.name as catagoryName, admin.name as author
              FROM post
              INNER JOIN catagory ON post.catagory_id=catagory.id
              INNER JOIN admin ON post.admin_id=admin.id
              WHERE post.is_published='Published'
              AND post.catagory_id=:catagoryId
              ORDER BY post.id DESC";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':catagoryId', $catagory->id, PDO::PARAM_INT);
              $stmt->execute();
              $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
              if ($posts != null) {
                foreach ($posts as $post) { ?>
                  <div class="col-lg-6">
                    <div class="blog-post">
                      <div class="blog-thumb">
                        <img src="admin/<?php echo $post->image; ?>" alt="">
                      </div>
                      <div class="down-content">
                        <span><?php echo $post->catagoryName; ?></span>
                        <a href="post-details.php?slug=<?php echo $post->slug; ?>">
                          <h4><?php echo $post->title; ?></h4>
                        </a>
                        <ul class="post-info">
                          <li><a href="#"><?php echo $post->author; ?></a></li>
                          <li><a href="#">
                              <?php
                              $printDate = date_create($post->created_at);
                              echo $printDate->format('M d, Y');
                              ?>
                            </a></li>
                        </ul>
                        <p><?php echo html_entity_decode(str_limit($post->description, 200)); ?></p>
                        <div class="post-options">
                          <div class="row">
                            <div class="col-lg-12">
                              <ul class="post-tags">
                                <li><i class="fa fa-tags"></i></li>
                                <?php

                                $sql = "SELECT tag.* 
                                FROM tag 
                                INNER JOIN post_tag ON tag.id = post_tag.tag_id 
                                WHERE post_id=:postId";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':postId', $post->id, PDO::PARAM_INT);
                                $stmt->execute();
                                $resultTag = $stmt->fetchAll(PDO::FETCH_OBJ);
                                if ($resultTag) {
                                  foreach ($resultTag as $key => $tag) { ?>
                                    <li><a href="#"><?php echo $tag->name;  ?></a> </li>
                                <?php
                                  }
                                }
                                ?>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

              <?php
                }
              }else {
                echo "No post found";
              }
              ?>

              <div class="col-lg-12">
                <ul class="page-numbers">
                  <li><a href="#">1</a></li>
                  <li class="active"><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="sidebar">
            <?php include "layout/sidebar.php" ?>
          </div>
        </div>
      </div>
  </section>

  <!-- footer section start -->
  <?php include "layout/footer.php" ?>
</body>

</html>