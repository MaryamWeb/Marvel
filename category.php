<?php include "includes/database.php" ?>
<?php include "includes/header.php" ?>
<?php include "includes/navbar.php" ?>

<?php

if(isset($_GET['category'])){
    $post_category_id = $_GET['category'];

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page= 1;
        }

        $per_page=6;
        $start = ($page - 1)*$per_page;
        $next_page = $page + 1;
        $previous_page = $page -1;
            
        $result = query("SELECT * FROM posts WHERE post_category_id= $post_category_id");
        $count= mysqli_num_rows($result);
        $count = ceil($count/$per_page);


        $result = query("SELECT * FROM posts INNER JOIN users ON users.user_id = posts.user_name_id WHERE posts.post_category_id= $post_category_id ORDER BY posts.post_id DESC LIMIT {$start},$per_page"); 
?>


<div class="container py-3 text-break" >
    <div class="row">
        <section class="col-md-8 all-posts-container  py-4" >
   
                <?php
                if(mysqli_num_rows($result) ==0 ){
                    echo "<h4 class='text-white text-center py-4'>Oops, no posts found in this category. Please try another.</h4>";
                }else{

                while($row = mysqli_fetch_array($result)):
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_subtitle = $row['post_subtitle'];
                    $post_author = $row['user_name_id'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'],0,300);
                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    
                ?>
         

                <h1 class="post-title text-uppercase"><a class="post-title-link no-hover-decoration" href="/marvel/post/<?= $post_id ?>"><?= $post_title ?><br></a>
                    <span class="post-subtitle"> <?= $post_subtitle ?></span> 
                </h1> 

                <div class="div-post-image">  
                    <img  class="img-fluid post-image" src="/marvel/public/images/<?= $post_image ?>" alt="">  
                </div>  
                <br>

                <div class="post-content" >
                    <p><?= $post_content ?><?php echo strlen($post_content) == 300 ? "...":""; ?></p>  
                </div>
                
                <div class="row pt-3 px-4">
                    <div class="col-6 mt-1">
                        <span class="text-white">By: <a name="user" class="no-hover-decoration post-by-author" href="/marvel/profile/<?= $user_id ?>"> <?= $user_name ?></a></span>
                    </div>
                    <div class="col-6 pl-4">
                        <button class="red-button btn btn-sm float-right" type="button">
                            <a href="/marvel/post/<?= $post_id ?>" class="readmore-link">Keep Reading <i class="fas fa-chevron-right"></i></a>
                        </button>
                    </div>
                </div>

                <hr class="red-line">  
                
            
                <?php endwhile;
            }//if categories result !=0
        }?>

        <?php include "includes/category_pagination.php"; ?>        

        </section> 
      
        <?php include "includes/sidebar.php"; ?>
        
    </div>
</div>

 


<?php include "includes/footer.php" ?>


 
