  <!-- FOOTER -->
    <footer style="background-image: url(<?php echo base_url();?>assets/wabamonto/img/background/bg-footer.jpg);">
      <!-- FOOTER INFO -->
      <div class="clearfix footerInfo">
        <div class="container">
          <div class="row">
            <div class="col-sm-7 col-xs-12">
              <div class="footerText">
                <a href="index.html" class="footerLogo"><img src="<?php echo base_url();?>assets/wabamonto/img/logo-footer.png" alt="Footer Logo"></a>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor</p>
                <ul class="list-styled list-contact">
                  <li><i class="fa fa-phone" aria-hidden="true"></i>[88] 657 524 332</li>
                  <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="#">info@listy.com</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-3 col-xs-12">
              <div class="footerInfoTitle">
                <h4>Links</h4>
              </div>
              <div class="useLink">
                <ul class="list-unstyled">
                  <li><a href="dashboard.html">Dashboard</a></li>
                  <li><a href="sign-up.html">Create Account</a></li>
                  <li><a href="login.html">Login</a></li>
                  <li><a href="add-listings.html">Add Listing</a></li>
                  <li><a href="edit-listings.html">Edit Listing</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-2 col-xs-12">
              <div class="footerInfoTitle">
                <h4>Company</h4>
              </div>
              <div class="useLink">
                <ul class="list-unstyled">
                  <li><a href="contact-us.html">Contact Us</a></li>
                  <li><a href="terms-of-services.html">Terms and Conditions</a></li>
                  <li><a href="how-it-works.html">How It Works</a></li>
                  <li><a href="payment-process.html">Payment</a></li>
                  <li><a href="pricing-table.html">Pricing</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- COPY RIGHT -->
      <div class="clearfix copyRight">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="copyRightWrapper">
                <div class="row">
                  <div class="col-sm-5 col-sm-push-7 col-xs-12">
                    <ul class="list-inline socialLink">
                      <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                      <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                      <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                      <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    </ul>
                  </div>
                  <div class="col-sm-7 col-sm-pull-5 col-xs-12">
                    <div class="copyRightText">
                      <p>Copyright &copy; 2017. All Rights Reserved by <a href="#">Abdus</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </footer>
  </div>

  <!-- LOGIN  MODAL -->
  <div id="loginModal" tabindex="-1" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Log In to your Account</h4>
        </div>
        <div class="modal-body">
          <form class="loginForm">
            <div class="form-group">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <input type="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="form-group">
              <i class="fa fa-lock" aria-hidden="true"></i>
              <input type="password" class="form-control" id="pwd" placeholder="Password">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Log In</button>
            </div>
            <div class="checkbox">
              <label><input type="checkbox"> Remember me</label>
              <a href="#" class="pull-right link">Fogot Password?</a>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <p>Don’t have an Account? <a href="#" class="link">Sign up</a></p>
        </div>
      </div>

    </div>
  </div>

  <!-- JAVASCRIPTS -->
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
