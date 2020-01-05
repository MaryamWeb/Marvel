<?php ob_start(); ?>
<?php include "../includes/database.php" ?>
<?php include "includes/admin-header.php" ?>
<?php include "includes/admin-navbar.php" ?>
 

<?php

$result= query("SELECT * FROM comments LEFT JOIN posts ON comments.comment_post_id=posts.post_id ORDER BY comments.comment_id DESC");

if(isset($_POST['apply'])){
    
    $select_option = $_POST['select_option'];
    switch($select_option){
        case 'username':
          $result= query("SELECT * FROM comments LEFT JOIN posts ON comments.comment_post_id=posts.post_id ORDER BY comments.comment_username");
        break;
        case 'email':
          $result= query("SELECT * FROM comments LEFT JOIN posts ON comments.comment_post_id=posts.post_id ORDER BY comments.comment_email");
        break;
        case 'date':
          $result= query("SELECT * FROM comments LEFT JOIN posts ON comments.comment_post_id=posts.post_id ORDER BY comments.comment_date");
        break;
        case 'status':
          $result= query("SELECT * FROM comments LEFT JOIN posts ON comments.comment_post_id=posts.post_id ORDER BY comments.comment_status");
        break;
        case 'responseto':
          $result= query("SELECT * FROM comments LEFT JOIN posts ON comments.comment_post_id=posts.post_id ORDER BY posts.post_title");
        break;
    }
}

?>

<div class="container py-4 white-container">
<?php include "includes/approve_comment_modal.php" ?>
<?php include "includes/delete_comment_modal.php" ?>

<form  action="" method="post">
    <div class="form-row col-lg-8 p-0">
      <div class="col">
        <select class="form-control" name="select_option" id="">
            <option value="" disabled selected hidden>Order by</option>
            <option value="username">Username</option>
            <option value="email">Email</option>
            <option value="date">Date</option>
            <option value="status">Status</option>
            <option value="responseto">Response To</option>
        </select>
     </div>
     <div class="col" >
        <input type="submit" name="apply" class="btn button-apply text-white" value="Apply">
    </div>
    </div>

</form>


   <!-- comments Table -->
  <section class="table-responsive py-2 mx-auto table-hover"> 
    <table class="table table-sm ">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">Content</th>
          <th scope="col">Response To</th>
          <th scope="col">Status</th>
          <th scope="col">Date</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody">
      
      <?php  while($row = mysqli_fetch_array($result)):
                    $comment_id = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_username = $row['comment_username'];
                    $comment_email = $row['comment_email'];
                    $comment_content = $row['comment_content'];
                    $comment_status = $row['comment_status'];
                    $comment_date= $row['comment_date'];
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                   

                    echo "<tr>";
                    echo "<th scope='row'> $comment_id</th>";echo "<td>$comment_username</td>";  
                    echo "<td>$comment_email</td>";
                    if(strlen($comment_content) > 40){
                      echo "<td><a href='#' data-toggle='popover' title='Full Comment'  data-trigger='focus' data-content='$comment_content'>". substr($comment_content,0,40) ."...</a></td>";

                    }else{
                      echo "<td>$comment_content</td>";
                    }
                   
                    echo "<td> <a href='/marvel/post/$post_id' class='titlehref'>$post_title</a></td>";
                    
                    if($comment_status=='pending'){
                      echo "<td>$comment_status <a rel='$comment_id' href='javascript:void()' class='approve_link'><i class='fas fa-clock fa-sm'></i></a></td>";
                    }else{
                      echo "<td>$comment_status <i class='fas fa-check-square fa-sm'></i></a></td>";
                    }
                     
                    echo "<td>$comment_date</td>";
                    echo "<td><a rel='$comment_id' href='javascript:void()' class='delete_link'><i class='fas fa-trash-alt fa-sm'></i></a></td>";
                    echo "</tr>";
      endwhile;?>  
      </tbody>
    </table>
  </section> 


</div>
 
<?php
  if(isset($_GET['approve'])){
    $comment_id = $_GET['approve'];
    
    $result= query("UPDATE comments SET comment_status='approved' WHERE comment_id= $comment_id");
    redirect("comments.php");
    
  }
?>

<?php
  if(isset($_GET['delete'])){
    $comment_id = $_GET['delete'];
    
    $result= query("DELETE FROM comments WHERE comment_id={$comment_id}");
    redirect("comments.php");
  }
?>

<script>
  $(document).ready(function(){
    
    $(".approve_link").on("click", function(){
      var id=$(this).attr("rel");
      var approve_url='comments.php?approve='+ id;  
      $(".modal_approve_comment_link").attr("href",approve_url);
      $("#approveCommentModal").modal("show");
    })

  
    $(".delete_link").on("click", function(){
      var id=$(this).attr("rel");
      var delete_url='comments.php?delete='+ id;  
      $(".modal_delete_comment_link").attr("href",delete_url);
      $("#deleteCommentModal").modal("show");
    })

    $('[data-toggle="popover"]').popover();
      trigger: 'focus';
    
  })
</script>
  
<?php include "includes/admin-footer.php" ?>
