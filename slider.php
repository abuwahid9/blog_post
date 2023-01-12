<div class="main-banner header-text">
  <div class="container-fluid">
    <div class="owl-banner owl-carousel">
      <?php
      $sql = "SELECT post.*, catagory.name as catagoryName, admin.name as author
              FROM post
              INNER JOIN catagory ON post.catagory_id=catagory.id
              INNER JOIN admin ON post.admin_id=admin.id
              WHERE post.is_published='Published'
              ORDER BY post.id DESC LIMIT 9";
      $query = $conn->query($sql);
      $posts = $query->fetchAll(PDO::FETCH_OBJ);
      if ($posts) {

        foreach ($posts as $post) { ?>

          <div class="item">

            <img src="admin/<?php echo $post->image; ?>" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span><?php echo $post->catagoryName; ?></span>
                </div>
                <a href="post-details.php?slug=<?php echo $post->slug; ?>">
                  <h4><?php echo $post->title; ?></h4>
                </a>
                <ul class="post-info">
                  <li><a href="#"><?php echo $post->author; ?></a></li>
                  <li>
                    <a href="#">
                      <?php
                      $printDate = date_create($post->created_at);
                      echo $printDate->format("M d, Y H:i:s");
                      ?>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

      <?php
        }
      }
      ?>


    </div>
  </div>