<?php

    define('HOST','localhost',true);
    define('ROOT','root',true);
    define('PASSWORD','LcVHgSXeRMABNpMB',true);
    define('DATABASE','marvel',true);

    $connection = mysqli_connect( HOST, ROOT, PASSWORD, DATABASE); 

        if(!$connection){
            die("CONNECTION TO MYSQL DATABASE FAILED ".mysqli_error());
        }

?>