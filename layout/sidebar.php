
<div class="row">
  <div class="col-lg-12">
    <div class="sidebar-item search">
      <form id="search_form" name="gs" method="GET" action="search.php">        
        <div class="input-group mb-3">
          <input type="text" name="search" class="form-control searchText" placeholder="type to search..." aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="on">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="sidebar-item recent-posts">
      <div class="sidebar-heading">
        <h2>Recent Posts</h2>
      </div>
      <div class="content">
        <ul>
          <?php
          $sql = "SELECT id,title,slug,created_at 
          FROM post
          where is_published='Published'
          ORDER BY created_at DESC LIMIT 4";
          $result = $conn->query($sql);
          $latestPosts = $result->fetchAll(PDO::FETCH_OBJ);
          // print_r($latestPosts);
          if ($latestPosts) {
            foreach ($latestPosts as $post) { ?>
              <li>
                <a href="post-details.php?slug=<?php echo $post->slug; ?>">
                  <h5><?php echo $post->title; ?></h5>
                  <span><?php
                        $dateCreate = date_create($post->created_at);

                        echo $dateCreate->format('M d, Y');

                        ?>
                  </span>
                </a>
              </li>
          <?php
            }
          }
          ?>

        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="sidebar-item categories">
      <div class="sidebar-heading">
        <h2>Categories</h2>
      </div>
      <div class="content">
        <ul>
          <?php
          $sql = "SELECT * FROM catagory";
          $result = $conn->query($sql);
          $catagories = $result->fetchAll(PDO::FETCH_OBJ);
          // print_r($catagories);
          if ($catagories) {
            foreach ($catagories as $catagory) { ?>
              <li><a href="catagory-posts.php?slug=<?php echo $catagory->slug; ?>"><?php echo $catagory->name; ?></a></li>
          <?php
            }
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="sidebar-item tags">
      <div class="sidebar-heading">
        <h2>Tag Clouds</h2>
      </div>
      <div class="content">
        <ul>
          <?php
          $sql = "SELECT * FROM tag
          ORDER BY RAND() LIMIT 50";
          $result = $conn->query($sql);
          $tags = $result->fetchAll(PDO::FETCH_OBJ);
          if ($tags) {
            foreach ($tags as $tag) { ?>
              <li><a href="tag-posts.php?slug=<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
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