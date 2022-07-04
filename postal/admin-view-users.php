<?php

    session_start();
    if (!isset($_SESSION['Userlevel']) || ($_SESSION['Userlevel'] != 1)) {
        # code...
        header("Location: login.php");
        exit();
    }
?>


<!DOCTYPE html>
<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	    <meta name="author" content="Kashingi Web disigner">
	    <title>Class Practicals</title>

	    <!--link to bootstrap-->
	    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	    <!--Main styleshet -->
	    <link rel="stylesheet" type="text/css" href="bootstrap/main.css">
    </head>
    <body>
        <div class="container" style="margin-top: 30px;">
            <!--The header Section -->
	        <header class="jumbotron text-center row" style="margin-bottom: 2px; background: linear-gradient(white, #0073e6); padding: 20px;">
	            <div class="col-sm-2">
                    <img class="img-fluid float-left" src="bootstrap/image/logo.png" alt="logo">
		        </div>
	            <div class="col-sm-8">
			        <h1 class="font-bold">Welcome to the world of designers</h1>
		        </div>
		        <div class="col-sm-2">
			        <nav class="btn-group-vertical btn-group-sm" role="group" aria-label="button-group">
				        <button type="button" class="btn btn-secondary" onclick="location.href='logout.php'">Logout</button>
                        <button type="button" class="btn btn-secondary" onclick="location.href='search.php'">Search</button>
				        <button type="button" class="btn btn-secondary" onclick="location.href='password.php'">New Password</button>
			        </nav>
			    </div>
	        </header>
            <!--The body Section -->
		    <div class="row" style="padding-left: 2px;">
			    <!--The nav section -->
		        <nav class="col-sm-2">
		            <ul class="nav nav-pills flex-column">
				        <?php include 'nav.php';?>
			        </ul>
		        </nav>
                <!-- Center column Content Section -->
                <div class="col-sm-8">
                    <h2 class="text-center">These are the registered users</h2>
                    <p>
                    <?php
                        try {
                            // This script retrieves all the records from the users table.
                            require('connection.php'); // Connect to the database.
                            //set the number of rows per display page
                            $pagerows = 4;
                            // Has the total number of pages already been calculated?
                            if ((isset($_GET['p']) && is_numeric($_GET['p']))) {
                                //already been calculated
                                $pages = htmlspecialchars($_GET['p'], ENT_QUOTES);
                                // make sure it is not executable XSS
                            }
                            else {//use the next block of code to calculate the number of pages
                                //First, check for the total number of records
                                $query = "SELECT COUNT(Userid) FROM users";
                                $result = mysqli_query ($conn, $query);
                                $row = mysqli_fetch_array ($result, MYSQLI_NUM);
                                $records = htmlspecialchars($row[0], ENT_QUOTES);
                                // make sure it is not executable XSS
                                //Now calculate the number of pages

                                if ($records > $pagerows){
                                    //if the number of records will fill more than one page
                                    //Calculate the number of pages and round the result up
                                    // to the nearest integer
                                    $pages = ceil ($records/$pagerows);
                                }
                                else {
                                    $pages = 1;
                                }
                            }//page check finished
                            //Declare which record to start with
                            if ((isset($_GET['s'])) &&( is_numeric($_GET['s'])))  {
                                $start = htmlspecialchars($_GET['s'], ENT_QUOTES);
                                // make sure it is not executable XSS
                            }
                            else {
                                $start = 0;
                            }
                            $query = "SELECT Lastname, Firstname, Email, DATE_FORMAT(registration_date, '%M %d, %Y') AS";
                            $query .=" regdat, Class, Paid, Userid FROM users ORDER BY registration_date DESC LIMIT ?, ?";
                            $q = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($q, $query);
                            // bind $id to SQL Statement
                            mysqli_stmt_bind_param($q, "ii", $start, $pagerows);
                            // execute query
                            mysqli_stmt_execute($q);
                            $result = mysqli_stmt_get_result($q);
                            if ($result) { // #2
                                // If it ran OK (records were returned), display the records.
                                // Table header
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
                                // Fetch and print all the records:
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    // Remove special characters that might already be in table to
                                    // reduce the chance of XSS exploits #3
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
                                // Error message:
                                echo '<p class="text-center">The current users could not be ';
                                echo 'retrieved We apologize for any inconvenience.</p>';
                                // Debug message:
                                echo '<p>' . mysqli_error($conn) . '<br><br>Query: ' . $q . '</p>';
                                    exit;
                            } // End of else ($result)
                            // Now display the total number of records/members.
                            $q = "SELECT COUNT(Userid) FROM users";
                            $result = mysqli_query ($conn, $q);
                            $row = mysqli_fetch_array ($result, MYSQLI_NUM);
                            $members = htmlspecialchars($row[0], ENT_QUOTES);
                            mysqli_close($conn); // Close the database connection.
                            $echostring = "<p class='text-center'>Total membership: $members </p>";
                            $echostring .= "<p class='text-center' >";
                            if ($pages > 1){
                                //What nuumber is the current  ?
                                $current_page = ($start / $pagerows) + 1;
                                //If the page is not the first page create a prevous link
                                if ($current_page != 1) {
                                    $echostring .= '<a href="admin-view-users.php?s=' .($start - $pages). '&p=' .$pages. '" style="margin-right: 100px">Previous</a>    ';
                                }
                                //Create next link
                                if ($current_page != $pages) {
                                    $echostring .= '<a href="admin-view-users.php?s=' .($start + $pages). '&p=' .$pages. '"style="margin-left: 45px">Next</a>';
                                }
                                $echostring .='</p>';
                                echo $echostring;
                            } 
                        } //end of try
                        catch(Exception $e) // We finally handle any problems here
                        {
                            print "An Exception occurred. Message: " . $e->getMessage();
                            print "The system is busy please try later";
                        }
                        catch(Error $e) {
                            print "An Error occurred. Message: " . $e->getMessage();
                            print "The system is busy please try again later.";
                        }
                    ?>
                    </p>

                </div>  
                <!-- Right side Column Content Section -->
                <aside class="col-sm2">
                    <?php include 'col.php'; ?>
                </aside>
	        </div>
            <!--The footer section -->
            <footer class="jumbotron text-center" style="position: absolute; top:90%">
                <?php include 'footer.php'; ?>
            </footer>
        </div>
    </body>
</html>