<?php
// Session start karna zaroori hai taaki use destroy kiya ja sake
session_start();

// Saare session variables ko remove karein
$_SESSION = array();

// Session ko puri tarah khatam karein
session_destroy();

// User ko login page (Account.html) par bhej dein
header("Location: Account.html");
exit();
?>