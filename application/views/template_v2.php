<!DOCTYPE html>
<html lang="en">
   <head>
      <title>PMAN (Performance Maintenance Apllication )</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Performance Maintenance Apllication " />
      <meta name="keywords" content="Performance Maintenance Apllication ">
      <!-- Favicon icon -->
      <link rel="icon" href="<?=base_url()?>assets/favicon.ico" type="image/x-icon">
      <!-- Google font-->
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/plugins/bootstrap/css/bootstrap.min.css">
      <!-- waves.css -->
      <link rel="stylesheet" href="<?=base_url()?>assets_v2/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- feather icon -->
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/icon/feather/css/feather.css">
      <!-- font-awesome-n -->
       
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/plugins/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/plugins/font-awesome/css/font-awesome-n.min.css">
      <!-- Chartlist chart css -->
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/css/style.css">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_v2/css/widget.css">
      <link rel="stylesheet" href="<?=base_url()?>assets_v2/plugins/data-tables/datatables.min.css"/>
      <link rel="stylesheet" href="<?=base_url()?>assets_v2/plugins/toastr/toastr.min.css"/>
      <link rel="stylesheet" href="<?=base_url()?>assets_v2/plugins/magnific/magnific.css"/>

      <script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/jquery/js/jquery.min.js"></script>
      <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
       -->
      <script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/popper.js/js/popper.min.js"></script>
      <link rel="stylesheet" href="<?=base_url()?>assets_v2/pages/chart/radial/css/radial.css" type="text/css" media="all">
      <link href="<?=base_url()?>assets_v2/plugins/select2/css/select2.min.css" rel="stylesheet" />
      <link rel="stylesheet" href="<?=base_url()?>assets_v2/css/custome.css"/>
      <link rel="stylesheet" href="<?=base_url()?>assets_v2/plugins/toastr/cute-alert.css"/>

      <script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/toastr/cute-alert.js"></script>
      <script src="<?=base_url()?>assets_v2/plugins/select2/js/select2.full.min.js"></script>

      <script src="<?=base_url()?>assets_v2/plugins/echarts/dist/echarts-en.min.js"></script>
      <style>
         body {
          
            font-size: 14px;
           
         }
         .img-fluid {
         max-width: 60%;
         height: auto;
         }
         @media only screen and (max-width: 992px) {
            .header-navbar .navbar-wrapper .navbar-logo a img {
               display: block;
               max-width: 20%;
               margin: auto;
            }
         }
         invalid-feedback {
         color: #dc3545
         }
         
         .header-navbar .navbar-wrapper .navbar-logo[logo-theme="theme6"] {
            background: #ffffff;
         }
         .pcoded .pcoded-header[header-theme="themelight1"] .navbar-logo a {
            color: #263544;
         }
         .table-bordered {
            border: 1px solid #EBEBEB;
         }
         .table-bordered td, .table-bordered th {
            padding: 10px;
         }
         .table .thead-blue th {
            color: #fff;
            background-color: #78b5f8;
            border-color: #2c7cccf5;
            vertical-align: middle;
            text-align: center;
         }

         .btn i {
            margin-right: 0px;
         }
   .btn.btn-icon {
      border-radius: 50%;
      width: 35px;
      line-height: 25px;
      height: 35px;
      padding: 3px;
      text-align: center;
   }

    /* css upload */


.image_picker {
    height: 150px;
    width: 100%;
    border: 1px #ddd solid;
    border-radius: 0px;
    background: #f5f5f5;
    text-align: center;
    display: table;
    color: #999;
    transition: .3s;
}
.image_picker i {
    font-size: 40px;
}
.image_picker div {
    display: table-cell;
    text-align: center;
    vertical-align: middle;
}
.d-none {
    display: none!important;
}

