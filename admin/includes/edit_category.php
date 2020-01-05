<section class="category-form col-lg-6 col-md-8">
  <form action="" method="post">
      <div class="input-group ">

        <!-- Edit -->
        <?php
          if(isset($_GET['edit'])){
            $category_id=escape( $_GET['edit']);

            $result= query("SELECT * FROM category  WHERE category_id=$category_id");

              $row= mysqli_fetch_assoc($result);
              $category_id = $row['category_id'];
              $category_title = $row['category_title'];
              
              echo "<input type='text' name='category_title' class='form-control' value=' $category_title '>";
            
          }
        ?>

        <!-- Update -->
        <?php 
          if(isset($_POST['edit'])){
            $category_title =escape($_POST['category_title']); 

            $stmt = mysqli_prepare($connection, "UPDATE category SET category_title = ? WHERE category_id = ?");
            mysqli_stmt_bind_param($stmt, 'si', $category_title, $category_id );
            mysqli_stmt_execute($stmt);
            checkQuery($stmt);
            mysqli_stmt_close($stmt);
          }
         
        ?> 
        
         
        <span class="input-group-prepend">
          <input type="submit" class="btn btn-dark" name="edit" value="Update">
        </span>
      </div>
  </form>
</section>