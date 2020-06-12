
window.onload = function () {
   loaded = true;
   hide();
   showBlocks();

   document.getElementById("start-button").click();
}

let designer =  {

   template: "Blank",

   create: function() {
      switch (this.template) {
         case 'Blank':
            this._create_blank_template();
            break;

         default:
            this._create_blank_template();
            break;
      }
   },

   _create_blank_template: function() {

      let body = `
      <!-- Mail Body -->
      <div class="bulkmailer">
         <div style="margin:0;padding:0;background-color:#e6e7e8">
            <table style="table-layout:fixed;vertical-align:top;min-width:320px;Margin:0 auto border-spacing:0; border-collapse:collapse;background-color:#e6e7e8;width:100%" cellpadding="0" cellspacing="0" role="presentation" width="100%" bgcolor="#E6E7E8" valign="top">
               <tbody>
                  <tr style="vertical-align:top" valign="top">
                     <td style="word-break:break-word;vertical-align:top;" valign="top">
                     
                        <!-- Header Row -->
                        <div class="default _add_block _row" style="background-color:transparent">
                           <div style="Margin:0 auto;min-width:320px;max-width:800px;word-wrap:break-word;word-break:break-word;">
                              <div style="border-collapse:collapse;display:table;width:100%;background-color:#ecf0f3">
                                 
                                 <!-- Column -->
                                 <div style="display:table-cell;vertical-align:top;max-width:800px;min-width:320px;width:800px">
                                    <div style="width:100%!important">
                                    
                                       <!-- Content -->
                                       <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:50px;padding-bottom:50px;padding-right:0px;padding-left:0px">
                                       
                                          <!-- Text Block -->
                                          <div class="_txtblock" align="center" style="color:#4e5052;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                                             <div style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:36px;line-height:1.5;color:#4e5052">
                                             
                                                <p class="_txt" style="font-size:36px;line-height:1.5;word-break:break-word;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;margin:0">
                                                   Header
                                                </p>

                                                <p class="_txt" style="font-size:36px;line-height:1.5;word-break:break-word;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;margin:0">
                                                   Add Content Block
                                                </p>
                                             
                                             </div>
                                          </div>

                                       </div>
                                    
                                    </div>
                                 </div>

                              </div>
                           </div>
                        </div>

                        <!-- Body -->
                        <div class="default _add_block _row" style="background-color:transparent">
                           <div style="Margin:0 auto;min-width:320px;max-width:800px;word-wrap:break-word;word-break:break-word;">
                              <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
                                 
                                 <!-- Column -->
                                 <div style="display:table-cell;vertical-align:top;max-width:800px;min-width:320px;width:800px">
                                    <div style="width:100%!important">
                                    
                                       <!-- Content -->
                                       <div class="_content" style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:150px;padding-bottom:150px;padding-right:0px;padding-left:0px">
                                       
                                          <!-- Text Block -->
                                          <div class="_txtblock" align="center" style="color:#4e5052;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                                             <div style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:36px;line-height:1.5;color:#4e5052">
                                             
                                                <p class="_txt" style="font-size:36px;line-height:1.5;word-break:break-word;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;margin:0">
                                                   Body
                                                </p>

                                                <p class="_txt" style="font-size:36px;line-height:1.5;word-break:break-word;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;margin:0">
                                                   Add Content Block
                                                </p>
                                             
                                             </div>
                                          </div>

                                       </div>
                                    
                                    </div>
                                 </div>

                              </div>
                           </div>
                        </div>

                        <!-- Footer -->
                        <div class="default _add_block _row" style="background-color:transparent">
                           <div style="Margin:0 auto;min-width:320px;max-width:800px;word-wrap:break-word;word-break:break-word;">
                              <div style="border-collapse:collapse;display:table;width:100%;background-color:#ecf0f3">
                                 
                                 <!-- Column -->
                                 <div style="display:table-cell;vertical-align:top;max-width:800px;min-width:320px;width:800px">
                                    <div style="width:100%!important">
                                    
                                       <!-- Content -->
                                       <div class="_content" style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:50px;padding-bottom:50px;padding-right:0px;padding-left:0px">
                                       
                                          <!-- Text Block -->
                                          <div class="_txtblock" align="center" style="color:#4e5052;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                                             <div style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:36px;line-height:1.5;color:#4e5052">
                                             
                                                <p class="_txt" style="font-size:36px;line-height:1.5;word-break:break-word;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;margin:0">
                                                   Footer
                                                </p>

                                                <p class="_txt" style="font-size:36px;line-height:1.5;word-break:break-word;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;margin:0">
                                                   Add Content Block
                                                </p>
                                             
                                             </div>
                                          </div>

                                       </div>
                                    
                                    </div>
                                 </div>

                              </div>
                           </div>
                        </div>
                     
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      `;

      // content.content = body;
      content.set(body)
      content.show();
   },

   _create_block: function(type) {
      let no = 1, body = "";
      switch (type) {
         case '1Block':
            body = `
            <div class="_row" style="background-color:transparent">
               <div style="Margin:0 auto;min-width:320px;max-width:800px;word-wrap:break-word;word-break:break-word;">
                  <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
                  
                     <!-- Column -->
                     <div class="_col" style="display:table-cell;vertical-align:middle;max-width:800px;min-width:320px;width:800px">
                        <div style="width:100%!important;border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px;background-color:#ffffff">
                           <!-- Content -->
                           <div class="_add_content">
                              <!-- Text Block -->
                              <div class="_txtblock" align="center" style="color:#4e5052;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                                 <div style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:36px;line-height:1.5;color:#4e5052">
                                 
                                    <p class="_txt" style="font-size:36px;line-height:1.5;word-break:break-word;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;margin:0">
                                       Add Content
                                    </p>
                                 
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
            `;
            return body;
         break;

         case '2Blocks':
            no = 2, body = `
            <div class="_row" style="background-color:transparent">
               <div style="Margin:0 auto;min-width:320px;max-width:800px;word-wrap:break-word;word-break:break-word;">
                  <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
            `;
            for (let count = 0; count < no; count++) {
               body += `
               <!-- Column -->
               <div class="_col" style="display:table-cell;vertical-align:middle;max-width:${800/no}px;min-width:${320/no}px;width:${800/no}px">
                  <div style="width:100%!important;border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px;background-color:#ffffff">
                  
                     <!-- Content -->
                     <div class="_add_content">
                     
                        <!-- Text Block -->
                        <div class="_txtblock" align="center" style="color:#4e5052;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                           <div style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:36px;line-height:1.5;color:#4e5052">
                           
                              <p class="_txt" style="font-size:36px;line-height:1.5;word-break:break-word;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;margin:0">
                                 Add Content
                              </p>
                           
                           </div>
                        </div>

                     </div>
                  
                  </div>
               </div>
               `;
            }
            body += `
                  </div>
               </div>
            </div>
            `;
            return body;
         break;
            
         case '3Blocks':
            no = 3, body = `
            <div class="_row" style="background-color:transparent">
               <div style="Margin:0 auto;min-width:320px;max-width:800px;word-wrap:break-word;word-break:break-word;">
                  <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
            `;
            for (let count = 0; count < no; count++) {
               body += `
               <div class="_col" style="display:table-cell;vertical-align:middle;max-width:${800/no}px;min-width:${320/no}px;width:${800/no}px">
                  <div style="width:100%!important;border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px;background-color:#ffffff">
                  
                     <div class="_add_content">
                     
                        <!-- Text Block -->
                        <div class="_txtblock" align="center" style="color:#4e5052;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                           <div style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:36px;line-height:1.5;color:#4e5052">
                           
                              <p class="_txt" style="font-size:36px;line-height:1.5;word-break:break-word;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;margin:0">
                                 Add Content
                              </p>
                           
                           </div>
                        </div>

                     </div>
                  
                  </div>
               </div>

               `;
               
            }
            body += `
                  </div>
               </div>
            </div>
            `;
            return body;
         break;

         case '4Blocks':
            no = 4, body = `
            <div class="_row" style="background-color:transparent">
               <div style="Margin:0 auto;min-width:320px;max-width:800px;word-wrap:break-word;word-break:break-word;">
                  <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
            `;
            for (let count = 0; count < no; count++) {
               body += `
               <!-- Column -->
               <div class="_col" style="display:table-cell;vertical-align:middle;max-width:${800/no}px;min-width:${320/no}px;width:${800/no}px">
                  <div style="width:100%!important;border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px;background-color:#ffffff">
                  
                     <!-- Content -->
                     <div class="_add_content">
                     
                        <!-- Text Block -->
                        <div class="_txtblock" align="center" style="color:#4e5052;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                           <div style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:36px;line-height:1.5;color:#4e5052">
                           
                              <p class="_txt" style="font-size:36px;line-height:1.5;word-break:break-word;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;margin:0">
                                 Add Content
                              </p>
                           
                           </div>
                        </div>

                     </div>
                  
                  </div>
               </div>
               `;
            }
            body += `
                  </div>
               </div>
            </div>
            `;
            return body;
         break;
      
         default:
            // 1Block
            break;
      }
   }, 

   _create_content: function(type) {
      let body = "";
      switch (type) {
         case 'Text':
            body  = `
            <div class="_txt" style="word-break:break-word;">
               <p style="font-size:14px;line-height:1.5;word-break:break-word;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;margin:0;font-weight:400;color:#000000;">
                  Text
               </p>
            </div>
            `;
            return body;
         break;

         case 'Image':
            var uri = 'assets/imgs/default.png';
            var src = (location.host == 'localhost') ? location.origin+'/bulkmailings/'+uri : location.origin+'/'+uri ;
            body  = `
            <div class="_img">
               <div align="center" style="padding-right:0px;padding-left:0px;padding-top:0px;padding-bottom:0px;">
                  <img src="${src}" alt="Image" title="Image" style="height:auto;width:100%;max-width:800px;display:block" width="800">
               </div>
            </div>
            `;
            return body;
         break;

         case 'LinkImage':
            var uri = 'assets/imgs/default.png';
            var src = (location.host == 'localhost') ? location.origin+'/bulkmailings/'+uri : location.origin+'/'+uri ;
            body  = `
            <div class="_imglink">
               <div align="center" style="padding-right:0px;padding-left:0px;padding-top:0px;padding-bottom:0px;">
                  <a style="text-decoration: none; color: inherit;" href="#">
                     <img src="${src}" alt="Image" title="Image" style="height:auto;width:100%;max-width:800px;display:block" width="800">
                  </a>
               </div>
            </div>
            `;
            return body;
         break;

         case 'Button':
            body  = `
            <div class="_button" align="center" style="text-align:center;">
               <a style="text-decoration: none; color: inherit;" href="#">
                  <div style="display:inline-block;font-weight:400;color:#ffffff;text-align:center;vertical-align:middle;background-color:#6c757d;border: 1px solid transparent;padding-right:5px;padding-left:5px;padding-top:5px;padding-bottom:5px;font-size: 14px;border-radius:5px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;">
                     Button
                  </div>
               </a>
            </div>
            `;
            return body;
         break;

         case 'Divider':
            body  = `
            <div class="_divider">
               <hr align="right" style="text-align:right;width:100%;padding-top:2px;background-color:#000000;"/>
            </div>
            `;
            return body;
         break;

         case 'Spacer':
            body  = `
            <div class="_spacer" style="font-size:1px;line-height:15px">&nbsp;</div>
            `;
            return body;
         break;

         case 'Table':
            body  = `
            
            <table class="_table" style="">
               <tbody>
                  <tr>
                     <td>A</td>
                     <td>B</td>
                     <td>C</td>
                     <td>D</td>
                  </tr>
               </tbody>
            </table>
            `;
            return body;
         break;
      
         default:
            break;
      }
   }

};


