<?php
try{
    require('mysqli_connect.php');
    echo '<p class="text-center">if no record is shown, ';
    echo 'this si because you had an incorrect or missing entry in the search form.';
    echo '<br> Click the back button on the browser and try again</p>';
    $query="SELECT last_name,first_name,email,";
    $query .="DATE_FORMAT(registration_date, '%M %d,%Y')";
    $query .="AS regdat,user_id FROM users WHERE ";
    $query .="last_name='smith'AND first_name='james'";
    $query .="ORDER BY registration_date ASC";
    //the string is hardcoded and so the prepare statement is not required.

    $result=mysqli_query($dbcon,$query);
    if ($result)
    {
        echo '<table class="table table-striped">
        <tr>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
        <th scope="col">Last Name</th>
        <th scope="col">First Name</th>
        <th scope="col">Email</th>
        <th scope="col">Date Registered</th>
        </tr>';

        //fetch and display records
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
        {
            $user_id=htmlspecialchars($row['user_id'],ENT_QUOTES);
            $last_name=htmlspecialchars($row['last_name'],ENT_QUOTES);
            $first_name=htmlspecialchars($row['first_name'],ENT_QUOTES);
            $email=htmlspecialchars($row['email'],ENT_QUOTES);
            $registration_date=htmlspecialchars($row['regdat'],ENT_QUOTES);
            echo '<tr>
            <td><a href="edit-user.php?id=' . $user_id .'">Edit</a></td>
            <td><a href="delete-user.php?id' .$user_id . '">Delete</a></td>
            <td>' .$last_name . '</td>
            <td>' . $first_name .'</td>
            <td>' . $email .'</td>
            <td>' .$registration_date .'</td>
            </tr>';
        }
        echo '</table>';
        mysqli_free_result($result);
    }
    else{
        echo '<p class="error">The current users could not be retrieved';
        echo 'we apologize for any inconivience</p>';
    }
    mysqli_close($dbcon);

}
catch(Exception $e)
{
    print "An exception occurred.Message: " .$e->getMessage();
    print "the system is currently busy.try again later";
}
catch(Error $e)
{
    print "An exception occurred.Message: " .$e->getMessage();
    print "The system is currently busy.Try again later";
}
?>