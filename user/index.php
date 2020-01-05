<?php include "../includes/database.php" ?>
<?php include "includes/user-header.php" ?>
<?php 
  if(isUser()){       
     include "includes/user-navbar.php";
  }elseif(isAdmin()){
    include "../admin/includes/admin-navbar.php";
  }
?>



<?php 
        
    $user_id = $_SESSION['user_id'];

    $result= query("SELECT * FROM posts WHERE user_name_id=$user_id ");
    $count_posts=  mysqli_num_rows($result);

    $result= query("SELECT * FROM users WHERE user_id={$user_id}");

        $row= mysqli_fetch_assoc($result);
        $user_name = $row['user_name'];
        $user_email = $row['user_email'];
        $user_fname = $row['user_fname'];
        $user_lname = $row['user_lname'];
        $user_image = $row['user_image'];
     
?>


<section class="container py-4 white-container">
  <div class="row">
    <div class="col-lg-12">
      <a class="red-text no-hover-decoration" href="posts.php?source=edit_user">Edit User</a>
          <h1>Profile:</h1>
          <hr class="red-line-profile mb-4" >
          <div class="div-user-profile-image">  
            <img class="user-profile-image" src="../public/images/<?= $user_image ?>" alt="profile image">
          </div>
          <h3 class="text-center"><?= $user_fname?$user_fname:'' ?> <?= $user_lname?$user_lname:'' ?></h3>
          <p class="text-center">Number of posts: <?= $count_posts ?></p>
    </div>
  </div>
</div>

 
<div class="col-lg-12 pt-4">
    <div class="row ">
        
    <?php     
      
      $result= query("SELECT * FROM posts INNER JOIN users ON users.user_id = posts.user_name_id  INNER JOIN  category ON posts.post_category_id = category.category_id WHERE users.user_name LIKE '$user_name' ORDER BY posts.post_id DESC");

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
          <img src="../public/images/<?= $post_image ?>" class="card-img-top" alt="post image" > 
      </div>
      <div class="card-body p-3 text-center">
        <h5 class="card-title"><a style="color:red;" href="/marvel/post/<?=$post_id?>">View post</a></h5>
        <p class="card-text "><small><a class="text-white" href="posts.php?source=edit_post&post_id=<?=$post_id?>">Edit post</a></small></p>
      </div>
    </div> 
  </div>
 
      <?php endwhile; ?>
 
</div>
</div>


</section>
  
 

<?php include "includes/user-footer.php" ?>
 