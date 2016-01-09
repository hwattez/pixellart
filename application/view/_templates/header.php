<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">

        <title><?php echo defined('SEO_TITLE') ? SEO_TITLE . ' - Pixellart' : "Pixell'art - Loïc Wattez"; ?></title>

        <!-- Meta Description -->
        <?php echo defined('SEO_CONTENT') ? '<meta name="description" content="' . SEO_CONTENT . '" />' : ''; ?>

        <!-- Meta Facebook -->
        <?php echo defined('SEO_TITLE') ? '<meta property="og:title" content="' . SEO_TITLE . '" />' : ''; ?>
        <?php echo defined('SEO_TITLE') ? '<meta property="og:type" content="website" />' : ''; ?>
        <?php echo defined('SEO_IMAGE') ? '<meta property="og:image" content="' . SEO_IMAGE . '" />' : ''; ?>
        <?php echo defined('SEO_IMAGE') ? '<meta property="og:url" content="' . URL . $_SERVER["REQUEST_URI"] . '" />' : ''; ?>
        <?php echo defined('SEO_CONTENT') ? '<meta property="og:description" content="' . SEO_CONTENT . '" />' : ''; ?>
        <?php echo defined('SEO_CONTENT') ? '<meta property="og:site_name" content="Pixell\'art - Loïc Wattez" />' : ''; ?>
        <?php echo defined('SEO_CONTENT') ? '<meta property="og:locale" content="fr_FR">' : ''; ?>
        <?php echo defined('SEO_CONTENT') ? '<meta property="fb:app_id" content="717058388438064" />' : ''; ?>
        
        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!-- Indexage Google -->
        <meta name="google-site-verification" content="Gl2C4Z-uRjeWgd1kGRC-rl9XLVLA3jnf02tLeXkbJxg" />
        <!--<meta name="robots" content="noindex,follow" /> -->
        
        <!-- Bootstrap -->
        <link href="<?php echo URL; ?>addons/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Google Font -->
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        
        <!-- FontAwesome -->
        <link href="<?php echo URL; ?>addons/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- Sweetalert -->
        <link href="<?php echo URL; ?>addons/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
        
        <!-- My CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>css/design.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>css/responsive-design.css">
    </head>
    
    <body class="col-xs-offset-2">
    
        <div id="sidebar" class="col-xs-2">
            <h1><span class="hidden-xs hidden-sm">Pixell'Art</span><span class="visible-xs visible-sm">P'A</span><br><small style="float:right; padding-right:10px;">Beta</small></h1>
            <ul id="menu_sidebar" class="nav nav-pills nav-stacked">
                <li class="active"><a href="<?php echo URL; ?>#"><i class="fa fa-home fa-fw"></i> <span class="hidden-xs">Accueil</span></a></li>
                <li><a href="<?php echo URL; ?>#videos"><i class="fa fa-video-camera fa-fw"></i> <span class="hidden-xs">Vidéos</span></a></li>
                <li><a href="<?php echo URL; ?>#contact"><i class="fa fa-phone fa-fw"></i> <span class="hidden-xs">Contact</span></a></li>
                <li>
                    <br>
                    <span class="hidden-xs">
                        <br><br><br>
                    </span>
                </li>
                <li class="textAlignCenter"><i class="fa fa-share-alt fa-fw"></i> <span class="hidden-xs">Follow me</span></li>
                <li class="textAlignCenter"><a target="_blank" class="facebook" href="https://www.facebook.com/pixellart.lw"><i class="fa fa-facebook fa-fw"></i></a></li>
                <li class="textAlignCenter"><a target="_blank" class="twitter" href="https://twitter.com/WattezL"><i class="fa fa-twitter fa-fw"></i></a></li>
                <li class="textAlignCenter"><a target="_blank" class="googleP" href="https://plus.google.com/u/0/114178251131214211570/posts"><i class="fa fa-google-plus fa-fw"></i></a></li>
                <li class="textAlignCenter"><a target="_blank" class="youtube" href="https://www.youtube.com/channel/UCFabwJ1_1dWVDSzWoiAgnJQ"><i class="fa fa-youtube fa-fw"></i></a></li>
            </ul>
        </div>