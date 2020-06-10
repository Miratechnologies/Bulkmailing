
var rows = 0;
var cols = 0;
var cntt = 0;
var selects = [];
var selected = null;

// how do I allow these variables respond to editing, without saving them in the database?
// when are they used?
// rows, only to add content
// cols, only to add content
// cntt, for adding contents too
// But, my fear is that ID's could clash, How?
// A template is created already, this content has Id cntt1, ...
// ...the template is now being edited, i add a new row and add a content, ...
// ...the row, column and the content would have the same id
// so what do we do?
// I'd store the JSON encoded data in a data tag in the template header 😉💡

$(document).ready(function(){
   start();
   setState();
});

// Hiding & Showing
function hideAll ()
{
   $("#create-new-template").hide();
   $("#default-display").hide();
   $("#row-display").hide();
   $("#col-actions").hide();
   $("#cntt-actions").hide();
   if (location.pathname != "/edit_template.php" ){
      $("#sms_save").hide();
   }
   $("#editRow-display").hide();
   $("#addColumn-display").hide();
   $("#editColumn-display").hide();
   $("#contents-display").hide();
}

function start ()
{
   hideAll();
   $("#create-new-template").show();
   textAlignClicked('center');
   textStyleClicked('normal');
   textLinkAlignClicked('center');
   textLinkStyleClicked('normal');
   $("#btnShowRow").hide();

   if (location.pathname == "/edit_template.php" ){
      $("#btnShowRow").show();
      
      var config = $("#email_template").attr("data-config");
      config = JSON.parse(config);
      rows = config.rows;
      cols = config.cols;
      cntt = config.cntt;
   }
}

function showRow ()
{
   hideAll();
   $("#row-display").show();
}

function showAddColumns ()
{
   hideAll();
   $("#addColumn-display").show();
}

function colClicked ()
{
   hideAll();
   $("#col-actions").show();
}

function showEditColumn()
{
   hideAll();
   $("#editColumn-display").show()
}

function showContents ()
{
   hideAll();
   $("#contents-display").show();
}

function cnttClicked ()
{
   hideAll();
   $("#cntt-actions").show();
   // $("#default-display").show();
}

// Content Type Clicked

function select (type, id)
{
   // alert(type);

   // log the selects
   selects.push([type,id])
   // use the type to decide which actions are applicable
   type = selects[0][0];
   switch (type) {
      case 'row':
         showAddColumns();
         $("#editRow-display").show()
         break;
      case 'col':
         colClicked();
         break;
      case 'cntt':
         cnttClicked();
         break;
      default:
         break;
   }
   // use the id to implement actions
   selected = selects[0][1];
   $("#"+selected).addClass("selected");
}

function clearSelect() {
   $("#"+selected).removeClass("selected");
   selects = [];
}

var states = [];
var state;

function setState()
{
   state = (states.push($("#template-pad").html())) - 1;
}

function getState(_state)
{
   return states[_state];
}

function undo()
{
   try {
      if (states.length == 0)
      throw("No Previous State");
      else
      {
         state--;
         var template = getState(state);
         $("#template-pad").html(template);
      }
   } catch (error) {
      alert(error);
   }
}

function redo()
{
   try {
      if (states.length < (state + 1))
      throw("No Next State");
      else
      {
         state++;
         var template = getState(state);
         $("#template-pad").html(template);
      }
   } catch (error) {
      alert(error);
   }
}

function createNewTemplate ()
{
   var template = //margin:10px 0
   `<div id="email_template" data-config="" style="background-color:#fbf1f1;width:100%; margin-top: 20px; margin-bottom: 50px;">
      <table border="0" bgcolor="#e4e4e4" cellspacing="0" cellpadding="0" width="100%" style="font-family:'Helvetica Neue','Helvetica','Arial','sans-serif';font-size:13px">
         <tbody>
         <tr>
            <td bgcolor="#eeeee6" width="100%" style="padding: 10px 0;">

               <!-- Container Table -->
               <table width="95%" cellpadding="0" cellspacing="0" border="0" align="center">
                  <tbody>
                     <tr style="border: 1px solid rgb(190, 147, 60);">
                        <td class="text-center" id="template-contents" width="100%" style="background-color: rgb(253, 252, 252);">
                           NEW TEMPLATE
                        </td>
                     </tr>
                  </tbody>
               </table>
            </td>
         </tr>
         </tbody>
      </table>
   </div>`;

   $("#template-pad").html(template);
   showRow();
   setState();
}

