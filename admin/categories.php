<?php include "../includes/database.php" ?>
<?php include "includes/admin-header.php" ?>
<?php include "includes/admin-navbar.php" ?>


<?php include "includes/delete_modal.php" ?>  

<div class="categories-container container py-4">

<!-- Insert Into Table -->
<section class="category-form col-lg-6 col-md-8">
  <form action="#" method="post">
    <div class="input-group ">
        <input type="text" name="category_title" class="form-control" placeholder="Insert A New Category">
        <span class="input-group-prepend">
        <input type="submit" class="btn btn-dark" name="submit" value="Insert">
        </span>
    </div>
    <?php insertCategory() ?>
    <?php deleteCategory(); ?>
  </form>
</section>


 <!-- Edit Form -->
<?php
  if(isset($_GET['edit'])){ 
    include "includes/edit_category.php";
  }
?>
 

<!-- Category Table -->
<section id="category-table"  class="col-lg-6 col-md-8 mx-auto">
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Category Title</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $result= query("SELECT * FROM category");
        
            while($row = mysqli_fetch_array($result)):
                $category_id = $row['category_id'];
                $category_title = $row['category_title'];
        ?>
              <tr>
                <th scope='row'><?= $category_id?></th>
                <td><?= $category_title?></td>
                <td><a href='categories.php?edit=<?=$category_id?>'><i class='fas fa-edit fa-sm'></a></td>
                <td><a rel='<?= $category_id ?>' href='javascript:void(0)' class='delete_link'><i class='fas fa-trash-alt fa-sm'></a></td>
              </tr>
        <?php endwhile;  ?>
    </tbody>
  </table>
</section>


</div>
 
 
<?php include "includes/admin-footer.php" ?>

<script>
  $(document).ready(function(){
    $(".delete_link").on("click", function(){
      var id=$(this).attr("rel");
      var delete_url='categories.php?delete='+ id;
      $(".modal_delete_link").attr("href",delete_url);
      $("#deleteModal").modal("show");
    })
  })
</script>

 