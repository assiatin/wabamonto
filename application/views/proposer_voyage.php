  </header>
<script>
  $( function() {
    var availableTags = [
     				 <?php
   					$i=0;
					foreach ($liste_ville as $liste) 
					{
						echo '"'.$liste->nom.'",';					   
					}
                    ?>
      
    ];
    $( "#ville_depart" ).autocomplete({
      source: availableTags
    });
	
	$( "#ville_arrive" ).autocomplete({
      source: availableTags
    });
  } );
  </script>
  
  <SCRIPT TYPE="text/JavaScript">
    function validateHhMmDepart(inputField) {
        var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(inputField.value);

        if (isValid) {
            inputField.style.backgroundColor = '#fff';
        } else {
            inputField.style.backgroundColor = '#fff';
			document.getElementById('heure_depart').value="";
        }

        return isValid;
    }
	
	
	function validateHhMmRetour(inputField) {
        var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(inputField.value);

        if (isValid) {
            inputField.style.backgroundColor = '#fff';
        } else {
            inputField.style.backgroundColor = '#fff';
			document.getElementById('heure_retour').value="";
        }

        return isValid;
    }
</SCRIPT>

<!-- DASHBOARD SECTION -->
<section class="clearfix signUpSection">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-xs-12">
				<div class="priceTableWrapper">
					<div class="priceTableTitle">
						<h2>Condition </h2>
					</div>
					<p style="margin:20px;">Please fill out the fields below to create your account. We will send your account information to the email address you enter. Your email address and information will NOT be sold or shared with any 3rd party. If you already have an account, please, Please fill out the fields below to create your account. We will send your account information to the email address you enter. Your email address and information will NOT be sold or shared with any 3rd party. If you already have an account, please,Please fill out the fields below to create your account. We will send your account information to the email address you enter. Your email address and information will NOT be sold or shared with any 3rd party. If you already have an account, please,Please fill out the fields below to create your account. We will send your account information to the email address you enter. Your email address and information will NOT be sold or shared with any 3rd party. If you already have an account, please, <a href="login.html">click here</a>.</p>
					
				</div>
			</div>
			<div class="col-sm-8 col-xs-12">
				<div class="signUpFormArea">
					<div class="priceTableTitle">
						<h2>Proposer un voyage</h2>
						 
					</div>
					<div class="signUpForm">
                    
						<form  method="post" action="<?php echo site_url('welcome/proposer_voyage2');?>">
							<div class="formSection">
								
								<div class="row">
                                
									
									<div class="form-group col-sm-6 col-xs-12" style="padding-top:20px;">
                                    <label class="radio-inline"><input checked onclick="afficher_retour();"  type="radio" name="estAllerSimple" value="Aller-retour">Aller-retour</label>
										<label class="radio-inline"><input  onclick="cacher_retour();" type="radio" name="estAllerSimple" value="Aller simple">Aller simple</label>
										
									</div>
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="firstName" class="control-label">Type de voyage *</label>
										
                                        <select class="form-control" name="typeVoyages" id="sel1">
    <option value="Courte distance" >Courte distance (urbain)</option>
    <option value="Longue distance" >Longue distance</option>
    
  </select>
									</div>
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordFirst" class="control-label">Ville départ*</label>
										<input type="text" placeholder="Saisir la ville" name="villeDepartVoyages" required="required" class="form-control" id="ville_depart">
									</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Ville destination*</label>
										<input type="text" placeholder="Saisir la ville" name="villeArriveeVoyages" required="required" class="form-control" id="ville_arrive">
									</div>
                                    
                                    <!--<div class="form-group col-sm-6 col-xs-12">
										<label for="passwordFirst" class="control-label">Date départ*</label>
                                        <div class="form-group">
                                        <div class="input-group date ed-datepicker filterDate" data-provide="datepicker">
                                             
                                            <input type="text" class="form-control" id="findItem" placeholder="Date départ">
                                            <div class="input-group-addon addon-right"> <i class="fa fa-calendar" aria-hidden="true"></i></div>
                                        </div>
                                </div>
										 
									</div>
                                    
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Heure Départ*</label>
										<input type="text" class="form-control" id="passwordAgain">
									</div>-->
                                    </div>
                                    <div class="row">
                                    
									
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordFirst" class="control-label">Date départ*</label>
                                        <div class="form-group">
							<div class="input-group date ed-datepicker filterDate" data-provide="datepicker">
								 
								<input type="text" name="dateDepartVoyages" required="required" class="form-control" id="findItem" placeholder="Date départ">
								<div class="input-group-addon addon-right"> <i class="fa fa-calendar" aria-hidden="true"></i></div>
							</div>
                    </div>
										<!--<input type="text" class="form-control date ed-datepicker filterDate" id="password">-->
									</div>
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Heure Départ*</label>
										<input type="time" name="heureDepartVoyages" onchange="validateHhMmDepart(this);" placeholder="hh:mm" required="required" class="form-control" id="heure_depart">
									</div>
                                    </div>
                                    <div class="row" id="retour">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="passwordFirst" class="control-label">Date retour*</label>
                                        <div class="form-group">
							<div class="input-group date ed-datepicker filterDate" data-provide="datepicker">
								 
								<input type="text" class="form-control" name="dateRetourVoyages" id="findItem" placeholder="Date retour">
								<div class="input-group-addon addon-right"> <i class="fa fa-calendar" aria-hidden="true"></i></div>
							</div>
                    </div>
										
									</div>
                                    
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Heure retour*</label>
										<input type="time" onchange="validateHhMmRetour(this);" name="heureRetourVoyages" placeholder="hh:mm"  class="form-control" id="heure_retour">
                                        									</div>
                                    </div>
                                    
                                    
							</div>
							
							<div class="formSection">
								
								<div class="row">
									
									
								  <div class="form-group col-xs-12 mb0">
                                                                    <input type="submit" class="btn btn-primary" name="btnsuivant" value="&nbsp;&nbsp;Suivant&nbsp;&nbsp;"/>

										 
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
     function cacher_retour() 
	 {
		 document.getElementById('retour').hidden=true;
                
	 }
	 function afficher_retour() 
	 {
		 document.getElementById('retour').hidden=false;
                
	 }
    </script>
    
    
    
