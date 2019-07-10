<!DOCTYPE html>
<html lang="en-US" class="no-js" ng-app="builder" ngCsp>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">

  <title>Trex Spiral Stairs Builder</title>

  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico">
  <link rel="icon" sizes="192x192" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch.png">
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch.png">

  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/builder/assets/css/fonts.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/builder/assets/css/style.css">

  <?php wp_head(); ?>

  <?php if (function_exists('the_field')) the_field('gtm_container_code', 'options'); ?>
  <script><?php if (function_exists('the_field')) the_field('dataLayer_snippet'); ?></script>

</head>

</head>
<body ng-controller="StaircaseController as staircase" class="toggle-indoor">
<?php if (function_exists('the_field')) the_field('gtm_container_frame', 'options'); ?>