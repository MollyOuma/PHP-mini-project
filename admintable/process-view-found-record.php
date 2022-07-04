<?php 
try
{
    //retrieves the records from user table
    require('mysqli_connect.php'); //connect to the db
    echo '<p class="text-center">If no record is shown,this is because you had an incorrect or missing entry in the search form.';
    echo '<br> Click the button on the browser and try again</p>';
    $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
    $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);


    //to constantly retrieve than sanitize is a good habit
    $query="SELECT last_name, first_name, email, ";
    $query .="DATE_FORMAT(registration_date, '%M %d %Y')";
    $query .="AS regdat,user_id FROM users WHERE";
    $query .=" last_name='?' AND  first_name='?' ";
    $query .="ORDER BY registration_date ASC ";
    $q=mysqli_stmt_init($dbcon);
    mysqli_stmt_prepare($q, $query);

    //bind values to sql statement
    mysqli_stmt_bind_param($q, 'ss' , $last_name, $first_name);
    //execute query
    mysqli_stmt_execute($q);
    $result=mysqli_stmt_get_result($q);
    if($result)
    {
        //table header
        echo '<table class="table table-striped">
        <tr>
        <th scope="col">Edit</th>
        <th scope="col">Deletet</th>
        <th scope="col">Last Name</th>
        <th scope="col">First Name</th>
        <th scope="col">Email</th>
        <th scope="col">Date Registered</th>
        </tr>';

        //fetch and display records
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
        {
            //remove special chars 
            $user_id=htmlspecialchar($row['user_id'] ,ENT_QUOTES);
            $last_name=htmlspecialchars($row['last_name'] , ENT_QUOTES);
            $first_name=htmlspecialchars($row['first_name'],ENT_QUOTES);
            $email=htmlspecialchars($row['email'], ENT_QUOTES);
            $registration_date=htmlspecialchars($row['regdat'],ENT_QUOTES);
            echo '<tr>
            <td><a href="edit-user.php?id' . $user_id . '">Edit</a></td>
            <td><a href="delete-user.php?id=' . $user_id . '">Delete</a></td>
            <td>' . $last_name . '</td>
            <td>' . $first_name . '</td>
            <td>' . $email . '</td>
            <td>' . $registration_date . '</td>
            </tr>';

        }
        echo '</table>';
        mysqli_free_result($result);

    }
    else
    {
        //if it did not run  ok
        echo '<p class="text-center">The current users could not be retrieved.';
        echo 'We apologize for any inconvience</p>';
        //debugging msg
        //echo '<p>' .mysqli_error($dbcon) . '<br><br>Query: ' . $q . '<p/>';
    }
    //display the total number of records
    mysqli_close($dbcon);

}
catch(Exception $e)
{
    print "the system is currently busy.please try again later";
    print "an exception occurred . Message:" .$e->getMessage();
}
catch(Error $e)
{
    print "the system is currently busy.please try again later";
    print "an exception occurred . Message:" .$e->getMessage();
}
?>