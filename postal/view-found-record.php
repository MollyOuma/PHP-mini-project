<?php
    session_start();
    if (!isset($_SESSION['Userlevel']) or ($_SESSION['Userlevel'] != 1)) {
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
                <div class="col-sm-10">
                    <h2 class="h2 text-center">These are the found Users.</h2>
                <p>
                <?php
                    try
                    {
                        // This script retrieves records from the users table.
                        require ('connection.php'); // Connect to the db.
                        echo '<p class="text-center">If no record is shown, ';
                        echo 'this is because you had an incorrect ';
                        echo ' or missing entry in the search form.';
                        echo '<br>Click the back button on the browser and try again</p>';
                        $Firstname = htmlspecialchars($_POST['Firstname'], ENT_QUOTES);
                        $Lastname = htmlspecialchars($_POST['Lastname'], ENT_QUOTES);
                        // Since it's a prepared statement below this sanitizing is not needed
                        // However, to consistently retrieve than sanitize is a good habit
                        $query = "SELECT Lastname, Firstname, Email, ";
                        $query .= "DATE_FORMAT(registration_date, '%M %d, %Y')";
                        $query .=" AS regdat, Class, Paid, Userid FROM users WHERE ";
                        $query .= "Lastname=? AND Firstname=? ";
                        $query .="ORDER BY registration_date ASC ";
                        $q = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($q, $query);
                        // bind values to SQL Statement
                        mysqli_stmt_bind_param($q, 'ss', $Firstname, $Lastname);
                        // execute query
                        mysqli_stmt_execute($q);
                        $result = mysqli_stmt_get_result($q);
                        if ($result) { // If it ran, display the records.
                            // Table header.
                            echo '<table class="table table-striped">
                            <tr>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Date Registered</th>
                                <th scope="col">Class</th>
                                <th scope="col">Paid</th>
                            </tr>';
                            // Fetch and display the records:
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                // Remove special characters that might already be in table to
                                // reduce the chance of XSS exploits
                                $Userid = htmlspecialchars($row['Userid'], ENT_QUOTES);
                                $Lastname = htmlspecialchars($row['Lastname'], ENT_QUOTES);
                                $Firstname = htmlspecialchars($row['Firstname'], ENT_QUOTES);
                                $Email = htmlspecialchars($row['Email'], ENT_QUOTES);
                                $registration_date = htmlspecialchars($row['regdat'], ENT_QUOTES);
                                $Class = htmlspecialchars($row['Class'], ENT_QUOTES);
                                $Paid = htmlspecialchars($row['Paid'], ENT_QUOTES);
                                echo '<tr>
                                    <td><a href="edit_user.php?id=' . $Userid . '">Edit</a></td>
                                    <td><a href="delete_user.php?id=' . $Userid . '">Delete</a></td>
                                    <td>' . $Lastname . '</td>
                                    <td>' . $Firstname . '</td>
                                    <td>' . $Email . '</td>
                                    <td>' . $registration_date . '</td>
                                    <td>' . $Class . '</td>
                                    <td>' . $Paid . '</td>
                                </tr>';
                            }
                            echo '</table>'; // Close the table.
                            mysqli_free_result ($result); // Free up the resources.
                        } 
                        else { // If it did not run OK.
                            // Public message:
                            echo '<p class="center-text">The current users could not be retrieved.';
                            echo 'We apologize for any inconvenience.</p>';
                            // Debugging message:
                            echo '<p>' . mysqli_error($conn) . '<br><br>Query: ' . $q . '</p>';
                            //Show $q is debug mode only
                        } // End of if ($result). Now display the total number of records/members.
                        mysqli_close($conn); // Close the database connection.
                    }
                    catch(Exception $e)  {
                        print "The system is currently busy. Please try later.";
                        print "An Exception occurred.Message: " . $e->getMessage();
                    }
                    catch(Error $e)  {
                        print "The system us busy. Please try later.";
                        print "An Error occurred. Message: " . $e->getMessage();
                    }
                ?>
                </div>
                <!-- Right side column content Section -->
                    <?php
                include 'footer.php';
                ?>
                </footer>
            </div>
    </body>
</html>