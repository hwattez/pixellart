<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pixell'Art Administration</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo URL; ?>addons/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo URL; ?>addons/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo URL; ?>addons/sbadmin/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo URL; ?>addons/sbadmin/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo URL; ?>addons/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo URL; ?>addons/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo URL; ?>administration/index/">Pixell'Art Administration</a>
            </div>
            <!-- /.navbar-header -->

            <?php if(LOGGED) { ?>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a href="<?php echo URL; ?>administration/logout/" alt="Se déconnecter">
                            <i class="fa fa-sign-out fa-fw"></i> Sé déconnecter
                        </a>
                        <!-- /.dropdown-messages -->
                    </li>
                </ul>
                <!-- /.navbar-top-links -->
            
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="<?php echo URL; ?>administration/index/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-video-camera fa-fw"></i> Vidéos<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo URL; ?>administration/videos/">Toutes</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo URL; ?>administration/video/new/">Nouvelle</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="<?php echo URL; ?>administration/tags/"><i class="fa fa-tags fa-fw"></i> Tags</a>
                            </li>
                            <li>
                                <a href="<?php echo URL; ?>administration/messages/"><i class="fa fa-envelope fa-fw"></i> Messages</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-tasks fa-fw"></i> Tâches<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo URL; ?>administration/tasks/">Toutes</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo URL; ?>administration/task/new/">Nouvelle</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            <?php } ?>
        </nav>
        <div id="page-wrapper" style="padding-bottom: 20px;">