<?php
session_start();
if(!isset($_SESSION['user_level'])or ($_SESSION['user_level'] !=0))
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
    <title>template for interactive web page</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" class="">
</head>
<body>
    <div class="container" style="margin-top:30px">
    <header class="jumbotron text-center row" style="margin-bottom:2px;background:linear-gradient(white,#0073e6);padding:20px">
        <?php include('members-header.php');?>
    </header>
    <div class="row" style="padding-left:0px;">
    <nav class="col-sm-2">
        <ul class="nav nav-pills flex-column">
            <?php include('nav.php'); ?>
        </ul>
    </nav>
    <div class="col-sm-8">
        <h2 class="text-center">This is the members page</h2>
        <p>The members page content</p>
        <p class="h3 text-center">Special offers to members only</p>
        <p class="text-center"><strong>T-shirts 10.00</strong></p>
        <img src="images/polo.png" alt="POLO SHIRT" class="mx-auto d-block">
        <br>
    </div>
        <aside class="col-sm-2">
            <?php include('info-col.php'); ?>
</aside>
    </div>
    <footer class="jumbotron text-cente row" style="padding-bottom:1px;padding-top:8px;background:linear-gradient(white,#0073e6);text;">
    <?php include('footer.php') ; ?>

    </footer>
    </div>
</body>
</html>