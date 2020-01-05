<form action="" method="post">
    <div class="form-group "> 
        <label class="leave-comment-label">Leave a comment:</label><br>
        <div class="form-row">

        <?php if(!isLoggedIn()): ?>
            <div class="col">
                <input type="text" class="form-control" name="comment_username" placeholder="Username*">
                <p class="invalid-field"><?= isset($error['comment_username'])?$error['comment_username']:''; ?></p>
            </div>
            <div class="col">
                <input type="email" class="form-control" name="comment_email" placeholder="Email*">
                <p class="invalid-field"><?= isset($error['comment_email'])?$error['comment_email']:''; ?></p>
            </div>
        <?php endif;?>

        </div>
    </div>

    <div class="form-group">  
        <textarea  cols="4" rows="5" class="form-control" name="comment_content" placeholder="Comment"></textarea>
        <p class="invalid-field"><?= isset($error['comment_content'])?$error['comment_content']:''; ?></p>
    </div> 
    <div class="form-group ">   
        <input type="submit" class="btn btn-md red-button text-white" name="post_comment" value="Post comment">
    </div> 
   
</form>
 