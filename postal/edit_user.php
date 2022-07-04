
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
                    <h2 class="text-center">Administration Edit</h2>
               <p>
               <?php
                    try
                    {
                        // After clicking the Edit link in the found_record.php page. This code is executed
                        // The code looks for a valid user ID, either through GET or POST:
                        if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
                            // From view_users.php
                            $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
                        } 
                        elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) {
                            // Form submission.
                            $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
                        } 
                        else { // No valid ID, kill the script.
                            echo '<p class="text-center">
                            This page has been accessed in error.</p>';
                            include ('footer.php');
                            exit();
                        }
                        require ('connection.php');
                        // Has the form been submitted?
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $errors = array();
                            // Look for the first name:
                            $Firstname = filter_var( $_POST['Firstname'], FILTER_SANITIZE_STRING);
                            if (empty($Firstname)) {
                                $errors[] = 'You forgot to enter your first name.';
                            }
                            // Look for the last name:
                            $Lastname = filter_var( $_POST['Lastname'], FILTER_SANITIZE_STRING);
                            if (empty($Lastname)) {
                                $errors[] = 'You forgot to enter your last name.';
                            }
                            // Look for the email address:
                            $Email = filter_var( $_POST['Email'], FILTER_SANITIZE_EMAIL);
                            if ((empty($Email)) || (!filter_var($Email, FILTER_VALIDATE_EMAIL))) {
                                $errors[] = 'You forgot to enter your email address';
                                $errors[] = ' or the e-mail format is incorrect.';
                            }
                            // Look for the class: #1
                            $Class = filter_var( $_POST['Class'], FILTER_SANITIZE_NUMBER_INT);
                            if (empty($Class)) {
                                $errors[] = 'You forgot to the class or it is not numeric.';
                            }
                            // Look for the Paid Status: #2
                            $Paid = filter_var( $_POST['Paid'], FILTER_SANITIZE_STRING);
                            if (empty($Paid)) {
                                $errors[] = 'You forgot to enter the paid status.';
                            }
                            if (!(($Paid == "No") || ($Paid == "Yes"))) {
                                $errors[] = "Paid must be No or Yes.";
                            }
                            if (empty($errors)) { // If everything's OK.
                                $q = mysqli_stmt_init($conn);
                                $query = 'SELECT Userid FROM users WHERE Email=? AND Userid !=?';
                                mysqli_stmt_prepare($q, $query);
                                // bind $id to SQL Statement
                                mysqli_stmt_bind_param($q, 'si', $email, $id);
                                // execute query
                                mysqli_stmt_execute($q);
                                $result = mysqli_stmt_get_result($q);
                                if (mysqli_num_rows($result) == 0) {
                                    // e-mail does not exist in another record
                                    $query = 'UPDATE users SET Firstname=?, Lastname=?, Email=?, Class=?, Paid=?';
                                    $query .= ' WHERE Userid=? LIMIT 1';
                                    $q = mysqli_stmt_init($conn);
                                    mysqli_stmt_prepare($q, $query);
                                    // bind values to SQL Statement
                                    mysqli_stmt_bind_param($q, 'sssssi', $Firstname, $Lastname, $Email, $Class, $Paid, $id);
                                    // execute query
                                    mysqli_stmt_execute($q);
                                    if (mysqli_stmt_affected_rows($q) == 1) { // Update OK
                                        // Echo a message if the edit was satisfactory:
                                        echo '<h3 class="text-center">
                                        The user has been edited.</h3>';
                                    } 
                                    else { // Echo a message if the query failed.
                                        echo '<p class="text-center">
                                        The user could not be edited due to a system error.';
                                        echo ' We apologize for any inconvenience.</p>';
                                        // Public message.
                                        echo '<p>' . mysqli_error($conn) . '<br />Query: ' . $q . '</p>';
                                        // Debugging message.
                                        // Message above is only for debug and should not in live mode
                                    }
                                } 
                                else { // Already registered.
                                    echo '<p class="text-center">The email address has already been registered.</p>';
                                }
                            }
                            else { // Display the errors.
                                echo '<p class="text-center">
                                The following error(s) occurred:<br />';
                                foreach ($errors as $msg) { // Echo each error.
                                    echo " - $msg<br />\n";
                                }
                                echo '</p><p>Please try again.</p>';
                            } // End of if (empty($errors))section.
                        } // End of the conditionals
                        // Select the user's information to display in textboxes:
                        $q = mysqli_stmt_init($conn);
                        $query =
                        "SELECT Firstname, Lastname, Email, Class, Paid FROM users WHERE Userid=?";
                        mysqli_stmt_prepare($q, $query);
                        // bind $id to SQL Statement
                        mysqli_stmt_bind_param($q, 'i', $id);
                        // execute query
                        mysqli_stmt_execute($q);
                        $result = mysqli_stmt_get_result($q);
                        $row = mysqli_fetch_array($result, MYSQLI_NUM);
                        if (mysqli_num_rows($result) == 1) {
                            // Valid user ID, display the form.
                            // Get the user's information:
                            // Create the form:
                            ?>
                            <h2 class="h2 text-center">Edit a Record</h2>
                            <form action="edit_user.php" method="post" name="editform" id="editform">
                                <div class="form-group row">
                                    <label for="Firstname" class="col-sm-4 col-form-label">First Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="Firstname" name="Firstname" placeholder="First Name" maxlength="30" required value="<?php echo htmlspecialchars($row[0], ENT_QUOTES); ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Lastname" class="col-sm-4 col-form-label">Last Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="Lastname" name="Lastname" placeholder="Last Name" maxlength="40" required value="<?php echo htmlspecialchars($row[1], ENT_QUOTES); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Email" class="col-sm-4 col-form-label">E-mail:</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="Email" name="Email" placeholder="E-mail" maxlength="60" required value="<?php echo htmlspecialchars($row[2], ENT_QUOTES); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Class" class="col-sm-4 col-form-label">Membership Class:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="Class" name="Class" placeholder="Membership Class" maxlength="60" required value="<?php echo htmlspecialchars($row[3], ENT_QUOTES); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Paid" class="col-sm-4 col-form-label">Paid:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="Paid" name="Paid" placeholder="Paid" maxlength="60" required value="<?php echo htmlspecialchars($row[4], ENT_QUOTES); ?>">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $id ?>" />
                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label"></label>
                                    <div class="col-sm-8">
                                        <input id="submit" class="btn btn-primary" type="submit" name="submit" value="Register">
                                    </div>
                                </div>
                            </form>
                        <?php
                        } 
                        else { // The user could not be validated
                            echo '<p class="text-center">
                            This page has been accessed in error.</p>';
                        }
                        mysqli_stmt_free_result($q);
                        mysqli_close($conn);
                    }
                    catch(Exception $e) {
                        print "The system is busy. Please try later";
                        print "An Exception occurred.Message: " . $e->getMessage();
                    }catch(Error $e)  {
                        print "The system is currently busy. Please try again later";
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