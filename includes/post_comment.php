<?php
         

    if(isset($_POST['post_comment']) && isLoggedIn()){

            $comment_content= escape($_POST['comment_content']);
            $comment_post_id =$_GET['id']; 
            $comment_user_id =$_SESSION['user_id'];
            

            $result=query("SELECT * FROM users WHERE user_id={$comment_user_id}");
            
            $row= mysqli_fetch_assoc($result);
            $comment_username = $row['user_name'];
            $comment_email = $row['user_email'];
            $comment_role= $row['user_role'];
            $comment_image= $row['user_image'];

            $error = [
                'comment_content'=> ''
            ];

            if($comment_content == ''){
                $error['comment_content']= 'Content is required'; 
            }elseif(strlen($comment_content) > 500){
                $error['comment_content']= 'Your comment must not exceed 500 characters';
            }

            foreach($error as $key => $value){
                if(empty($value)){
                    unset($error[$key]);
                }
            }
        
            if(empty($error)){
                $stmt = mysqli_prepare($connection, "INSERT INTO comments(comment_post_id,comment_user_id,comment_username,comment_email,comment_content,comment_date,comment_role,comment_image) VALUES(?, ?, ?, ?, ?, now(), ?, ?)");
                mysqli_stmt_bind_param($stmt, 'iisssss', $comment_post_id, $comment_user_id,$comment_username,$comment_email,$comment_content,$comment_role,$comment_image); 
                mysqli_stmt_execute($stmt);
                checkQuery($stmt);
                mysqli_stmt_close($stmt);

            } 
        }
 
      
    if(isset($_POST['post_comment']) && !isLoggedIn()){
        $comment_post_id =$_GET['id'];
        $comment_content=  escape($_POST['comment_content']);
        $comment_username=  escape($_POST['comment_username']);
        $comment_email=  escape($_POST['comment_email']); 
        $comment_role= 'visitor';
        $comment_image='icon.png';

        $error = [
            'comment_username'=> '',
            'comment_email'=> '',
            'comment_content'=> ''
        ];


        if($comment_username == ''){
            $error['comment_username']= 'Username is required'; 
        }elseif(strlen($comment_username) < 4){
            $error['comment_username']= 'Username must be more than 3 characters';
        }

        if($comment_email == ''){
            $error['comment_email']= 'Email is required'; 
        }
        if($comment_content == ''){
            $error['comment_content']= 'Content is required'; 
        }

        if( record_exists('users', 'user_name' ,$comment_username)){
            $error['comment_username']= 'A registered user with this username already exists, Please use a different username.';   
        }

        if(record_exists('users', 'user_email' ,$comment_email)){
            $error['comment_email']= 'This email is already registered. please <a href="login.php">login</a> first?';
        }

        foreach($error as $key => $value){
            if(empty($value)){
                unset($error[$key]);
            }
        }
        if(empty($error)){
            $stmt = mysqli_prepare($connection, "INSERT INTO comments(comment_post_id,comment_username,comment_email,comment_content,comment_date,comment_role,comment_image) VALUES(?, ?, ?, ?, now(), ?, ?)");
            mysqli_stmt_bind_param($stmt, 'isssss', $comment_post_id,$comment_username,$comment_email,$comment_content, $comment_role,$comment_image); 
            mysqli_stmt_execute($stmt);
            checkQuery($stmt);
            mysqli_stmt_close($stmt);
        }
    }
 ?>