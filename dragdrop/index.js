
var rows = 0;
var cols = 0;
var cntt = 0;
var selects = [];
var selected = null;

$(document).ready(function(){
   start();
});

// Hiding & Showing
function hideAll ()
{
   $("#create-new-template").hide();
   $("#default-display").hide();
   $("#row-actions").hide();
   $("#col-actions").hide();
   $("#cntt-actions").hide();
}

function start ()
{
   hideAll();
   $("#create-new-template").show();
   textAlignClicked('center');
   textStyleClicked('normal');
   textLinkAlignClicked('center');
   textLinkStyleClicked('normal')
}

function defaults ()
{
   $("#default-display").show();
}

function rowClicked ()
{
   hideAll();
   $("#row-actions").show();
   $("#default-display").show();
}

function colClicked ()
{
   hideAll();
   $("#col-actions").show();
   $("#default-display").show();
}

function cnttClicked ()
{
   hideAll();
   $("#cntt-actions").show();
   $("#default-display").show();
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
         rowClicked();
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

function createNewTemplate ()
{
   var template = 
   `<div style="background-color:#fbf1f1;width:100%;margin:10px 0">
      <table border="0" bgcolor="#e4e4e4" cellspacing="0" cellpadding="0" width="100%" style="font-family:'Helvetica Neue','Helvetica','Arial','sans-serif';font-size:13px">
         <tbody>
         <tr>
            <td bgcolor="#eeeee6" width="100%" style="padding: 10px 0;">

               <!-- Container Table -->
               <table width="80%" cellpadding="0" cellspacing="0" border="0" align="center">
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
   hideAll();
   defaults();
}

function addRow ()
{
   // increment the rows, hence using it as ID selected('row','row${rows}');
   rows++;
   var template =
   `<table width="100%" cellspacing="0" cellpadding="0" style="vertical-align:middle">
      <tbody>
         <tr id="row${rows}" onclick="select('row','row${rows}')" class="selectable">
            <td align="center" style="vertical-align: middle;">
               ROW${rows}
            </td>
         </tr>
      </tbody>
   </table>`;

   if ($("#template-contents").text().trim() == "NEW TEMPLATE") {
      $("#template-contents").html(template);
   } else {
      $("#template-contents").append(template);
   }

   clearSelect();

}

function addColumns ()
{
   var no_columns = $("#no_columns").val();
   var percentage = Math.floor(100 / no_columns);

   var template;
   for (let i = 0; i < no_columns; i++) {
      // increment cols
      cols++;

      template += 
      `<td 
         id="col${cols}" 
         onclick="select('col','col${cols}');" 
         class="selectable" 
         style="
         border: 
         width: ${percentage}%;
         "
      >
         COLUMN${cols}
      </td>
      `;
   }

   $("#"+selected).html(template);

   clearSelect();
   
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
      padding: ${ypadding}% ${xpadding}%; 
      text-align: ${align}; 
      ${styleCode}
      "
   >
   ${text}
   </p>`;
   
   $("#"+selected).html(content);
   clearSelect();
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

   var styleCode = (style == "normal" || style == "italic") ? `font-style: ${style}; ` : `text-decoration: ${style}; ` ;

   var content = 
   `<a 
      href="${link}" 
      target="_blank"
      id="cntt${cntt}" 
      class="selectable-content"
      onclick="select('cntt','cntt${cntt}');" 
      style="
      font-family: ${family}; 
      font-size: ${size}px; 
      color: ${color}; 
      font-weight: ${weight}; 
      padding: ${ypadding}% ${xpadding}%; 
      text-align: ${align}; 
      ${styleCode}
      "
   >
   ${text}
   </a>`;
   
   $("#"+selected).html(content);
   clearSelect();
}

function addImageLink ()
{
   cntt++
   var image = $("#linkImageSelect").val();
   var imagelink = $("#imagelink").val();
   var content = 
   `<a id="cntt${cntt}" onclick="select('cntt','cntt${cntt}');" class="selectable" style="color:black;text-decoration:none;padding:0 2%" href="${imagelink}" target="_blank">
      <img src="${image}" width="100%"/>
   </a>`
   $("#"+selected).html(content);
   clearSelect();
}

function addImage ()
{
   cntt++
   // get parameters
   var image = $("#imageSelect").val();
   var content = `<img id="cntt${cntt}" onclick="select('cntt','cntt${cntt}');" class="selectable"  src="${image}" width="100%"/><br/>`
   $("#"+selected).html(content);
   clearSelect();
}

// Content Functionalities


function anotherContent ()
{
   var content =
   `Another Content`;
   $("#"+selected).parent().append(content);
}

function removeContent ()
{
   $("#"+selected).remove();
   clearSelect();
}

function clearContent ()
{
   $("#"+selected).empty();
   clearSelect();
}

function getCode ()
{
   alert($("#template-pad").html());
}