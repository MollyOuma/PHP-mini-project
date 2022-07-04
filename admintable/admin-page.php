<?php
session_start();
if(!isset($_SESSION['user_level'])or($_SESSION['user_level'] !=1))
{
    header("Location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template for interactive web page</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" class="">
</head>
<body>
    <div class="container" style="margin-top:30px">
    <header class="jumbotron text-center row" style="margin-bottom:2px;background:linear-gradient(white,#0073e6);padding:20px;"><?php include('admin-header.php');?>
</header>
<div class="row" style="padding-left:0px;">
<nav class="col-sm-2">
    <ul class="nav nav-pills flex-column">
        <?php include('nav.php');?>
    </ul>
</nav>
<div class="col-sm-8">
    <h2 class="text-center">This is the administration page</h2>
    <h3>You have permission to:</h3>
    <p>Edit and Delete record</p>
    <p>Use the View members button to page through all the members</p>
    <p>Use the New Password button to change your password</p>
</div>
<aside class="col-sm-2">
    <?php include('info-col.php'); ?>
</aside>
</div>
<footer class="jumbotron text-center row" style="padding-bottom:1px;padding-top:8px;background:linear-gradient(white,#0073e6);">
<?php include('footer.php'); ?>
</footer>

    </div>
</body>
</html>