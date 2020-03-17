<?php

   // get the session
   $logId = $_SESSION['USER.LOG.ID'];
   $activities = $_SESSION['USER.ACTIVITY'];

   // splitting activities array
   $activities = implode(",",$activities);

   // update the database with the session details
   $add = $model->updateLog($logId,$activities);

?>