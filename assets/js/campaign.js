
const CAMPAIGN_PARAMS = {
   DRAFT_ID:0,
   DRAFT_BODY:"",
   RECIPIENTS:[],
   SENDER:"",
   SUBJECT:""
}

function start() {
   hidePages();
   showDraft();
}

function hidePages() {
   hideDraft();
   hideRecipient();
   hideSender();
   hideSubject();
   hideSend();
}

// ------------------------------------------

function hideDraft() {
   $("#draft").hide();
   $("#draftNav").removeClass("btn-dark");
   $("#draftNav").addClass("btn-outline-dark");
}

function hideRecipient() {
   $("#recipient").hide();
   $("#recipientNav").removeClass("btn-dark");
   $("#recipientNav").addClass("btn-outline-dark");
}

function hideSender() {
   $("#sender").hide();
   $("#senderNav").removeClass("btn-dark");
   $("#senderNav").addClass("btn-outline-dark");
}

function hideSubject() {
   $("#subject").hide();
   $("#subjectNav").removeClass("btn-dark");
   $("#subjectNav").addClass("btn-outline-dark");
}

function hideSend() {
   $("#send").hide();
   $("#sendNav").removeClass("btn-dark");
   $("#sendNav").addClass("btn-outline-dark");
}

// ------------------------------------------

function showDraft() {
   hidePages();
   $("#draft").show();
   $("#draftNav").removeClass("btn-outline-dark");
   $("#draftNav").addClass("btn-dark");
}

function showRecipient() {
   hidePages();
   $("#recipient").show();
   $("#recipientNav").removeClass("btn-outline-dark");
   $("#recipientNav").addClass("btn-dark");
}

function showSender() {
   hidePages();
   $("#sender").show();
   $("#senderNav").removeClass("btn-outline-dark");
   $("#senderNav").addClass("btn-dark");
}

function showSubject() {
   hidePages();
   $("#subject").show();
   $("#subjectNav").removeClass("btn-outline-dark");
   $("#subjectNav").addClass("btn-dark");
}

function showSend() {
   hidePages();
   $("#send").show();
   $("#sendNav").removeClass("btn-outline-dark");
   $("#sendNav").addClass("btn-dark");

   loadEmailPreview();
}

function showSMSSend() {
   hidePages();
   $("#send").show();
   $("#sendNav").removeClass("btn-outline-dark");
   $("#sendNav").addClass("btn-dark");

   loadSMSPreview();
}

function loadEmailPreview() {
   $("#previewSender").html(CAMPAIGN_PARAMS.SENDER)
   $("#previewSubject").html(CAMPAIGN_PARAMS.SUBJECT)
   $("#emailBodyPreview").html(CAMPAIGN_PARAMS.DRAFT_BODY);

   // prepare recipients
   
   var recipients = "";
   CAMPAIGN_PARAMS.RECIPIENTS.forEach(element => {
      var aud = element.split("|");
      recipients += aud[1] + " " + aud[2] + "{"+ aud[3] +"}, ";
   });

   $("#previewRecipients").html(recipients);
}

function loadSMSPreview() {
   $("#previewSender").html(CAMPAIGN_PARAMS.SENDER)
   $("#emailBodyPreview").html(CAMPAIGN_PARAMS.DRAFT_BODY);

   // prepare recipients
   
   var recipients = "";
   CAMPAIGN_PARAMS.RECIPIENTS.forEach(element => {
      var aud = element.split("|");
      recipients += aud[1] + " " + aud[2] + "{"+ aud[3] +"}, ";
   });

   $("#previewRecipients").html(recipients);
}

function selectDraft(bodyId,draftId) {
   CAMPAIGN_PARAMS.DRAFT_ID = draftId;
   CAMPAIGN_PARAMS.DRAFT_BODY = $("#"+bodyId).val();

   // enable recipients
   $("#recipientNav").attr("disabled",false);

   // load next section
   showRecipient();
}

function selectAllRecipient() {
   var all = $(".check");
   for (let i = 0; i < all.length; i++) {
      const element = all[i];
      element.checked = true;
   }
}

function deselectAllRecipient() {
   var all = $(".check");
   for (let i = 0; i < all.length; i++) {
      const element = all[i];
      element.checked = false;
   }
}

function confirmRecipient() {
   var checkedRecipients = new Array;
   var all = $(".check");
   var j = 0;
   for (let i = 0; i < all.length; i++) {
      const element = all[i];
      if (element.checked === true) {
         checkedRecipients[j] = element.id;
         j++;
      }
   }

   CAMPAIGN_PARAMS.RECIPIENTS = JSON.parse(JSON.stringify(checkedRecipients));

   // if the list is not empty
   if (CAMPAIGN_PARAMS.RECIPIENTS.length != 0) {
      // enable recipients
      $("#senderNav").attr("disabled",false);

      // load next section
      showSender();
   }
}

function selectSender() {
   CAMPAIGN_PARAMS.SENDER = $("#selectSender").val();
   
   // enable subject
   $("#subjectNav").attr("disabled",false);

   // load next section
   showSubject();
}