function addFooter()
{
   var contents =
   `
   <div>
         <table width="100%" cellspacing="0" cellpadding="0"
            style="vertical-align:middle">
            <tbody>
               <tr height="0px" style="
      border: 0px solid #ffffff;
      background-color: #ffffff;
      ">
               </tr>
            </tbody>
         </table>
         <table width="100%" cellspacing="0" cellpadding="0"
            style="vertical-align:middle">
            <tbody>
               <tr height="0px" style="
      border: 0px solid #ffffff;
      background-color: #ffffff;
      ">
                  <td
                     height="50px" width="20%" ;="" style="
      padding: 0px 0px;
      border: 0px solid #ffffff;
      background-color: #dddddd;
      ">
                     <p
                        style="margin: 0px 0px; overflow: auto;">
                        <a href="https://www.facebook.com/Obejorcom-2335973039767186/"
                           target="_blank">
                           <img src="https://obejorgroup.com.ng/storage/images/523291.png"
                              width="20%" height="20%" align="middle" style="padding: 0% 0%; "
                              alt="Facebook Logo">
                        </a>
                     </p>
                  </td>
                  <td
                     height="50px" width="20%" ;="" style="
      padding: 0px 0px;
      border: 0px solid #ffffff;
      background-color: #dddddd;
      ">
                     <p
                        style="margin: 0px 0px; overflow: auto;">
                        <a href="https://twitter.com/ObejorNigeria" target="_blank">
                           <img src="https://obejorgroup.com.ng/storage/images/9aa70a.png"
                              width="20%" height="20%" align="middle" style="padding: 0% 0%; "
                              alt="Twitter Logo">
                        </a>
                     </p>
                  </td>
                  <td
                     height="50px" width="20%" ;="" style="
      padding: 0px 0px;
      border: 0px solid #ffffff;
      background-color: #dddddd;
      ">
                     <p
                        style="margin: 0px 0px; overflow: auto;">
                        <a href="https://www.youtube.com/channel/UCwN0kOwuSlkxU9v4E-UEZog?view_as=subscriber"
                           target="_blank">
                           <img src="https://obejorgroup.com.ng/storage/images/0f72a4.png"
                              width="20%" height="20%" align="middle" style="padding: 0% 0%; "
                              alt="Youtube Logo">
                        </a>
                     </p>
                  </td>
                  <td
                     height="50px" width="20%" ;="" style="
      padding: 0px 0px;
      border: 0px solid #ffffff;
      background-color: #dddddd;
      ">
                     <p
                        style="margin: 0px 0px; overflow: auto;">
                        <a href="https://www.instagram.com/obejoronline_store/" target="_blank">
                           <img src="https://obejorgroup.com.ng/storage/images/bdc311.png"
                              width="20%" height="20%" align="middle" style="padding: 0% 0%; "
                              alt="Instagram Logo">
                        </a>
                     </p>
                  </td>
                  <td
                     height="50px" width="20%" ;="" style="
      padding: 0px 0px;
      border: 0px solid #ffffff;
      background-color: #dddddd;
      ">
                     <p
                        style="margin: 0px 0px; overflow: auto;">
                        <a href="https://www.linkedin.com/company/obejorstore" target="_blank">
                           <img src="https://obejorgroup.com.ng/storage/images/623082.png"
                              width="20%" height="20%" align="middle" style="padding: 0% 0%; "
                              alt="LinkedIn Logo">
                        </a>
                     </p>
                  </td>
               </tr>
            </tbody>
         </table>
         <table width="100%" cellspacing="0" cellpadding="0"
            style="vertical-align:middle">
            <tbody>
               <tr height="0px" style="
      border: 0px solid #ffffff;
      background-color: #ffffff;
      ">
                  <td
                     height="50px" width="20%" ;="" style="
      padding: 0px 0px;
      border: 1px solid #ee2d11;
      background-color: #ffffff;
      ">
                     <p
                        style="
      margin: 0px 0px !important;
      ">
                        <a href="https://www.obejor.com.ng/about-us" target="_blank" style="
      font-family: Verdana, Geneva, Tahoma, sans-serif;; 
      font-size: 10px; 
      color: #000000; 
      font-weight: 400; 
      padding: 2% 2%; 
      margin: 0px 0px !important;
      text-align: center; 
      font-style: normal; text-decoration: none;
      ">
                           About Us
                        </a>
                     </p>
                  </td>
                  <td
                     height="50px" width="20%" ;="" style="
      padding: 0px 0px;
      border: 1px solid #ee2d11;
      background-color: #ffffff;
      ">
                     <p
                        style="
      margin: 0px 0px !important;
      ">
                        <a href="https://obejorblog.com/" target="_blank" style="
      font-family: Verdana, Geneva, Tahoma, sans-serif;; 
      font-size: 10px; 
      color: #000000; 
      font-weight: 400; 
      padding: 2% 2%; 
      margin: 0px 0px !important;
      text-align: center; 
      font-style: normal; text-decoration: none;
      ">
                           Blog
                        </a>
                     </p>
                  </td>
                  <td
                     height="50px" width="20%" ;="" style="
      padding: 0px 0px;
      border: 1px solid #ee2d11;
      background-color: #ffffff;
      ">
                     <p
                        style="
      margin: 0px 0px !important;
      ">
                        <a href="https://www.obejor.com.ng/ocmultivendor/sellerlogin" target="_blank"
                           style="
      font-family: Verdana, Geneva, Tahoma, sans-serif;; 
      font-size: 10px; 
      color: #000000; 
      font-weight: 400; 
      padding: 2% 2%; 
      margin: 0px 0px !important;
      text-align: center; 
      font-style: normal; text-decoration: none;
      ">
                           Seller Login
                        </a>
                     </p>
                  </td>
                  <td
                     height="50px" width="20%" ;="" style="
      padding: 0px 0px;
      border: 1px solid #ee2d11;
      background-color: #ffffff;
      ">
                     <p
                        style="
      margin: 0px 0px !important;
      ">
                        <a href="https://www.obejor.com.ng/returns-policy" target="_blank" style="
      font-family: Verdana, Geneva, Tahoma, sans-serif;; 
      font-size: 10px; 
      color: #000000; 
      font-weight: 400; 
      padding: 2% 2%; 
      margin: 0px 0px !important;
      text-align: center; 
      font-style: normal; text-decoration: none;
      ">
                           Return Policy
                        </a>
                     </p>
                  </td>
                  <td
                     height="50px" width="20%" ;="" style="
      padding: 0px 0px;
      border: 1px solid #ee2d11;
      background-color: #ffffff;
      ">
                     <p
                        style="
      margin: 0px 0px !important;
      ">
                        <a href="https://www.obejor.com.ng/terms-condition" target="_blank" style="
      font-family: Verdana, Geneva, Tahoma, sans-serif;; 
      font-size: 10px; 
      color: #000000; 
      font-weight: 400; 
      padding: 2% 2%; 
      margin: 0px 0px !important;
      text-align: center; 
      font-style: normal; text-decoration: none;
      ">
                           Terms and Condition
                        </a>
                     </p>
                  </td>
               </tr>
            </tbody>
         </table>
         <table width="100%" cellspacing="0" cellpadding="0"
            style="vertical-align:middle">
            <tbody>
               <tr height="100px" style="
      border: 0px solid #ffffff;
      background-color: #ffffff;
      ">
                  <td height="0px"
                     width="50%" ;="" style="background-color:#dddddd;border:0px solid #ffffff;">
                     <p style="
      font-family: Verdana, Geneva, Tahoma, sans-serif;; 
      font-size: 14px; 
      color: #000000; 
      font-weight: 400; 
      padding: 0px 0px; 
      margin: 0px 0px !important;
      text-align: center; 
      font-style: normal; 
      ">
                        16 Adepele Street, Computer Village, Ikeja, Lagos State, Nigeria
                     </p>
                  </td>
                  <td height="0px"
                     width="50%" ;="" style="background-color:#dddddd;border:0px solid #ffffff;">
                     <p
                        style="
      font-family: Verdana, Geneva, Tahoma, sans-serif;; 
      font-size: 14px; 
      color: #000000; 
      font-weight: 400; 
      padding: 0px 5px; 
      margin: 0px 0px !important;
      text-align: center; 
      font-style: normal; 
      ">
                        Phone No: <a href='tel:+234-70-40002622'>+2347040002622</a>, <a
                           href='tel:+234-70-40002422'>+2347040002422</a>
                     </p>
                  </td>
               </tr>
            </tbody>
         </table>
         <table width="100%" cellspacing="0" cellpadding="0"
            style="vertical-align:middle">
            <tbody>
               <tr height="0px" style="
      border: 0px solid #ffffff;
      background-color: #ffffff;
      ">
                  <td
                     height="55px" width="60%" ;=""
                     style="background-color:#dddddd;border:0px solid #ffffff;">
                     <p style="
      font-family: Verdana, Geneva, Tahoma, sans-serif;; 
      font-size: 14px; 
      color: #000000; 
      font-weight: 400; 
      padding: 0px 0px; 
      margin: 0px 0px !important;
      text-align: center; 
      font-style: normal; 
      ">
                        Email: <a href="mailto:sales@obejor.com">sales@obejor.com</a>, <a
                           href="mailto:help@obejor.com">help@obejor.com.</a. </p>
                  </td>
                  <td
                     height="55px" width="60%" ;=""
                     style="background-color:#dddddd;border:0px solid #ffffff;">
                     <p style="
      font-family: Verdana, Geneva, Tahoma, sans-serif;; 
      font-size: 14px; 
      color: #000000; 
      font-weight: 400; 
      padding: 0px 0px; 
      margin: 0px 0px !important;
      text-align: center; 
      font-style: normal; 
      ">
                        Whatsapp: <a
                           href="https://api.whatsapp.com/send?phone=+2347040002622">07040002622.</a>
                     </p>
                  </td>
               </tr>
            </tbody>
         </table>
         <table width="100%" cellspacing="0" cellpadding="0"
            style="vertical-align:middle">
            <tbody>
               <tr height="40px"
                  style="background-color:#ffffff;border:0px solid #ffffff;">
                  <td
                     height="100px" width="60%" ;=""
                     style="background-color:#dddddd;border:0px solid #ffffff;">
                     <p style="
      font-family: Verdana, Geneva, Tahoma, sans-serif;; 
      font-size: 12px; 
      color: #000000; 
      font-weight: 400; 
      padding: 0px 0px; 
      margin: 0px 0px !important;
      text-align: center; 
      font-style: normal; 
      ">
                        Want to stop receiving these type of email? You can <a
                           href="https://obejorgroup.com.ng/api/unsubscribe?email=[[EMAIL]]">unsubscribe</a>
                        from this list.
                     </p>
                  </td>
               </tr>
            </tbody>
         </table>
         <table width="100%" cellspacing="0" cellpadding="0"
            style="vertical-align:middle">
            <tbody>
               <tr height="0px" style="
      border: 0px solid #ffffff;
      background-color: #ffffff;
      ">
                  <td
                     height="55px" width="50%" ;=""
                     style="background-color:#dddddd;border:0px solid #ffffff;">
                     <p
                        style="margin: 0px 0px; overflow: auto;">
                        <a href="https://play.google.com/store/apps/details?id=com.obejor.app"
                           target="_blank">
                           <img src="https://obejorgroup.com.ng/storage/images/googlePlay.png"
                              width="40%" height="100%" align="right" style="padding: 0% 5%; "
                              alt="Google Play">
                        </a>
                     </p>
                  </td>
                  <td
                     height="55px" width="50%" ;=""
                     style="background-color:#dddddd;border:0px solid #ffffff;">
                     <p
                        style="margin: 0px 0px; overflow: auto;">
                        <a href="" target="_blank">
                           <img src="https://obejorgroup.com.ng/storage/images/appleStore.png"
                              width="40%" height="100%" align="left" style="padding: 0% 5%; "
                              alt="Apple Store">
                        </a>
                     </p>
                  </td>
               </tr>
            </tbody>
         </table>
         <table width="100%" cellspacing="0" cellpadding="0"
            style="vertical-align:middle">
            <tbody>
               <tr height="0px" style="
      border: 0px solid #ffffff;
      background-color: #ffffff;
      ">
                  <td
                     height="100px" width="100%" ;="" style="
      padding: 0px 0px;
      border: 0px solid #ffffff;
      background-color: #dddddd;
      ">
                     <p
                        style="
      font-family: Verdana, Geneva, Tahoma, sans-serif;; 
      font-size: 14px; 
      color: #000000; 
      font-weight: 400; 
      padding: 0px 5px; 
      margin: 0px 0px !important;
      text-align: center; 
      font-style: normal; 
      ">

                     </p>
                  </td>
               </tr>
            </tbody>
         </table>
   </div>
   `;

   $("#"+selected).html(contents);
   clearSelect();
   setState();
}