let content = {

   states: [""],
   state: 0,
   content: null,

   show: function() {
      // Reflect Contents
      $("#body-mobile").html(this.content);
      $("#body-pc").html(this.content);
      
      // Set Event Listeners
      // when row is clicked, show block actions
      $("._row").click(function(ev) {
         showBlockActions(ev);
      });

      // when row is hovered, highlight
      $("._row").on('mouseenter', function(ev) {
         ev.currentTarget.children[0].style.borderWidth = "1.0px"
         ev.currentTarget.children[0].style.borderStyle = "dashed";
         ev.currentTarget.children[0].style.borderColor = "#4e5052";
      });

      // when hover leaves row, remove highlight
      $("._row").on('mouseleave', function(ev) {
         ev.currentTarget.children[0].style.borderWidth = ""
         ev.currentTarget.children[0].style.borderStyle = "";
         ev.currentTarget.children[0].style.borderColor = "";
      });

      // Rows/Blocks
      $("._add_block").on('dragover', function(ev) {
         allowBlockDrop(ev);
         ev.currentTarget.children[0].style.borderWidth = "1.0px"
         ev.currentTarget.children[0].style.borderStyle = "dashed";
         ev.currentTarget.children[0].style.borderColor = "#4e5052";
      });

      $("._add_block").on('dragenter', function(ev) {
         ev.currentTarget.children[0].style.borderWidth = "1.0px"
         ev.currentTarget.children[0].style.borderStyle = "dashed";
         ev.currentTarget.children[0].style.borderColor = "#4e5052";
      });

      $("._add_block").on('dragleave', function(ev) {
         ev.currentTarget.children[0].style.borderWidth = ""
         ev.currentTarget.children[0].style.borderStyle = "";
         ev.currentTarget.children[0].style.borderColor = "";
      });

      $("._add_block").on('drop', function(ev) {
         blockDrop(ev);
      });

      // Contents
      $("._add_content").on('dragover', function(ev) {
         allowContentDrop(ev);
         ev.currentTarget.style.borderWidth = "1.0px"
         ev.currentTarget.style.borderStyle = "dashed";
         ev.currentTarget.style.borderColor = "#4e5052";
      });

      $("._add_content").on('dragenter', function(ev) {
         ev.currentTarget.style.borderWidth = "1.0px"
         ev.currentTarget.style.borderStyle = "dashed";
         ev.currentTarget.style.borderColor = "#4e5052";
      });

      $("._add_content").on('dragleave', function(ev) {
         ev.currentTarget.style.borderWidth = ""
         ev.currentTarget.style.borderStyle = "";
         ev.currentTarget.style.borderColor = "";
      });

      $("._add_content").on('drop', function(ev) {
         contentDrop(ev);
      });

   },

   set: function(content) {
      this.state = (this.states.push(content)) - 1;
      this.content = content;
   },

   get: function() {
      return this.states[this.state];
   },

   previous: function() {
      try {
         if (this.state <= 1)
         throw("No Previous State");
         else
         {
            this.state--;
            this.content = this.get(this.state);
            this.show();
         }
      } catch (error) {
         alert(error);
      }
   },

   next: function() {
      try {
         if (this.states.length <= (this.state + 1))
         throw("No Next State");
         else
         {
            this.state++;
            this.content = this.get(this.state);
            this.show();
         }
      } catch (error) {
         alert(error);
      }
   }

};


let display = {
   displayed: "body-pc",

   pc: function() {
      this.displayed = "body-pc";
      $("#body-mobile").hide();
      $("#body-pc").show();
   },

   mobile: function() {
      this.displayed = "body-mobile";
      $("#body-pc").hide();
      $("#body-mobile").show();
   }

};

// Drag Drop Functions
// Blocks
let draggedBlock = "1Block";
let blockDragging = false;
function blockDrag(ev) {
   blockDragging = true;
   ev.dataTransfer.setData("text", ev.target.dataset.type)
   draggedBlock = ev.target.dataset.type;
}

function allowBlockDrop(ev) {
   if (blockDragging == true) {
      ev.preventDefault();
   }
}

function blockDrop(ev) {
   if (blockDragging == true) {
      ev.preventDefault();
      body = designer._create_block(draggedBlock);
      ev.currentTarget.outerHTML = body;
      body = $("#"+display.displayed).html();
      content.set(body);
      content.show();
      showContents();
      blockDragging = false;
   }
}

// Contents
let draggedContent = "Text";
let contentDragging = false;
function contentDrag(ev) {
   contentDragging = true;
   ev.dataTransfer.setData("text", ev.target.dataset.type)
   draggedContent = ev.target.dataset.type;
}

function allowContentDrop(ev) {
   if (contentDragging == true) {
      ev.preventDefault();
   }
}

function contentDrop(ev) {
   if (contentDragging == true) {
      ev.preventDefault();
      body = designer._create_content(draggedContent);
      ev.currentTarget.outerHTML = body;
      body = $("#"+display.displayed).html();
      content.set(body);
      content.show();
      contentDragging = false;
   }
}

// Display Functions
function showBlocks() {
   hide();
   $("#content-blocks").show();
}

function showContents() {
   hide();
   $("#contents").show();
}

