<?php include "includes/database.php" ?>
<?php include "includes/header.php" ?>

<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $username=  escape($_POST['username']);
    $email=  escape($_POST['email']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password= escape($_POST['password']);
    
    $error = [
        'username'=> '',
        'email'=> '',
        'password'=> '' 
    ];

    
    if($username == ''){
        $error['username']= 'Username field must not be empty'; 
    }elseif(strlen($username) < 4){
        $error['username']= 'Username must be more than 3 characters';
    }

    if(record_exists('users', 'user_name' ,$username)){
        $error['username']= 'Another user with this username already exists';   
    }


    if($email == ''){
        $error['email']= 'Email field must not be empty';
    }elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $error['email']= 'Please enter a valid email address';  
    }

    if(record_exists('users', 'user_email' ,$email)){
        $error['email']= 'This email is already registered. Want to <a href="login.php">login</a> instead?';
    }

    
    if($password == ''){
        $error['password']= 'password field must not be empty';
    }elseif(strlen($password) < 6){
        $error['password']= 'Your password must be at least 6 characters';
    }

    
    foreach($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }
   

    if(empty($error)){
        RegisterUser($username, $email, $password);
        loginUser($username,$password);
    }

} 


?>

<nav class="navbar navbar-expand-md navbar-dark text-uppercase login-nav">
    <a class="navbar-brand " href="/marvel/" >Marvel</a>
</nav>

<div class="container py-5 login-signup-container">
    <section class="col-10 col-lg-6 all-posts-container p-4 mx-auto text-white"  >
        <form action="signup.php" method="post" autocomplete="off">
            <div class="text-center pb-4">
                <h1>Sign Up</h1>
            </div>
            <div class="form-group mb-4 ">
                <label for="email" class="label-field">Email:</label>
                <input type="text" name="email" id="email" class="form-control <?= isset($error['email'])?'invalid-box':''?>" placeholder="Enter your email" autocomplete="on" value="<?= isset($email)? $email:'' ?>" >
                <p class="invalid-field"><?= isset($error['email'])?$error['email']:''; ?></p>
            </div>
            <div class="form-group mb-4">   
                <label for="username" class="label-field">Username:</label>
                <input type="text" name="username" id="username" class="form-control <?= isset($error['username'])?'invalid-box':''?>" placeholder="Enter a username" autocomplete="on" value="<?= isset($username)? $username:'' ?>" >
                <p class="invalid-field"><?= isset($error['username'])?$error['username']:''; ?></p>
            </div>
            <div class="form-group mb-4">
                <label for="password" class="label-field">Password</label>
                <input type="password" name="password" id="password" class="form-control <?= isset($error['password'])?'invalid-box':''?>" placeholder="Password must be at least 6 characters long" >
                <p class="invalid-field"><?= isset($error['password'])?$error['password']:''; ?></p>
            </div>

            <input type="submit" name="signup" class="btn red-button btn-lg btn-block text-white" value="Sign Up">
        </form>
    </section>
</div>

      
<?php include "includes/footer.php" ?>


 