function addRowAbove() 
{
   // How?
   // Read the table id of the selected column
   var currentRowId = $("#"+selected).parentsUntil("div")[2].id;

   // increment the rows, hence using it as ID selected('row','row${rows}');
   rows++;

   var template =
   `<table id="table${rows}" width="100%" cellspacing="0" cellpadding="0" style="vertical-align:middle;">
      <tbody >
         <tr 
            class="selectable"
            onclick="select('row','row${rows}')" 
            id="row${rows}" 
            height="0px" 
            style="
            border: 0px solid #ffffff;
            background-color: #ffffff;
            "
         >   
            <td align="center" style="vertical-align: middle; margin: 2px;">ROW</td>
         </tr>
      </tbody>
   </table>`;

   // add the row above
   $("#"+currentRowId).before(template);

   // deselect
   clearSelect();
   // default select
   select('row','row'+rows);
   showAddColumns();

   // default details
   $("#rowBgColor").val("#ffffff");
   $("#rowBorderWeight").val(0);
   $("#rowBorderColor").val("#ffffff");
   $("#rowHeight").val(0);

   // show add row for subsequent rows
   $("#btnShowRow").show();
   setState();
}

function addRowBelow() 
{
   // How?
   // Read the table id of the selected column
   var currentRowId = $("#"+selected).parentsUntil("div")[2].id;

   // increment the rows, hence using it as ID selected('row','row${rows}');
   rows++;

   var template =
   `<table id="table${rows}" width="100%" cellspacing="0" cellpadding="0" style="vertical-align:middle">
      <tbody >
         <tr 
            class="selectable"
            onclick="select('row','row${rows}')" 
            id="row${rows}" 
            height="0px" 
            style="
            border: 0px solid #ffffff;
            background-color: #ffffff;
            "
         >   
            <td align="center" style="vertical-align: middle; margin: 2px;">ROW</td>
         </tr>
      </tbody>
   </table>`;

   // add the row above
   $("#"+currentRowId).after(template);

   // deselect
   clearSelect();
   // default select
   select('row','row'+rows);
   showAddColumns();

   // default details
   $("#rowBgColor").val("#ffffff");
   $("#rowBorderWeight").val(0);
   $("#rowBorderColor").val("#ffffff");
   $("#rowHeight").val(0);

   // show add row for subsequent rows
   $("#btnShowRow").show();
   setState();
}