let selectedBlock = null;
let blockColumns = [];
function showBlockActions(ev) {
   selectedBlock = ev;
   // ***
   // find out how many columns are in it
   // console.log(ev.currentTarget.children[0].children[0].children);
   
   if (selectedBlock.currentTarget.className == "_row" ) {
      blockColumns = ev.currentTarget.children[0].children[0].children;
         
      // content buttons for editing contents
      let columns = blockColumns.length;
      let columnBtns = "";
      for (let i = 0; i < columns; i++) {
         columnBtns += `<button class="btn btn-sm btn-secondary" title="Column ${i+1}" onclick="showColumn${i+1}();">Column ${i+1}</button>`
      }
      $("#select-column-btn").html(columnBtns);

      // reflect the row bg attribute
      $("#label-block-bg").css('background-color',rgbToHex(selectedBlock.currentTarget.children[0].children[0].style.backgroundColor));
      $("#block-bg").val(rgbToHex(selectedBlock.currentTarget.children[0].children[0].style.backgroundColor));

      // action block
      let columnAction = "";
      
      let count = 0;
      // foreach column in the row
      for (const key in blockColumns) {
         if (blockColumns.hasOwnProperty(key)) {
            const column = blockColumns[key];
            
            // no content yet
            if (column.className == "_add_content" || column.children[0].children[0].className == "_add_content") {
               columnAction += `
                  <div id="column-${count+1}-actions">
                     <div class="border rounded px-1 my-1 w-100 text-secondary">
                        <span class="my-2 float-left">Column ${count+1}</span>
                        <div class="my-1 float-right">
                           <button class="btn btn-sm btn-secondary" onclick="duplicateColumn(${count});"><span class="fa fa-copy"></span></button>
                           <button class="btn btn-sm btn-secondary" onclick="deleteColumn(${count});"><span class="fa fa-trash"></span></button>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                     ${$("#contents").html()}
                  </div>
               `;
            } else {
               columnAction += `
                  <div id="column-${count+1}-actions">
               `;

               // changing variable
               varr = null;
               // get the column attributes
               let valign = column.style.verticalAlign;
               // let maxwidth = column.style.maxWidth;
               // let minwidth = column.style.minWidth;
               varr = column.style.width.toString();
               let width = varr.substring(0,varr.length - 2);
               varr = column.children[0].style.borderTopWidth.toString();
               let bordertopwidth = varr.substring(0,varr.length - 2);
               let bordertopcolor = column.children[0].style.borderTopColor;
               varr = column.children[0].style.borderRightWidth.toString();
               let borderrightwidth = varr.substring(0,varr.length - 2);
               let borderrightcolor = column.children[0].style.borderRightColor;
               varr = column.children[0].style.borderLeftWidth.toString();
               let borderleftwidth = varr.substring(0,varr.length - 2);
               let borderleftcolor = column.children[0].style.borderLeftColor;
               varr = column.children[0].style.borderBottomWidth.toString();
               let borderbottomwidth = varr.substring(0,varr.length - 2);
               let borderbottomcolor = column.children[0].style.borderBottomColor;
               varr = column.children[0].style.paddingTop.toString();
               let paddingtop = varr.substring(0,varr.length - 2);
               varr = column.children[0].style.paddingLeft.toString();
               let paddingleft = varr.substring(0,varr.length - 2);
               varr = column.children[0].style.paddingRight.toString();
               let paddingright = varr.substring(0,varr.length - 2);
               varr = column.children[0].style.paddingBottom.toString();
               let paddingbottom = varr.substring(0,varr.length - 2);
               let bgcolor = column.children[0].style.backgroundColor;

               columnAction += `
                  <div class="border rounded px-1 my-1 w-100 text-secondary">
                     <span class="my-2 float-left">Column ${count+1}</span>

                     <div class="my-1 float-right">
                        <button class="btn btn-sm btn-secondary" onclick="duplicateColumn(${count});"><span class="fa fa-copy"></span></button>
                        <button class="btn btn-sm btn-secondary" onclick="deleteColumn(${count});"><span class="fa fa-trash"></span></button>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <hr class="my-0">

                  <!-- Column Attributes -->
                  <div>
                     <br>
                     <div class="h5 font-weight-normal text-secondary"><span class="fa fa-sm fa-edit"></span> Edit Column</div>
                     <hr class="my-0">
   
                     <div class="input-group my-1">
                        <div class="input-group-prepend">
                           <span class="input-group-text bg-muted">
                              Background Color
                           </span>
                        </div>
                        <label for="column-${count+1}-bg" class="form-control cursor-pointer" id="label-column-${count+1}-bg" style="background-color:${rgbToHex(bgcolor)}"></label>
                        <input type="color" onchange="$('#label-column-${count+1}-bg').css('background-color', $('#column-${count+1}-bg').val());editColumn('bg',$('#column-${count+1}-bg').val(),${count});" id="column-${count+1}-bg" class="d-none form-control" value="${rgbToHex(bgcolor)}">
                        <button title="Transparent" class="btn border btn-sm input-group-append text-secondary" onclick="editColumn('bg','transparent',${count})"><span class="fa my-auto fa-times"></span></button>
                     </div>

                     <!-- VAlign & Width -->
                     <div class="input-group my-1">
                        <div class="input-group-prepend">
                           <span title="Vertical Alignment" class="input-group-text bg-muted">
                              Vertical Alignment
                           </span>
                        </div>
                        <select id="column-${count+1}-valign" class="input-group-append form-control" value="${valign}" onchange="editColumn('valign',$('#column-${count+1}-valign').val(),${count})" placeholder="Alignment">
                           <option value="top">Top</option>
                           <option value="middle">Middle</option>
                           <option value="bottom">Bottom</option>
                        </select>
                        <span title="Width" class="input-group-append input-group-text rounded-0 bg-muted">
                           Width
                        </span>
                        <input type="number" max="800" min="80" id="column-${count+1}-width" class="input-group-append form-control" placeholder="Width" value="${width}" onchange="editColumn('width',$('#column-${count+1}-width').val(),${count})">
                     </div>

                     <!-- Border -->
                     <div class="input-group my-1">
                        <div class="input-group-prepend">
                           <span class="input-group-text bg-muted">
                              Border Left
                           </span>
                        </div>
                        <input type="number" id="column-${count+1}-border-left" class="form-control" placeholder="Width" value="${borderleftwidth}" onchange="editColumn('blw',$('#column-${count+1}-border-left').val(),${count})">
                        <label for="column-${count+1}-border-left-color" class="form-control cursor-pointer" id="label-column-${count+1}-border-left" style="background-color:${rgbToHex(borderleftcolor)};">Color</label>
                        <input type="color" onchange="$('#label-column-${count+1}-border-left').css('background-color', $('#column-${count+1}-border-left-color').val());editColumn('blc',$('#column-${count+1}-border-left-color').val(),${count})" id="column-${count+1}-border-left-color" class="d-none form-control" value="${rgbToHex(borderleftcolor)}">
                        <button title="Transparent" class="btn border btn-sm input-group-append text-secondary" onclick="editColumn('blc','transparent',${count})"><span class="fa my-auto fa-times"></span></button>
                     </div>
                     <div class="input-group my-1">
                        <div class="input-group-prepend">
                           <span class="input-group-text bg-muted">
                              Border Top
                           </span>
                        </div>
                        <input type="number" id="column-${count+1}-border-top" class="form-control" placeholder="Width" value="${bordertopwidth}" onchange="editColumn('btw',$('#column-${count+1}-border-top').val(),${count})">
                        <label for="column-${count+1}-border-top-color" class="form-control cursor-pointer" id="label-column-${count+1}-border-top" style="background-color:${rgbToHex(bordertopcolor)};">Color</label>
                        <input type="color" onchange="$('#label-column-${count+1}-border-top').css('background-color', $('#column-${count+1}-border-top-color').val());editColumn('btc',$('#column-${count+1}-border-top-color').val(),${count})" id="column-${count+1}-border-top-color" class="d-none form-control" value="${rgbToHex(bordertopcolor)}">
                        <button title="Transparent" class="btn border btn-sm input-group-append text-secondary" onclick="editColumn('btc','transparent',${count})"><span class="fa my-auto fa-times"></span></button>
                     </div>
                     <div class="input-group my-1">
                        <div class="input-group-prepend">
                           <span class="input-group-text bg-muted">
                              Border Right
                           </span>
                        </div>
                        <input type="number" id="column-${count+1}-border-right" class="form-control" placeholder="Width" value="${borderrightwidth}" onchange="editColumn('brw',$('#column-${count+1}-border-right').val(),${count})">
                        <label for="column-${count+1}-border-right-color" class="form-control cursor-pointer" id="label-column-${count+1}-border-right" style="background-color:${rgbToHex(borderrightcolor)};">Color</label>
                        <input type="color" onchange="$('#label-column-${count+1}-border-right').css('background-color', $('#column-${count+1}-border-right-color').val());editColumn('brc',$('#column-${count+1}-border-right-color').val(),${count})" id="column-${count+1}-border-right-color" class="d-none form-control" value="${rgbToHex(borderrightcolor)}">
                        <button title="Transparent" class="btn border btn-sm input-group-append text-secondary" onclick="editColumn('brc','transparent',${count})"><span class="fa my-auto fa-times"></span></button>
                     </div>
                     <div class="input-group my-1">
                        <div class="input-group-prepend">
                           <span class="input-group-text bg-muted">
                              Border Bottom
                           </span>
                        </div>
                        <input type="number" id="column-${count+1}-border-bottom" class="form-control" placeholder="Width" value="${borderbottomwidth}" onchange="editColumn('bbw',$('#column-${count+1}-border-bottom').val(),${count})">
                        <label for="column-${count+1}-border-bottom-color" class="form-control cursor-pointer" id="label-column-${count+1}-border-bottom" style="background-color:${rgbToHex(borderbottomcolor)};">Color</label>
                        <input type="color" onchange="$('#label-column-${count+1}-border-bottom').css('background-color', $('#column-${count+1}-border-bottom-color').val());editColumn('bbc',$('#column-${count+1}-border-bottom-color').val(),${count})" id="column-${count+1}-border-bottom-color" class="d-none form-control" value="${rgbToHex(borderbottomcolor)}">
                        <button title="Transparent" class="btn border btn-sm input-group-append text-secondary" onclick="editColumn('bbc','transparent',${count})"><span class="fa my-auto fa-times"></span></button>
                     </div>

                     <!-- Padding -->
                     <div class="input-group my-1">
                        <div class="input-group-prepend">
                           <span title="Padding Left" class="input-group-text bg-muted">
                              PL
                           </span>
                        </div>
                        <input type="number" id="column-${count+1}-padding-left" class="input-group-append form-control" placeholder="Width" value="${paddingleft}" onchange="editColumn('pl',$('#column-${count+1}-padding-left').val(),${count})">
                        <span title="Padding Right" class="input-group-append input-group-text rounded-0 bg-muted">
                           PR
                        </span>
                        <input type="number" id="column-${count+1}-padding-right" class="input-group-append form-control" placeholder="Width" value="${paddingright}" onchange="editColumn('pr',$('#column-${count+1}-padding-right').val(),${count})">
                        <span title="Padding Top" class="input-group-append input-group-text rounded-0 bg-muted">
                           PT
                        </span>
                        <input type="number" id="column-${count+1}-padding-top" class="input-group-append form-control" placeholder="Width" value="${paddingtop}" onchange="editColumn('pt',$('#column-${count+1}-padding-top').val(),${count})">
                        <span title="Padding Bottom" class="input-group-append input-group-text rounded-0 bg-muted">
                           PB
                        </span>
                        <input type="number" id="column-${count+1}-padding-bottom" class="input-group-append form-control" placeholder="Width" value="${paddingbottom}" onchange="editColumn('pb',$('#column-${count+1}-padding-bottom').val(),${count})">
                     </div>
                     
                  </div>
                  <hr>
               `;

               // for each content in the column
               // list out the content type, and its attributes
               // <div id="content-${ccount+1}-editor">
               // </div>

               let colContents = column.children[0].children;
               // console.log(colContents);

               let ccount = 0;
               let columnContents = "";
               
               for (const key in colContents) {
                  if (colContents.hasOwnProperty(key)) {
                     const content = colContents[key];
                     let contentAction = `
                     <div class="float-right my-1 btn-group">
                        <button class="btn btn-sm btn-secondary" title="Duplicate Content" onclick="duplicateContent(${count},${ccount});"><span class="fa fa-sm fa-copy"></span></button>
                        <button class="btn btn-sm btn-secondary" title="Delete Content" onclick="deleteContent(${count},${ccount});"><span class="fa fa-sm fa-trash"></span></button>
                        <button class="btn btn-sm btn-secondary" title="Add Content Above" onclick="addContentAbove(${count},${ccount});"><span class="fa fa-sm fa-arrow-up"></span></button>
                        <button class="btn btn-sm btn-secondary" title="Add Content Below" onclick="addContentBelow(${count},${ccount});"><span class="fa fa-sm fa-arrow-down"></span></button>
                     </div>
                     `;

                     // get the content type
                     let type = content.className;
                     console.log(content);
                     let varr = null;
                     // alert(type);
                     switch (type) {
                        case '_txt':
                           textcontent = content.innerHTML;
                           // get the text content for the editor
                           columnContents += `
                           <div class="border rounded pl-3 pr-1 my-1 w-100 text-secondary">
                              <span class="my-2 float-left">Text</span>

                              ${contentAction}
                              <div class="clearfix"></div>
                              <hr class="mt-1">
                              <textarea class="form-control text-secondary" id="content-${count+1}-${ccount+1}-text"  onchange="editText($('#content-${count+1}-${ccount+1}-text').val(), ${count}, ${ccount});" >${textcontent}</textarea>
                              <script>
                                 $('#content-${count+1}-${ccount+1}-text').summernote({
                                    disableDragAndDrop: true,
                                    dialogsInBody: true,
                                    codeviewFilter: false,
                                    codeviewIframeFilter: true,
                                    tabsize: 3,
                                    height: 120,
                                    toolbar: [
                                       ['style', ['style','h1']],
                                       ['fontstyle', ['bold', 'underline', 'italic', 'strikethrough']],
                                       ['textstyle', ['superscript', 'subscript', 'color', 'clear']],
                                       ['font', ['fontname', 'fontsize','height']],
                                       ['para', ['ul', 'ol', 'paragraph']],
                                       ['inserts', ['link','table','picture','video','hr']],
                                       ['optview', ['codeview','undo','redo','help']]
                                    ]
                                 });
                              </script>
                              
                              <button onclick="editText($('#content-${count+1}-${ccount+1}-text').val(), ${count}, ${ccount})" class="btn btn-dark btn-sm my-2">Apply</button>
                              <br>
                           </div>
                           
                           `;
                        break;

                        case '_img':
                           alignment = content.children[0].align;
                           src = content.children[0].children[0].src;
                           title = content.children[0].children[0].title;
                           alt = content.children[0].children[0].alt;
                           width = content.children[0].children[0].width;
                           varr = content.children[0].style.paddingLeft.toString();
                           paddingleft = varr.substring(0,varr.length - 2);
                           varr = content.children[0].style.paddingRight.toString();
                           paddingright = varr.substring(0,varr.length - 2);
                           varr = content.children[0].style.paddingTop.toString();
                           paddingtop = varr.substring(0,varr.length - 2);
                           varr = content.children[0].style.paddingBottom.toString();
                           paddingbottom = varr.substring(0,varr.length - 2);

                           columnContents += `
                           <div class="border rounded pl-3 pr-1 my-1 w-100 text-secondary">
                              <span class="my-2 float-left">Image</span>

                              ${contentAction}
                              <div class="clearfix"></div>
                              <hr class="mt-1">
                              
                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <button data-toggle="modal" data-target="#selectImage" onclick="setImageSelector(${count}, ${ccount}, 'content-${count+1}-${ccount+1}-img-lbl')" class="btn btn-md btn-secondary">Select Image</button>
                                 </div>
                                 <span class="input-group-append form-control" id="content-${count+1}-${ccount+1}-img-lbl">No Image</span>
                              </div>

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="Width" class="input-group-text color-muted">
                                       Width
                                    </span>
                                 </div>
                                 <input type="number" id="content-${count+1}-${ccount+1}-width" class="input-group-append form-control" min="80" max="800" placeholder="Width" value="${width}" onchange="editImage('width',$('#content-${count+1}-${ccount+1}-width').val(),${count},${ccount})">
                                 
                                 <span title="Alignment" class="input-group-append input-group-text rounded-0 bg-muted">
                                    Alignment
                                 </span>
                                 <select id="content-${count+1}-${ccount+1}-align" class="input-group-append form-control" value="${alignment}" onchange="editImage('align',$('#content-${count+1}-${ccount+1}-align').val(),${count},${ccount})" placeholder="Alignment">
                                    <option value="center">Center</option>
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                 </select>
                              </div>

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="ALT" class="input-group-text color-muted">
                                       ALT
                                    </span>
                                 </div>
                                 <input type="text" id="content-${count+1}-${ccount+1}-alt" class="input-group-append form-control" placeholder="ALT" value="${alt}" onchange="editImage('alt',$('#content-${count+1}-${ccount+1}-alt').val(),${count}, ${ccount})">
                                 <span title="Title" class="input-group-append input-group-text rounded-0 bg-muted">
                                    Title
                                 </span>
                                 <input type="text" id="content-${count+1}-${ccount+1}-title" class="input-group-append form-control" placeholder="Title" value="${title}" onchange="editImage('title',$('#content-${count+1}-${ccount+1}-title').val(),${count}, ${ccount})">
                              </div>

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="Padding Left" class="input-group-text bg-muted">
                                       PL
                                    </span>
                                 </div>
                                 <input type="number" id="content-${count+1}-${ccount+1}-padding-left" class="input-group-append form-control" placeholder="Width" value="${paddingleft}" onchange="editImage('pl',$('#content-${count+1}-${ccount+1}-padding-left').val(),${count},${ccount})">
                                 <span title="Padding Right" class="input-group-append input-group-text rounded-0 bg-muted">
                                    PR
                                 </span>
                                 <input type="number" id="content-${count+1}-${ccount+1}-padding-right" class="input-group-append form-control" placeholder="Width" value="${paddingright}" onchange="editImage('pr',$('#content-${count+1}-${ccount+1}-padding-right').val(),${count},${ccount})">
                                 <span title="Padding Top" class="input-group-append input-group-text rounded-0 bg-muted">
                                    PT
                                 </span>
                                 <input type="number" id="content-${count+1}-${ccount+1}-padding-top" class="input-group-append form-control" placeholder="Width" value="${paddingtop}" onchange="editImage('pt',$('#content-${count+1}-${ccount+1}-padding-top').val(),${count},${ccount})">
                                 <span title="Padding Bottom" class="input-group-append input-group-text rounded-0 bg-muted">
                                    PB
                                 </span>
                                 <input type="number" id="content-${count+1}-${ccount+1}-padding-bottom" class="input-group-append form-control" placeholder="Width" value="${paddingbottom}" onchange="editImage('pb',$('#content-${count+1}-${ccount+1}-padding-bottom').val(),${count},${ccount})">
                              </div>

                           </div>
                           `;
                        break;

                        case '_imglink':
                           alignment = content.children[0].align;
                           src = content.children[0].children[0].children[0].src;
                           title = content.children[0].children[0].children[0].title;
                           alt = content.children[0].children[0].children[0].alt;
                           width = content.children[0].children[0].width;
                           varr = content.children[0].style.paddingLeft.toString();
                           paddingleft = varr.substring(0,varr.length - 2);
                           varr = content.children[0].style.paddingRight.toString();
                           paddingright = varr.substring(0,varr.length - 2);
                           varr = content.children[0].style.paddingTop.toString();
                           paddingtop = varr.substring(0,varr.length - 2);
                           varr = content.children[0].style.paddingBottom.toString();
                           paddingbottom = varr.substring(0,varr.length - 2);
                           href = content.children[0].children[0].href;

                           columnContents += `
                           <div class="border rounded pl-3 pr-1 my-1 w-100 text-secondary">
                              <span class="my-2 float-left">Image</span>

                              ${contentAction}
                              <div class="clearfix"></div>
                              <hr class="mt-1">
                              
                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <button data-toggle="modal" data-target="#selectImage" onclick="setImageSelector(${count}, ${ccount}, 'content-${count+1}-${ccount+1}-img-lbl')" class="btn btn-md btn-secondary">Select Image</button>
                                 </div>
                                 <span class="input-group-append form-control" id="content-${count+1}-${ccount+1}-img-lbl">${title}</span>
                              </div>

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="Link" class="input-group-text color-muted">
                                       Link
                                    </span>
                                 </div>
                                 <input type="text" id="content-${count+1}-${ccount+1}-link" class="input-group-append form-control" placeholder="Link" value="${href}" onchange="editImageLink('link',$('#content-${count+1}-${ccount+1}-link').val(),${count}, ${ccount})">
                              </div>

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="Width" class="input-group-text color-muted">
                                       Width
                                    </span>
                                 </div>
                                 <input type="number" id="content-${count+1}-${ccount+1}-width" class="input-group-append form-control" min="80" max="800" placeholder="Width" value="${width}" onchange="editImage('width',$('#content-${count+1}-${ccount+1}-width').val(),${count},${ccount})">
                                 
                                 <span title="Alignment" class="input-group-append input-group-text rounded-0 bg-muted">
                                    Alignment
                                 </span>
                                 <select id="content-${count+1}-${ccount+1}-align" class="input-group-append form-control" value="${alignment}" onchange="editImage('align',$('#content-${count+1}-${ccount+1}-align').val(),${count},${ccount})" placeholder="Alignment">
                                    <option value="center">Center</option>
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                 </select>
                              </div>

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="ALT" class="input-group-text color-muted">
                                       ALT
                                    </span>
                                 </div>
                                 <input type="text" id="content-${count+1}-${ccount+1}-alt" class="input-group-append form-control" placeholder="ALT" value="${alt}" onchange="editImage('alt',$('#content-${count+1}-${ccount+1}-alt').val(),${count}, ${ccount})">
                                 <span title="Title" class="input-group-append input-group-text rounded-0 bg-muted">
                                    Title
                                 </span>
                                 <input type="text" id="content-${count+1}-${ccount+1}-title" class="input-group-append form-control" placeholder="Title" value="${title}" onchange="editImage('title',$('#content-${count+1}-${ccount+1}-title').val(),${count}, ${ccount})">
                              </div>

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="Padding Left" class="input-group-text bg-muted">
                                       PL
                                    </span>
                                 </div>
                                 <input type="number" id="content-${count+1}-${ccount+1}-padding-left" class="input-group-append form-control" placeholder="Width" value="${paddingleft}" onchange="editImage('pl',$('#content-${count+1}-${ccount+1}-padding-left').val(),${count},${ccount})">
                                 <span title="Padding Right" class="input-group-append input-group-text rounded-0 bg-muted">
                                    PR
                                 </span>
                                 <input type="number" id="content-${count+1}-${ccount+1}-padding-right" class="input-group-append form-control" placeholder="Width" value="${paddingright}" onchange="editImage('pr',$('#content-${count+1}-${ccount+1}-padding-right').val(),${count},${ccount})">
                                 <span title="Padding Top" class="input-group-append input-group-text rounded-0 bg-muted">
                                    PT
                                 </span>
                                 <input type="number" id="content-${count+1}-${ccount+1}-padding-top" class="input-group-append form-control" placeholder="Width" value="${paddingtop}" onchange="editImage('pt',$('#content-${count+1}-${ccount+1}-padding-top').val(),${count},${ccount})">
                                 <span title="Padding Bottom" class="input-group-append input-group-text rounded-0 bg-muted">
                                    PB
                                 </span>
                                 <input type="number" id="content-${count+1}-${ccount+1}-padding-bottom" class="input-group-append form-control" placeholder="Width" value="${paddingbottom}" onchange="editImage('pb',$('#content-${count+1}-${ccount+1}-padding-bottom').val(),${count},${ccount})">
                              </div>

                           </div>
                           `;
                        break;

                        case '_button':
                           // button attributes
                           alignment = content.align;
                           href = content.children[0].href;
                           color = rgbToHex(content.children[0].children[0].style.color);
                           bgcolor = rgbToHex(content.children[0].children[0].style.backgroundColor);
                           varr = content.children[0].children[0].style.paddingLeft.toString();
                           paddingleft = varr.substring(0,varr.length - 2);
                           varr = content.children[0].children[0].style.paddingRight.toString();
                           paddingright = varr.substring(0,varr.length - 2);
                           varr = content.children[0].children[0].style.paddingTop.toString();
                           paddingtop = varr.substring(0,varr.length - 2);
                           varr = content.children[0].children[0].style.paddingBottom.toString();
                           paddingbottom = varr.substring(0,varr.length - 2);
                           varr = content.children[0].children[0].style.fontSize.toString();
                           fontsize = varr.substring(0,varr.length - 2);
                           varr = content.children[0].children[0].style.borderRadius.toString();
                           borderradius = varr.substring(0,varr.length - 2);
                           fontfamily =  content.children[0].children[0].style.fontFamily;
                           btntext = content.children[0].children[0].innerText;

                           columnContents += `
                           <div class="border rounded pl-3 pr-1 my-1 w-100 text-secondary">
                              <span class="my-2 float-left">Button</span>

                              ${contentAction}
                              <div class="clearfix" ></div>
                              <hr class="mt-1">

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text bg-muted">
                                       Background Color
                                    </span>
                                 </div>
                                 <label for="content-${count+1}-${ccount+1}-bg" class="form-control cursor-pointer" id="label-content-${count+1}-${ccount+1}-bg" style="background-color:${bgcolor}"></label>
                                 <input type="color" onchange="$('#label-content-${count+1}-${ccount+1}-bg').css('background-color', $('#content-${count+1}-${ccount+1}-bg').val());editButton('bg',$('#content-${count+1}-${ccount+1}-bg').val(),${count},${ccount});" id="content-${count+1}-${ccount+1}-bg" class="d-none form-control" value="${bgcolor}">
                              </div>
                              
                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="Alignment" class="input-group-text color-muted">
                                       Text Color
                                    </span>
                                 </div>
                                 <label for="content-${count+1}-${ccount+1}-color" class="form-control cursor-pointer" id="label-content-${count+1}-${ccount+1}-color" style="background-color:${color}"></label>
                                 <input type="color" onchange="$('#label-content-${count+1}-${ccount+1}-color').css('background-color', $('#content-${count+1}-${ccount+1}-color').val());editButton('color',$('#content-${count+1}-${ccount+1}-color').val(),${count},${ccount});" id="content-${count+1}-${ccount+1}-color" class="d-none form-control" value="${color}">
                                 
                                 <span title="Alignment" class="input-group-append input-group-text rounded-0 bg-muted">
                                    Alignment
                                 </span>
                                 <select id="content-${count+1}-${ccount+1}-align" class="input-group-append form-control" value="${alignment}" onchange="editButton('align',$('#content-${count+1}-${ccount+1}-align').val(),${count},${ccount})" placeholder="Alignment">
                                    <option value="center">Center</option>
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                 </select>
                              </div>
                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="Alignment" class="input-group-text color-muted">
                                       Text
                                    </span>
                                 </div>
                                 <input type="text" id="content-${count+1}-${ccount+1}-text" class="input-group-append form-control" placeholder="Button Text" value="${btntext}" onchange="editButton('text',$('#content-${count+1}-${ccount+1}-text').val(),${count}, ${ccount})">
                              </div>
                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="Alignment" class="input-group-text color-muted">
                                       Button Link
                                    </span>
                                 </div>
                                 <input type="text" id="content-${count+1}-${ccount+1}-link" class="input-group-append form-control" placeholder="Link" value="${href}" onchange="editButton('link',$('#content-${count+1}-${ccount+1}-link').val(),${count}, ${ccount})">
                              </div>

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="Padding Left" class="input-group-text bg-muted">
                                       PL
                                    </span>
                                 </div>
                                 <input type="number" id="content-${count+1}-${ccount+1}-padding-left" class="input-group-append form-control" placeholder="Width" value="${paddingleft}" onchange="editButton('pl',$('#content-${count+1}-${ccount+1}-padding-left').val(),${count},${ccount})">
                                 <span title="Padding Right" class="input-group-append input-group-text rounded-0 bg-muted">
                                    PR
                                 </span>
                                 <input type="number" id="content-${count+1}-${ccount+1}-padding-right" class="input-group-append form-control" placeholder="Width" value="${paddingright}" onchange="editButton('pr',$('#content-${count+1}-${ccount+1}-padding-right').val(),${count},${ccount})">
                                 <span title="Padding Top" class="input-group-append input-group-text rounded-0 bg-muted">
                                    PT
                                 </span>
                                 <input type="number" id="content-${count+1}-${ccount+1}-padding-top" class="input-group-append form-control" placeholder="Width" value="${paddingtop}" onchange="editButton('pt',$('#content-${count+1}-${ccount+1}-padding-top').val(),${count},${ccount})">
                                 <span title="Padding Bottom" class="input-group-append input-group-text rounded-0 bg-muted">
                                    PB
                                 </span>
                                 <input type="number" id="content-${count+1}-${ccount+1}-padding-bottom" class="input-group-append form-control" placeholder="Width" value="${paddingbottom}" onchange="editButton('pb',$('#content-${count+1}-${ccount+1}-padding-bottom').val(),${count},${ccount})">
                              </div>

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="Font Family" class="input-group-text bg-muted">
                                       Font
                                    </span>
                                 </div>
                                 <select id="content-${count+1}-${ccount+1}-family" class="input-group-append form-control" value="${alignment}" onchange="editButton('family',$('#content-${count+1}-${ccount+1}-family').val(),${count},${ccount})" style="width: 100px;">
                                    <option style="font-family: Verdana, Geneva, Tahoma, sans-serif;" value="Verdana, Geneva, Tahoma, sans-serif;">Verdana</option>
                                    <option style="font-family: 'Courier New', Courier, monospace;" value="'Courier New', Courier, monospace;">Courier New</option>
                                    <option style="font-family: monospace;" value="monospace">Monospace</option>
                                    <option style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif" value="Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">Cambria</option>
                                    <option style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif" value="'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Lucida Sans</option>
                                    <option style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" value="Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">IMPACT</option>
                                    <option style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" value="'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Segoe UI</option>
                                    <option style="font-family: 'Times New Roman', Times, serif;" value="'Times New Roman', Times, serif;">Times New Roman</option>
                                    <option style="font-family: Arial, Helvetica, sans-serif;" value="Arial, Helvetica, sans-serif;">Arial</option>
                                    <option style="font-family: sans-serif;" value="sans-serif;">Sans Serif</option>
                                 </select>
                                 <span title="Font Size" class="input-group-append input-group-text rounded-0 bg-muted">
                                    Sz
                                 </span>
                                 <input type="number" id="content-${count+1}-${ccount+1}-font-size" class="input-group-append form-control" placeholder="Size" value="${fontsize}" onchange="editButton('size',$('#content-${count+1}-${ccount+1}-font-size').val(),${count},${ccount})">

                                 <span title="Radius" class="input-group-append input-group-text rounded-0 bg-muted">
                                    Rd
                                 </span>
                                 <input type="number" id="content-${count+1}-${ccount+1}-radius" class="input-group-append form-control" placeholder="Radius" value="${borderradius}" onchange="editButton('radius',$('#content-${count+1}-${ccount+1}-radius').val(),${count},${ccount})">
                              </div>

                           </div>
                           `;
                        break;
                     
                        case '_table':
                           columnContents += `
                           <div class="border rounded pl-3 pr-1 my-1 w-100 text-secondary">
                              <span class="my-2 float-left">Table</span>

                              ${contentAction}
                              <div class="clearfix"></div>
                           </div>
                           `;
                        break;

                        case '_spacer':
                           varr = content.style.lineHeight.toString();
                           thickness = varr.substring(0,varr.length - 2);

                           columnContents += `
                           <div class="border rounded pl-3 pr-1 my-1 w-100 text-secondary">
                              <span class="my-2 float-left">Spacer</span>

                              ${contentAction}
                              <div class="clearfix"></div>
                              <hr class="mt-1">

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text bg-muted">
                                       Thickness
                                    </span>
                                 </div>
                                 <input type="number" id="content-${count+1}-${ccount+1}-thickness" class="input-group-append form-control" placeholder="Thickness" value="${thickness}" onchange="editSpacer('thickness',$('#content-${count+1}-${ccount+1}-thickness').val(),${count},${ccount})">
                              </div>

                           </div>
                           `;
                        break;

                        case '_divider':
                           alignment = content.children[0].align;
                           bgcolor = rgbToHex(content.children[0].style.backgroundColor);
                           varr = content.children[0].style.paddingTop.toString();
                           thickness = varr.substring(0,varr.length - 2);
                           varr = content.children[0].style.width.toString();
                           width = varr.substring(0,varr.length - 1);

                           columnContents += `
                           <div class="border rounded pl-3 pr-1 my-1 w-100 text-secondary">
                              <span class="my-2 float-left">Divider</span>

                              ${contentAction}
                              <div class="clearfix"></div>
                              <hr class="mt-1">

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text bg-muted">
                                       Background Color
                                    </span>
                                 </div>
                                 <label for="content-${count+1}-${ccount+1}-bg" class="form-control cursor-pointer" id="label-content-${count+1}-${ccount+1}-bg" style="background-color:${bgcolor}"></label>
                                 <input type="color" onchange="$('#label-content-${count+1}-${ccount+1}-bg').css('background-color', $('#content-${count+1}-${ccount+1}-bg').val());editDivider('bg',$('#content-${count+1}-${ccount+1}-bg').val(),${count},${ccount});" id="content-${count+1}-${ccount+1}-bg" class="d-none form-control" value="${bgcolor}">
                              </div>

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="Thickness" class="input-group-text bg-muted">
                                       Thickness
                                    </span>
                                 </div>
                                 <input type="number" id="content-${count+1}-${ccount+1}-thickness" class="input-group-append form-control" placeholder="Thickness" value="${thickness}" onchange="editDivider('thickness',$('#content-${count+1}-${ccount+1}-thickness').val(),${count},${ccount})">

                                 <span title="Width" class="input-group-append input-group-text rounded-0 bg-muted">
                                    Width
                                 </span>
                                 <input type="number" id="content-${count+1}-${ccount+1}-width" class="input-group-append form-control" placeholder="Width" value="${width}" min="1" max="100" onchange="editDivider('width',$('#content-${count+1}-${ccount+1}-width').val(),${count},${ccount})">
                              </div>

                              <div class="input-group my-1">
                                 <div class="input-group-prepend">
                                    <span title="Alignment" class="input-group-text bg-muted">
                                       Alignment
                                    </span>
                                 </div>
                                 <select id="content-${count+1}-${ccount+1}-align" class="input-group-append form-control" value="${alignment}" onchange="editDivider('align',$('#content-${count+1}-${ccount+1}-align').val(),${count},${ccount})" placeholder="Alignment">
                                    <option value="center">Center</option>
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                 </select>
                              </div>

                           </div>
                           `;
                        break;

                        case '_add_content':
                           columnContents += `
                           <div class="border rounded pl-3 pr-1 my-1 w-100 text-secondary">
                              <span class="my-2 float-left">Add Content</span>
                              
                              <div class="float-right my-1 btn-group">
                                 <button class="btn btn-sm btn-secondary" title="Duplicate Content" onclick="duplicateContent(${count},${ccount});"><span class="fa fa-sm fa-copy"></span></button>
                                 <button class="btn btn-sm btn-secondary" title="Delete Content" onclick="deleteContent(${count},${ccount});"><span class="fa fa-sm fa-trash"></span></button>
                              </div>
                              <div class="clearfix"></div>
                              <hr class="my-0">
                              ${$("#contents").html()}
                           </div>
                           `;
                        break;

                        default:
                           columnContents += `<br><br>`;
                        break;
                     }

                     columnAction += columnContents;
                     columnContents = "";
                     ccount++;
                  }
               }

               columnAction += `
               </div>
               `;
            }

            count++;
         }
      }
      // display the content action
      $("#column-action").html(columnAction);
      
      hide();
      $("#block-actions").show();
      showColumn1();
   }

}

