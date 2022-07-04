<?php
try
{
require('mysqli_connect.php');
//set number of rows per display
$pagerows=4;
if((isset($_GET['p']) && is_numeric($_GET['p'])))
{
    $pages=htmlspecialchars($_GET['P'], ENT_QUOTES);

}
else
{
    $q="SELECT COUNT(user_id)FROM users";
    $result=mysqli_query($dbcon,$q);
    $row=mysqli_fetch_array($result, MSQLI_NUM);
    $records=htmlspecialchars($row[0],ENT_QUOTES);

    if($records > $pagerows)
    {
        $pages=ceil($records / $pagerows);
    }
     else
    {
        $pages=1;
    }
}
//declare which record to start with
if((isset($_GET['s'])) && (is_numeric($_GET['S'])))
{
    $start=htmlspecialchars($_GET['s'], ENT_QUOTES);
}
else{
    $start=0;
}
$query="SELECT last_name,first_name,email,";
$query .="DATE_FORMAT(registration_date, '%M %d %Y)";
$query .="AS regdat,user_id FROM users ORDER BY registration_date ASC";
$query .="LIMIT?,?";
$q=mysqli_stmt_init($dbcon);
mysqli_stmt_prepare($q,$query);
//bind start and pagerows to SQLstatement
mysqli_stmt_bind_param($q,"ii",$start,$pagerows);
mysqli_stmt_execute($q);
$result=mysqli_stmt_get_result($q);
if($result)
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
    //fetch and print all records
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
        //REDUCE THE CHANCE OF XSS EXPLOITS
        $user_id=htmmlspecialchars($row['user_id'],ENT_QUOTES);
        $last_name=htmlspecialchars($row['last_name'],ENT_QUOTES);
        $first_name=htmlspecialchars($row['first_name'],ENT_QUOTES);
        $email=htmlspecialchars($row['email'],ENT_QUOTES);
        $registration_date=htmlspecialchars($row['regdat'],ENT_QUOTES);

        echo '<tr>
        <td><a href="edit-user.php?id='  . $user_id . '">Edit</a></td> 
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
else{
    echo 'p class=="text-center">The current users could noot be ';
    echo 'retrieved.we apologize for any inconvinience</p>';
    exit;

}
$q="SELECT COUNT(user_id) FROM users";
$result=mysqli_query($dbcon, $q);
$row = mysqli_fetch_array($result,MYSQLI_NUM);
$members=htmlspecialchars($row[0], ENT_QUOTES);
mysqli_close($dbcon);
$echostring ="<p class='text-center'>Total membership:$members</p>";
$echostring .= "<p class='text-center'>";
if($pages > 1)
{
    $current_page=($start/$pagerows)+1;
    //if the page is not the first then create a previous link
    if($current_page != 1)
    {
        $echostring  .= '<a href="admin-view-users.php?s=' . ($start - $pagerows) . 
        '&p=' . $pages . '">Previous </a>';
    }
    //create a link
    if($current_page !=$pages)
    {
        $echostring .='<a href="admin-view-users.php?s=' .($start + $pagerows) . '&p'. $pages .'">Next</a> ';
    }
    $echostring .='</p>';
    $echostring;
}
}

    catch(Exception $e)
    {
        print "an error ocurred .Message: " .$e->getMessage() ;
        print "the system is busy try again later";
    }
    catch(Error $e)
    {
        print "an error ocurred .Message: " .$e->getMessage() ;
        print "the system is busy try again later";
    }
?>

