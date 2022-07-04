<?php
// This script is a query that INSERTs a record in the users table.
// Check that form has been submitted:
try {
    $errors = array(); // Initialize an error array.
    // Check for a first name:
    $Firstname = filter_var( $_POST['Firstname'], FILTER_SANITIZE_STRING);
    if (empty($Firstname)) {
        $errors[] = 'You forgot to enter your first name.';
    }
    // Check for a last name:
    $Lastname = filter_var( $_POST['Lastname'], FILTER_SANITIZE_STRING);
    if (empty($Lastname)) {
    $errors[] = 'You forgot to enter your last name.';
    }
    // Check for an email address:
    $Email = filter_var( $_POST['Email'], FILTER_SANITIZE_EMAIL);
    if ((empty($Email)) || (!filter_var($Email, FILTER_VALIDATE_EMAIL))) {
        $errors[] = 'You forgot to enter your email address';
        $errors[] = ' or the e-mail format is incorrect.';
    }
    // Check for a password and match against the confirmed password:
    $password1 = filter_var( $_POST['password1'], FILTER_SANITIZE_STRING);
    $password2 = filter_var( $_POST['password2'], FILTER_SANITIZE_STRING);
    if (!empty($password1)) {
        if ($password1 !== $password2) {
            $errors[] = 'Your two password did not match.';
        }
    } 
    else {
        $errors[] = 'You forgot to enter your password(s).';
    }
    
    // Check for an membership class
    if(isset($_POST['level'])) {
        $Class = filter_var( $_POST['level'], FILTER_SANITIZE_STRING); }
        if (empty($Class)) {
            $errors[] = 'Please choose your membership class.';
        }
        // Check for address:
        $address1 = filter_var( $_POST['address1'], FILTER_SANITIZE_STRING);
        if (empty($address1)) {
            $errors[] = 'You forgot to enter your address.';
        }
        // Check for address2: #1
        $address2 = filter_var( $_POST['address2'], FILTER_SANITIZE_STRING);
        if (empty($address2)) {
            $address2 = NULL;
        }
        // Check for city:
        $City = filter_var( $_POST['city'], FILTER_SANITIZE_STRING);
        if (empty($City)) {
            $errors[] = 'You forgot to enter your City.';
        }
        // Check for the county:
        $state_country = filter_var( $_POST['state_country'], FILTER_SANITIZE_STRING);
        if (empty($state_country)) {
            $errors[] = 'You forgot to enter your country.';
        }
        // Check for the post code:
        $Zip_code = filter_var( $_POST['Zip_code'], FILTER_SANITIZE_STRING);
        if (empty($Zip_code)) {
            $errors[] = 'You forgot to enter your post code.';
        }
        // Check for the phone number:
        $Phone = filter_var( $_POST['Phone'], FILTER_SANITIZE_STRING);
        if (empty($Phone)) {
            $Phone = NULL;
        }
        if (empty($errors)) { // If everything's OK.
            //Determine whether the email address has already been registered #2
            require ('connection.php'); // Connect to the db.
            $query = "SELECT Userid FROM users WHERE email = ? ";
            $q = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($q, $query);
            mysqli_stmt_bind_param($q, 's', $Email);
            mysqli_stmt_execute($q);
            $result = mysqli_stmt_get_result($q);
    
            if (mysqli_num_rows($result) == 0){
                //The email address has not been registered
                // Register the user in the database...
                // Hash password current 60 characters but can increase
                $hashed_passcode = password_hash($password1, PASSWORD_DEFAULT);
                require ('connection.php'); // Connect to the db.
                // Make the query:
                $query = "INSERT INTO users (Userid, Firstname, Lastname, Email, Password, ";
                $query .= "Class, address1, address2, City, state_country, Zip_code, Phone, ";
                $query .= "registration_date ) ";
                $query .= "VALUES(' ', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW() )";
                $q = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($q, $query);
                // use prepared statement to ensure that only text is inserted
                // bind fields to SQL Statement
                mysqli_stmt_bind_param($q, 'sssssssssss', $Firstname, $Lastname, $Email, $hashed_passcode,
                $Class, $address1, $address2, $City, $state_country, $Zip_code, $Phone);
                // execute query
                mysqli_stmt_execute($q);
                if (mysqli_stmt_affected_rows($q) == 1) { // One record inserted
                    header ("location: register-thanks.php?class=" . $Class);
                    exit();
                } 
                else { // If it did not run OK.
                    // Public message:
                    $errorstring = "<p class='text-center col-sm-8' style='color:red'>";
                    $errorstring .= "System Error<br />You could not be registered due ";
                    $errorstring .= "to a system error. We apologize for any inconvenience.</p>";
                    echo "<p class=' text-center col-sm-2'
                    style='color:red'>$errorstring</p>";
                    // Debugging message below do not use in production
                    echo '<p>' . mysqli_error($conn) . '<br><br>Query: ' . $query . '</p>';
                    mysqli_close($conn); // Close the database connection.
                    // include footer then close program to stop execution
                    echo '<footer class="jumbotron text-center col-sm-12"
                        style="padding-bottom:1px; padding-top:8px;">
                        include("footer.php");
                        </footer>';
                    exit();
                }
            }
            else{//The email address is already registered #3
                $errorstring = 'The email address is already registered.';
                echo "<p class=' text-center col-sm-2' 
                style='color:red'>$errorstring</p>";
            }
        } 
        else { // Report the errors.
            $errorstring = "Error! <br /> The following error(s) occurred:<br>";
            foreach ($errors as $msg) { // Print each error.
                $errorstring .= " - $msg<br>\n";
            }
            $errorstring .= "Please try again.<br>";
            echo "<p class=' text-center col-sm-2'
            style='color:red'>$errorstring</p>";
        }// End of if (empty($errors)) IF.
    }
    catch(Exception $e) // We finally handle any problems here
    {
        print "An Exception occurred. Message: " . $e->getMessage();
        print "The system is busy please try later";
    }
    catch(Error $e)
    {
        print "An Error occurred. Message: " . $e->getMessage();
        print "The system is busy please try again later.";
    }
    ?>