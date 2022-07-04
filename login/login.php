<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" class="">
    <script src="verify.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container" style="margin-top=30px">
<!--header section-->
        <header class="jumbotron text-center row col-sm-14" style="margin-bottom:2px;background:linear-gradient(white,#0073e6);padding:20px;">
            <?php include('login-header.php');?>
    </header>
    <!--body section-->
    <div class="row" style="padding-left:0px;">
    <nav class="col-sm-2">
        <ul class="nav nav-pills flex-column">
            <?php include('nav.php');?>
        </ul>
    </nav>
    <!--validate input-->
    <?php
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        require('process-login.php');
    }
    ?>
    <div class="col-sm-8">
        <h2 class="h2 text-center">Login</h2>
        <form action="login.php" method="post" name="loginform" id="loginform">
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email Address:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" maxlength="30" required value=<?php if(isset($_POST['email']))echo $_POST['email'];?> >

            </div>
            </div>
    
    <div class="form-group row">
                <label for="password" class="col-sm-4 col-form-label">Password:</label>
               <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="40" required value=<?php if(isset($_POST['password']))echo $_POST['password'];?> >

    </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <input id="submit" class="btn btn-primary"type="submit" name="submit" value="Login">
        </div>
    </div>
</form>
</div>
<?php
if(!isset($errorstring))
{
    echo '<aside class="col-sm-2">';
    include('info-col.php');
    echo '</aside>';
    echo '</div>';
    echo '<footer class="jumbotron text-center row col-sm-14" style="pading-bottom:1px;padding-top:8px;background:linear-gradient(white,#0073e6);">';
}
else
{
    echo '<footer class="jumbotron text-center col-sm-12"style="padding-bottom:1px;padding-top:8px;background:linear-gradient(white,#0073e6);">';
}
include('footer.php');
?>
</footer>
</div>
</body>
</html>