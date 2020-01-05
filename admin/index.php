<?php include "../includes/database.php" ?>
<?php include "includes/admin-header.php" ?>
<?php include "includes/admin-navbar.php" ?>
 

<?php
    $count_posts      =countTableRecords('posts');
    $count_comments   =countTableRecords('comments');
    $count_users      =countTableRecords('users');
    $count_categories =countTableRecords('category');
    $count_comments_pending =countCommentRecordsByStatus('comments','pending');
    $count_comments_approved =countCommentRecordsByStatus('comments','approved');
?>


<div class="container py-4 white-container">
  <div class="row">
    <div class="col-lg-12">

      <h1>Admin</h1>
        <hr>
    </div>
  </div>

    
<!---------------------Cards--------------------->
           
<div class="row py-3">

<!-- Posts -->
  <div class="col-lg-3 col-md-6 pb-4" >
    <div class="card card_posts card-border">
      <div class="card-body text-white">
        <div class=" row  ">
          <div class="col-3">
          <i class="far fa-sticky-note fa-5x"></i>
          </div>
          <div class="col-9 text-right" >
            <h5 class="card-number-count" ><?= $count_posts ?></h5>
            <p>Posts <a class="text-white " href="posts.php "><i class="fa fa-arrow-circle-right fa-1x"></i></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<!-- Comments -->
<div class="col-lg-3 col-md-6 pb-4" >
    <div class="card card_comments card-border">
      <div class="card-body text-white">
        <div class=" row  ">
          <div class="col-3">
            <i class="far fa-comment fa-5x"></i> 
          </div>
          <div class="col-9 text-right">
            <h5 class="card-number-count"><?= $count_comments ?></h5>
            <p>Comments <a class="text-white " href="comments.php "><i class="fa fa-arrow-circle-right fa-1x"></i></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Users -->
<div class="col-lg-3 col-md-6 pb-4">
    <div class="card card_users card-border" >
      <div class="card-body text-white">
        <div class=" row  ">
          <div class="col-3">
            <i class="far fa-user fa-5x"></i> 
          </div>
          <div class="col-9 text-right">
            <h5 class="card-number-count"><?= $count_users ?></h5>
            <p>Users <a class="text-white " href="users.php "><i class="fa fa-arrow-circle-right fa-1x"></i></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<!-- Categories -->
<div class="col-lg-3 col-md-6 pb-4">
    <div class="card card_categories card-border">
      <div class="card-body text-white">
        <div class=" row  ">
          <div class="col-3">
          <i class="far fa-list-alt fa-5x"></i> 
          </div>
          <div class="col-9 text-right">
            <h5 class="card-number-count" ><?= $count_categories ?></h5>
            <p>Categories <a class="text-white " href="categories.php "><i class="fa fa-arrow-circle-right fa-1x"></i></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>



</div>
<!-------------------End Cards------------------->

<!-------------------- Chart -------------------->

<div class="row  ">
  <script type="text/javascript" >
    google.charts.load('current', {'packages':['bar']});
    google.load("visualization", "1.1", {packages:["bar"]});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([ 
        ['Data', 'Count'],
            <?php 
                $element_text = ['Posts','All Comments','Approved','Pending','Users','Categories'];
                $element_count = [$count_posts,$count_comments,$count_comments_approved,$count_comments_pending,$count_users,$count_categories];
                for($i =0; $i < count($element_count); $i++){
                    echo "['{$element_text[$i]}'" . " ," ."{$element_count[$i]}],";
                }
            ?>
      ]);

      var options = { 
       
        colors: ['rgb(219,2,19)'],
        chart: {
          title: "Website Statistics",
          subtitle: 'Posts, Comments, Users and Categories:',
        }
    };

      var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>

    <div class="col-10 mx-auto">
      <div id="columnchart_material"></div>
    </div>

<!------------------- End Chart ------------------->
 
</div>
 
<?php include "includes/admin-footer.php" ?>

 



 