// Contents
{
   function duplicateContent(col,cnt) {
      let columns = selectedBlock.currentTarget.children[0].children[0].children;
      let column = columns[col];
      let block = column.children[0].children[cnt].outerHTML;
      column.children[0].children[cnt].outerHTML = block + block;
      body = $("#"+display.displayed).html();
      content.set(body);
      content.show();
   }

   function deleteContent(col,cnt) {
      let columns = selectedBlock.currentTarget.children[0].children[0].children;
      let column = columns[col];
      if (column.children[0].children.length > 1) {
         let block = column.children[0].children[cnt].outerHTML;
         column.children[0].children[cnt].outerHTML = "";
         body = $("#"+display.displayed).html();
         content.set(body);
         content.show();
      }
   }

   function addContentAbove(col,cnt) {
      let columns = selectedBlock.currentTarget.children[0].children[0].children;
      let body = `
         <div class="_add_content" align="center" style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:50px;padding-bottom:50px;padding-right:0px;padding-left:0px">
            Add Content
         </div>
      `;
      let column = columns[col];
      let block = column.children[0].children[cnt].outerHTML;
      column.children[0].children[cnt].outerHTML = body + block;
      body = $("#"+display.displayed).html();
      content.set(body);
      content.show();
   }

   function addContentBelow(col,cnt) {
      let columns = selectedBlock.currentTarget.children[0].children[0].children;
      let body = `
         <div class="_add_content" align="center" style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:50px;padding-bottom:50px;padding-right:0px;padding-left:0px">
            Add Content
         </div>
      `;
      let column = columns[col];
      let block = column.children[0].children[cnt].outerHTML;
      column.children[0].children[cnt].outerHTML = block + body;
      body = $("#"+display.displayed).html();
      content.set(body);
      content.show();
   }
}

