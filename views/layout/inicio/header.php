<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
    	<!-- meta charec set -->
        <meta charset="utf-8">
		<!-- Always force latest IE rendering engine or request Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!-- Page Title -->
        <title>
         <?php if(isset($this->titulo)) echo $this->titulo; ?>
         </title>	
         <!-- Favicons -->
  <link href="<?php echo $_layoutParams2['ruta_img'];?>favicon.png" rel="icon">
  <link href="<?php echo $_layoutParams2['ruta_img'];?>apple-touch-icon.png" rel="apple-touch-icon">
	
		<!-- Meta Description -->
        <meta name="description" content="Blue One Page Creative HTML5 Template">
        <meta name="keywords" content="one page, single page, onepage, responsive, parallax, creative, business, html5, css3, css3 animation">
        <meta name="author" content="Muhammad Morshed">
		<!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Google Font -->
		
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

		<!-- CSS
		================================================== -->
		<!-- Fontawesome Icon font -->
        <link rel="stylesheet" href="<?php echo $_layoutParams2['ruta_css'];?>font-awesome.min.css">
		<!-- Twitter Bootstrap css -->
        <link rel="stylesheet" href="<?php echo $_layoutParams2['ruta_css'];?>bootstrap.min.css">
		<!-- jquery.fancybox  -->
        <link rel="stylesheet" href="<?php echo $_layoutParams2['ruta_css'];?>jquery.fancybox.css">
		<!-- animate -->
        <link rel="stylesheet" href="<?php echo $_layoutParams2['ruta_css'];?>animate.css">
		<!-- Main Stylesheet -->
        <link rel="stylesheet" href="<?php echo $_layoutParams2['ruta_css'];?>main.css">
		<!-- media-queries -->
        <link rel="stylesheet" href="<?php echo $_layoutParams2['ruta_css'];?>media-queries.css">
        <link rel="stylesheet" href="<?php echo $_layoutParams2['ruta_css'];?>style-resp.css">
        <link rel="stylesheet" href="<?php echo $_layoutParams2['ruta_css'];?>style_one.css">
        <link rel="stylesheet" href="<?php echo $_layoutParams2['ruta_css'];?>miestilo.css">
        

		<!-- Modernizer Script for old Browsers   -->
		<script src="<?php echo $_layoutParams2['ruta_js'];?>modernizr-2.6.2.min.js"></script>
        <script src="<?php echo $_layoutParams2['ruta_js'];?>jquery.min.js"></script>
    </head>
    <body id="body">
	
		<!-- preloader -->
		<div id="preloader">
			<img src="<?php echo $_layoutParams2['ruta_img'];?>preloader.gif" alt="Preloader">

		</div>
		<!-- end preloader -->

   
        <!-- 
        Fixed Navigation
        ==================================== -->
        <header id="navigation" class="navbar-fixed-top navbar">
            <div class="container">
                <div class="navbar-header">
                    <!-- responsive nav button -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars fa-2x"></i>
                    </button>
					<!-- /responsive nav button -->
					
					<!-- logo -->
                    <a class="navbar-brand" href="#body">
						<h1 id="logo">
							<img src="<?php echo $_layoutParams2['ruta_img'];?>logo.png" alt="SACUR">
						</h1>
					</a>
					<!-- /logo -->
                </div>

				<!-- main nav -->
        <nav id="navbar" class="navbar-collapse collapse navbar-right" role="navigation">
         <ul class="nav  nav-pills">
        </li>
          <?php
if(isset($_layoutParams2['menu'])) {
 foreach($_layoutParams2['menu'] as $menu){
           ?>
<li><a href="<?php echo $menu['enlace']?>" title="<?php echo $menu['titulo']?>" id="<?php echo $menu['id']?>"><?php echo $menu['titulo']?></a></li>

<?php
 }
}	
  ?>
  <li><a data-toggle="modal" href="#" data-target="#registroEstudiante">Registrar Estudiante</a></li> 
  <li><a data-toggle="modal" href="#" data-target="#registroProfesor">Registrar Profesor</a></li> 
</ul>
  </nav>
				<!-- /main nav -->
				
            </div>
        </header>
