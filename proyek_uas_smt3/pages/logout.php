<?php
// logout.php
session_start();
// clear session
$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
// redirect ke halaman login
header('Location: /proyek_uas_smt3/index.php');
exit;
