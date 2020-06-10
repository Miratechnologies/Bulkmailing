<?php

// session_start();

$lifetime = 60 * 60 * 24 * 7;
session_start(['cookie_lifetime' => $lifetime]);

if (isset($_SESSION['USER.EMAIL']) !== true && isset($_SESSION['USER.ROLE']) !== true ) {
   die(header("Location: logout.php"));
}

?>