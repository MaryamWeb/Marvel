<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "../admin/functions.php" ?>

<?php
    $_SESSION['user_id'] =  null;
    $_SESSION['username'] =  null;
    $_SESSION['useremail'] =  null;
    $_SESSION['userrole'] =  null;
    $_SESSION['userimage'] =  null;

    redirect("/marvel/index.php");
?>
 