function addRow ()
{
   // increment the rows, hence using it as ID selected('row','row${rows}');
   rows++;

   // get the details
   var bgColor = $("#rowBgColor").val();
   var borderWeight = $("#rowBorderWeight").val();
   var borderColor = $("#rowBorderColor").val();
   var height = $("#rowHeight").val();

   var template =
   `<table id="table${rows}" width="100%" cellspacing="0" cellpadding="0" style="vertical-align:middle">
      <tbody >
         <tr 
            class="selectable"
            onclick="select('row','row${rows}')" 
            id="row${rows}" 
            height="${height}px" 
            style="
            border: ${borderWeight}px solid ${borderColor};
            background-color: ${bgColor};
            "
         >   
            <td align="center" style="vertical-align: middle; margin: 2px;">ROW</td>
         </tr>
      </tbody>
   </table>`;

   if ($("#template-contents").text().trim() == "NEW TEMPLATE") {
      $("#template-contents").html(template);
   } else {
      $("#template-contents").append(template);
   }

   // default select
   select('row','row'+rows);
   showAddColumns();

   // default details
   $("#rowBgColor").val("#ffffff");
   $("#rowBorderWeight").val(0);
   $("#rowBorderColor").val("#ffffff");
   $("#rowHeight").val(0);

   // show add row for subsequent rows
   $("#btnShowRow").show();
   setState();

}

