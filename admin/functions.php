<?php

    function redirect($location){
        header("Location:".$location);
        exit;
    }

    function escape($string){
        global $connection;
        $string =mysqli_real_escape_string($connection, trim($string));
        return $string = stripslashes($string);
    }

    function checkQuery($result){
        global $connection;

        if(!$result){
            die("QUERY FAILED ".mysqli_error($connection));
        }
    }

    function query($query){
        global $connection;
        $result = mysqli_query($connection, $query);
        checkQuery($result);
        return $result;
    }


 
/* ----------------------------------------- */

    function countTableRecords($table){
        $result= query("SELECT * FROM $table");
        return  mysqli_num_rows($result);
    }

         
    function countCommentRecordsByStatus($table, $status){
        $result= query("SELECT * FROM $table WHERE comment_status ='{$status}'");
        return mysqli_num_rows($result);
    }  

/* ----------------------------------------- */
 
function insertCategory(){
    global $connection;

    if(isset($_POST['submit'])){
        $category_title = escape($_POST['category_title']);
        
        if(!empty($category_title)){

            $stmt = mysqli_prepare($connection, "INSERT INTO category(category_title) VALUES(?) ");
            mysqli_stmt_bind_param($stmt, 's', $category_title);
            mysqli_stmt_execute($stmt);
            checkQuery($stmt);
            mysqli_stmt_close($stmt);
            
        }else{
            echo "<span>please insert a value</span>";
        }
    }
}
    
function deleteCategory(){
    if(isset($_GET['delete'])){
        $category_id=$_GET['delete'];
        $result= query("DELETE FROM category WHERE category_id=$category_id");
    }
}

function selectNavbarCategory(){
    $result= query("SELECT * FROM category");
    checkQuery($result);

    while($row = mysqli_fetch_array($result)){
        $category_id = $row['category_id'];
        $category_title = $row['category_title'];
        
        
        $category_class='';
        if(isset($_GET['category']) && $_GET['category']==$category_id )
        {
            $category_class='active';
        }
        
        echo "<a class='nav-item nav-link $category_class' href='../Marvel/category/$category_id }'>{$category_title}</a>";
   
    }  
}
    
/* ----------------------------------------- */

function redirectUserAdminPage(){
    if($_SESSION['userrole']=='admin'){ 
        echo "/marvel/admin/";
    }else{ 
        echo "/marvel/user/";
    }
}


function isLoggedIn(){
    if(isset($_SESSION['userrole'])){
        return true;
    }
        return false;
}

function isAdmin(){
    $result= query("SELECT user_role FROM users WHERE user_name='" . $_SESSION['username'] ."'");
     
    $row = mysqli_fetch_array($result);
    if($row['user_role']=='admin'){
        return true;
    }else{
        return false;
    }

}

function isUser(){
    $result= query("SELECT user_role FROM users WHERE user_name='" . $_SESSION['username'] ."'");
     
    $row = mysqli_fetch_array($result);
    if($row['user_role']=='user'){
        return true;
    }else{
        return false;
    }
}

/* ----------------------------------------- */

function record_exists($table, $field, $string) {

    global $connection;
    
    
    $query = "SELECT $field FROM $table WHERE $field = '$string' ";
    $result = mysqli_query($connection, $query);
    checkQuery($result);
    
    
    if(mysqli_num_rows($result) > 0) {
        
        return true;
        
    } else {
        
        return false;
        
    }
    
}

function loginUser($username,$password){
    $result=query("SELECT * FROM users WHERE user_name ='{$username}'");
    
        $row = mysqli_fetch_array($result);
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_fname = $row['user_fname'];
        $user_lname = $row['user_lname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
        

        if(password_verify($password, $user_password)){
            
            $_SESSION['user_id'] =  $user_id;
            $_SESSION['username'] =  $user_name;
            $_SESSION['useremail'] =  $user_email;
            $_SESSION['userrole'] =  $user_role;
            $_SESSION['userimage'] =  $user_image;

            redirect("/marvel/index");
        } 
         
}

function RegisterUser($username, $email, $password){
    global $connection;
    $password= password_hash($password,PASSWORD_BCRYPT,array('cost'=> 12));
    

    $stmt = mysqli_prepare($connection, "INSERT INTO users(user_name,user_email,user_password) VALUES(?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $password);
    mysqli_stmt_execute($stmt);
    checkQuery($stmt);
    mysqli_stmt_close($stmt);
    
}

?>
