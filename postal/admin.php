
<?php
    session_start();                                                            //#1
        if(!isset($_SESSION['User_level']) or ($_SESSION['User_level'] !=1)){
            header("Location: login.php");
            exit();
        }
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
                    <h1 class="blue-text mb-4 font-bold">Welcome Administrator</h1>
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
                <!--Center Column Content Section-->
                <div class="col-sm-8">
                    <h2 class="text-center">Welcome to Administration </h2>
                    <h3>You have permission to:</h3>
                        <p>Edit and Delet a record</p>
                        <p>Use the View Members button to page through all members</p>
                        <p>Use the Search button to locate a aparticular member</p>
                        <p>Use the New Password button to change your password.</p>
                </div>
                <!--Right-side Column Content Section-->
                <aside class="col-sm-2">
                    <?php include('col.php'); ?>
                </aside>
            </div>
            <!-- Footer Content Section-->
            <footer class="jumbotron text-center row" style="padding-bottom: 1px; padding-top: 8px;">
                <?php include('footer.php');?>
            </footer>
    </div>
    </body>
</html>