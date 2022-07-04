<?php                                                                       
session_start();
if (!isset($_SESSION['user_level']) || ($_SESSION['user_level'] != 1))
{ header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive web page</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" class="">
</head>
<body>
    <div class="container" style="margin-top:30px">
    <!--header-->
    <header class="jumbotron text-center row" style="margin-bottom:2px;background:linear-gradient(white,#0073e6);padding:20px;">
        <?php include('header.php'); ?>
</header>

<!--body-->
<div class="row" style="paddding-left:0px;">
        <nav class="col-sm-2">
            <ul class="nav nav-pills flex-column">
                <?php include('nav.php'); ?>
            </ul>
        </nav>
        <!--column content-->
        <div class="col-sm-8">
            <h2 class="text-center">These are the registered users</h2>
            <p>
                <?php
                require('process-admin-view-users.php');
                ?>
             
        </div>
        <aside class="col-sm-2">
            <?php include('info-col.php'); ?>
        </aside>

</div>
<!--footer-->
<footer class="jumbotron text-center row" style="padding-top:8px;background:linear-gradient(white,#0073e6);">
                <?php include('footer.php'); ?>
</footer>

</div>
</body>
</html>