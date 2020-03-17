

function uploadExcelFile() {

   $("#labelImportFromExcel").hide();
   $("#labelImporting").show();

   var file = $("#importFromExcel")[0].files[0];
   var formdata = new FormData();
   formdata.append("excelFile", file);

   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
         // alert(xhttp.responseText);
         var data = JSON.parse(xhttp.responseText);
         if (data.flag == false) {
            alert(data.data);
            $("#labelImporting").hide();
            $("#labelImportFromExcel").show();
         } else {

            alert("Audiences imported successfully.");
            setTimeout(() => {
               location.reload();
            },1000);
         }
      }
   };
   xhttp.open("POST","scripts/getAudienceFromExcelDoc.php",true);
   xhttp.send(formdata);
}