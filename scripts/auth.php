<?php

session_start();

if (isset($_SESSION['USER.EMAIL']) !== true && isset($_SESSION['USER.ROLE']) !== true ) {
   die(header("Location: logout.php"));
}

?>