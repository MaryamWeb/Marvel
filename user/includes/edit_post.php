<?php
    if(isset($_GET['post_id'])){
        $post_id=$_GET['post_id'];
        
        $result =query("SELECT * FROM posts WHERE post_id={$post_id}");

        $row= mysqli_fetch_assoc($result);
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_subtitle = $row['post_subtitle'];
        $user_name_id = $row['user_name_id'];
        $post_image = $row['post_image'];
        $post_content =$row['post_content'];
        $post_tags = $row['post_tags'];
    }
?>

<?php
 if(isset($_POST['update'])){
    
    $post_category_id = escape($_POST['post_category_id']);
    $post_title = escape($_POST['post_title']);
    $post_subtitle =  escape($_POST['post_subtitle']);

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_content =  escape($_POST['post_content']);
    $post_tags =  escape($_POST['post_tags']);
    
    move_uploaded_file($post_image_temp,"../public/images/$post_image");

    if(empty($post_image)) {
        $result =query("SELECT * FROM posts WHERE post_id= $post_id ");

        while($row = mysqli_fetch_array($result)){
            $post_image = $row['post_image'];
        }
    }

    $error = [
        'post_title'=> '',
        'post_content'=> ''
    ];

    if($post_title == ''){
        $error['post_title']= 'Title is required'; 
    }

    if($post_content == ''){
        $error['post_content']= 'Content is required'; 
    }elseif(strlen($post_content) < 100){
        $error['post_content']= 'Content must be more than 100 characters';
    }
    
    foreach($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }
    

    if(empty($error)){
        $stmt = mysqli_prepare($connection, "UPDATE posts SET post_category_id = ? ,post_title = ? ,post_subtitle = ? ,post_image = ? ,post_content = ? ,post_tags = ?  WHERE post_id = ? ");
        mysqli_stmt_bind_param($stmt, 'isssssi', $post_category_id, $post_title, $post_subtitle, $post_image, $post_content, $post_tags,$post_id ); 
        mysqli_stmt_execute($stmt);
        checkQuery($stmt);
        mysqli_stmt_close($stmt);

        
        $success_message ="<div class='alert alert-success' role='alert'> Post has been succefully updated <a href= '/marvel/post/{$post_id}'  class='alert-link'> Click here to check the post</a> or
                           <a href='posts.php?source=posts' class='alert-link'>view all your posts</a></div>"; 
    }
}
?>

<form action="#" class="col-12 col-md-10 mx-auto" method="post"  enctype="multipart/form-data">
    <?= isset($success_message)?$success_message:''?>   
   
    <h1 class="pb-3 title-edit-add">Edit Post:</h1>
 
    <div class="form-group pb-1">
        <label for="post_title" class="font-weight-bold">Title</label>
        <input type="text" name="post_title" id="post_title" class="form-control <?= isset($error['post_title'])?'invalid-box-lighter':''?>" value='<?= isset($post_title)? $post_title:''?>' ?>
        <p class="invalid-field"><?= isset($error['post_title'])?$error['post_title']:''; ?></p>
    </div> 

    <div class="form-group pb-2">
        <label for="post_subtitle" class="font-weight-bold">Subtitle</label>
        <input type="text" name="post_subtitle" id="post_subtitle" class="form-control" value='<?= isset($post_subtitle)? $post_subtitle:''?>'>
    </div> 
    
    <div class="form-group pb-2">  
        <label for="post_category_id" class="font-weight-bold">Category</label> <br>
       <select name="post_category_id">
       <option value='' hidden>Choose a category</option>
          <?php
           $result= query("SELECT * FROM category");
           
               while($row = mysqli_fetch_array($result)){
                   $category_id = $row['category_id'];
                   $category_title = $row['category_title'];

                   if($category_id == $post_category_id) {
                    echo "<option value='$category_id' selected>{$category_title}</option>";  
                  }else{
                    echo "<option value='$category_id'>{$category_title}</option>";  
                  } 
               }
           ?>
       </select>
   </div>

    <div class="form-group pb-2">
        <label for="" class="font-weight-bold">Image</label> <br>
        <img width="80" src="../public/images/<?= $post_image; ?>" alt=""><br>
        <input type="file" name="post_image" id="">
    </div> 
 

    <div class="form-group pb-2">
        <label for="post_tags" class="font-weight-bold">Tags</label>
        <input type="text" name="post_tags" id="post_tags" class="form-control" value='<?= isset($post_tags)? $post_tags:''?>'>
    </div> 

    <div class="form-group pb-2">
         <label for="bodyeditor" class="font-weight-bold">Content</label>
        <div class=" <?= isset($error['post_content'])?'invalid-box-lighter':''?>">
            <textarea name="post_content" id="bodyeditor" class="form-control">  <?= isset($post_content)? $post_content:''?></textarea>
        </div> 
        <p class="invalid-field"><?= isset($error['post_content'])?$error['post_content']:''; ?></p>
    </div> 

    <div class="form-group mx-auto pt-2" > 
    <input type="submit" class="btn btn-dark btn-block" name="update" value="Update">
    </div>
     
</form>
