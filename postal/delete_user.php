
<?php
    session_start();                                                            //#1
        if(!isset($_SESSION['Userlevel']) or ($_SESSION['Userlevel'] !=1)){
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
		<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.O/css/bootstrap.min.css" integrity="sha384-9gVO4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXrljddIhOegiulFwO5qRGvFXOd3Z4" crossorigin="anonymous">
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
                    <h2 class="text-center">Administration Delete </h2>
                   
                    <?php
                    try {
                        // Check for a valid user ID, through GET or POST: #1
                        if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
                            // From view_users.php
                            $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
                        } 
                        elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) {
                            // Form submission.
                            $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
                        } 
                        else { // No valid ID, kill the script.
                            // return to login page
                            header("Location: login.php");
                            exit();
                        }
                        require './connection.php';
                        // Check if the form has been submitted: #2
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $sure = htmlspecialchars($_POST['sure'], ENT_QUOTES);
                            if ($sure == 'Yes') { // Delete the record.
                                // Make the query:
                                // Use prepare statement to remove security problems
                                $q = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($q, 'DELETE FROM users WHERE Userid=? LIMIT 1');
                                // bind $id to SQL Statement
                                mysqli_stmt_bind_param($q, "s", $id);
                                // execute query
                                mysqli_stmt_execute($q);
                                if (mysqli_stmt_affected_rows($q) == 1) { // It ran OK
                                    // Print a message:
                                    echo '<h3 class="text-center">The record has been deleted.</h3>';
                                } 
                                else { // If the query did not run OK display public message
                                    echo '<p class="text-center">The record could not be deleted.';
                                    echo '<br>Either it does not exist or due to a system error.</p>';
                                    echo '<p>' . mysqli_error($conn ) . '<br />Query: ' . $q . '</p>';
                                    // Debugging message. When live comment out because this displays SQL
                                }
                            } 
                            else { // User did not confirm deletion.
                                echo '<h3 class="text-center">The user has NOT been deleted as ';
                                echo 'you requested</h3>';
                            }
                        } 
                        else { // Show the form. #3
                            $q = mysqli_stmt_init($conn);
                            $query = "SELECT CONCAT(Firstname, ' ', Lastname) FROM users WHERE Userid=?";
                            mysqli_stmt_prepare($q, $query);
                            // bind $id to SQL Statement
                            mysqli_stmt_bind_param($q, "s", $id);
                            // execute query
                            mysqli_stmt_execute($q);
                            $result = mysqli_stmt_get_result($q);
                            $row = mysqli_fetch_array($result, MYSQLI_NUM); // get user info
                            if (mysqli_num_rows($result) == 1) {
                                // Valid user ID, display the form.
                                // Display the record being deleted: #4
                                $user = htmlspecialchars($row[0], ENT_QUOTES);
                                ?>

                                <h2 class="h2 text-center">Are you sure you want to permanently delete <?php echo $user; ?>?</h2>
                                <form action="delete_user.php" method="post" name="deleteform" id="deleteform">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-8" style="padding-left: 70px;">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <input id="submit-yes" class="btn btn-primary" type="submit" name="sure" value="Yes"> -
                                            <input id="submit-no" class="btn btn-primary" type="submit" name="sure" value="No">
                                        </div>
                                    </div>
                                </form>
                                <?php
                            } 
                            else { // Not a valid user ID.
                                echo '<p class="text-center">This page has been accessed in error.</p>';
                            }
                        } // End of the main submission conditional.
                        mysqli_stmt_close($q);
                        mysqli_close($conn);
                    }
                    catch(Exception $e) {
                        print "The system is busy. Please try again.";
                        print "An Exception occurred. Message: " . $e->getMessage();
                    }
                    catch(Error $e) {
                        print "The system is currently busy. Please try again soon.";
                        print "An Error occurred. Message: " . $e->getMessage();
                    }
                    ?>

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