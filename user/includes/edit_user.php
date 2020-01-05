<?php
    if(isLoggedIn()){
        $user_id=$_SESSION['user_id'];
        
        $result=query("SELECT * FROM users WHERE user_id={$user_id}");

        while($row= mysqli_fetch_assoc($result)){
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_email = $row['user_email'];
            $user_fname = $row['user_fname'];
            $user_lname = $row['user_lname'];
            $user_image = $row['user_image'];
            $db_user_password = $row['user_password'];
    
        }
    }
?>

<?php
    if(isset($_POST['update_user'])){
        $user_fname = escape($_POST['user_fname']);
        $user_lname = escape($_POST['user_lname']);
        $user_password =  escape($_POST['user_password']);

        $user_image = $_FILES['user_image']['name'];
        $user_image_temp =  mysqli_real_escape_string($connection,$_FILES['user_image']['tmp_name']);
        move_uploaded_file($user_image_temp,"../public/images/$user_image");

            if(empty($user_image)) {
                $query = "SELECT * FROM users WHERE user_id= $user_id ";
                $select_image = mysqli_query($connection, $query);
        
                while($row = mysqli_fetch_array($select_image)){
                    $user_image = $row['user_image'];
                }
            }

        $error = [
            'user_password'=> '' 
        ];

        
        if($user_password != ''){
            if(strlen($user_password) < 6){
                $error['user_password']= 'Your password must be at least 6 characters';
            }
        }

        foreach($error as $key => $value){
            if(empty($value)){
                unset($error[$key]);
            }
        }
        
        if(empty($error)){
            if(!empty($user_password)){
                $hashed_password= password_hash($user_password,PASSWORD_BCRYPT,array('cost'=> 10));
                $stmt = mysqli_prepare($connection, "UPDATE users SET user_fname= ? ,user_lname= ? , user_image= ? ,user_password= ? WHERE  user_id= ?");
                mysqli_stmt_bind_param($stmt, 'ssssi', $user_fname, $user_lname, $user_image, $hashed_password, $user_id); 
                mysqli_stmt_execute($stmt);
                checkQuery($stmt);
                mysqli_stmt_close($stmt);
                $success_message = "<div class='alert alert-success' role='alert'>Your personal information has been succefully updated</div>";
                
            }elseif(empty($user_password)){
                $stmt = mysqli_prepare($connection, "UPDATE users SET user_fname= ? ,user_lname= ? , user_image= ? WHERE  user_id= ?");
                mysqli_stmt_bind_param($stmt, 'sssi', $user_fname, $user_lname, $user_image, $user_id); 
                mysqli_stmt_execute($stmt);
                checkQuery($stmt);
                mysqli_stmt_close($stmt);
                $success_message = "<div class='alert alert-success' role='alert'>Your personal information has been succefully updated</div>";
            }
        }
    }
?>

 
<form action="#" class="col-12 col-md-10 mx-auto" method="post"  enctype="multipart/form-data">
    <?= isset($success_message)?$success_message:'';?>   
    
    <h1 class="pb-3 title-edit-add">Edit Profile:</h1>

    <div class="form-group">
    <label for="user_name " class="font-weight-bold">Username:</label>
        <p><?=$user_name?></p>
        <hr class="hr-form">
    </div> 

    <div class="form-group ">
    <label for="user_email" class="font-weight-bold">Email:</label>
        <p><?=$user_email?></p>
        <hr class="hr-form">
    </div> 

    <div class="form-group pb-2">
        <label for="user_fname" class="font-weight-bold">First Name:</label>
        <input type="text" name="user_fname" id="user_fname" class="form-control" value='<?= isset($user_fname)? $user_fname:'' ?>' ?>
    </div> 

    <div class="form-group pb-2">
        <label class="font-weight-bold" for="user_lname">Last Name:</label>
        <input type="text" name="user_lname" id="user_lname" class="form-control" value='<?=$user_lname?>' ?>
    </div>

    <div class="form-group pb-2">
        <label for="" class="font-weight-bold">Icon:</label> <br>
        <img width="80" src="../public/images/<?= $user_image; ?>" alt=""><br>
        <input type="file" name="user_image" id="">
    </div>

    <div class="form-group pb-2">
        <label for="user_password" class="font-weight-bold">Password:</label>
        <input type="password" name="user_password" id="user_password" class="form-control <?= isset($error['user_password'])?'invalid-box-lighter':''?>" ?>
        <p class="invalid-field"><?= isset($error['user_password'])?$error['user_password']:''; ?></p>
    </div>

    <div class="form-group pt-2" > 
        <input type="submit" class="btn btn-dark btn-block" name="update_user" value="Update">
    </div>
    
</form>
