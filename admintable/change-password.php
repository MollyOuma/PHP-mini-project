<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive web page</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" class="">
    <script src="verify.js"></script>
</head>
<body>
    <div class="container " style="margin-top:30px">
    <!--header-->
    <header class="jumbotron text-center row col-sm-14" style="margin-bottom:2px;background:linear-gradient(white,#0073e6);padding:20px;">
    <?php include('password-header.php'); ?>
</header>
<!--body-->
    <div class="row" style="padding-left:0px">
        <nav class="col-sm-2">
            <ul class="nav nav-pills flex-column">
                <?php include('nav.php'); ?>
            </ul>
        </nav>
        <!--validate input-->
        <?php
        if($_SERVER['REQUEST_METHOD']== 'POST')
        {
            require('process-change-password.php');
        }
        ?>
        <div class="col-sm-8">
            <h2 class="h2 text-center">Change password</h2>
            <form action="change-password.php" method=post name="regform" id="regform" onsubmit="return checked();">
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">E-mail</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" maxlength="60" required value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">

                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-4 col-form-label">Current password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" name="password" placeholder="password" minlength="8" maxlength="12" required value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>">
                    
                    
                </div>
        </div>
        <div class="form-group row">
                <label for="password1" class="col-sm-4 col-form-label">password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password1" name="password1" placeholder="password" minlength="8"maxlength="12" required value="<?php if(isset($_POST['password1'])) echo $_POST['password1']; ?>">
                    <span id='message'>Between 8 and 12 characters.</span>
                </div>
    </div>

                <div class="form-group row">
                <label for="password2" class="col-sm-4 col-form-label">Confirm password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm password" minlength="8"maxlength="12" required value="<?php if(isset($_POST['password2'])) echo $_POST['password2']; ?>">
                    
                </div>
</div>
<div class="form-group row">
    <div class="col-sm-12">
        <input id="submit" class="btn btn-primary" type="submit" name="submit"
        value="Change password">
    </div>
</div>
</form>
</div>
    <?php 
   if(isset($errorstring))
    {
      
        echo '<footer class="jumbotron text-center row col-sm-14" style="padding-bottom:1px;padding-top:8px;background:linear-gradient(white,#0073e6);">';
    }
    else
    {
        echo '<aside class="col-sm-2">';
        include('info-col.php');
        echo '</aside>';
        echo '</div>';
        echo '<footer class="jumbotron text-center col-sm-12" style="padding-bottom:1px; padding-top:8px;background:linear-gradient(white,#0073e6);">'; 
    }

    include('footer.php');
    ?>
</footer>
</div>
    

<script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>