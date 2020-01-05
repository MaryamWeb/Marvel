<?php include "../includes/database.php" ?>
<?php include "includes/user-header.php" ?>
<?php include "includes/user-navbar.php" ?>

 
<div class="container py-4 white-container">
 
<?php 

if(isset($_GET['source'])){
    $source = $_GET['source'];
  }else{
    $source="";
}

switch($source){
  case 'add_post':
  include "includes/add_post.php";
  break;

  case 'edit_post':
  include "includes/edit_post.php";
  break;

  case 'edit_user':
  include "includes/edit_user.php";
  break;

  default:include "includes/view_all_posts.php";
}

 ?>
 

</div>

<?php include "includes/user-footer.php" ?>

