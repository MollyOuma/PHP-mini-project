<I DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	    <meta name="author" content="Kashingi Web disigner">
	    <title>Class Practicals</title>

        <!-- Bootstrap CSS File -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1•O/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFph3iwGPXrljddIh0egiulFw05qRGvFX0dJZ4" crossorigin="anonymous">
    </head>
    <body>
        <div class="container" style="margin-top:30px">
            <!-- Header Section -->
            <header class="jumbotron text-center row" style="margin-bottom:2px; background:linear-gradient(white, #0073e6); padding:20px;">
                <div class="col-sm-2">
                    <img class="img-fluid float-left" src="bootstrap/image/logo.png" alt="logo">
		        </div>
		        <div class="col-sm-8">
			        <h1 class="font-bold">Welcome to the world of designers</h1>
		        </div>
		        <div class="col-sm-2">
			        <nav class="btn-group-vertical btn-group-sm" role="group" aria-label="button-group">
				        <button type="button" class="btn btn-secondary" onclick="location.href='index.php'">Home Page</button>
				    </nav>
                </div>
            </header>
            <!-- Body Section -->
            <div class="row" style="padding-left: Opx;">
                <!-- Left-side Column Menu Section -->
                <nav class="col-sm-2">
                    <ul class="nav nav-pills flex-column">
                        <?php 
                        include('nav.php'); 
                        ?>
                    </ul>
                </nav>
                <!-- Center Column Content Section -->
                <div class="col-sm-8 text-center">
                    <h2>Your Password has been changed successfully.</h2>
                    On the Home Page, you will now be able to login  using the new. <br> password and add new quotes to the message board.
                    <!-- login does not yet work, nut will in the next chapter -->
                </div>
                <!-- Right-side Column Content Section -->
                <aside class="col-sm-2">
                    <?php 
                    include('col.php'); 
                    ?>
                </aside>
            </div>
            <!-- Footer Content Section -->
            <footer class="jumbotron text-center row" style="padding-bottom:lpx; padding-top:8px;">
                <?php 
                include('footer.php'); 
                ?>
            </footer>
        </div>
    </body>
</html>
