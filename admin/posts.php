<?php include "../includes/database.php" ?>
<?php include "includes/admin-header.php" ?>
<?php include "includes/admin-navbar.php" ?>
 

<div class="container py-4 white-container">

 
<?php 

if(isset($_GET['source'])){
  $source = $_GET['source'];
}else{
  $source="";
}

switch($source){
  case 'addpost':
  include "includes/add_post.php";
  break;

  case 'editpost':
  include "includes/edit_post.php";
  break;

  default:include "includes/view_all_posts.php";
}

 ?>
 

</div>

<?php include "includes/admin-footer.php" ?>

