<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	    <meta name="author" content="Kashingi Web disigner">
	    <title>Class Practicals</title>

	    <!--link to bootstrap-->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
        <script src="verify.js"></script>

    </head> 
    <body>
        <div class="container" style="margin-top: 30px;">
        <header class="jumbotron text-center row" style="margin-bottom: 2px; background: linear-gradient(white, #0073e6); padding: 20px;">
                <div class="col-sm-2">
					<img class="img-fluid float-left" src="bootstrap/image/logo.png" alt="logo">
		        </div>
		        <div class="col-sm-8">
		    	    <h1 class="font-bold">Welcome to the world of designers</h1>
		        </div>
		        <div class="col-sm-2">
		    	    <nav class="btn-group-vertical btn-group-sm" role="group" aria-label="button-group">
			    	    <button type="button" class="btn btn-secondary" onclick="location.href='login.php'">Erase Entries</button>
				        <button type="button" class="btn btn-secondary" onclick="location.href='register.php'">Register</button>
			    	    <button type="button" class="btn btn-secondary" onclick="location.href='index.php'">Cancel</button>
				    </nav>
		        </div>
            </header>
            <!--The body Section -->
		    <div class="row" style="padding-left: 2px;">
			    <!--The left side column menu -->
			    <nav class="col-sm-2">
				    <ul class="nav nav-pills flex-column">
					    <?php
					    include 'nav.php';
					    ?>
				    </ul>
			    </nav>
                <!--Validate input-->
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        # code...
                        require 'process-login.php';

                    }//End of the amain submit conditional
                ?>
                <div class="col-sm-8">
                    <h2 class="h2 text-center">Login</h2>
                    <form action="login.php" method="POST" name="loginform" id="loginform">
                        <div class="form-group row">
                            <label for="Email" class="col-sm-4 col-form-label">Email Address</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="Email" name="Email" placeholder="E-Mail" value="<?php if(isset($_POST['Email'])) echo $_POST['Email']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Password" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" value="<?php if(isset($_POST['Password'])) echo $_POST['Password']; ?>">
                                <span id="message">Between 8 and 12 characters.</span>
                            </div>
                        </div>
                        <div class="form-group row">
							<div class="col-sm-12">
								<input id="submit" class="btn btn-primary" type="submit" name="submit" value="Login">
							</div>
						</div>
                    </form>
                </div>
                <!-- Right-side Column Content Section	#3 -->
				<?php 
					if(!isset($errorstring)) 
					{
						echo '<aside class="col-sm-2">';
						include('col.php');
						echo '</aside>';
						echo '</div>';
						echo '<footer class="jumbotron text-center row col-sm-14" style="padding-bottom:lpx; padding-top:8px;">' ;
					} 
					else 
					{
						echo '<footer class="jumbotron text-center col-sm-12" style="padding-bottom:lpx; padding-top:8px;">' ;
					}
					include('footer.php');
				?>
		    </div>
        </div>
    </body>
</html>
	