function editRow ()
{
   var bgColor = $("#editrowBgColor").val();
   var borderWeight = $("#editrowBorderWeight").val();
   var borderColor = $("#editrowBorderColor").val();
   var height = $("#editrowHeight").val();

   // alert(bgColor + height)

   $("#"+selected).attr("height",`${height}px`);
   $("#"+selected).attr("style",`background-color:${bgColor};border:${borderWeight}px solid ${borderColor};`);

   // default details
   $("#editrowBgColor").val("#ffffff");
   $("#editrowBorderWeight").val(0);
   $("#editrowBorderColor").val("#ffffff");
   $("#editrowHeight").val(0);

   setState();
}

function addColumns ()
{
   var no_columns = $("#no_columns").val();
   var percentage = Math.floor(100 / no_columns);

   // check against min input
   no_columns = (no_columns < 0) ? 1 : no_columns;
   // check against max input
   no_columns = (no_columns > 5) ? 5 : no_columns;

   // get the details
   var bgColor = $("#columnBgColor").val();
   var borderWeight = $("#columnBorderWeight").val();
   var borderColor = $("#columnBorderColor").val();
   var height = $("#columnHeight").val();

   var template;
   for (let i = 0; i < no_columns; i++) {
      // increment cols
      cols++;

      template += 
      `<td 
         id="col${cols}" 
         onclick="select('col','col${cols}');" 
         class="selectable-column" 
         height="${height}px" 
         width="${percentage}%"; 
         style="
         padding: 0px 0px;
         border: ${borderWeight}px solid ${borderColor};
         background-color: ${bgColor};
         "
      >
         COLUMN
      </td>
      `;
   }

   if (selected != null)
   {
      $("#"+selected).html(template);

      clearSelect();

      $("#addColumn-display").hide();
      $("#editRow-display").hide();
      $("#row-display").show();
   }
   
   // default details
   $("#columnBgColor").val("#ffffff");
   $("#columnBorderWeight").val(0);
   $("#columnBorderColor").val("#ffffff");
   $("#columnHeight").val(0);
   
   setState();

}

