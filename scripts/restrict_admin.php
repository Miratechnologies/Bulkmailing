<?php

if ($_SESSION['USER.ROLE'] != "ADMIN" ) {
   die(header("Location: dashboard.php"));
}

?>