// Columns
{
   function duplicateColumn(id) {
      // the columns must not be more than 4
      if (blockColumns.length < 4) {
         let column = blockColumns[id];
         let block = column.outerHTML;
         column.outerHTML = block + block;
         body = $("#"+display.displayed).html();
         content.set(body);
         content.show();
      }
   }

   function deleteColumn(id) {
      let column = blockColumns[id];
      let block = column.outerHTML;
      column.outerHTML = "";
      body = $("#"+display.displayed).html();
      content.set(body);
      content.show();
   }

   function showColumn1() {
      columnActionHide();
      $("#column-1-actions").show();
   }

   function showColumn2() {
      columnActionHide();
      $("#column-2-actions").show();
   }

   function showColumn3() {
      columnActionHide();
      $("#column-3-actions").show();
   }

   function showColumn4() {
      columnActionHide();
      $("#column-4-actions").show();
   }

   function columnActionHide() {
      $("#column-1-actions").hide();
      $("#column-2-actions").hide();
      $("#column-3-actions").hide();
      $("#column-4-actions").hide();
   }
}

// Rows/Blocks
//#region 
function addBlockAbove() {
   if (selectedBlock.currentTarget.className != "default _add_block _row") {
      let body = `
      <div class="_add_block _row" style="background-color:transparent">
         <div style="Margin:0 auto;min-width:320px;max-width:800px;word-wrap:break-word;word-break:break-word;">
            <div align="center" style="border-collapse:collapse;display:table;width:100%;height:10px;">
               Add Content Block
            </div>
         </div>
      </div>
      `;

      let block = selectedBlock.currentTarget.outerHTML;
      selectedBlock.currentTarget.outerHTML = body + block;
      body = $("#"+display.displayed).html();
      content.set(body);
      content.show();
   }
}

