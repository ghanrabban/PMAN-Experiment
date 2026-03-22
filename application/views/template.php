
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="<?= base_url("assets") ?>/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="<?= base_url("assets") ?>/vendors/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="<?= base_url("assets") ?>/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">
        <link rel="stylesheet" href="<?= base_url("assets") ?>/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css">

        <!-- App styles -->
        <link rel="stylesheet" href="<?= base_url("assets") ?>/css/app.css">
        <script src="<?= base_url("assets") ?>/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?= base_url("assets") ?>/vendors/bower_components/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?= base_url("assets") ?>/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?= base_url("assets") ?>/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="<?= base_url("assets") ?>/vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>

        <style type="text/css">
            main.hide-sidebar aside.sidebar {
                display: none;
            }

            main.hide-sidebar section.content {
                padding-left: 0 !important;
                transition: padding .5s;
            }

            main.main section.content {
                transition: padding .5s;
            }

            .opc0{
                opacity: 0;
                width: 0;
                float: left;
            }
        </style>

        <title>Performance Business Review (PBR)</title>

    </head> 

    <body data-ma-theme="blue">
        <main class="main">
            

            <header class="header">
                <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
                    <div class="navigation-trigger__inner">
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                    </div>
                </div>

                <button class="btn btn-link hidden-md-down px-4" id="toggle-sidebar" style="margin-left: -25px !important;">
                    <i class="navigation-trigger__line"></i>
                    <i class="navigation-trigger__line"></i>
                    <i class="navigation-trigger__line"></i>
                </button>

                <div class="header__logo hidden-sm-down">
                    <h1><a href="<?= base_url('') ?>"><img src="<?= base_url('assets/ap2_favicon.PNG') ?>" height="50px"/></a></h1>
                </div>

                <ul class="top-nav">
                    <li class="hidden-xl-up"><a href="" data-ma-action="search-open"><i class="zmdi zmdi-search"></i></a></li>

                    <?php
                    if (session("username") != "") {
                        ?>
                        <li >
                            <a href="<?= site_url("login/logout") ?>" ><i class="zmdi zmdi-power"></i> Logout</a>
                        </li>

                        <?php
                    }
                    ?>

                </ul>
            </header>

            <aside class="sidebar">
                <div class="scrollbar-inner">
                    <?php
                    if (session("username") != "") {
                        ?>

                        <div class="user" style="border-radius:10px;overflow-wrap: break-word;">
                            <div class="user__info" data-toggle="dropdown">
                                <?= !empty(session("photo2")) ? session("photo2") : "<img src='".base_url('assets/user_default.png')."' style='width:50px;'/>";  ?>
                                <div style="">
                                    <h5 class="user__name">&nbsp;<?= session("nama") ?></h5>
                                    <div class="user__email" style="font-size:10px">&nbsp;<?= session("email") ?></div>
                                </div>
                            </div>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="">View Profile</a>
                                <a class="dropdown-item" href="">Settings</a>
                                <a class="dropdown-item" href="<?= site_url("login/logout") ?>">Logout</a>
                            </div>
                        </div>

                        <?php
                    } else {
                        ?>




                        <button id="login" data-toggle="modal" data-target="#modal-small" type="button" class="btn btn-warning btn-lg " style="width:100%">Login</button>
                        <hr/>
                        <?php
                    }
                    ?>
                    <div class="form-group">

                        <style>
                            #kont  .select2-container--default .select2-selection--single .select2-selection__rendered {

                                line-height: 10px !important;
                            }
                        </style>

                     <!--   <div id="kont">
                            <SELECT name="unit_id" class="select2 select4" >
                                echo "<option value=''>SEMUA UNIT</option>";
                                <?php
                              #  $q = $this->db->query("SELECT * FROM UNIT");



                               # foreach ($q->result() as $key) {
                               #     $selected = cookies("unit") == $key->UNIT_ID ? "selected" : "";
                               #     echo "<option value='$key->UNIT_ID' $selected>$key->UNIT</option>";
                              #  }
                                ?>
                            </SELECT>

                        </div> -->

                    </div>

                    <ul class="navigation">
                    <li class="<?= isset($position) && $position == "HOME" ? "navigation__active" : "" ?>"><a href="<?= base_url() ?>"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <?php foreach(session('menu') as $value) : ?>
                            <?php if($value->VIEW == "Y"): ?>
                            <li class="<?= isset($position) && $position == $value->POSITION ? "navigation__active" : "" ?>"><a href="<?= site_url($value->URL) ?>"><i class="zmdi zmdi-apps"></i> <?= $value->MENU_LV1 ?></a></li>
                            <?php endif ?>
                        <?php endforeach; ?>
                        
                    </ul>


                </div>
            </aside>



            <section class="content">

                <?php
                if (isset($content)) {
                    $this->load->view($content);
                }
                ?>

                <footer class="footer hidden-xs-down">
                    <p>© PT Indonesia Power. All rights reserved.</p>
                </footer>
            </section>
        </main>

        


        <?php
        if (isset($plugin)) {
            foreach ($plugin as $pl) {
                if (isset($data_plugin)) {
                    $this->load->view($pl, $data_plugin);
                } else {
                    $this->load->view($pl);
                }
            }
        }
        ?>





        <!-- App functions and actions -->
        <script src="<?= base_url("assets") ?>/js/app.min.js"></script>
        <script>
            (function() {
                if (sessionStorage.getItem('hide_sidebar') == 'true') {
                    toggleSidebar();
                }

                $('#toggle-sidebar').on('click', function(e){
                    sessionStorage.setItem('hide_sidebar', sessionStorage.getItem('hide_sidebar') == 'true' ? false : true);
                    toggleSidebar();
                });
            })();

            function toggleSidebar(argument) {
                $('main.main').toggleClass('hide-sidebar');
            }
        </script>
    </body>
</html>