/* @media (min-width: 768px) {
    .modal-dialog {
      max-width: 1140px;
        margin: 30px auto;
    }
}
@media (min-width: 768px) {
    .modal-dialog {
        width: 800px;
        margin: 30px auto;
    }
} */
/* end css upload */
      </style>
       <script>
         function show () {
            $("#spinner").addClass("show");
         
         }
         
         function hide () {
           $("#spinner").removeClass("show");
         }
      </script>
   </head>
   <body>
      <!-- [ Pre-loader ] start -->
      <div id="spinner" class="">
         <div class="loader is-loading">
            <div class="spin-loader"></div>
         </div>
      </div>
      <div class="loader-bg">
         <div class="loader-bar"></div>
      </div>
      <!-- [ Pre-loader ] end -->
      <div id="pcoded" class="pcoded">
         <div class="pcoded-overlay-box"></div>
         <div class="pcoded-container navbar-wrapper">
            <!-- [ Header ] start -->
            <nav class="navbar header-navbar pcoded-header">
               <div class="navbar-wrapper">
                  <div class="navbar-logo">
                     <a href="<?=base_url()?>">
                     <img class="img-fluid" src="<?=base_url()?>assets/injourney.png" alt="Theme-Logo" />
                     </a>
                     <a class="mobile-menu" id="mobile-collapse" href="#!">
                     <i class="feather icon-menu icon-toggle-right"></i>
                     </a>
                     <a class="mobile-options waves-effect waves-light">
                     <i class="feather icon-more-horizontal"></i>
                     </a>
                  </div>
                  <div class="navbar-container container-fluid">
                     <ul class="nav-left">
                        <li class="header-search">
                           <div class="main-search morphsearch-search">
                              <div class="input-group">
                                 <span class="input-group-prepend search-close">
                                 <i class="feather icon-x input-group-text"></i>
                                 </span>
                                 <input type="text" class="form-control" placeholder="Enter Keyword">
                                 <span class="input-group-append search-btn">
                                 <i class="feather icon-search input-group-text"></i>
                                 </span>
                              </div>
                           </div>
                        </li>
                        <li>
                           <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                           <i class="full-screen feather icon-maximize"></i>
                           </a>
                        </li>
                     </ul>
                     <ul class="nav-right">
                        <li class="user-profile header-notification">
                           <div class="dropdown-primary dropdown">
                              <div class="dropdown-toggle" data-toggle="dropdown">
                              <?= !empty(session("photo2")) ? session("photo2") : "<img src='".base_url('assets_v2/images/user_default.svg')."' class = 'img-radius'/>";  ?>
                       
                                 <span><?= session("nama") ?></span>
                                 <i class="feather icon-chevron-down"></i>
                              </div>
                              <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                 <?php
                                    if (session("username") != "") {?>
                                 <li>
                                    <a href="<?=base_url()?>">
                                    <i class="feather icon-user"></i> Profile
                                    </a>
                                 </li>
                                 <li>
                                    <a href="<?=base_url()?>login/logout">
                                    <i class="feather icon-log-out"></i> Logout
                                    </a>
                                 </li>
                                 <?php
                                    }
                                    ?>
                              </ul>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav>
            <div class="pcoded-main-container">
               <div class="pcoded-wrapper">
                  <!-- [ navigation menu ] start -->
                  <nav class="pcoded-navbar">
                     <div class="nav-list">
                        <div class="pcoded-inner-navbar main-menu">
                         
                           <ul class="pcoded-item pcoded-left-item">
                              <li class="">
                                 <a href="<?=base_url()?>" class="waves-effect waves-dark">
                                 <span class="pcoded-micon">
                                 <i class="feather icon-home"></i>
                                 </span>
                                 <span class="pcoded-mtext">Dashboard</span>
                                 </a>
                              </li>
                              <?php 
                              //  echo "<pre>",print_r ( fetch_menu() ),"</pre>";
                               $menu = fetch_menu() ;
                              foreach( $menu as $key => $value) : ?>
                                 <?php if(count($value['sub']) == 0): ?>
                                   
                                    <?php ?>
                                       <li class="">
                                          <a href="<?= site_url($value['url']) ?>" class="waves-effect waves-dark">
                                          <span class="pcoded-micon">
                                          <i class="<?= $value['icon'] ?>"></i>
                                          </span>
                                          <span class="pcoded-mtext"><?= $value['name'] ?></span>
                                          </a>
                                       </li>
                                    <?php ?>
                                 <?php else: ?>
                                       <li class="pcoded-hasmenu">
                                          <a href="javascript:void(0)" class="waves-effect waves-dark">
                                          <span class="pcoded-micon">
                                          <i class="<?= $value['icon'] ?>"></i>
                                          </span>
                                          <span class="pcoded-mtext"><?= $value['name'] ?></span>
                                          </a>
                                          <ul class="pcoded-submenu">
                                             <?php foreach($value['sub'] as $sb) : ?>
                                                <?php if ($sb['url'] == 'pm' && sess()['unit'] == 4):?>
                                                   <li class="">
                                                      <a href="<?= site_url('pm/PM_area') ?>" class="waves-effect waves-dark">
                                                      <span class="pcoded-mtext"><?= $sb['name']?></span>
                                                      </a>
                                                   </li>
                                                <?php elseif($sb['url'] == 'pm/PM_area' && sess()['unit'] != 4): ?>
                                                 
                                                <li class="">
                                                         <a href="<?= site_url('pm') ?>" class="waves-effect waves-dark">
                                                         <span class="pcoded-mtext">List PM</span>
                                                         </a>
                                                      </li>
                                                <?php else: ?>
                                                      
                                                      <li class="">
                                                         <a href="<?= site_url($sb['url']) ?>" class="waves-effect waves-dark">
                                                            <span class="pcoded-mtext"><?= $sb['name']?></span>
                                                         </a>
                                                      </li>
                                                
                                                   <?php endif ?>
                                             <?php endforeach; ?>
                                          </ul>
                                       </li>
                                 <?php endif ?>
                              <?php endforeach; 
                              if (sess()['unit']==5):
                              ?>

                              
                             <li class="">
                                          <a href="<?= site_url('monitoring_xray') ?>" class="waves-effect waves-dark">
                                          <span class="pcoded-micon">
                                          <i class="<?= $value['icon'] ?>"></i>
                                          </span>
                                          <span class="pcoded-mtext">Monitoring X-ray</span>
                                          </a>
                              </li>
                              <?php endif;?>
                              
                           </ul>
                        </div>
                     </div>
                  </nav>
                  <!-- [ navigation menu ] end -->
                  <div class="pcoded-content">
                  <?php
                  if (isset($content)) {
                     $this->load->view($content);
                  }
                  ?>
                     <!-- [ breadcrumb ] start -->
                    
                     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/highlight.min.js"></script> -->
                     
                     <!-- EChartJS JavaScript -->
                     <script></script>
                  </div>
                  <!-- [ style Customizer ] start -->
                  <!-- [ style Customizer ] end -->
               </div>
            </div>
         </div>
      </div>
      <!-- Required Jquery -->
      <script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/jquery/js/jquery.validate.min.js"></script>
      <script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/jquery-ui/js/jquery-ui.min.js"></script>
      <script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/bootstrap/bootstrap.min.js"></script>
      <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
      <script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/toastr/toastr.min.js"></script>
      <!-- waves js -->
      <script src="<?=base_url()?>assets_v2/pages/waves/js/waves.min.js"></script>
      <!-- jquery slimscroll js -->
      <script type="text/javascript" src="<?=base_url()?>assets_v2/plugins/jquery-slimscroll/js/jquery.slimscroll.js"></script>
      <!-- Chartlist charts -->
      <!-- amchart js -->
      <!-- Custom js -->

      <!-- <script src="<?=base_url()?>assets_v2/plugin/js/barcharts-data.js"></script> -->
      <script src="<?=base_url()?>assets_v2/js/pcoded.min.js"></script>
      <script src="<?=base_url()?>assets_v2/js/vertical/vertical-layout.min.js"></script>
      <script type="text/javascript" src="<?=base_url()?>assets_v2/js/script.min.js"></script>
      <script type="text/javascript" src="<?=base_url()?>assets_v2/js/jquery.slimscroll.js"></script>

      
      <script>
      $(document).ready(function() {
         $('[data-toggle="tooltip"]').tooltip();   
         $('.js-example-basic-single').select2({
            theme: 'bootstrap',
            dropdownCssClass: 'select2-dropdown--scroll'
         });
      });
      
      $(function(){
         $('.scroll-data').slimScroll({
            position: 'right',
            height: '350px',
            railVisible: true,
            alwaysVisible: false
         });

      $('.scroll-data2').slimScroll({
            position: 'right',
            height: '300px',
            railVisible: true,
            alwaysVisible: false
         });
      });
      function NF(i){
         if (i['code'] == "200") {
            toastr.success(i['msg']);
         }else {
            toastr.error(i['msg']);
         }
      }
      function slideToggle(e, t) {
         var a = $(e);
         a.hasClass("hide") && a.removeClass("hide", "slow"), a.length && a.slideToggle();
         var n = $(".progress-bar").not(".not-dynamic");
         0 < n.length && (n.each(function() {
            $(this).css("width", "0%"), $(this).text("0%")
         }), "function" == typeof appProgressBar && appProgressBar()), "function" == typeof t && t()
	   }
      </script>
            <div class="modal fade" id="loader" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
         <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body text-center">
                  <i style="font-size: 20px" class='fa fa-circle-o-notch fa-spin'></i> Tunggu
               </div>
            </div>
         </div>
      </div>
     
   </body>
   

</html>