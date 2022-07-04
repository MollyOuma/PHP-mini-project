<?php
//This section processes submissions from the login form
//Check if the form has been submitted 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...
    //Connect to database.
    try {
        //code...
        require 'connection.php';
        //Validate the email address
        //Check for an email address
        $Email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
        if ((empty($Email)) || (!filter_var($Email, FILTER_VALIDATE_EMAIL))) {
            # code...
            $errors[] = 'You forgot to enter your email';
            $errors[] = 'or the email format is incorrec t';
        }
        //Validate the password
        $Password =trim( $_POST['Password']);
       
        if (empty($Password)) {
            # code...
            $errors[] = 'You forgot to enter your password';

        }
        if (empty($errors)) {//If everything is ok          #1
            # code...
            //Retrieve the user_id, password, Firstname, and user_level for tha
            //email / password combination
            $query = "SELECT Password, Firstname, Lastname, Userlevel FROM users WHERE Email=?";
            $q = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($q, $query);
            //Bindd id to SQl statement
            mysqli_stmt_bind_param($q, "s", $Email);
            //Execute query
            mysqli_stmt_execute($q);
            $result = mysqli_stmt_get_result($q);
            $row = mysqli_fetch_array($result,MYSQLI_NUM);
            if (mysqli_num_rows($result)==1) {
                # code...
                //If one database row (record) matches the input:-
                //Start the session, fetch the record and insert the value in an array
                if (password_verify($Password, $row[0])) {            #2
                    # code...
                     session_start();
                    //Ensure that the user level is n ineterger
                    $_SESSION['Userlevel'] = (int) $row[3];
                    //Use a ternary operation to set the URL
                    $url = ($_SESSION['Userlevel'] === 1)?'admin.php':'users.php';
                    header('Location:'.$url);
                    //Make the browser load either the members or the admin page
                }
                else {//No emal match was made
                    # code...
                    $errors[] = 'E-mail or Password entered does not match our records  database';
                   
                }
            }
            else {// No Email match was made
                # code...
                $errors[] = 'E-mail or Password entered does not match our records in the used database.';
                $errors[] = 'Perhaps you need to register, just click the register';
                $errors[] = 'button on the header menu';
            }
        }
        if (!empty($errors)) {
            # code...
            $errorstring = "Error! <br /> The following error(s) occurred: <br>";
            foreach ($errors as $msg){
                $errorstring .= " $msg<br>\n";
            }
            $errorstring .= "Please try again <br>";
            echo "<p class='text-center col-sm-2' style='color:red'>$errorstring</p> ";
        }//End of if (!empty($errors)) IF
        mysqli_stmt_free_result($q);
        mysqli_stmt_close($q);


    } 
    catch(Exception $e)  {
        // We finally handle any problems here
        print "An Exception occurred. Message: " . $e->getMessage();
        print "The system is busy please try later to complete the transaction.";
    }
    catch(Error $e) {
        print "An Error occurred. Message: " . $e->getMessage();
        print "The system is busy please try again later.";
    }
}
?>