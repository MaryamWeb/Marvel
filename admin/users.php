<?php ob_start(); ?>
<?php include "../includes/database.php" ?>
<?php include "includes/admin-header.php" ?>
<?php include "includes/admin-navbar.php" ?>
 

<?php include "includes/user_role_modal.php" ?>  
<?php include "includes/delete_modal.php" ?> 

<div class="container white-container py-4">

  <section class="table-responsive py-2 mx-auto"> 
    <table class="table table-sm ">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Username</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role[Admin/User]</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>

      <?php 
          $result= query("SELECT * FROM users");
          while($row = mysqli_fetch_array($result)):
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_fname = $row['user_fname'];
            $user_lname = $row['user_lname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            
            echo "<tr>";
            echo "<th scope='row'> $user_id</th>";
            echo "<td>$user_name</td>";
            echo "<td>$user_fname</td>";
            echo "<td>$user_lname</td>";
            echo "<td>$user_email</td>";

              
              if($user_role=='user'){
                echo "<td>$user_role  <a rel='$user_id' href='javascript:void()' class='edit_rule_link2'><i class='fas fa-exchange-alt fa-sm'></i></a></td>";
              }elseif($user_role=='admin'){
                echo "<td>$user_role  <a rel='$user_id' href='javascript:void()' class='edit_rule_link'><i class='fas fa-exchange-alt fa-sm'></i></a></td>";
              }

            echo "<td><a rel='$user_id' href='javascript:void()' class='delete_user_link'><i class='fas fa-trash-alt fa-sm'></i></a></td>";
            echo "</tr>";  

          endwhile;?>  

      </tbody>
    </table>
  </section>


</div>
 
<?php
  if(isset($_GET['toAdmin'])){
    $user_id = $_GET['toAdmin'];
    
    $result=query("UPDATE users SET user_role='admin' WHERE user_id= $user_id");
    redirect("users.php");
  }
?>

<?php
  if(isset($_GET['toUser'])){
    $user_id = $_GET['toUser'];
    
    $result=query("UPDATE users SET user_role='user' WHERE user_id= $user_id");
    redirect("users.php");
  }
?>

<?php
  if(isset($_GET['delete'])){
    $user_id = $_GET['delete'];
    
    $result=query("DELETE FROM users WHERE user_id= {$user_id}");
    redirect("users.php");
  }
?>


<script>
  $(document).ready(function(){
    
    $(".edit_rule_link").on("click", function(){
      var id=$(this).attr("rel");
      var edit_to_user='users.php?toUser='+ id;  
      $(".modal_edit_link").attr("href",edit_to_user);
      $("#editRoleModal").modal("show");
    })

    $(".edit_rule_link2").on("click", function(){
      var id=$(this).attr("rel");
      var edit_to_admin='users.php?toAdmin='+ id;  
      $(".modal_edit_link").attr("href",edit_to_admin);
      $("#editRoleModal").modal("show");
    })

    $(".delete_user_link").on("click", function(){
      var id=$(this).attr("rel");
      var delete_url='users.php?delete='+ id;  
      $(".modal_delete_link").attr("href",delete_url);
      $("#deleteModal").modal("show");
    })

  })
</script>

  
<?php include "includes/admin-footer.php" ?>
