<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title><?php if(isset($this->titulo)) echo $this->titulo; ?></title>

  <!-- Favicons -->
  <link href="<?php echo $_layoutParams['ruta_img'];?>favicon.png" rel="icon">
  <link href="<?php echo $_layoutParams['ruta_img'];?>apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="<?php echo $_layoutParams['ruta_css'];?>bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $_layoutParams['ruta_css'];?>bootstrap.css" rel="stylesheet">

  <!--external css-->
  <link href="<?php echo $_layoutParams['ruta_css'];?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="<?php echo $_layoutParams['ruta_css'];?>style.css" rel="stylesheet">
  <link href="<?php echo $_layoutParams['ruta_css'];?>styles.css" rel="stylesheet">
  <link href="<?php echo $_layoutParams['ruta_css'];?>style-responsive.css" rel="stylesheet">
  <link href="<?php echo $_layoutParams['ruta_css'];?>zabuto_calendar.css" rel="stylesheet">
  <link href="<?php echo $_layoutParams['ruta_css'];?>jquery.gritter.css " rel="stylesheet">
  <link href="<?php echo $_layoutParams['ruta_css'];?>miEstilo.css" rel="stylesheet">

  <script src="<?php echo $_layoutParams['ruta_js'];?>Chart.js"></script>
 
  <script src="<?php echo $_layoutParams['ruta_js'];?>jquery.min.js"></script>
</head>

   


<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header  class="header black-bg">
  
      <div class="sidebar-toggle-box ">
        <div class="fa fa-bars tooltips " data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="<?php echo BASE_URL.'index';?>" class="logo"><b><span>UNAN LEON </span></b></a>
      <!--logo end-->

    </header>
    <!--header end-->
     