<?php include "includes/database.php" ?>
<?php include "includes/header.php" ?>


<?php  
    if(isset($_POST['login'])){
        $username= escape($_POST['username']);
        $password= escape($_POST['password']);

        $error = [
            'username'=> '',
            'password'=> '' 
        ];
    
        if($username == ''){
            $error['username']= 'Username field must not be empty'; 
        }
        
        if($password == ''){
            $error['password']= 'password field must not be empty';

        }else{
            $result = query("SELECT * FROM users WHERE user_name ='{$username}'");
            $row = mysqli_fetch_array($result);
            $user_password = $row['user_password'];
             
            
            if(!password_verify($password, $user_password)){
                $error['username']= 'Your username and/or password combination is incorrect.'; 
                $error['password']= 'Your username and/or password combination is incorrect.'; 
            } 
        }
        
        foreach($error as $key => $value){
            if(empty($value)){
                unset($error[$key]);
            }
        }
    
        if(empty($error)){
            loginUser($username,$password);
        }
    
    }    
    
?>


<nav class="navbar navbar-expand-md navbar-dark text-uppercase login-nav">
    <a class="navbar-brand " href="/marvel/" >Marvel</a>
</nav>

<div class="container py-5 login-signup-container">
    <section class="col-10 col-lg-6 all-posts-container p-4 mx-auto text-white"  >
        <form action="login.php" method="post" autocomplete="off">
            <div class="text-center pb-4">
                <h1>Login</h1>
            </div>
            <div class="form-group mb-4">
                <label for="username" class="label-field">Username:</label>
                <input type="text" name="username" id="username" class="form-control <?= isset($error['username'])?'invalid-box':''?>" placeholder="Enter your username" autocomplete="on" value="<?= isset($username)? $username:'' ?>">
                <p class="invalid-field"><?= isset($error['username'])?$error['username']:''; ?></p>
            </div>
            <div class="form-group mb-4">
                <label for="password" class="label-field">Password:</label>
                <input type="password" name="password" id="password" class="form-control  <?= isset($error['password'])?'invalid-box':''?>" placeholder="Password">
                <p class="invalid-field"><?= isset($error['password'])?$error['password']:''; ?></p>
            </div>

            <input type="submit" name="login" class="btn red-button btn-lg btn-block text-white" value="Login">
        </form>
    </section>
</div>
 
 
         
<?php include "includes/footer.php" ?>


 
