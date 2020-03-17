<?php
include 'scripts/dbmodel.php';
$model = new DBModel();

session_start();
if (isset($_SESSION['USER.LOG.ID'])) {
   $_SESSION['USER.ACTIVITY'][] = "logout - " . date("d/m/Y h:i a");
   include 'scripts/log.php';

   $model->updateLogOut($_SESSION['USER.LOG.ID'],date("Y-m-d H:i:s"));

   session_unset();
   session_destroy();
}
exit(header('location: index.php'));

?>