<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connexion wabamoto</title>

  <!-- PLUGINS CSS STYLE -->
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/listtyicons/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/bootstrapthumbnail/bootstrap-thumbnail.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/datepicker/datepicker.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/selectbox/select_option1.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/isotope/isotope.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/map/css/map.css" rel="stylesheet">

  <!-- GOOGLE FONT -->
  <link href="https://fonts.googleapis.com/css?family=Muli:200,300,400,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Herr+Von+Muellerhoff" rel="stylesheet">

  <!-- CUSTOM CSS -->
  <link href="<?php echo base_url();?>assets/wabamonto/css/style.css" rel="stylesheet">

  <!-- FAVICON -->
  <link href="<?php echo base_url();?>assets/wabamonto/img/favicon.png" rel="shortcut icon">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body class="body-wrapper">
  <div class="page-loader" style="background: url(img/preloader.gif) center no-repeat #fff;"></div>
<div class="main-wrapper">
    <!-- HEADER -->
    <header id="pageTop" class="header">

      <!-- TOP INFO BAR -->

      <div class="nav-wrapper" >

        <!-- NAVBAR -->
        <nav id="menuBar"   style="background: rgba(0, 0, 0, 0.7) !important;" class="navbar navbar-default lightHeader" role="navigation">
          
        </nav>
      </div>
    </header>


<!-- LOGIN SECTION -->
<section class="clearfix loginSection">
	<div class="container">
		<div class="row">
			<div class="center-block col-md-5 col-sm-6 col-xs-12">
				<div class="panel panel-default loginPanel">
					<div class="panel-heading text-center">Connexion</div>
				  <div class="panel-body">
						<!--form class="loginForm" -->
						<form class="form-horizontal m-t-20" action="<?php echo site_url('admin/doConnect'); ?>" method="post">
						
						
						 <?php 
			
						if ($notification=="0")
						{
							echo  '<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								Connexion echouée!.
							</div>';
						}
						
						?>
						
						
							<div class="form-group">
								<label for="userName">E-mail </label>
								<input type="text" required class="form-control" placeholder="Votre Email" id="userName" name="Email">
								 
							</div>
							<div class="form-group">
								<label for="userPassword">Mot de passe *</label>
								<input type="password" required class="form-control" placeholder="Entrer votre mot de passe." id="userPassword" name="pwd">
								 
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary pull-left">Connexionn</button>
								
							</div>
                            
                            
                    
						</form>
                    
                      <!--<div class="row">
                   
                            <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" style="background-color:#000059">Rechercher <i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                            <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" style="background-color:#000059">Rechercher <i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                            </div>-->
					</div>
					
                    
				</div>
			</div>
		</div>
	</div>
</section>

    <!-- FOOTER -->
    
  </div>

  <!-- LOGIN  MODAL --><!-- JAVASCRIPTS -->
  <script src="<?php echo base_url();?>assets/wabamonto/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/plugins/smoothscroll/SmoothScroll.min.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/plugins/waypoints/waypoints.min.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/plugins/counter-up/jquery.counterup.min.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/plugins/datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/plugins/selectbox/jquery.selectbox-0.1.3.min.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/plugins/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/plugins/isotope/isotope.min.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/plugins/fancybox/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/plugins/isotope/isotope-triger.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEDfNcQRmKQEyulDN8nGWjLYPm8s4YB58"></script>
<script src="<?php echo base_url();?>assets/wabamonto/plugins/map/js/rich-marker.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/plugins/map/js/infobox_packed.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/js/single-map.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/js/map.js"></script>
<script src="<?php echo base_url();?>assets/wabamonto/js/custom.js"></script>

</body>

</html>
