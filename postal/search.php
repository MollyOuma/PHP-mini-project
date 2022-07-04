<?php
   /* session_start();
    if (!isset($_SESSION['Userlevel']) or ($_SESSION['Userlevel'] != 1)) {
        header("Location: login.php");
        exit();
    }*/
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=l, shrink-to-fit=no">
		<meta name="author" content="Website and system designer. Kashing74 KE">
		<title>Class Practicals</title>

		<!-- Bootstrap CSS File -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
		<link rel="stylesheet"href="https://stackpath•bootstrapcdn•com/bootstrap/4•1.O/css/bootstrap.min.css" integrity="sha384-9gVO4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXrljddIhOegiulFwO5qRGvFXOd3Z4" crossorigin="anonymous">
		<script src="verify.js"></script>
    </head>
    <body>
        <div class="container" style="margin-top: 30px;">
            <header class="jumbotron text-center row" style="margin-bottom: 2px; background: linear-gradient(white, #0073e6); padding: 20px;">
                <div class="col-sm-2">
                    <img class="img-fluid float-left" src="bootstrap/image/logo.png" alt="logo">  
                </div>  
                <div class="col-sm-8">
                    <h1 class="blue-text mb-4 font-bold">Admin Search</h1>
                </div>
                <nav class="col-sm-2">
                    <div class="btn-group-vertical btn-group-sm" role="group" aria-label="Button group">
                        <button type="button" class="btn btn-secondary" onclick="location.href='logout.php'">Logout</button>
                        <button type="button" class="btn btn-secondary" onclick="location.href='admin-view-users.php'">View members</button>
                        <button type="button" class="btn btn-secondary" onclick="location.href='search.php'">Search</button>
                        <button type="button" class="btn btn-secondary" onclick="location.href = '#'"> Addresses</button>
                        <button type="button" class="btn btn-secondary" onclick="location.href='password.php'">New password</button>
                    </div>
                </nav>
            </header>
            <!--Body section-->
            <div class="row" style="padding-left: 0px;">
                <!--Left-side column Menu Section-->
                <nav class="col-sm-2">
                    <ul class="nav nav-pills flex-column">
                        <?php include('nav.php');?>
                    </ul>
                </nav>
                <div class="col-sm-8">
                    <h2 class="h2 text-center">Search for a record</h2>
                    <h6 class="text-center">Both names are required items</h6>
                    <form action="view-found-record.php" method="POST">
                        <div class="form-group row">
                            <label for="Firstname" class="col-sm-4 col-form-label">Firstname:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="Firstname" name="Firstname" placeholder="First Name" maxlength="30" required value="<?php if (isset($_POST['Firstname'])) echo htmlspecialchars($_POST['Firstname'], ENT_QUOTES) ; ?>"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Lastname" class="col-sm-4 col-form-label">Lastname:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="Lastnamee" name="Lastname" placeholder="First Name" maxlength="30" required value="<?php if (isset($_POST['Lastname'])) echo htmlspecialchars($_POST['Lastname'], ENT_QUOTES) ; ?>"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="colo-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Search">
                            </div>
                        </div>
                    </form>
                 </div>
                 <!-- Right side column content Section -->
                 <?php 
                 if (!isset($errorstring)) {
                     echo '<aside class="col-sm-2">';
                     include 'col.php';
                    echo '</aside> ';
                    echo '</div>';
                    echo '<footer class="jumbotron text-center col-sm-12" style="padding-bottom:1px; padding-top:8px;" ';
                 }
                 else {
                    echo '<footer class="jumbotron text-center col-sm-12" style="padding-bottom:1px; padding-top:8px;" ';
                 } 
                 include 'footer.php';
                 ?>
                 </footer>
            </div>
    </body>
</html>