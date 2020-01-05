<?php ob_start(); ?>
<?php include "../admin/includes/delete_modal.php" ?>  

<a href="posts.php?source=add_post" style=" color:var(--main-medium-grey-color); "><i class="fas fa-plus-square"></i> Add a new post</a>

  
<section class="table-responsive py-2 mx-auto"> 
  <table class="table table-sm ">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Category</th>
        <th scope="col">Title</th>
        <th scope="col">Subtitle</th>
        <th scope="col">Image</th>
        <th scope="col">Tags</th>
        <th scope="col">Comments</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>

    <?php   

    $username= $_SESSION['username'];
    $result= query("SELECT * FROM posts INNER JOIN users ON users.user_id = posts.user_name_id  INNER JOIN  category ON posts.post_category_id = category.category_id WHERE users.user_name LIKE '$username' ORDER BY posts.post_id DESC");
      

      while($row = mysqli_fetch_array($result)):
          $post_id = $row['post_id'];
          $post_category_id = $row['post_category_id'];
          $post_title = $row['post_title'];
          $post_subtitle = $row['post_subtitle'];
          $post_author = $row['user_name_id'];
          $post_image = $row['post_image'];
          $post_tags = str_replace(" ", ",",$row['post_tags']);
          $category_id = $row['category_id'];
          $category_title = $row['category_title'];
          $user_id = $row['user_id'];
          $user_name = $row['user_name'];
          

          echo "<tr>";
          echo "<td>$category_title</td>";
          echo "<td> <a href='/marvel/post/$post_id' class='titlehref'>$post_title</a></td>";
          echo "<td>$post_subtitle</td>";
          echo "<td><img width=50 height=45 src='../public/images/{$post_image}'></d>";
          echo "<td>$post_tags</td>";

          $result_count=query("SELECT * FROM comments WHERE comment_post_id = $post_id");
          $count_comments= mysqli_num_rows($result_count);

          echo "<td>$count_comments</td>"; 
          echo "<td><a href='posts.php?source=edit_post&post_id={$post_id}'><i class='fas fa-edit fa-sm'></i></a></td>";
          
        ?>


        <form method="post">

            <input type="hidden" name="delete" value="<?php echo $post_id ?>">

         <?php   

            //echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';
            echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'><i class='fas fa-trash-alt fa-sm'></i></a></td>";

          ?>


        </form>




        <?php

          
          echo "</tr>";  
      endwhile;
     ?>  
      </tbody>
    </table>
  </section>

    
<?php
  if(isset($_GET['delete'])){
    $post_id = $_GET['delete'];
    
    $result=query("DELETE FROM posts WHERE post_id={$post_id}");
    redirect("posts.php");
  }
 
?>


<script>
  $(document).ready(function(){
    $(".delete_link").on("click", function(){
      var id=$(this).attr("rel");
      var delete_url='posts.php?delete='+ id;
      $(".modal_delete_link").attr("href",delete_url);
      $("#deleteModal").modal("show");
    })
  })</script>

 
  
