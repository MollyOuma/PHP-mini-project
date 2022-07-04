<?php
session_start();
if(!isset($_SESSION['user_level'])or ($_SESSION['user_level'] != 1))
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
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" class="">
    <title>template</title>
</head>
<body>
    <div class="container" style="margin-top:30px">
    <!--header section-->
    <header class="jumbotron text-center row col-sm-14" style="margin-bottom:2px;background:linear-gradient(white,#0073e6);padding:20px;">
    <?php include('admin-header.php'); ?>


    </header>
    <!--body section-->
    <div class="row" style="padding: left 0px;">
    <nav class="col-sm-2">
        <ul class="nav nav-pills flex-column">
            <?php include('nav.php'); ?>

        </ul>
    </nav>
    <div class="col-sm-8">
        <h2 class="h2 text-center">search for a record</h2>
        <h6 class="text-center">Both names are required items</h6>
        <form action="view-found-record.php" method="post">
            <div class="form-group row">
                <label for="first_name" class="col-sm-4 col-form-label">First Name:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control-label" id="first_name" name="first_name" placeholder="First Name" maxlength="30" required value= "<?php if(isset($_POST['first_name']))
                    echo htmspecialchars($_POST['first_name'],ENT_QUOTES); ?> ">
            </div>
                </div>
            <div class="form-group row">
                <label for="last_name" class="col-sm-4 col-form-label">Last Name:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control-label" id="last_name" name="last_name" placeholder="Last Name" maxlength="40" required value="<?php if(isset($_POST['last_name']))
                    echo htmlspecialchars($_POST['last_name'],ENT_QUOTES); ?>">
                </div>

            </div>
            <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                    <input id="submit" class="btn btn-primary" type="submit" name="submit" value="search">
                </div>
            </div>
</form>
    </div>
    <!--right-side column content section-->
    <?php
   
    if(!isset($errorstring))
    {
        echo '<aside class="col-sm-2">';
        include('info-col.php');
        echo '</aside>';
        echo '</div>';
        echo '<footer class="jumbotron text-center col-sm-12" style="padding-bottom:1px;padding-top:8px;background:linear-gradient(white,#0073e6);">';
    }
    else
    {
        echo '<footer class="jumbotron text-center col-sm-12" style="padding-bottom:1px;padding-top:8px;background:linear-gradient(white,#0073e6);">';
    }
    
    include('footer.php');
    ?>
    </footer>

    </div>
    
</body>
</html>