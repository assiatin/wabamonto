<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Wabamonto</title>

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
  <div class="page-loader" style="background: url(<?php echo base_url();?>assets/wabamonto/img/preloader.gif) center no-repeat #fff;"></div>
  <div class="main-wrapper">
    <!-- HEADER -->
    <header id="pageTop" class="header">

      <!-- TOP INFO BAR -->

      <div class="nav-wrapper" >

        <!-- NAVBAR -->
        <nav id="menuBar"   style="background: rgba(0, 0, 0, 0.7) !important;" class="navbar navbar-default lightHeader" role="navigation">
          <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.html"><img src="<?php echo base_url();?>assets/wabamonto/img/logo.png" alt="logo"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <ul class="nav navbar-nav navbar-right">
              <li class=""><a href="<?php echo site_url('welcome/proposer_voyage');?>">Proposer un voyage </a></li>
                 <li class=""><a href="<?php echo site_url('welcome/chercher_voyage');?>">Chercher un voyage</a></li>
                 
                  <?php if(!$this->session->userdata('user'))
		                 {?>
		
	
                 <li class=""><a href="<?php echo site_url('welcome/inscription');?>">Inscription </a></li>
                 
                  <li class=""><a href="<?php echo site_url('welcome/connexion');?>">Connection </a></li>
                   <?php }?>
                   <li class=""><a href="<?php echo site_url('welcome/demo');?>">Demo </a></li>
                  
              </ul>
            </div>
            <!--<button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#loginModal"> + <span>Add Listing</span> </button>-->
          </div>
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
						<form class="loginForm" action="<?php echo site_url('welcome/connexion');?>" method="post">
							<div class="form-group">
								<label for="userName">E-mail ou Télephone *</label>
								<input type="text" name="txtlogin" class="form-control" placeholder="Email ou  télephone (Ex Tél: 97000000)." id="userName">
								 
							</div>
							<div class="form-group">
								<label for="userPassword">Mot de passe *</label>
								<input type="password" name="txtpwd" class="form-control" placeholder="Entrer votre mot de passe." id="userPassword">
								 
							</div>
							<div class="form-group">
                             <input type="submit" class="btn btn-primary pull-left" name="btnSave" value="&nbsp;&nbsp;Connexion&nbsp;&nbsp;"/>
								
								<a href="#" class="pull-right link">Mot de passe oublié?</a>
							</div>
                            
                            
                    
						</form>
                        <div style="text-align:center">
            <span >OU</span>
            <hr>
          </div>
                        <div class="row">
            <div class="col-xs-12" style="padding-bottom:10px;">
              <button class="btn btn-facebook btn-block" style="background:#3b5998"><i class="fa fa-facebook" aria-hidden="true"></i> Se connecter avec Facebook</button>
            </div>
            <div class="col-xs-12">
              <button class="btn btn-google btn-block" style="background:#dd4b39"><i class="fa fa-google" aria-hidden="true"></i> Se connecter avec Google</button>
            </div>
						
          </div>
                        <!--<div class="row">
                   
                            <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" style="background-color:#000059">Rechercher <i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                            <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" style="background-color:#000059">Rechercher <i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                            </div>-->
					</div>
					<div class="panel-footer text-center">
						<p>Vous n'avez pas un compte? <a href="sign-up.html" class="link">S'inscrire</a></p>
					</div>
                    
				</div>
			</div>
		</div>
	</div>
</section>