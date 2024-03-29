<?php
 if (isset($_GET['action']) && $_GET['action'] === 'admin_logout') {
    // Set cookie expiration in the past to delete the cookie
    unset($_COOKIE['admin']);
    setcookie("admin", "", time() - 3600,"");
    // Redirect the user to the login page or any other appropriate page
    header("Location: admin-homepage.php");
    // echo $_COOKIE['admin'];
exit();
}

if (isset($_GET['action']) && $_GET['action'] === 'residents_logout') {
    // Set cookie expiration in the past to delete the cookie
    unset($_COOKIE['user']);
    setcookie("user", "", time() - 3600,"");
    unset($_COOKIE['tenant']);
    setcookie("tenant", "", time() - 3600,"");
    // Redirect the user to the login page or any other appropriate page
    header("Location: user-homepage.php");
    // echo $_COOKIE['user'];
exit();
}

if (isset($_GET['action']) && $_GET['action'] === 'security_logout') {
    // Set cookie expiration in the past to delete the cookie
    unset($_COOKIE['security']);
    setcookie("security", "", time() - 3600,"");
    // Redirect the user to the login page or any other appropriate page
    header("Location: security-homepage.php");
    // echo $_COOKIE['admin'];
exit();
}

if (isset($_GET['action']) && $_GET['action'] === 'maintenance_logout') {
    // Set cookie expiration in the past to delete the cookie
    unset($_COOKIE['maintenance']);
    setcookie("maintenance", "", time() - 3600,"");
    // Redirect the user to the login page or any other appropriate page
    header("Location: maintenance-homepage.php");
    // echo $_COOKIE['admin'];
exit();
}

?>