function editColumn()
{
   // get the details
   var bgColor = $("#editcolumnBgColor").val();
   var borderWeight = $("#editcolumnBorderWeight").val();
   var borderColor = $("#editcolumnBorderColor").val();
   var height = $("#editcolumnHeight").val();
   var width = $("#editcolumnWidth").val();

   if (selected != null)
   {
      $("#"+selected).attr("height",`${height}px`);
      $("#"+selected).attr("width",`${width}%`);
      $("#"+selected).attr("style",`background-color:${bgColor};border:${borderWeight}px solid ${borderColor};`);

      clearSelect();
      colClicked();
   }

   // default details
   $("#editcolumnBgColor").val("#ffffff");
   $("#editcolumnBorderWeight").val(0);
   $("#editcolumnBorderColor").val("#ffffff");
   $("#editcolumnHeight").val(0);

   setState();
}

// Contents -------------------------------------------------------------
var textContentAlign;
function textAlignClicked (_textContentAlign = "center")
{
   textContentAlign = _textContentAlign;
   // return all btn to defaults
   $("#textContentAlignCenter").removeClass("btn-dark");
   $("#textContentAlignCenter").addClass("btn-outline-dark");
   $("#textContentAlignJustify").removeClass("btn-dark");
   $("#textContentAlignJustify").addClass("btn-outline-dark");
   $("#textContentAlignStart").removeClass("btn-dark");
   $("#textContentAlignStart").addClass("btn-outline-dark");
   $("#textContentAlignEnd").removeClass("btn-dark");
   $("#textContentAlignEnd").addClass("btn-outline-dark");
   // set the btn to display
   switch (textContentAlign) {
      case 'center':
         $("#textContentAlignCenter").removeClass("btn-outline-dark");
         $("#textContentAlignCenter").addClass("btn-dark");
         break;
      case 'justify':
            $("#textContentAlignJustify").removeClass("btn-outline-dark");
            $("#textContentAlignJustify").addClass("btn-dark");
         break;
      case 'start':
         $("#textContentAlignStart").removeClass("btn-outline-dark");
         $("#textContentAlignStart").addClass("btn-dark");
         break;
      case 'end':
         $("#textContentAlignEnd").removeClass("btn-outline-dark");
         $("#textContentAlignEnd").addClass("btn-dark");
         break;
      default:
         break;
   }
}

var textContentStyle;
function textStyleClicked (_textContentStyle = "normal")
{
   textContentStyle = _textContentStyle;
   // return all btn to defaults
   $("#textContentStyleNormal").removeClass("btn-dark");
   $("#textContentStyleNormal").addClass("btn-outline-dark");
   $("#textContentStyleItalic").removeClass("btn-dark");
   $("#textContentStyleItalic").addClass("btn-outline-dark");
   $("#textContentStyleStrikethrough").removeClass("btn-dark");
   $("#textContentStyleStrikethrough").addClass("btn-outline-dark");
   $("#textContentStyleUnderline").removeClass("btn-dark");
   $("#textContentStyleUnderline").addClass("btn-outline-dark");
   // set the btn to display
   switch (textContentStyle) {
      case 'normal':
         $("#textContentStyleNormal").removeClass("btn-outline-dark");
         $("#textContentStyleNormal").addClass("btn-dark");
         break;
      case 'italic':
            $("#textContentStyleItalic").removeClass("btn-outline-dark");
            $("#textContentStyleItalic").addClass("btn-dark");
         break;
      case 'line-through':
         $("#textContentStyleStrikethrough").removeClass("btn-outline-dark");
         $("#textContentStyleStrikethrough").addClass("btn-dark");
         break;
      case 'underline':
         $("#textContentStyleUnderline").removeClass("btn-outline-dark");
         $("#textContentStyleUnderline").addClass("btn-dark");
         break;
      default:
         break;
   }
}

