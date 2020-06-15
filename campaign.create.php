<?php

include_once 'scripts/auth.php';

include 'scripts/dbmodel.php';
$model = new DBModel();
// session_start();
$_SESSION['USER.ACTIVITY'][] = "create campaign - " . date("d/m/Y h:i a");
include 'scripts/log.php';

$get = $model->getImages();

if ($get['flag'] == true) {
   $images = $get['data'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Create Email Campaign | BulkMailing</title>

   <link rel="shortcut icon" href="assets/imgs/favicon.png" type="image/x-icon"><!-- Jquery -->
	<script src="assets/js/jquery.min.js"></script>
	<!-- Popper -->
	<script src="assets/js/popper.min.js"></script>
	<!-- Bootstrap -->
	<script src="assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<!-- Font Awesome -->
   <link rel="stylesheet" href="assets/css/fontawesome.css">
   
   <!-- Custom -->
   <link rel="stylesheet" href="assets/css/create.css">
   <script src="assets/js/create.js"></script>

   <script src="assets/js/main.js"></script>
	<link rel="stylesheet" href="assets/css/main.css">

   <!-- Summernote -->
   <link href="assets/css/summernote.min.css" rel="stylesheet">
   <script src="assets/js/summernote.min.js"></script>
   <script src="assets/js/summernote-image-attribute.js"></script>
</head>
<body class="bg-white">
   
   <nav class="navbar navbar-expand-md navbar-dark obejor-bg-dark sticky-top overflow-hidden" style="height: 60px;">
	   <a class="navbar-brand active ml-5 h1 mt-1" href="index.php">
      <img src="assets/imgs/favicon.png" alt="Obejor Logo" width="30">
         Obejor Bulk Mailing & SMS <span id="campaign-name-display"></span>
      </a>

      <button class="navbar-toggler text-dark" type="button" data-toggle="collapse" data-target="#navMenu"
         aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>

      <ul class="navbar-nav mr-auto"></ul>
      
      <div class="text-center mx-auto mx-lg-1">
         <a href="profile.php" class="nav-brand text-white">
            <span class="fa fa-user-o fa-1x"></span>
            Profile
         </a>
         <span class="mx-2 text-white">|</span>
         <a href="logout.php" class="nav-brand text-white">
            Logout
            <span class="fa fa-sign-out fa-1x"></span>
         </a>
      </div>
   </nav>

   <main class="row no-gutters">
      
      <!-- Mail Body -->
      <section class="position-fixed col-lg-8 bg-muted border-right border-secondary bg-secondary cursor-pointer" style="width: 70%; height: 90%;">
         
         <!-- Mobile -->
         <div id="body-mobile" class="mb-5 position-fixed scrollable bg-white" style="width: 328px;max-width: 328px;min-width: 328px;height: 90%;margin-left: 25%;border: 4px solid rgb(82, 72, 67);border-radius: 20px;overflow: hidden;display: none;">
            
         </div>

         <!-- PC -->
         <div id="body-pc" class="mb-5 position-fixed scrollable bg-white" style="width:66.6%;height: 90%;display: block;">
            
         </div>

      </section>

      <!-- Edit Section -->
      <aside class="offset-8 position-fixed col-lg-4 bg-light h-100 p-3 pb-5 mb-5 scrollable" style="width: 40%; height: 90%;">
      
         
         <!-- <button onclick="previewTemplate();" data-toggle="modal" data-target="#previewBody" class="btn btn-md btn-outline-secondary text-dark"> <span class="fa fa-eye"></span> Preview</button>
         <button id="btnShowRow" onclick="showRow();" class="btn btn-md btn-outline-secondary text-dark">Add New Row</button> -->
         
         <div class="btn-group">
            <!-- <button onclick="previewTemplate();" data-toggle="modal" data-target="#previewBody" class="btn btn-sm btn-secondary"> <span class="fa fa-lg fa-mobile"></span></button> -->
            <button class="btn btn-sm btn-secondary" title="Display PC" onclick="pc()"><span class="fa fa-sm fa-desktop"></span></button>
            <button class="btn btn-sm px-3 btn-secondary" title="Display Mobile" onclick="mobile()"><span class="fa fa-lg fa-mobile"></span></button>
            <!--  -->
            <button class="btn btn-sm px-3 btn-secondary" title="Undo" onclick="undo()"><span class="fa fa-sm fa-undo"></span></button>
            <button class="btn btn-sm px-3 btn-secondary" title="Redo" onclick="redo()"><span class="fa fa-sm fa-repeat"></span></button>
            <button class="btn btn-sm px-3 btn-secondary" title="Save" onclick="save()"><span class="fa fa-sm fa-save"></span></button>
            <!-- <button class="btn btn-md btn-secondary" onclick="clearSelect()">Deselect</button> -->
         </div>
         <button id="start-button" class="d-none btn btn-sm btn-secondary" data-toggle="modal" data-target="#start-campaign">Start</button>
         <button class="btn btn-sm btn-secondary" onclick="showBlocks();">Content Blocks</button>
         <button class="btn btn-sm btn-secondary" onclick="showContents();">Contents</button>
         <!-- <button class="btn btn-sm btn-secondary" onclick="addContent();">Add Content</button> -->
         <hr>

         <!-- Content Blocks -->
         <div id="content-blocks">
            <div class="row my-2 no-gutters text-center">
               <div class="col-6">
                  <button class="btn btn-md border text-secondary py-5 display-3" data-type="1Block" draggable="true" ondragstart="blockDrag(event)"> <span class="fa fa-plus"></span><br>Add 1 Content Block</button>
               </div>
               <div class="col-6">
                  <button class="btn btn-md border text-secondary py-5 display-3" data-type="2Blocks" draggable="true" ondragstart="blockDrag(event)"> <span class="fa fa-plus"></span><br>Add 2 Content Blocks</button>
               </div>
            </div>
            <div class="row my-2 no-gutters text-center">
               <div class="col-6">
                  <button class="btn btn-md border text-secondary py-5 display-3" data-type="3Blocks" draggable="true" ondragstart="blockDrag(event)"> <span class="fa fa-plus"></span><br>Add 3 Content Blocks</button>
               </div>
               <div class="col-6">
                  <button class="btn btn-md border text-secondary py-5 display-3" data-type="4Blocks" draggable="true" ondragstart="blockDrag(event)"> <span class="fa fa-plus"></span><br>Add 4 Content Blocks</button>
               </div>
            </div>
         </div>

         <!-- Contents -->
         <div id="contents">
            <div class="row my-2 no-gutters text-center w-100">
               <div class="col-3 mx-auto h-auto">
                  <button class="btn btn-md border text-secondary w-100" data-type="Text" draggable="true" ondragstart="contentDrag(event)"> <span class="fa fa-plus"></span><br>Text</button>
               </div>
               <div class="col-3 mx-auto h-auto">
                  <button class="btn btn-md border text-secondary w-100" data-type="Image" draggable="true" ondragstart="contentDrag(event)"> <span class="fa fa-plus"></span><br>Image</button>
               </div>
               <div class="col-3 mx-auto h-auto">
                  <button class="btn btn-md border text-secondary w-100" data-type="Button" draggable="true" ondragstart="contentDrag(event)"> <span class="fa fa-plus"></span><br>Button</button>
               </div>
            </div>
            <div class="row my-2 no-gutters text-center w-100">
               <div class="col-3 mx-auto h-auto">
                  <button class="btn btn-md border text-secondary w-100" data-type="LinkImage" draggable="true" ondragstart="contentDrag(event)"> <span class="fa fa-plus"></span><br>Link Image</button>
               </div>
               <div class="col-3 mx-auto h-auto">
                  <button class="btn btn-md border text-secondary w-100" data-type="Divider" draggable="true" ondragstart="contentDrag(event)"> <span class="fa fa-plus"></span><br>Divider</button>
               </div>
               <div class="col-3 mx-auto h-auto">
                  <button class="btn btn-md border text-secondary w-100" data-type="Spacer" draggable="true" ondragstart="contentDrag(event)"> <span class="fa fa-plus"></span><br>Spacer</button>
               </div>
            </div>
            <div class="row my-2 no-gutters text-center w-100">
               <div class="col-11 mx-auto h-auto">
                  <button class="btn btn-md border text-secondary w-100" data-type="SocialIcons" draggable="true" ondragstart="contentDrag(event)"> <span class="fa fa-plus"></span><br>Social Media Links</button>
               </div>
            </div>
         </div>

         <!-- Editor -->
         <div id="block-actions">
            <!-- Edit Row -->
            <div>
               <p class="h5 font-weight-normal text-secondary float-left"><span class="fa fa-sm fa-edit"></span> Edit Row</p>
               <div class="float-right btn-group">
                  <button class="btn btn-sm btn-secondary" title="Duplicate Row" onclick="duplicateBlock();"><span class="fa fa-sm fa-copy"></span></button>
                  <button class="btn btn-sm btn-secondary" title="Delete Row" onclick="deleteBlock();"><span class="fa fa-sm fa-trash"></span></button>
                  <button class="btn btn-sm btn-secondary" title="Add Content Block Above" onclick="addBlockAbove();"><span class="fa fa-sm fa-arrow-up"></span></button>
                  <button class="btn btn-sm btn-secondary" title="Add Content Block Below" onclick="addBlockBelow();"><span class="fa fa-sm fa-arrow-down"></span></button>
               </div>
               <div class="clearfix"></div>
               <!-- <hr class="my-0"> -->
               <!-- $('#label-column-${count+1}-border-left').html($('#column-${count+1}-border-left-color').val()); -->

               <div class="input-group my-1">
                  <div class="input-group-prepend">
                     <span class="input-group-text bg-muted">
                        Background Color
                     </span>
                  </div>
                  <label for="block-bg" class="form-control cursor-pointer" id="label-block-bg"></label>
                  <input type="color" onchange="$('#label-block-bg').css('background-color', $('#block-bg').val());editRow('bgcolor', $('#block-bg').val());" id="block-bg" class="d-none form-control" value="#ffffff">
               </div>
            </div>
            <hr>

            <!-- Edit Contents -->
            <div>
               <div class="btn-group w-100" id="select-column-btn"></div>
               <div id="column-action"></div>
            </div>
            <br>

         </div>
         
      </aside>
   
   </main>


   <script>
      function foo() {
         var selObj = window.getSelection(); 
         alert(selObj);
         var selRange = selObj.getRangeAt(0);
         // do stuff with the range
         alert(selRange)
      }
   </script>

   

   <!-- Modals -->
   <!-- Create Campaign -->
   <div onclick="closing()" class="modal fade" id="start-campaign" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
         <div onclick="typing()" class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">
                  Enter Campaign Name
               </h4>

               <button type="button" id="close-start-campaign" class="d-none float-left close" data-dismiss="modal" data-toggle="start-campaign" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <div class="modal-body" >
               <form action="Javascript:void(0);">

                  <input type="text" name="campaign-name" id="campaign-name" placeholder="Enter Campaign Name" maxlength="20" autofocus class="my-1 form-control">

                  <div class="mt-3 mb-0 h5 font-weight-normal text-center">Select Template - <span id="template">Blank</span></div>
                  <hr>

                  <div class="row ">

                     <div class="col-4">
                        <button class="btn btn-sm w-100 border" onclick="template('Blank')">Blank</button>
                     </div>

                     <div class="col-4">
                        <button class="btn btn-sm w-100 border" onclick="template('1 : 2 : 1')">1 : 2 : 1</button>
                     </div>

                     <div class="col-4">
                        <button class="btn btn-sm w-100 border" onclick="template('1 : 3 : 1 : 3 : 3 : 1')">1 : 3 : 1 : 3 : 3 : 1</button>
                     </div>

                  </div>

                  <button type="submit" onclick="create()" class="my-3 btn btn-md btn-secondary">Submit</button>
                  
               </form>
            </div>

         </div>
      </div>
   </div>

   <!-- Select Image -->
   <div class="modal fade" id="selectImage" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="exampleModalLongTitle">
                  Select Image
               </h4>

               <button type="button" class="float-left close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <div class="modal-body row no-gutters" id="" >
               <?php
                  if (isset($images) && is_array($images)) {
                     foreach ($images as $image) {
                        $url = $image["image_url"];
                        $name = $image["image_name"];
                        $id = $image["image_id"];
                        echo '
                        <div class="col-lg-4 p-1 col-12 my-2">
                           <div class="card">
                              <img src="'.$url.'" alt="Template Image" width="100%" height="100%">
                              <hr>
                              <p class="ml-2 h6 font-weight-normal my-auto">
                                 '.$name.'
                                 <input class="btn bnt-sm btn-secondary mb-2 mr-2 float-right" type="button" value="Select" data-dismiss="modal" aria-label="Close" onclick="chooseImage(\''.$name.'\',\''.$url.'\');" />
                                 <span class="clearfix"></span>
                              </p>
                           </div>
                        </div>
                        ';
                     }
                     
                  } else {
                     echo '
                     <div class="col-lg-12 p-1 col-12 my-2">
                        <div class="alert alert-secondary w-100">
                           <span class="fa fa-info-circle"></span>
                           There are no Images.
                        </div>
                     </div>
                     ';
                  }
               ?>
            </div>

         </div>
      </div>
   </div>

</body>
</html>