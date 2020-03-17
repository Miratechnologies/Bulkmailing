
function showAllTemplates() {
   hidePages();
   $("#allTemplates").show();
}

function showEmailTemplates() {
   hidePages();
   $("#emailTemplates").show();
}

function showSmsTemplates() {
   hidePages();
   $("#smsTemplates").show();
}

function hidePages() {
   $("#allTemplates").hide();
   $("#emailTemplates").hide();
   $("#smsTemplates").hide();
}

function changeTemplates() {
   var page = $("#filter").val();

   if (page == "ALL") {
      showAllTemplates();
   } else if (page == "EMAIL") {
      showEmailTemplates();
   } else if (page == "SMS") {
      showSmsTemplates();
   }
}
