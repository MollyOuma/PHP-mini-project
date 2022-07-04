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
                try{
                    require('mysqli_connect.php');
                    $query= "SELECT CONCAT(last_name, ', ',first_name)AS name,";
                    $query.="DATE_FORMAT(registration_date,'%M %d,%Y')AS ";
                    $query.="regdat FROM users ORDER BY registration_date ASC";
                    $result=mysqli_query($dbcon,$query);
                    if($result)
                    {
                        echo '<table class="table table-striped">
                        <tr><th scope="col">Name</th><th scope="col">Date Registered</th></tr>';
                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                        {
                            echo '<tr><td>' . $row['name'] . '</td><td>' . $row['regdat'] . '</td></tr>';

                        }
                        echo '</table>';
                        mysqli_free_result($result);
                    }
                    else{
                        echo '<p class="error">The current users could not be retrieved. We apologize';
                        echo 'for any inconvinience.</p>';
                        echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
                        exit;

                    }
                    mysqli_close($dbcon);
                }
                catch(Exception $e)
                {
                    print "an exception occured.Message:" . $e->getMessage();
                    print "The system is busy please try later!";

                }
                catch(error $e)
                {
                    print "an exception occured.Message:" . $e->getMessage();
                    print "The system is busy please try later!";
                }
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