
<!-- This is shown on mobile -->
<aside class="w-100 bg-white">
   <nav class="collapse navbar-collapse" id="navMenu">
               
      <div class="my-4">
         <ul class="nav flex-column">

            <li class="nav-item d-flex justify-content-between align-items-center my-2">
               <?php 
               if ($nav == "DASHBOARD") {
                  echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="dashboard.php">';
               } else {
                  echo '<a class="nav-link text-dark" href="dashboard.php">';
               }
               ?>
                  <span class="badge">
                     <span class="fa fa-2x fa-th"></span>
                  </span>
                  <span class="text-lg mt-2 ml-2">
                     Dashboard
                  </span>
               </a>
            </li>

            <li class="nav-item d-flex justify-content-between align-items-center my-2">
               <?php 
               if ($nav == "CAMPAIGN") {
                  echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="campaign.php">';
               } else {
                  echo '<a class="nav-link text-dark" href="campaign.php">';
               }
               ?>
                  <span class="badge">
                     <span class="fa fa-2x fa-envelope-o"></span>
                  </span>
                  <span class="text-lg mt-2 ml-2">
                     Campaign
                  </span>
               </a>
            </li>

            <li class="nav-item d-flex justify-content-between align-items-center my-2">
               <?php 
               if ($nav == "DRAFTS") {
                  echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="drafts.php">';
               } else {
                  echo '<a class="nav-link text-dark" href="drafts.php">';
               }
               ?>
                  <span class="badge">
                     <span class="fa fa-2x fa-archive"></span>
                  </span>
                  <span class="text-lg mt-2 ml-1">
                     Drafts
                  </span>
               </a>
            </li>

            <li class="nav-item d-flex justify-content-between align-items-center my-2">
               <?php
               if ($nav == "AUDIENCE") {
                  echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="audience.php">';
               } else {
                  echo '<a class="nav-link text-dark" href="audience.php">';
               }
               ?>
                  <span class="badge">
                     <span class="fa fa-2x fa-group ml-1 "></span>
                  </span>
                  <span class="text-lg mt-2 ml-3">
                     Audience
                  </span>
               </a>
            </li>

            <li class="nav-item d-flex justify-content-between align-items-center my-2">
               <?php
               if ($nav == "IMAGES") {
                  echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="images.php">';
               } else {
                  echo '<a class="nav-link text-dark" href="images.php">';
               }
               ?>
                  <span class="badge">
                     <span class="fa fa-2x fa-group ml-1 "></span>
                  </span>
                  <span class="text-lg mt-2 ml-3">
                     Images
                  </span>
               </a>
            </li>

            <li class="nav-item d-flex justify-content-between align-items-center my-2">
               <?php 
               if ($nav == "STATISTICS") {
                  echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="statistics.php">';
               } else {
                  echo '<a class="nav-link text-dark" href="statistics.php">';
               }
               ?>
                  <span class="badge">
                     <span class="fa fa-2x fa-bar-chart-o"></span>
                  </span>
                  <span class="text-lg mt-2 ml-2">
                     Statistics
                  </span>
               </a>
            </li>

            <!-- <li class="nav-item d-flex justify-content-between align-items-center my-2">
               < ?php 
               // if ($nav == "TEMPLATES") {
               //    echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="templates.php">';
               // } else {
               //    echo '<a class="nav-link text-dark" href="templates.php">';
               // }
               ? >
                  <span class="badge">
                     <span class="fa fa-2x fa-folder"></span>
                  </span>
                  <span class="text-lg mt-2 ml-2">
                     Templates
                  </span>
               </a>
            </li> -->

            <li class="nav-item d-flex justify-content-between align-items-center my-2">
               <?php 
               if ($nav == "SETTINGS") {
                  echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="settings.php">';
               } else {
                  echo '<a class="nav-link text-dark" href="settings.php">';
               }
               ?>
                  <span class="badge">
                     <span class="fa fa-2x fa-cogs"></span>
                  </span>
                  <span class="text-lg mt-2 ml-1">
                     Settings
                  </span>
               </a>
            </li>

            <li class="nav-item d-flex justify-content-between align-items-center my-2">
               <?php 
               if ($nav == "USERS") {
                  echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="users.php">';
               } else {
                  echo '<a class="nav-link text-dark" href="users.php">';
               }
               ?>
                  <span class="badge">
                     <span class="fa fa-2x fa-users"></span>
                  </span>
                  <span class="text-lg mt-2 ml-1">
                     Users
                  </span>
               </a>
            </li>

            <!-- <li class="nav-item d-flex justify-content-between align-items-center my-2">
               <?php 
               // if ($nav == "AUTHORIZATION") {
               //    echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="abc.php">';
               // } else {
               //    echo '<a class="nav-link text-dark" href="abc.php">';
               // }
               ?>
                  <span class="badge">
                     <span class="fa fa-2x fa-user-secret"></span>
                  </span>
                  <span class="text-lg mt-2 ml-1">
                     Authorizations
                  </span>
               </a>
            </li> -->

         </ul>
      </div>

   </nav>
</aside>

