// Custom js codes

function showPassword() {
   $("#password").attr("type","text");
   $("#showPassword").hide();
   $("#hidePassword").show();
}

function hidePassword() {
   $("#password").attr("type","password");
   $("#hidePassword").hide();
   $("#showPassword").show();
}

function previewCode() {
   var body = $("#code_body").val();
   $("#bodyPreview").html(body);
}

function previewTemplateCode(id) {
   var body = $("#"+id).val();
   $("#bodyPreview").html(body);
}

function generatePassword() {
   var password = '';
   var bAlpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   var sAlpha = 'abcdefghijklmnopqrstuvwxyz';
   var num = '0123456789';
   var sChar = '!@#$%^&*()_+}{":;\'?/>.<,';
   
   for ( var i = 0; i < 3; i++ ) {
      password += bAlpha.charAt(Math.floor(Math.random() * bAlpha.length));
      password += sAlpha.charAt(Math.floor(Math.random() * sAlpha.length));
      password += num.charAt(Math.floor(Math.random() * num.length));
      password += sChar.charAt(Math.floor(Math.random() * sChar.length));
   }
   const el = document.createElement('textarea');
   el.value = password;
   document.body.appendChild(el);
   el.select();
   document.execCommand('copy');
   document.body.removeChild(el);
   document.getElementById("g_password").value = password;
   document.getElementById("password").value = password;
}

function setupEdit(prefId,preference,options,value) {
   $("#edit_pref").val(preference);
   $("#edit_pref_options").val(options);
   $("#edit_pref_value").val(value);
   $("#edit_pref_id").val(prefId);
}

function saveAsDraft(type,description,bodyId) {
   var body = $("#"+bodyId).val();

   var url = "scripts/add_to_draft.php";

   var data = {
      templateType: type,
      description: description,
      body: body
   }

   $.post(url, data, function (data, status) {
      if (status == "success") {
         data = JSON.parse(data);
         if (data.flag == true) {

            alert("Template added to draft successfully.");

         } else {
            
            alert("Template is not added to draft.");

         }
      }
   });

}

function startAudience() {
   $("#labelImporting").hide();
}

function removeAudience(id) {

   var url = "scripts/remove_audience.php";

   var data = {
      audienceId: id
   }

   $.post(url, data, function (data, status) {
      if (status == "success") {
         data = JSON.parse(data);
         if (data.flag == true) {
            alert("This audience was removed successfully.");
            setTimeout(() => {
               location.reload();
            },2000);

         } else {
            
            alert("This audience was not removed.");

         }
      }
   });

}

function blockUser(id) {
   
   var url = "scripts/update_user_status.php";

   var data = {
      userId: id,
      status: "BLOCKED"
   }

   $.post(url, data, function (data, status) {
      if (status == "success") {
         data = JSON.parse(data);
         if (data.flag == true) {
            alert("This user has been blocked successfully.");
            setTimeout(() => {
               location.reload();
            },2000);

         } else {
            
            alert("This user was not blocked.");

         }
      }
   });

}

function activateUser(id) {

   var url = "scripts/update_user_status.php";

   var data = {
      userId: id,
      status: "ACTIVE"
   }

   $.post(url, data, function (data, status) {
      if (status == "success") {
         data = JSON.parse(data);
         if (data.flag == true) {
            alert("This user has been activated successfully.");
            setTimeout(() => {
               location.reload();
            },2000);

         } else {
            
            alert("This user was not activated.");

         }
      }
   });

}