<?php include "includes/database.php" ?>
<?php include "includes/header.php" ?>
<?php include "includes/profile-navbar.php" ?>

<?php 
  if(isset($_GET['user'])){
    $the_user_id= $_GET['user']; 
    $result= query("SELECT * FROM users WHERE user_id = '$the_user_id'");

    if(mysqli_num_rows($result) ==0 ){
      redirect("/marvel/index"); 
  }

    $row = mysqli_fetch_array($result); 
    $user_id = $row['user_id'];;
    $user_name = $row['user_name'];
    $user_email = $row['user_email'];
    $user_fname = $row['user_fname'];
    $user_lname = $row['user_lname'];
    $user_image = $row['user_image'];

    $result= query("SELECT * FROM posts WHERE user_name_id=$user_id");
    $count_posts=  mysqli_num_rows($result);

  }  
?>
  

<section class="container mt-4 all-posts-container text-white p-4">
  <div class="row">
    <div class="col-lg-12">

          <h2>Welcome To <?= $user_name ?>'s Profile: </h2> 
          <hr class="red-line-profile mb-4" >
          <div class="div-user-profile-image">  
            <img class="user-profile-image" src="/marvel//public/images/<?= $user_image ?>" alt="profile image">
          </div>
          <h3 class="text-center"><?= $user_fname?$user_fname:'' ?> <?= $user_lname?$user_lname:'' ?></h3>
          <p class="text-center">Number of posts: <?= $count_posts ?></p>
        </div>

    </div>
  </div>

 
 
    <div class="col-lg-12 ">
      <h3>All Posts:</h3>
        <div class="row ">
              
          <?php
            $result= query("SELECT * FROM posts INNER JOIN users ON users.user_id = posts.user_name_id  INNER JOIN  category ON posts.post_category_id = category.category_id WHERE users.user_id LIKE '$the_user_id'");
            while($row = mysqli_fetch_array($result)):
                $post_id = $row['post_id'];
                $post_category_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_subtitle = $row['post_subtitle'];
                $post_author = $row['user_name_id'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,100);
                $post_tags = str_replace(" ", ",",$row['post_tags']);
                $category_id = $row['category_id'];
                $category_title = $row['category_title'];
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
          ?>  
          <div class="col-6 col-sm-4 col-md-3 col-lg-2 pb-4">
            <div class="card ">
              <div class="card-img-container">
                  <a href="/marvel//post/<?=$post_id?>"><img src="/marvel//public/images/<?= $post_image ?>" class="card-img-top" alt="post image" ></a>
              </div>
              <div class="card-body p-3 text-center">
                <h5 class="card-title"><?= $post_title ?> </h5>
                <p class="card-text "><small><?= $category_title ?></small></p>
              </div>
            </div>
          </div>
          <?php  endwhile; ?>
  
    </div>
  </div>

 
</section>
 
<?php include "includes/footer.php" ?>
 
 