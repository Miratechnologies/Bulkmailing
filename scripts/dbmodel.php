<?php
require_once("dbconnection.php");

class DBModel extends DBConnection{
    // properties
    private $conn;

    // methods
    public function __construct(){
        $this->conn = parent::__construct();
        // die(json_encode($this->conn));
    }

    // audience_tbl -----------------------------------------------------------------------
    public function addAudience($firstname, $lastname, $email, $telephone, $classification, $subscriptionStatus) {
        $sql = "INSERT INTO audience_tbl(firstname, lastname, email, telephone, classification, subscription_status) VALUES (?,?,?,?,?,?)";
        $res = $this->conn->prepare($sql);
        $res->bind_param("ssssss",$firstname,$lastname,$email,$telephone,$classification,$subscriptionStatus);
        $res = $res->execute();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSubscriptionStatus($status, $audienceId) {
        $sql = "UPDATE audience_tbl SET subscription_status = ? WHERE audience_id = $audienceId";
        $res = $this->conn->prepare($sql);
        $res->bind_param("s",$status);
        $res = $res->execute();
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAudience($audienceId, $firstname, $lastname, $email, $telephone, $status) {
        $sql = "UPDATE audience_tbl SET firstname = ?, lastname = ?, email = ?, telephone = ?, subscription_status = ? WHERE audience_id = $audienceId";
        $res = $this->conn->prepare($sql);
        $res->bind_param("sssss",$firstname, $lastname, $email, $telephone, $status);
        $res = $res->execute();
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    public function unSubscribeAudience($email) {
        $sql = "UPDATE audience_tbl SET subscription_status = 'UNSUBSCRBD' WHERE email = ?";
        $res = $this->conn->prepare($sql);
        $res->bind_param("s",$email);
        $res = $res->execute();
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    public function removeAudience($audienceId) {
        $sql = "DELETE FROM audience_tbl WHERE audience_id = $audienceId";
        $res = $this->conn->query($sql);
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllSubscribers() {
        $sql = "SELECT * FROM audience_tbl WHERE subscription_status = 'SUBSCRIBED' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getAllAudiences() {
        $sql = "SELECT * FROM audience_tbl";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function countAudiences() {
        $sql = "SELECT COUNT(audience_id) as count FROM audience_tbl";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data[0]];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function checkAudienceExist($email) {
        $sql = "SELECT * FROM audience_tbl WHERE email LIKE '$email' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function countSubscribers() {
        $sql = "SELECT COUNT(audience_id) as count FROM audience_tbl WHERE subscription_status = 'SUBSCRIBED' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data[0]];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    // templates_tbl
    public function addTemplate($type, $description, $body) {
        $sql = "INSERT INTO templates_tbl(template_type, description, body) VALUES (?,?,?)";
        $res = $this->conn->prepare($sql);
        $res->bind_param("sss",$type,$description,$body);
        $res = $res->execute();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function getThisTemplate($templateId) {
        $sql = "SELECT * FROM templates_tbl WHERE template_id = '$templateId' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getAllTemplates() {
        $sql = "SELECT * FROM templates_tbl";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getAllEmailTemplates() {
        $sql = "SELECT * FROM templates_tbl WHERE template_type = 'EMAIL' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getAllSmsTemplates() {
        $sql = "SELECT * FROM templates_tbl WHERE template_type = 'SMS' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function updateTemplate($description, $body, $templateId) {
        $sql = "UPDATE templates_tbl SET description = ?, body = ? WHERE template_id = $templateId";
        $res = $this->conn->prepare($sql);
        $res->bind_param("ss",$description,$body);
        $res = $res->execute();
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTemplate($templateId) {
        $sql = "DELETE FROM templates_tbl WHERE template_id = $templateId";
        $res = $this->conn->query($sql);
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    // draft_tbl
    public function addDraft($type, $description, $body) {
        $sql = "INSERT INTO draft_tbl(draft_type, description, body) VALUES (?,?,?)";
        $res = $this->conn->prepare($sql);
        $res->bind_param("sss",$type,$description,$body);
        $res = $res->execute();
        if ($res) {
            $lastId = $this->conn->insert_id;
            return $lastId;
        } else {
            return false;
        }
    }

    public function getThisDraft($draftId) {
        $sql = "SELECT * FROM draft_tbl WHERE draft_id = '$draftId' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getAllDrafts() {
        $sql = "SELECT * FROM draft_tbl";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getAllEmailDrafts() {
        $sql = "SELECT * FROM draft_tbl WHERE draft_type = 'EMAIL' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getAllSmsDrafts() {
        $sql = "SELECT * FROM draft_tbl WHERE draft_type = 'SMS' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function updateDraft($body, $draftId) {
        $sql = "UPDATE draft_tbl SET body = ? WHERE draft_id = $draftId";
        $res = $this->conn->prepare($sql);
        $res->bind_param("s",$body);
        $res = $res->execute();
        // die('Good');
        // error_log($res . "\n",3,'error.log');
        // die(json_encode($res));
        if ($res == true) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteDraft($draftId) {
        $sql = "DELETE FROM draft_tbl WHERE draft_id = $draftId";
        $res = $this->conn->query($sql);
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    // auth_tbl
    public function addAuthForUser($firstname, $lastname, $telephone, $email, $password, $token, $role) {
        $sql = "INSERT INTO auth_tbl(firstname, lastname, telephone, email, password, token, role) VALUES (?,?,?,?,?,?,?)";
        $res = $this->conn->prepare($sql);
        $res->bind_param("sssssss",$firstname, $lastname, $telephone, $email, $password, $token, $role);
        $res = $res->execute();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserDetail($email) {
        $sql = "SELECT * FROM auth_tbl WHERE email = '$email' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM auth_tbl";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function updateUserStatus($status, $userId) {
        $sql = "UPDATE auth_tbl SET status = ? WHERE auth_id = $userId";
        $res = $this->conn->prepare($sql);
        $res->bind_param("s",$status);
        $res = $res->execute();
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    public function countUsers() {
        $sql = "SELECT COUNT(auth_id) as count FROM auth_tbl";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data[0]];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function updateUserToken($email,$token) {
        $sql = "UPDATE auth_tbl SET token = $token WHERE email = '$email'";
        // $res = $this->conn->prepare($sql);
        // $res->bind_param("s",$token);
        // $res = $res->execute();
        mysqli_query($this->conn, $sql);
        if (mysqli_affected_rows($this->conn) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyToken($email,$token) {
        $sql = "SELECT * FROM auth_tbl WHERE email = '$email' AND token = '$token'";
        $res = mysqli_query($this->conn, $sql);
        // die(json_encode(mysqli_num_rows($res)));
        if (mysqli_num_rows($res) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePassword($email,$password) {
        $sql = "UPDATE auth_tbl SET password = '$password' WHERE email = '$email'";
        mysqli_query($this->conn, $sql);
        if (mysqli_affected_rows($this->conn) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // preference_tbl
    public function addNewPreference($preference, $options, $value) {
        $sql = "INSERT INTO preference_tbl(preference, options, value) VALUES (?,?,?)";
        $res = $this->conn->prepare($sql);
        $res->bind_param("sss",$preference, $options, $value);
        $res = $res->execute();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllPreferences() {
        $sql = "SELECT * FROM preference_tbl";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getThisPreference(int $prefId) {
        $sql = "SELECT * FROM preference_tbl WHERE preference_id = $prefId";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data[0]];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getEmailSendersFromPreference() {
        $sql = "SELECT * FROM preference_tbl WHERE preference = 'Email Senders' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data[0]];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getSMSSenderFromPreference() {
        $sql = "SELECT * FROM preference_tbl WHERE preference = 'SMS Sender' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data[0]];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function updatePreference($prefId, $preference, $options, $value) {
        $sql = "UPDATE preference_tbl SET preference = ?, options = ?, value = ? WHERE preference_id = $prefId";
        $res = $this->conn->prepare($sql);
        $res->bind_param("sss",$preference,$options,$value);
        $res = $res->execute();
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    // mails_tbl
    public function addNewMailCampaign($subject, $sender, $recipients, $body, $status) {
        $sql = "INSERT INTO mails_tbl(subject, sender, recipients, body, status) VALUES (?,?,?,?,?)";
        $res = $this->conn->prepare($sql);
        $res->bind_param("sssss",$subject, $sender, $recipients, $body, $status);
        $res = $res->execute();
        if ($res) {
            $lastId = $this->conn->insert_id;
            return ["flag"=>true,"lastId"=>$lastId];
        } else {
            return ["flag"=>false];
        }
    }

    public function getAllPendingEmailCampaign(){
        $sql = "SELECT * FROM mails_tbl WHERE status = 'Pending' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }
    
    public function getThisEmailCampaign($id){
        $sql = "SELECT * FROM mails_tbl WHERE mail_id = $id ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function updateMailStatus($id, $status) {
        $sql = "UPDATE mails_tbl SET status = '$status' WHERE mail_id = $id";
        mysqli_query($this->conn, $sql);
        if (mysqli_affected_rows($this->conn) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // scheduler_tbl
    public function addNewScheduler($subject, $sender, $recipients, $body, $date, $time) {
        $sql = "INSERT INTO scheduler_tbl(subject, sender, recipients, body, schedule_date, schedule_time) VALUES (?,?,?,?,?,?)";
        $res = $this->conn->prepare($sql);
        $res->bind_param("ssssss",$subject, $sender, $recipients, $body, $date, $time);
        $res = $res->execute();
        if ($res) {
            $lastId = $this->conn->insert_id;
            return ["flag"=>true,"lastId"=>$lastId];
        } else {
            return ["flag"=>false];
        }
    }
    // public function addNewScheduler($subject, $sender, $recipients, $body, $dateStart, $dateEnd, $interval, $lastSent) {
    //     $sql = "INSERT INTO scheduler_tbl(subject, sender, recipients, body, date_started, date_ended, mail_interval, last_sent) VALUES (?,?,?,?,?,?,?,?)";
    //     $res = $this->conn->prepare($sql);
    //     $res->bind_param("ssssssss",$subject, $sender, $recipients, $body, $dateStart, $dateEnd, $interval, $lastSent);
    //     $res = $res->execute();
    //     if ($res) {
    //         $lastId = $this->conn->insert_id;
    //         return ["flag"=>true,"lastId"=>$lastId];
    //     } else {
    //         return ["flag"=>false];
    //     }
    // }

    public function getAllScheduledEmail(){
        $sql = "SELECT * FROM scheduler_tbl ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getActiveScheduledEmail(){
        $sql = "SELECT * FROM scheduler_tbl WHERE status = 'ACTIVE'";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function updateScheduledEmailStatus( $schedulerId, $status) {
        $sql = "UPDATE scheduler_tbl SET status = ? WHERE scheduler_id = $schedulerId";
        $res = $this->conn->prepare($sql);
        $res->bind_param("s",$status);
        $res = $res->execute();
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    // public function updateLastSent( $schedulerId, $time) {
    //     $sql = "UPDATE scheduler_tbl SET last_sent = ? WHERE scheduler_id = $schedulerId";
    //     $res = $this->conn->prepare($sql);
    //     $res->bind_param("s",$time);
    //     $res = $res->execute();
    //     if ($res === true) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // mail_report_tbl
    public function addMailReport($mailId, $noRecipients, $noMailSent, $noMailOpened) {
        $sql = "INSERT INTO mail_report_tbl(mail_id, no_of_recipients, no_of_mail_sent, no_of_mail_opened) VALUES (?,?,?,?)";
        $res = $this->conn->prepare($sql);
        $res->bind_param("dsss",$mailId, $noRecipients, $noMailSent, $noMailOpened);
        $res = $res->execute();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function getEmailReport() {
        $sql = "SELECT date_sent as date, no_of_mail_sent as mails FROM mail_report_tbl";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getEmailReportByDate($startDate,$endDate) {
        $sql = "SELECT date_sent as date, no_of_mail_sent as mails FROM mail_report_tbl WHERE date_sent > '$startDate' AND date_sent < '$endDate' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    // sms_tbl
    public function addNewSMSCampaign($subject, $sender, $recipients, $body) {
        $sql = "INSERT INTO sms_tbl(subject, sender, recipients, body) VALUES (?,?,?,?)";
        $res = $this->conn->prepare($sql);
        $res->bind_param("ssss",$subject, $sender, $recipients, $body);
        $res = $res->execute();
        if ($res) {
            $lastId = $this->conn->insert_id;
            return ["flag"=>true,"lastId"=>$lastId];
        } else {
            return ["flag"=>false];
        }
    }

    // sms_report_tbl
    public function addSMSReport($mailId, $noRecipients, $noMailSent) {
        $sql = "INSERT INTO mail_report_tbl(sms_id, no_of_recipients, no_of_mail_sent) VALUES (?,?,?)";
        $res = $this->conn->prepare($sql);
        $res->bind_param("dss",$mailId, $noRecipients, $noMailSent);
        $res = $res->execute();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function getSMSReport() {
        $sql = "SELECT date_sent as date, no_of_sms_sent as sms FROM sms_report_tbl";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getSMSReportByDate($startDate,$endDate) {
        $sql = "SELECT date_sent as date, no_of_sms_sent as sms FROM sms_report_tbl WHERE date_sent > '$startDate' AND date_sent < '$endDate' ";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    // log_tbl
    public function addNewLog($userId, $activities, $ip) {
        $sql = "INSERT INTO log_tbl(user_id, activities, ip_address) VALUES (?,?,?)";
        $res = $this->conn->prepare($sql);
        $res->bind_param("sss",$userId, $activities, $ip);
        $res = $res->execute();
        if ($res) {
            return ['flag'=>true,'id'=>$this->conn->insert_id];
        } else {
            return ['flag'=>false];
        }
    }

    public function updateLog($logId, $activities) {
        $sql = "UPDATE log_tbl SET activities = ? WHERE log_id = $logId";
        $res = $this->conn->prepare($sql);
        $res->bind_param("s",$activities);
        $res = $res->execute();
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    public function updateLogOut($logId, $logout) {
        $sql = "UPDATE log_tbl SET date_logged_out = ? WHERE log_id = $logId";
        $res = $this->conn->prepare($sql);
        $res->bind_param("s",$logout);
        $res = $res->execute();
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserLog($userId) {
        $sql = "SELECT * FROM log_tbl WHERE user_id = '$userId'";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    // image_tbl
    public function addImage($imageUrl, $imageName) {
        $sql = "INSERT INTO images_tbl(image_url, image_name) VALUES (?,?)";
        $res = $this->conn->prepare($sql);
        $res->bind_param("ss",$imageUrl, $imageName);
        $res = $res->execute();
        if ($res) {
            return ['flag'=>true];
        } else {
            return ['flag'=>false];
        }
    }

    public function getImages() {
        $sql = "SELECT * FROM images_tbl";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function getImage($imageId) {
        $sql = "SELECT * FROM images_tbl WHERE image_id = $imageId";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ["flag"=>true,"data"=>$data[0]];
        } else {
            $data = mysqli_error($this->conn);
            return ["flag"=>false,"data"=>$data];
        }
    }

    public function deleteImage($imageId) {
        $sql = "DELETE FROM images_tbl WHERE image_id = ?";
        $res = $this->conn->prepare($sql);
        $res->bind_param("i",$imageId);
        $res = $res->execute();
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    // auto committing
    public function play(){
        mysqli_commit($this->conn);
        mysqli_autocommit($this->conn,TRUE);
    }

    public function pause(){
        // Set autocommit to off
        mysqli_autocommit($this->conn,FALSE);
    }

    public function rollback(){
        // Rollback transaction
        mysqli_rollback($this->conn);
    }

    function __destruct(){
        $this->conn = null;
    }
}

?>