<!-- This is shown on large screens -->
<aside class="col-lg-2 bg-white border-right border-white">
   <nav class="collapse navbar-collapse d-lg-block">
            
   <div class="">
      <ul class="nav flex-column">

         <li class="nav-item d-flex justify-content-between align-items-center my-2">
            <?php 
            if ($nav == "DASHBOARD") {
               echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="dashboard.php">';
            } else {
               echo '<a class="nav-link text-dark" href="dashboard.php">';
            }
            ?>
               <span class="badge">
                  <span class="tex t-dark fa fa-2x fa-th"></span>
               </span>
               <span class="text-lg mt-2 te xt-dark ml-2">
                  Dashboard
               </span>
            </a>
         </li>

         
         <li class="nav-item d-flex justify-content-between align-items-center my-2">
            <?php 
            if ($nav == "CAMPAIGN") {
               echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="campaign.php">';
            } else {
               echo '<a class="nav-link text-dark" href="campaign.php">';
            }
            ?>
               <span class="badge">
                  <span class="fa fa-2x fa-envelope-o ml-1"></span>
               </span>
               <span class="text-lg mt-2 ml-2">
                  Campaign
               </span>
            </a>
         </li>

         <li class="nav-item d-flex justify-content-between align-items-center my-2">
            <?php 
            if ($nav == "DRAFTS") {
               echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="drafts.php">';
            } else {
               echo '<a class="nav-link text-dark" href="drafts.php">';
            }
            ?>
               <span class="badge">
                  <span class="fa fa-2x fa-archive"></span>
               </span>
               <span class="text-lg mt-2 ml-1">
                  Drafts
               </span>
            </a>
         </li>

         <li class="nav-item d-flex justify-content-between align-items-center my-2">
            <?php 
            if ($nav == "AUDIENCE") {
               echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="audience.php">';
            } else {
               echo '<a class="nav-link text-dark" href="audience.php">';
            }
            ?>
               <span class="badge">
                  <span class="fa fa-2x fa-group ml-1 "></span>
               </span>
               <span class="text-lg mt-2 ml-2">
                  Audience
               </span>
            </a>
         </li>

         <li class="nav-item d-flex justify-content-between align-items-center my-2">
            <?php 
            if ($nav == "IMAGES") {
               echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="images.php">';
            } else {
               echo '<a class="nav-link text-dark" href="images.php">';
            }
            ?>
               <span class="badge">
                  <span class="fa fa-2x fa-image ml-1 "></span>
               </span>
               <span class="text-lg mt-2 ml-2">
                  Images
               </span>
            </a>
         </li>

         <li class="nav-item d-flex justify-content-between align-items-center my-2">
            <?php 
            if ($nav == "STATISTICS") {
               echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="statistics.php">';
            } else {
               echo '<a class="nav-link text-dark" href="statistics.php">';
            }
            ?>
               <span class="badge">
                  <span class="fa fa-2x fa-bar-chart-o"></span>
               </span>
               <span class="text-lg mt-2 ml-2">
                  Statistics
               </span>
            </a>
         </li>

         <!-- <li class="nav-item d-flex justify-content-between align-items-center my-2">
            < ?php 
            // if ($nav == "TEMPLATES") {
            //    echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="templates.php">';
            // } else {
            //    echo '<a class="nav-link text-dark" href="templates.php">';
            // }
            ?>
               <span class="badge">
                  <span class="fa fa-2x fa-folder"></span>
               </span>
               <span class="text-lg mt-2 ml-2">
                  Templates
               </span>
            </a>
         </li> -->

         <li class="nav-item d-flex justify-content-between align-items-center my-2">
            <?php 
            if ($nav == "SETTINGS") {
               echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="settings.php">';
            } else {
               echo '<a class="nav-link text-dark" href="settings.php">';
            }
            ?>
               <span class="badge">
                  <span class="fa fa-2x fa-cogs"></span>
               </span>
               <span class="text-lg mt-2 ml-1">
                  Settings
               </span>
            </a>
         </li>

         <li class="nav-item d-flex justify-content-between align-items-center my-2">
            <?php 
            if ($nav == "USERS") {
               echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="users.php">';
            } else {
               echo '<a class="nav-link text-dark" href="users.php">';
            }
            ?>
               <span class="badge">
                  <span class="fa fa-2x fa-users"></span>
               </span>
               <span class="text-lg mt-2 ml-1">
                  Users
               </span>
            </a>
         </li>

         <!-- <li class="nav-item d-flex justify-content-between align-items-center my-2">
            <?php 
            // if ($nav == "AUTHORIZATIONS") {
            //    echo '<a class="nav-link text-light obejor-bg-dark w-100 rounded-right" href="abc.php">';
            // } else {
            //    echo '<a class="nav-link text-dark" href="abc.php">';
            // }
            ?>
               <span class="badge">
                  <span class="fa fa-2x fa-user-secret"></span>
               </span>
               <span class="text-lg mt-2 ml-1">
                  Authorizations
               </span>
            </a>
         </li> -->

      </ul>
   </div>

   </nav>
</aside>