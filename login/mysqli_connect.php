<?php
//accessing the database and connecting to MYSQL
define('DB_HOST','localhost');
define('DB_USER', 'root');
define('DB_PASSWORD','localhostroot');
define('DB_NAME' , 'logindb');
$dbcon=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
mysqli_set_charset($dbcon,'utf8');
/*try{
    $dbcon=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_set_charset($dbcon,'utf8');

}
catch(exceptions $e)
{
    print "exceptions occurred! message:" . $e->getmessage();
    print "system busy try again later";
}
catch (error $e)
{
    print "an error occurred! message:" . $e->getmessage();
    print "system busy try again later";
}*/
?>