function selectSMSSender() {
   CAMPAIGN_PARAMS.SENDER = $("#selectSender").val();
   
   // enable subject
   $("#sendNav").attr("disabled",false);

   // load next section
   showSend();
}

function enterSubject() {
   if ($("#enterSubject").val().trim() != "") {
      CAMPAIGN_PARAMS.SUBJECT = $("#enterSubject").val();
      
      // enable subject
      $("#sendNav").attr("disabled",false);

      // load next section
      showSend();
   }
   
}

function sendEmail() {

   var email_recipients = [];
   CAMPAIGN_PARAMS.RECIPIENTS.forEach(element => {
      var aud = element.split("|");
      email_recipients.push({
         email: aud[3],
         name: aud[1] + " " + aud[2]
      });
   });

   var data = {
      send_email:"send_email",
      email_recipients: email_recipients,
      email_sender: CAMPAIGN_PARAMS.SENDER,
      email_subject: CAMPAIGN_PARAMS.SUBJECT,
      email_body: CAMPAIGN_PARAMS.DRAFT_BODY,
   }

   // URL to notify admin
   var url = "scripts/notify_admin_campaign.php";
   // var url = "scripts/send_mail.php";

   $("#sendBtn").html("<span class='fa fa-spin fa-spinner'></span> Sending...");
   $("#sendBtn").attr("disabled", false);

   $.post(url, data, function (data, status) {
      if (status == "success") {
         data = JSON.parse(data);
         if (data.flag == true) {

            $('#sendBtn').html("<span class='fa fa-check'></span> Sent Successfully");
            $('#sendBtn').removeClass('obejor-btn-dark');
            $('#sendBtn').addClass('btn-success');

            setTimeout(()=>{
               location.href = "campaign.php";
            },5000);

         } else {
            $('#sendBtn').removeClass('obejor-btn-dark');
            $('#sendBtn').addClass('btn-danger');
            $('#sendBtn').text(data.data);
         }
         $('#sendBtn').attr('disabled', false);
      }
   });
}

function sendSMS() {

   var sms_recipients = [];
   CAMPAIGN_PARAMS.RECIPIENTS.forEach(element => {
      var aud = element.split("|");
      sms_recipients.push({
         telephone: aud[3],
         name: aud[1] + " " + aud[2]
      });
   });

   var data = {
      send_sms:"send_sms",
      sms_recipients: sms_recipients,
      sms_sender: CAMPAIGN_PARAMS.SENDER,
      sms_body: CAMPAIGN_PARAMS.DRAFT_BODY,
   }

   var url = "scripts/send_sms.php"

   $("#sendBtn").html("<span class='fa fa-spin fa-spinner'></span> Sending...");
   $("#sendBtn").attr("disabled", false);

   $.post(url, data, function (data, status) {
      if (status == "success") {
         data = JSON.parse(data);
         if (data.flag == true) {

            $('#sendBtn').html("<span class='fa fa-check'></span> Sent Successfully");
            $('#sendBtn').removeClass('obejor-btn-dark');
            $('#sendBtn').addClass('btn-success');

            setTimeout(()=>{
               location.href = "campaign.php";
            },5000);

         } else {
            $('#sendBtn').removeClass('obejor-btn-dark');
            $('#sendBtn').addClass('btn-danger');
            $('#sendBtn').text(data);
         }
         $('#sendBtn').attr('disabled', false);
      }
   });
}

function scheduleEmail() {

   var email_recipients = [];
   CAMPAIGN_PARAMS.RECIPIENTS.forEach(element => {
      var aud = element.split("|");
      email_recipients.push({
         email: aud[3],
         name: aud[1] + " " + aud[2]
      });
   });

   var scheduleDate = $("#sdlDate").val();
   var scheduleTime = $("#sdlTime").val();

   var data = {
      schedule_email:"schedule_email",
      email_recipients: email_recipients,
      email_sender: CAMPAIGN_PARAMS.SENDER,
      email_subject: CAMPAIGN_PARAMS.SUBJECT,
      email_body: CAMPAIGN_PARAMS.DRAFT_BODY,
      schedule_date: scheduleDate,
      schedule_time: scheduleTime
   };
   var url = "scripts/add_scheduler.php"

   $("#scheduleBtn").html("<span class='fa fa-spin fa-spinner'></span> Scheduling...");
   $("#scheduleBtn").attr("disabled", false);

   $.post(url, data, function (data, status) {
      if (status == "success") {
         data = JSON.parse(data);
         if (data.flag == true) {

            $('#scheduleBtn').html("<span class='fa fa-check'></span> Scheduled Successfully");
            $('#scheduleBtn').removeClass('obejor-btn-dark');
            $('#scheduleBtn').addClass('btn-success');

            setTimeout(()=>{
               location.href = "campaign.php";
            },3000);

         } else {
            $('#scheduleBtn').removeClass('obejor-btn-dark');
            $('#scheduleBtn').addClass('btn-danger');
            $('#scheduleBtn').text(data);
         }
         $('#scheduleBtn').attr('disabled', false);
      }
   });
}