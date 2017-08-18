<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Box - Listty</title>

  <!-- PLUGINS CSS STYLE -->
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/listtyicons/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/bootstrapthumbnail/bootstrap-thumbnail.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/datepicker/datepicker.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/selectbox/select_option1.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/wabamonto/plugins/rwdtable/css/rwd-table.css" rel="stylesheet">
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

<body>
  <div class="page-loader" style="background: url(img/preloader.gif) center no-repeat #fff;"></div>
  <div class="main-wrapper">
    <!-- HEADER -->
    <header id="pageTop" class="header">

      <!-- TOP INFO BAR -->

      <div class="nav-wrapper navbarWhite">

        <!-- NAVBAR -->
        
      </div>
      <div class="navbar-dashboard-area">
        <nav class="navbar navbar-default lightHeader navbar-dashboard" role="navigation">
          <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-dash">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-dash">
              <ul class="nav navbar-nav mr0">
                <li class="active">
                  <a href="dashboard.html"><i class="fa fa-handshake-o" aria-hidden="true"></i> Médiation</a>
                </li>
                <li class="dropdown singleDrop">
                  <a href="dashboard.html#categories" class="scrolling"><i class="fa fa-bullseye" aria-hidden="true"></i> Vérifier l’identité</a>
                </li>
                
               <li class="dropdown singleDrop">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-ul icon-dash" aria-hidden="true"></i> Listings <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                  <ul class="dropdown-menu dropdown-menu-left">
                    <li><a href="listings.html">Voyages</a></li>
                    <li><a href="add-listings.html">Resevation</a></li>
                   <li><a href="<?php echo site_url('admin/utilisateur');?>"><i class="md md-album"></i>Utilisateurs</a></li>
                  </ul>
                </li>
                
                <li class="dropdown singleDrop">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i> Systeme <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                  <ul class="dropdown-menu dropdown-menu-left">
                    <li><a href="<?php echo site_url('admin/utilisateur');?>">Utilisateur</a></li>
                    <li><a href="add-listings.html">Changer mot de passe</a></li>
                    
                  </ul>
                </li>
                <li><a href="<?php echo site_url('admin/logout'); ?>"><i class="fa fa-user-times" aria-hidden="true"></i> Déconnexion</a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>


<!-- DASHBOARD SECTION -->
<section class="clearfix bg-dark equalHeight dashboardSection">
  
</section>

