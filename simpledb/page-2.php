<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <title>Template for interactive webpage</title>
</head>
<body>
    <div class="container" style="margin-top:30px">
    
        <header class="jumbotron text-center row"
        style="margin-bottom:2px; background:linear-gradient(
            white,#0073e6 );padding:20px;">
             
             <?php
             //include('header-for-template.php');
             include('header.php');

             ?>
             
            
    </header>
    <div class="row" style="padding-left:0px;">
    <nav class="col-sm-2">
        <ul class="nav nav-pills flex-column">
            <?php include('nav.php'); ?>

        </ul>
    </nav>


    <div class="col-sm-8">
        <h2 class ="text-center">This is the Home page</h2>
        <p>
            welcome to this site where we make everything interactive with the user.
            We have a database that is incorporated in the webpage.
            <h1> THIS IS THE SECOND PAGE!</h1>
        </p>
    </div>
    <aside class="col-sm-2">
      <?php include('info-col.php'); ?>
  </aside>

  </div>
  <footer class="jumbotron text-center row"
   style="padding-bottom:1px; padding-top:8px; background:linear-gradient(white,#0073e6)">
   <?php include('footer.php'); ?>

  </footer>
 
</div>
<script src="active.js">
    document.getElementById("page2").classList.add('active');
</script>
</body>
</html>