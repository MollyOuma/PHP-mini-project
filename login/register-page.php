<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="verify.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container" style="margin-top:30px">
    <header class="jumbotron text-center row" style="margin-bottom:2px;background:linear-gradient(white,#0073e6);padding:20px">
    <?php include('register-header.php'); ?>


    </header>

    <!--body seection-->
    <div class="row "style="padding-left:0px;">
    <nav class="col-sm-2">
        <ul class="nav nav-pills flex-column">
            <?php include('nav.php'); ?>
        
        </ul>
    </nav>
    <!--validate input-->
    <?php 
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        require('process-register-page.php');
    }
     ?>
     <div class="col-sm-8">
         <h2 class="h2 text-center">Register</h2>
         <form action="register-page.php" method="post" onsubmit="return checked();">
         <div class="form-group row">
             <label for="first_name" class="col-sm-4 col-form-label">First Name</label>
             <div class="col-sm-8">
                 <input type="text" class="form=control" id="first_name" name="first_name" placeholder="First Name" maxlength="30" required value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>">

             </div>
         </div>
         <div class="form-group row">
             <label for="last_name" class="col-sm-4 col-form-label">Last Name</label>
             <div class="col-sm-8">
                 <input type="text" class="form=control" id="last_name" name="last_name" placeholder="Last Name" maxlength="40" required value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>">

             </div>
         </div>
         <div class="form-group row">
             <label for="email" class="col-sm-4 col-form-label">E-mail</label>
             <div class="col-sm-8">
                 <input type="email" class="form=control" id="email" name="email" placeholder="E-mail" maxlength="60" required value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">

             </div>
         </div>
         <div class="form-group row">
             <label for="password1" class="col-sm-4 col-form-label">Password</label>
             <div class="col-sm-8">
                 <input type="password" class="form=control" id="password1" name="password1" placeholder="Password" minlength="8" maxlenth="12" required value="<?php if(isset($_POST['password1'])) echo $_POST['password1']; ?>">
                 <span id='message'>Between 8 and 12 characters.</span>

             </div>
             
         </div>
         <div class="form-group row">
             <label for="password2" class="col-sm-4 col-form-label">Confirm Password</label>
             <div class="col-sm-8">
                 <input type="password" class="form=control" id="password2" name="password2" placeholder="Confirm Password" minlength="8" maxlenth="12" required value="<?php if(isset($_POST['password2'])) echo $_POST['password2']; ?>">
                 

             </div>
         <div class="form-group row">
             <div class="col-sm-12">
                 <input id="submit" class="btn btn-primary" type="submit" name="submit" value="Register">

             </div>
         </div>

</form>


     </div>
     <?php 
     if(!isset($errorstring))
     {
         echo '<aside class="col-sm-2>';
         include('info-col.php');
         echo '<?aside>';
         echo '</div>';
         echo '<footer class="jumbotron text-center row col-sm-14" style="padding-bottom:1px;padding-top:8px;background:linear-gradient(white,#0073e6);">';

     }
     else{
         echo '<footer class="jumbotron text-center col-sm-12" style="padding-bottom:1px;padding-top:8px;background:linear-gradient(white,#0073e6);">';

     }
     include('footer.php');
     
     ?>


    </footer>

</div>
</body>
</html>