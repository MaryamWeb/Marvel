<?php include "includes/database.php" ?>
<?php include "includes/header.php" ?>
<?php include "includes/navbar.php" ?>


<?php include "includes/post_comment.php" ?>

<div class="container py-3 text-break" >
    <div class="row">
        <section class="col-md-8 all-posts-container py-4" >

            <?php 

                if(isset($_GET['id'])){
                    $post_id = $_GET['id'];

                    $result= query("SELECT * FROM posts INNER JOIN users ON users.user_id = posts.user_name_id INNER JOIN category ON posts.post_category_id=category.category_id WHERE post_id=$post_id");

                    $row = mysqli_fetch_array($result);
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_subtitle = $row['post_subtitle'];
                    $post_author = $row['user_name_id'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    $category_title= $row['category_title'];
                    $category_id= $row['category_id'];
                    
                    if(mysqli_num_rows($result) ==0 ){
                        redirect("/marvel/index"); 
                    }

                    $result2  =query("SELECT * FROM comments WHERE comment_post_id=$post_id AND comment_status='approved'"); 
                    $count_comments=mysqli_num_rows($result2);
                }
            ?>

 
                <h1 class="single-post-title text-uppercase text-center pb-3"><?= $post_title ?><br>
                    <span class="post-subtitle"> <?= $post_subtitle ?></span> 
                </h1> 
              
                <div class="">  
                    <img  class="img-fluid post-image" src="/marvel/public/images/<?= $post_image ?>" alt="">  
                </div>  
                <br>

                <div class="post-content pb-2">
                    <p><?= $post_content ?></p>  
                </div>
              
                <span class="text-white">By: <a name="user" class="no-hover-decoration post-by-author" href="/marvel/profile/<?= $user_id ?>"> <?= $user_name ?></a></span>
                <br><span class="text-white">Category: <a name="user" class="no-hover-decoration post-by-author" href="/marvel/category/<?= $category_id ?>"> <?= $category_title ?></a></span>
                <hr class="red-line my-4">

                
                <!-- View All Comments -->

                <div class="col-md-10 pb-1 pt-3 comments-background">
                    <h2>Comments:<small style="font-size: 0.8em;"><?=$count_comments?></small></h2>
                <hr>

                <?php  
                    if(isset($_POST['post_comment']) && empty($error)){ 
                        echo "<div class='alert alert-success' role='alert'> Your comment is currently being reviewed, thank you.</div>";
                    }

                    $result= query("SELECT * FROM comments WHERE comment_post_id=$post_id AND comment_status='approved' ORDER BY comment_id DESC");
                
                    while($row = mysqli_fetch_array($result)):
                        $comment_id = $row['comment_id'];
                        $comment_post_id = $row['comment_post_id'];
                        $comment_user_id = $row['comment_user_id'];
                        $comment_username = $row['comment_username'];
                        $comment_content = $row['comment_content'];
                        $comment_date= $row['comment_date'];
                        $comment_role= $row['comment_role'];
                        $comment_image= $row['comment_image'];
             
                        if($comment_role=='visitor'){
                            $comment_profile="<span class='visitor-user'>(visitor)</span>";
                        }else{
                            $comment_profile= "<a class='visit-user-link' href='/marvel/profile/$comment_user_id'><span class='visitor-user'>(profile)</span></a>";
                        }
                ?>

                <div class="media" >
                    <img src="/marvel/public/images/<?= $comment_image ?>" class="user_icon mr-3" alt="user icon">
                    <div class="media-body " >
                        <h5 class="mb-0"><?=$comment_username?> <?=$comment_profile?></h5>
                        <small class="mt-0" style="font-size: 12px;"><?= $comment_date ?></small>
                        <p class="pt-4 pr-2 comment-content" ><?= $comment_content ?></p>
                    </div>
                </div>
                <hr>
                
             <?php endwhile;?>  

     
        <?php include "includes/comments_form.php" ?>
        </section> 
      
      <?php include "includes/sidebar.php"; ?>
      
  </div>
</div>


<?php include "includes/footer.php" ?>


 
