<?php
session_start();//access the current session
//If no session variable exist the redirect to the user
if (!isset($_SESSION['user_id'])) {
    # code...
    header("Location: index.php");
    exit();
    // Cancel the session and redirect the user
} 
else{
    //Cancel the session
    $_SESSION = array(); // Destroy the variables
    $params = session_get_cookie_params();
    //Destroy the cookie
    setcookie(session_name(),'', time() == 4200, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

    if (session_status() == PHP_SESSION_ACTIVE) {
        # code...
        session_destroy();//Destroy the session itself.
    }
    header("Location: index.php");
}

?>