function addBlockBelow() {
   if (selectedBlock.currentTarget.className != "default _add_block _row") {
      let body = `
      <div class="_add_block _row" style="background-color:transparent">
         <div style="Margin:0 auto;min-width:320px;max-width:800px;word-wrap:break-word;word-break:break-word;">
            <div align="center" style="border-collapse:collapse;display:table;width:100%;height:10px;">
               Add Content Block
            </div>
         </div>
      </div>
      `;

      let block = selectedBlock.currentTarget.outerHTML;
      selectedBlock.currentTarget.outerHTML = block + body;
      body = $("#"+display.displayed).html();
      content.set(body);
      content.show();
   }
}

function deleteBlock() {
   if (selectedBlock.currentTarget.className != "default _add_block _row") {
      selectedBlock.currentTarget.outerHTML = "";
      body = $("#"+display.displayed).html();
      content.set(body);
      content.show();
   }
}

function duplicateBlock() {
   if (selectedBlock.currentTarget.className != "default _add_block _row") {
      let block = selectedBlock.currentTarget.outerHTML;
      selectedBlock.currentTarget.outerHTML = block + block;
      body = $("#"+display.displayed).html();
      content.set(body);
      content.show();
   }
}
//#endregion

function hide() {
   $("#block-actions").hide();
   $("#content-blocks").hide();
   $("#contents").hide();
}