var textLinkContentAlign;
function textLinkAlignClicked (_textLinkContentAlign = "center")
{
   textLinkContentAlign = _textLinkContentAlign;
   // return all btn to defaults
   $("#textLinkContentAlignCenter").removeClass("btn-dark");
   $("#textLinkContentAlignCenter").addClass("btn-outline-dark");
   $("#textLinkContentAlignJustify").removeClass("btn-dark");
   $("#textLinkContentAlignJustify").addClass("btn-outline-dark");
   $("#textLinkContentAlignStart").removeClass("btn-dark");
   $("#textLinkContentAlignStart").addClass("btn-outline-dark");
   $("#textLinkContentAlignEnd").removeClass("btn-dark");
   $("#textLinkContentAlignEnd").addClass("btn-outline-dark");
   // set the btn to display
   switch (textLinkContentAlign) {
      case 'center':
         $("#textLinkContentAlignCenter").removeClass("btn-outline-dark");
         $("#textLinkContentAlignCenter").addClass("btn-dark");
         break;
      case 'justify':
            $("#textLinkContentAlignJustify").removeClass("btn-outline-dark");
            $("#textLinkContentAlignJustify").addClass("btn-dark");
         break;
      case 'start':
         $("#textLinkContentAlignStart").removeClass("btn-outline-dark");
         $("#textLinkContentAlignStart").addClass("btn-dark");
         break;
      case 'end':
         $("#textLinkContentAlignEnd").removeClass("btn-outline-dark");
         $("#textLinkContentAlignEnd").addClass("btn-dark");
         break;
      default:
         break;
   }
}

var textLinkContentStyle;
function textLinkStyleClicked (_textLinkContentStyle = "normal")
{
   textLinkContentStyle = _textLinkContentStyle;
   // return all btn to defaults
   $("#textLinkContentStyleNormal").removeClass("btn-dark");
   $("#textLinkContentStyleNormal").addClass("btn-outline-dark");
   $("#textLinkContentStyleItalic").removeClass("btn-dark");
   $("#textLinkContentStyleItalic").addClass("btn-outline-dark");
   $("#textLinkContentStyleStrikethrough").removeClass("btn-dark");
   $("#textLinkContentStyleStrikethrough").addClass("btn-outline-dark");
   $("#textLinkContentStyleUnderline").removeClass("btn-dark");
   $("#textLinkContentStyleUnderline").addClass("btn-outline-dark");
   // set the btn to display
   switch (textLinkContentStyle) {
      case 'normal':
         $("#textLinkContentStyleNormal").removeClass("btn-outline-dark");
         $("#textLinkContentStyleNormal").addClass("btn-dark");
         break;
      case 'italic':
            $("#textLinkContentStyleItalic").removeClass("btn-outline-dark");
            $("#textLinkContentStyleItalic").addClass("btn-dark");
         break;
      case 'line-through':
         $("#textLinkContentStyleStrikethrough").removeClass("btn-outline-dark");
         $("#textLinkContentStyleStrikethrough").addClass("btn-dark");
         break;
      case 'underline':
         $("#textLinkContentStyleUnderline").removeClass("btn-outline-dark");
         $("#textLinkContentStyleUnderline").addClass("btn-dark");
         break;
      default:
         break;
   }
}

function addText ()
{
   cntt++;
   var text = $("#textContentText").val();
   var family = $("#textContentFamily").val();
   var size = $("#textContentSize").val();
   var color = $("#textContentColor").val();
   var weight = $("#textContentWeight").val();
   var xpadding = $("#textContentXPadding").val();
   var ypadding = $("#textContentYPadding").val();
   var align = textContentAlign;
   var style = textContentStyle;

   var styleCode = (style == "normal" || style == "italic") ? `font-style: ${style}; ` : `text-decoration: ${style}; ` ;

   var content = 
   `<p 
      id="cntt${cntt}" 
      onclick="select('cntt','cntt${cntt}');" 
      class="selectable-content"
      style="
      font-family: ${family}; 
      font-size: ${size}px; 
      color: ${color}; 
      font-weight: ${weight}; 
      padding: ${ypadding}px ${xpadding}px; 
      margin: 0px 0px !important;
      text-align: ${align}; 
      ${styleCode}
      "
   >
   ${text}
   </p>`;
   
   if ($("#"+selected).text().trim() == "COLUMN") {
      $("#"+selected).html(content);
   } else {
      $("#"+selected).append(content);
   }

   clearSelect();
   setState();
}

