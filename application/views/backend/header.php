<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title><?=isset($title) ? $title : 'Manager - Admin' ?></title>

    <!-- Bootstrap -->
    <link href="<?=CDN?>/backend/css/bootstrap.min.css?gb=<?=time()?>" rel="stylesheet">
    <link href="<?=CDN?>/backend/css/mrdam.css?gb=<?=time()?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=CDN?>/backend/css/font-awesome.css?gb=<?=time()?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=CDN?>/backend/css/nprogress.css?gb=<?=time()?>" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?=CDN?>/backend/css/daterangepicker.css?gb=<?=time()?>" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?=CDN?>/backend/css/custom.min.css?gb=<?=time()?>" rel="stylesheet">

    <!-- PNotify -->
    <link href="<?=CDN?>/backend/css/pnotify.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?=CDN?>/backend/js/jquery.min.js?gb=<?=time()?>"></script>
</head>

<?php
    if (isset($return))
    {
        ?>
            <body class="nav-md" onload="notification('<?=$return['title']?>','<?=$return['text']?>')">
        <?php
    }
    else
    {
        ?>
        <body class="nav-md">
        <?php
    }
?>
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>CMC Béo</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="<?=CDN?>/backend/images/logo.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2><?=isset($check_login['full_name'])? ($check_login['full_name']):'Nguyễn Đạm'?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>G.B 07/13/2017</h3>
                        <ul class="nav side-menu">
                            <li <?=isset($active)&& $active == 'main_admin' ?'class="active"':''?>><a href="<?=URL?>/manager.html"><i class="fa fa-home"></i> Home</a></li>
                            <li <?=isset($active)&& $active == 'settings' ?'class="active"':''?>><a href="<?=URL?>/manager/settings.html"><i class="fa fa-wrench"></i> Settings</a></li>
                            <li <?=isset($active)&& $active == 'users_admin' ?'class="active"':''?>><a><i class="fa fa-users"></i>User<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li <?=isset($active)&& $active == 'users_admin' ?'class="current-page"':''?>><a href="<?=URL?>/manager/users-admin.html">All user admin</a></li>
                                    <li><a href="<?=URL?>/manager/users-admin-trash.html">Trash user admin</a></li>
                                    <li <?=isset($active)&& $active == 'users' ?'class="current-page"':''?>><a href="<?=URL?>/manager/users.html">All user</a></li>
                                    <li><a href="<?=URL?>/manager/users-trash.html">Trash user</a></li>
                                </ul>
                            </li>
                            <li <?=isset($active)&& $active == 'slideshow' ?'class="active"':''?> ><a><i class="fa fa-desktop"></i>Slideshow <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?=URL?>/manager/slideshow.html">All slideshow</a></li>
                                    <li><a href="<?=URL?>/manager/slideshow-trash.html">Trash</a></li>
                                </ul>
                            </li>
                            <li <?=isset($active)&& $active == 'upload' ?'class="active"':''?>><a><i class="fa fa-cloud-upload" aria-hidden="true"></i>Upload  <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li <?=isset($active)&& $active == 'upload' ?'class="current-page"':''?> ><a target="_blank" href="<?=URL?>/manager/upload.html">Upload image</a></li>
                                    <li><a target="_blank" href="<?=URL?>/manager/list-files.html">All image</a></li>
                                </ul>
                            </li>
                            <li <?=isset($active)&& $active == 'category' ?'class="active"':''?>><a><i class="fa fa-th-list" aria-hidden="true"></i>Category<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li <?=isset($active)&& $active == 'category' ?'class="current-page"':''?> ><a href="<?=URL?>/manager/category.html">Category</a></li>
                                    <li <?=isset($active)&& $active == 'menu' ?'class="current-page"':''?> ><a href="<?=URL?>/manager/menu.html">Menu</a></li>
                                </ul>
                            </li>
                            <li <?=isset($active)&& $active == 'posts' ?'class="active"':''?>><a><i class="fa fa-clone"></i>Posts <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" <?=isset($active_children)&& $active_children == 'add-posts' ?'style="display: block"':''?> >
                                    <li <?=isset($active_children)&& $active_children == 'add-posts' ?'class="current-page"':''?> ><a href="<?=URL?>/manager/posts.html">All posts</a>
                                    <li><a href="<?=URL?>/manager/posts/trash.html">Trash posts </a></li>
                                </ul>
                            </li>
                            <li <?=isset($active_hone) && $active_hone == 'product' ? 'class="active"':'' ?> ><a><i class="fa fa-sitemap"></i> Product <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="<?=isset($iteam) && $iteam=='iteam'?'display: block;':''?>">
                                    <li class=""><a>Attribute product<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="<?=isset($iteam) && $iteam=='iteam'?'':''?>">
                                            <li class="sub_menu<?= isset($active) && $active == 'attribute'  ? ' current-page':'' ?>"><a href="<?=URL?>/manager/product/attribute.html">All Attribute</a></li>
                                        </ul>
                                    </li>
                                    <li class=""><a>Product<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="<?=isset($iteam) && $iteam=='product'?'display: block;':''?>">
                                            <li class="sub_menu<?= isset($active) && $active == 'product'  ? ' current-page':'' ?>"><a href="<?=URL?>/manager/product.html">All Product</a></li>
                                            <li class="sub_menu<?= isset($active) && $active == 'product'  ? ' current-page':'' ?>"><a href="<?=URL?>/manager/product/trash.html">Trash Product</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li <?=isset($active)&& $active == 'card' ?'class="active"':''?>><a><i class="fa fa-btc" aria-hidden="true"></i>Card  <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li <?=isset($active)&& $active == 'card' ?'class="current-page"':''?> ><a target="" href="<?=URL?>/manager/card.html">All card</a></li>
                                </ul>
                            </li>
                            <li <?=isset($active)&& $active == 'orders' ?'class="active"':''?>><a><i class="fa fa-bars" aria-hidden="true"></i>Orders  <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li <?=isset($active)&& $active == 'orders' ?'class="current-page"':''?> ><a target="" href="<?=URL?>/manager/orders.html">All orders</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="menu_section">
                        <h3>Live On</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="e_commerce.html">E-commerce</a></li>
                                    <li><a href="projects.html">Projects</a></li>
                                    <li><a href="project_detail.html">Project Detail</a></li>
                                    <li><a href="contacts.html">Contacts</a></li>
                                    <li><a href="profile.html">Profile</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="page_403.html">403 Error</a></li>
                                    <li><a href="page_404.html">404 Error</a></li>
                                    <li><a href="page_500.html">500 Error</a></li>
                                    <li><a href="plain_page.html">Plain Page</a></li>
                                    <li><a href="login.html">Login Page</a></li>
                                    <li><a href="pricing_tables.html">Pricing Tables</a></li>
                                </ul>
                            </li>

                            <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="<?=CDN?>/backend/images/logo.jpg" alt=""><?=isset($check_login['full_name'])? ($check_login['full_name']):'Nguyễn Đạm'?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;"> Profile</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li><a href="javascript:;">Help</a></li>
                                <li><a href="<?=URL?>/manager/logout.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img src="<?=CDN?>/backend/images/logo.jpg" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="<?=CDN?>/backend/images/logo.jpg" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="<?=CDN?>/backend/images/logo.jpg" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="<?=CDN?>/backend/images/logo.jpg" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->