// Editors
function editRow(type,value) {
   switch (type) {
      case 'bgcolor':
         selectedBlock.currentTarget.children[0].children[0].style.backgroundColor = rgbToHex(value);
         body = $("#"+display.displayed).html();
         content.set(body);
         // content.show();
      break;

      default:
      break;
   }
}

function editColumn(type, value, col) {
   let column = selectedBlock.currentTarget.children[0].children[0].children[col];

   switch (type) {
      case 'bg':
         column.children[0].style.backgroundColor = value == 'transparent' ? value : rgbToHex(value);
      break;
      case 'valign':
         column.style.verticalAlign = value;
      break;
      case 'width':
         column.style.width = value+"px";
         column.style.maxWidth = value+"px";
      break;
      case 'pl':
         column.children[0].style.paddingLeft = value+"px";
      break;
      case 'pr':
         column.children[0].style.paddingRight = value+"px";
      break;
      case 'pt':
         column.children[0].style.paddingTop = value+"px";
      break;
      case 'pb':
         column.children[0].style.paddingBottom = value+"px";
      break;
      case 'brw':
         column.children[0].style.borderRightWidth = value+"px";
      break;
      case 'brc':
         column.children[0].style.borderRightColor = value == 'transparent' ? value : rgbToHex(value);
      break;
      case 'blw':
         column.children[0].style.borderLeftWidth = value+"px";
      break;
      case 'blc':
         column.children[0].style.borderLeftColor = value == 'transparent' ? value : rgbToHex(value);
      break;
      case 'btw':
         column.children[0].style.borderTopWidth = value+"px";
      break;
      case 'btc':
         column.children[0].style.borderTopColor = value == 'transparent' ? value : rgbToHex(value);
      break;
      case 'bbw':
         column.children[0].style.borderBottomWidth = value+"px";
      break;
      case 'bbc':
         column.children[0].style.borderBottomColor = value == 'transparent' ? value : rgbToHex(value);
      break;
      default:
      break;
   }
   body = $("#"+display.displayed).html();
   content.set(body);
   // content.show();
}

