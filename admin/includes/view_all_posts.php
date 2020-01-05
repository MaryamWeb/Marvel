<?php ob_start(); ?>
<?php include "delete_modal.php" ?> 

<?php
 $result= query("SELECT * FROM posts LEFT JOIN category ON posts.post_category_id = category.category_id LEFT JOIN users ON users.user_id = posts.user_name_id ORDER BY posts.post_id DESC");
 

if(isset($_POST['apply'])){
    $select_option = $_POST['select_option'];
    switch($select_option){
        case 'category':
          $result= query("SELECT * FROM posts LEFT JOIN category ON posts.post_category_id = category.category_id LEFT JOIN users ON users.user_id = posts.user_name_id ORDER BY category.category_title");
        break;
        case 'author':
          $result= query("SELECT * FROM posts LEFT JOIN category ON posts.post_category_id = category.category_id LEFT JOIN users ON users.user_id = posts.user_name_id ORDER BY users.user_name");
        break;
        case 'title':
          $result= query("SELECT * FROM posts LEFT JOIN category ON posts.post_category_id = category.category_id LEFT JOIN users ON users.user_id = posts.user_name_id ORDER BY posts.post_title");
        break;
    }
}

?>


<div class="container py-4 white-container">
  <a href="posts.php?source=addpost" class="add-post-link "><i class="fas fa-plus-square"></i> Add a new post</a> 


  <form  action="" method="post">
    <div class="form-row col-lg-8 p-0">
      <div class="col">
        <select class="form-control" name="select_option" id="">
            <option value="" disabled selected hidden>Order by</option>
            <option value="category">Category</option>
            <option value="author">Author</option>
            <option value="title">Title</option>
        </select>
     </div>
     <div class="col" >
        <input type="submit" name="apply" class="btn button-apply text-white" value="Apply">
    </div>
    </div>
</form>


   <!-- Posts Table -->
  <section class="table-responsive py-2 mx-auto"> 
    <table class="table table-sm table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Category</th>
          <th scope="col">Author</th>
          <th scope="col">Title</th>
          <th scope="col">Subtitle</th>
          <th scope="col">Image</th>
          <th scope="col">Tags</th>
          <th scope="col">Comment</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
      <?php     
      
     

      while($row = mysqli_fetch_array($result)):
          $post_id = $row['post_id'];
          $post_category_id = $row['post_category_id'];
          $post_author = $row['user_name_id'];
          $post_title = $row['post_title'];
          $post_subtitle = $row['post_subtitle'];
          $post_image = $row['post_image'];
          $post_tags = str_replace(" ", ",",$row['post_tags']);
          $category_id = $row['category_id'];
          $category_title = $row['category_title'];
          $user_id = $row['user_id'];
          $user_name = $row['user_name'];
          

          echo "<tr>";
          echo "<th scope='row'> $post_id</th>";
          echo "<td>$category_title</td>";
          echo "<td> <a href='/marvel/profile/$user_id' class='titlehref'>$user_name</a></td>";
          echo "<td> <a href='/marvel/post/$post_id' class='titlehref'>$post_title</a></td>";
          echo "<td>$post_subtitle</td>";
          echo "<td><img width=50 height=45 src='../public/images/{$post_image}'></d>";
          echo "<td>$post_tags</td>";

          $result_count=query("SELECT * FROM comments WHERE comment_post_id = $post_id");
          $count_comments= mysqli_num_rows($result_count);

          echo "<td>$count_comments</td>";
          echo "<td><a href='posts.php?source=editpost&post_id={$post_id}'><i class='fas fa-edit fa-sm'></i></a></td>";
          echo "<td><a rel='$post_id' href='javascript:void()' class='delete_link'><i class='fas fa-trash-alt fa-sm'></i></a></td>";
          echo "</tr>";

      endwhile;?> 

      </tbody>
    </table>
  </section>


</div>
 
 
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
  })
</script>

