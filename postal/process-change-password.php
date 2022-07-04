<?php
// This script is a query that UPDATES the passwords in the users table.
// Check that the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require ('connection.php'); //connect to the db
    $errors = array(); //Initialize an error array
    // Check for an email address
    $email = trim($_POST['email']);
    if (empty($email)) {
        $errors[] = 'You forgot to enter your email address.';
    }
    // Check for a password amd match against the confirmed password
    $password = trim($_POST['password']);
    if (empty($password)) {
        $errors[] = 'You forgot to enter your old password.';
    }
    // Prepare and check new password
    $new_password = trim($_POST['password1']);
    $verify_password = trim($_POST['password2']);
    if (!empty($new_password)){
        if (($new_password != $verify_password) || ( $password == $new_password)) {
            $errors[] = 'Your new password did not match the confirmed password and/or ';
            $errors[] = 'Your old password is the same as your new password.';
        }
    }
    else {
        $errors[] = 'You did not enter a new password.';
    } 
    if (empty($errors)) { //If everything is OK.
        try{
            //Check that the user has entered the right email address/password combination
            $query = "SELECT Userid, Password FROM users WHERE (Email=? )";
            $q = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($q, $query);
            //use prepared statement to ensure that only text is inserted
            //bind fields to SQL statement
            mysqli_stmt_bind_param($q, 's', $email);
            //execute query
            mysqli_stmt_execute($q);
            $result = mysqli_stmt_get_result($q);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ((mysqli_num_rows($result) == 1) && (password_verify($password, $row['Password']))) {   //Found one record
                //Change the password in the database...
                // Hash password current 60 characters but can increase
                $hashed_passcode = password_hash($new_password, PASSWORD_DEFAULT);
                // Make the query
                $query = "UPDATE users SET Password=? WHERE Email=?";
                $q = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($q, $query);
                // use prepared statement to ensure that only text is inserted
                //bind fields to SQL statement
                mysqli_stmt_bind_param($q, 'ss', $hashed_passcode, $email);
                // execute query
                mysqli_stmt_execute($q);
                if (mysqli_stmt_affected_rows($q) == 1) { //one row updated
                    //Thank you
                    header ("location: page-thanks.php");
                    exit();
                }
                else  { //If it did not run OK
                    //Public message
                    $errorstring = "System Error! <br /> You could bot change password due to ";
                    $errorstring .= "to a system error. We appologize for any inconvenience</p>";
                    echo "<p class='text-center col-sm-2' style='color:red'>$errorstring</p>";
                    // Debugging message below do not use in production
                    //echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query . '</p>';
                    // include footer then close program to stop execution
                    echo '<footer class="jumbotron text-center col-sm-12"
                        style="padding-bottom:1px; padding-top:8px;">
                        include("footer.php");
                        </footer>';
                    exit(); 
                }
            } 
            else { // invalid email address/password combination.
                $errorstring = 'Error! <br /> ';
                $errorstring .= 'The email address or/and password do not match those on file.';
                $errorstring .= "Please try again.";
                echo "<p class='text-center col-sm-2' style='color:red'>$errorstring</p>";
            }
        }
        catch(Exception $e) // We finally handle problems here
        {
            Print "An Exception Occurred. Message: " . $e->getMessage();
            print "The system is busy please try again later for you to complete your action";
        }
        catch (Error $e)
        {
            Print "An Exception Occurred. Message: " . $e->getMessage();
            print "The system is busy please try again later";
        }
    }
    else { //Report the errors.
        header ("location: register.php");
        $errorstring = "Error! The following error(s) occurred: <br>";
        foreach ($errors as $msg){//Print each error.
                $errorstring .= " - $msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        echo "<p class='text-center col-sm-2' style='color:red'>$errorstring</p>";
    }// End of IF (empty($errors))
}// End of main Submit condition

?>