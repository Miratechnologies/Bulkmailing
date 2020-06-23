

function uploadExcelFile() {

   $("#labelImportFromExcel").hide();
   $("#labelImporting").show();

   var file = $("#importFromExcel")[0].files[0];
   var formdata = new FormData();
   formdata.append("excelFile", file);

   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
         alert(xhttp.responseText);
         var data = JSON.parse(xhttp.responseText);
         if (data.flag == false) {
            alert(data.data);
            $("#labelImporting").hide();
            $("#labelImportFromExcel").show();
         } else {
            alert("Audiences imported successfully.");
            setTimeout(() => {
               location.reload();
            },300);
         }
      }
   };
   xhttp.open("POST","scripts/getAudienceFromExcelDoc.php",true);
   xhttp.send(formdata);
}


function loadAudience(id, firstname, lastname, email, telephone, status) {

   // alert(id);
   $("#eid").val(id);
   $("#efirstname").val(firstname);
   $("#elastname").val(lastname);
   $("#eemail").val(email);
   $("#etelephone").val(telephone);
   $("#estatus").val(status);

}

function updateAudience() {

   $.post('scripts/update_audience.php', 
   {
      id: $("#eid").val(),
      firstname: $("#efirstname").val(),
      lastname: $("#elastname").val(),
      email: $("#eemail").val(),
      telephone: $("#etelephone").val(),
      status: $("#estatus").val()
   }, function(data, status) {
      if (status == 'success') {
         resp = JSON.parse(data);
         if (resp.flag == true) {
            alert(`Audience is updated!`);
            setTimeout(() => {
               location.reload();
            },300);
         } else {
            created = false;
            alert(`Audience was not updated! Please try again`);
         }
      }
   });

}