function editText(value, col, cnt) {
   let column = selectedBlock.currentTarget.children[0].children[0].children[col];
   let text = column.children[0].children[cnt];

   text.innerHTML = value;
   body = $("#"+display.displayed).html();
   content.set(body);
}

function editImage(type, value, col, cnt) {
   let column = selectedBlock.currentTarget.children[0].children[0].children[col];
   let cntt = column.children[0].children[cnt];

   switch (type) {
      case 'align':
         // alert(value)
         cntt.children[0].align = value;
         // cntt.children[0].style.textAlign = value;
      break;
      case 'pl':
         cntt.children[0].style.paddingLeft = value + 'px';
      break;
      case 'pr':
         cntt.children[0].style.paddingRight = value + 'px';
      break;
      case 'pt':
         cntt.children[0].style.paddingTop = value + 'px';
      break;
      case 'pb':
         cntt.children[0].style.paddingBottom = value + 'px';
      break;
      case 'width':
         cntt.children[0].children[0].width = value;
         cntt.children[0].children[0].style.maxWidth = value + 'px';
      break;
      case 'alt':
         cntt.children[0].children[0].alt = value;
      break;
      case 'title':
         cntt.children[0].children[0].title = value;
      break;
   
      default:
      break;
   }

   body = $("#"+display.displayed).html();
   content.set(body);
}

function editImageLink(type, value, col, cnt) {
   let column = selectedBlock.currentTarget.children[0].children[0].children[col];
   let cntt = column.children[0].children[cnt];

   switch (type) {
      case 'align':
         cntt.children[0].align = value;
      break;
      case 'link':
         cntt.children[0].children[0].href = value;
      break;
      case 'pl':
         cntt.children[0].style.paddingLeft = value + 'px';
      break;
      case 'pr':
         cntt.children[0].style.paddingRight = value + 'px';
      break;
      case 'pt':
         cntt.children[0].style.paddingTop = value + 'px';
      break;
      case 'pb':
         cntt.children[0].style.paddingBottom = value + 'px';
      break;
      case 'width':
         cntt.children[0].children[0].children[0].width = value;
         cntt.children[0].children[0].children[0].style.maxWidth = value + 'px';
      break;
      case 'alt':
         cntt.children[0].children[0].children[0].alt = value;
      break;
      case 'title':
         cntt.children[0].children[0].children[0].title = value;
      break;
   
      default:
      break;
   }

   body = $("#"+display.displayed).html();
   content.set(body);
}

function chooseImage(name, uri) {
   // set label
   $("#"+imgToLabel).html(name);
   // set src & uri of image
   var src = (location.host == 'localhost') ? location.origin+'/bulkmailings/'+uri : location.origin+'/'+uri ;

   let column = selectedBlock.currentTarget.children[0].children[0].children[imageToCol];
   let cntt = column.children[0].children[imgToCnt];

   // alert(src)

   if (cntt.className == '_img') {
      cntt.children[0].children[0].src = src;
   } else if (cntt.className == '_imglink') {
      cntt.children[0].children[0].children[0].src = src;
   }
   
   body = $("#"+display.displayed).html();
   content.set(body);
}

let imageToCol, imgToCnt = imgToLabel = null;
function setImageSelector(col, cnt, label) {
   imageToCol = col;
   imgToCnt = cnt;
   imgToLabel = label;
}

function editTable(type, value, col, cnt) {
   let column = selectedBlock.currentTarget.children[0].children[0].children[col];
   let cntt = column.children[0].children[cnt];
}


function editButton(type, value, col, cnt) {
   let column = selectedBlock.currentTarget.children[0].children[0].children[col];
   let cntt = column.children[0].children[cnt];

   switch (type) {
      case 'bg':
         cntt.children[0].children[0].style.backgroundColor = rgbToHex(value);
      break;
      case 'color':
         cntt.children[0].children[0].style.color = rgbToHex(value);
      break;
      case 'link':
         cntt.children[0].href = value;
      break;
      case 'text':
         cntt.children[0].children[0].innerText = value;
      break;
      case 'align':
         cntt.align = value;
         cntt.style.textAlign = value;
      break;
      case 'pl':
         cntt.children[0].children[0].style.paddingLeft = value + 'px';
      break;
      case 'pr':
         cntt.children[0].children[0].style.paddingRight = value + 'px';
      break;
      case 'pt':
         cntt.children[0].children[0].style.paddingTop = value + 'px';
      break;
      case 'pb':
         cntt.children[0].children[0].style.paddingBottom = value + 'px';
      break;
      case 'family':
         cntt.children[0].children[0].style.fontFamily = value;
      break;
      case 'size':
         alert(value)
         cntt.children[0].children[0].style.fontSize = value+'px';
      break;
      case 'radius':
         cntt.children[0].children[0].style.borderRadius = value+'px';
      break;
   
      default:
      break;
   }

   body = $("#"+display.displayed).html();
   content.set(body);
}

function editDivider(type, value, col, cnt) {
   let column = selectedBlock.currentTarget.children[0].children[0].children[col];
   let cntt = column.children[0].children[cnt];

   switch (type) {
      case 'bg':
         cntt.children[0].style.backgroundColor = rgbToHex(value);
      break;
      case 'align':
         cntt.children[0].align = value;
         cntt.children[0].style.textAlign = value;
      break;
      case 'thickness':
         cntt.children[0].style.paddingTop = value + 'px';
      break;
      case 'width':
         cntt.children[0].style.width = value + '%';
      break;
   
      default:
      break;
   }

   body = $("#"+display.displayed).html();
   content.set(body);
}

function editSpacer (type, value, col, cnt) {
   let column = selectedBlock.currentTarget.children[0].children[0].children[col];
   let cntt = column.children[0].children[cnt];

   switch (type) {
      case 'thickness':
         cntt.style.lineHeight = value + 'px';
      break;
   
      default:
      break;
   }

   body = $("#"+display.displayed).html();
   content.set(body);
}

function rgbToHex(rgb) {
   rgb = rgb.toString();
   if (rgb.charAt(0) == 'r') {
      let value = rgb.replace("rgb(", "").replace(")","").replace(/ */gm, "");
      rgb = value.split(',');
      let r = rgb[0], g = rgb[1], b = rgb[2];
      let hex = "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
      return hex;
   } else if (rgb == "transparent") {
      return "#ffffff";
   } else {
      return rgb;
   }
}

function componentToHex(c) {
   var hex = Number(c).toString(16);
   return hex.length < 2 ? "0" + hex : hex ;
}

// States
{
   function undo() {
      content.previous();
   }

   function redo() {
      content.next();
   }
}
// States

// Display
{
   function pc() {
      content.show();
      display.pc();
   }

   function mobile() {
      content.show();
      display.mobile();
   }
}
// Display

// Create Campaign
{
   campaignId = null;
   created = false;
   createstate = "null";
   function create() {
      let campaign_name = $("#campaign-name").val();
      // do validation
      campaign_name = campaign_name.toString().trim();
      if (campaign_name !== "" && campaign_name.length > 0 && campaign_name.length <= 20) {
         
         $("#campaign-name-display").html(" - " + campaign_name);
         designer.create();
         
         // post data to database and retrieve id
         $.post('scripts/add_to_draft.php', 
         {
            templateType: 'EMAIL',
            description: campaign_name,
            body: content.content
         }, function(data, status) {
            if (status == 'success') {
               resp = JSON.parse(data);
               if (resp.flag == true) {
                  campaignId = resp.id;

                  created = true;
                  document.getElementById("close-start-campaign").click();
                  alert(`creating campaign ${campaign_name}...`);
               } else {
                  created = false;
                  alert(`Campaign could not be created! Please try again`);
               }
            }
         });
      }
   }

   function closing() {
      if (createstate != "typing" && created == false) {
         setTimeout(() => {
            document.getElementById("start-button").click();
         }, 400);
      }
      createstate = "null";
   }

   function typing() {
      createstate = "typing";
   }

   function template(type) {
      designer.template = type;
      $("#template").html(type);
   }
}
// Create Campaign

function save() {
   if (campaignId != null && campaignId > 0) {
      $.post('scripts/update_draft.php', 
      {
         id: campaignId,
         body: content.content
      }, function(data, status) {
         if (status == 'success') {
            // alert(data);
            resp = JSON.parse(data);
            if (resp.flag == true) {
               created = true;
               alert(`creating campaign ${campaign_name}...`);
            } else {
               created = false;
               alert(`Campaign could not be created! Please try again`);
            }
         }
      });
   } else {
      alert('not updating...')
   }
}