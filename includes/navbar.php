<nav id="main-nav" class="navbar navbar-expand-md navbar-dark fixed-top text-uppercase" >
    <a class="navbar-brand " href="/marvel" >Marvel</a>
    <button class="navbar-toggler"  type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
            <div class="nav navbar-nav ">
                <?php
                    $result = query( "SELECT * FROM category");
                    while($row = mysqli_fetch_array($result)){
                        $category_id = $row['category_id'];
                        $category_title = $row['category_title'];
                        
                        //Active Links    
                        $category_class='';
                        if(isset($_GET['category']) && $_GET['category']==$category_id ){
                            $category_class='active-link';
                        }
                        
                        echo "<a class='nav-item nav-link $category_class' href='/marvel/category/{$category_id }'>{$category_title}</a>";
                    }
                ?>
            </div>
            <div class="navbar-nav ml-auto">  
                <?php if(!isLoggedIn()){?>
                    <a class="nav-item nav-link" href="/marvel/login" >Login </i><i class="fas fa-sign-in-alt 2x"></i></a>
                    <a class="nav-item nav-link" href="/marvel/signup" >Sign up <i class="fas fa-user-plus 2x"></i></a>
                <?php }else{ ?>
                    <a class="nav-item nav-link" href="<?php redirectUserAdminPage();?>"><?= $_SESSION['username'] ?> <i class="fas fa-user 2x"></i></a>
                    <a class="nav-item nav-link" href="/marvel/includes/logout.php" >Logout <i class="fas fa-sign-out-alt 2x"></i></a>
                <?php } ?>
                
            </div>
        </div> 
</nav>
   
<img id="marvel-banner" src="/marvel/public/images/marvel-header.jpg" class="img-fluid" alt="Responsive image"> 
    
 