function addTextLink ()
{  
   cntt++;
   var text = $("#textLinkContentText").val();
   var link = $("#textLinkContentLink").val();
   var family = $("#textLinkContentFamily").val();
   var size = $("#textLinkContentSize").val();
   var color = $("#textLinkContentColor").val();
   var weight = $("#textLinkContentWeight").val();
   var xpadding = $("#textLinkContentXPadding").val();
   var ypadding = $("#textLinkContentYPadding").val();
   var align = textLinkContentAlign;
   var style = textContentStyle;

   var styleCode = (style == "normal" || style == "italic") ? `font-style: ${style}; text-decoration: none;` : `text-decoration: ${style}; ` ;

   var content = 
   `<p 
      onclick="select('cntt','cntt${cntt}');" 
      id="cntt${cntt}" 
      class="selectable-content"
      style="
      margin: 0px 0px !important;
      "
   >
   <a 
      href="${link}" 
      target="_blank"
      style="
      font-family: ${family}; 
      font-size: ${size}px; 
      color: ${color}; 
      font-weight: ${weight}; 
      padding: ${ypadding}% ${xpadding}%; 
      margin: 0px 0px !important;
      text-align: ${align}; 
      ${styleCode}
      "
   >
   ${text}
   </a>
   </p>`;
   
   if ($("#"+selected).text().trim() == "COLUMN") {
      $("#"+selected).html(content);
   } else {
      $("#"+selected).append(content);
   }

   clearSelect();
   setState();
}

imageSelector = "";
imageName = "";
imageUrl = "";

function selectThisImage(name, url)
{
   $("#"+imageSelector).html(name);
   imageName = name;
   imageUrl = url;
}

function setImageSelector (id)
{
   imageSelector = id;
}

function addImage ()
{
   cntt++
   // get parameters
   var src = (location.host == 'localhost') ? location.origin+'/bulkmailings/'+imageUrl : location.origin+'/'+imageUrl ;
   var width = $("#imgContentWidth").val();
   var height = $("#imgContentHeight").val();
   var xpadding = $("#imgContentXPadding").val();
   var ypadding = $("#imgContentYPadding").val();
   var align = $("#imgContentAlign").val();

   var content = 
   `<p 
      onclick="select('cntt','cntt${cntt}');" 
      id="cntt${cntt}" 
      class="selectable-content"
      style="margin: 0px 0px; overflow: auto;"
   >
   <img 
      src="${src}" 
      width="${width}%"
      height="${height}%"
      align="${align}" 
      style="padding: ${ypadding}% ${xpadding}%; " 
      alt="${imageName}"
   />
   </p>`
   
   if ($("#"+selected).text().trim() == "COLUMN") {
      $("#"+selected).html(content);
   } else {
      $("#"+selected).append(content);
   }
   
   clearSelect();
   setState();
}

function addImageLink ()
{
   cntt++
   // get parameters
   var src = (location.host == 'localhost') ? location.origin+'/bulkmailings/'+imageUrl : location.origin+'/'+imageUrl ;
   var width = $("#imgLinkContentWidth").val();
   var height = $("#imgLinkContentHeight").val();
   var xpadding = $("#imgLinkContentXPadding").val();
   var ypadding = $("#imgLinkContentYPadding").val();
   var link = $("#imageLinkContentLink").val();
   var align = $("#imgLinkContentAlign").val();

   var content = 
   `<p 
      onclick="select('cntt','cntt${cntt}');" 
      id="cntt${cntt}" 
      class="selectable-content"
      style="margin: 0px 0px; overflow: auto;"
   >
   <a 
      href="${link}" 
      target="_blank"
   >
   <img 
      src="${src}" 
      width="${width}%"
      height="${height}%"
      align="${align}" 
      style="padding: ${ypadding}% ${xpadding}%; " 
      alt="${imageName}"
   />
   </a>
   </p>`
   
   if ($("#"+selected).text().trim() == "COLUMN") {
      $("#"+selected).html(content);
   } else {
      $("#"+selected).append(content);
   }
   
   clearSelect();
   setState();
}

// Content Functionalities

function remove ()
{
   $("#"+selected).remove();
   clearSelect();
   setState();
}

function clearContent ()
{
   $("#"+selected).empty();
   clearSelect();
   setState();
}

function saveTemplate ()
{
   // set the configuration details
   var config = {
      rows: rows,
      cols: cols,
      cntt: cntt
   };
   config = JSON.stringify(config);
   $("#email_template").attr("data-config",config)

   var body = $("#template-pad").html();
   var templateForm = $("#templateForm");

   $("#email_body").val(body);
   
   // go ahead and submit form
   templateForm.submit();

}

function updateTemplate ()
{
   // set the configuration details
   var config = {
      rows: rows,
      cols: cols,
      cntt: cntt
   };
   config = JSON.stringify(config);
   $("#email_template").attr("data-config",config)

   var body = $("#template-pad").html();
   var templateForm = $("#templateForm");

   $("#email_body").val(body);
   
   // go ahead and submit form
   templateForm.submit();
}

function previewTemplate ()
{
   var body = $("#template-pad").html();
   // strip body
   // body = body.replace('class="selectable"',"");
   // body = body.replace('class="selected"',"");
   // ! Do it for all
   $("#bodyPreview").html(body);
}
