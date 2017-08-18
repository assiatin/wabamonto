  </header>


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
						<form  method="post" action="<?php echo site_url('welcome/proposer_voyage2');?>">							<div class="formSection">
								
								
                                    
                                    
                                    <div class="row">
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="firstName" class="control-label">Bagage*</label>
										
                                        <select class="form-control" name="prendreBagage" id="sel1">
    <option>Pas de bagage </option>
    <option>Petit bagage</option>
    <option>Moyen</option>
    <option>Grand bagage</option>
    
  </select>
									</div>
                                    
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Nombre de place*</label>
										<input type="number" name="nbrePlaceVoyages" required="required" min="1" max="3" class="form-control" id="passwordAgain" value="1">
									</div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Coût de voyage (en F CFA)*</label>
                                         <input type="number" name="coutVoyages" required="required" class="form-control" id="passwordAgain2" />
                                    </div>
                                    
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Retard accodé (mn)*</label>
										<input type="number" name="retardVogages" required="required" min="0" max="30" class="form-control" id="passwordAgain" value="0">
									</div>
                                    
                                    <div class="form-group col-xs-12">
										<label for="usernames" class="control-label">Description*</label>
                                        <textarea rows="2" name="descriptionVoyages" required="required" class="form-control" id="usernames"></textarea>
										
									</div>
                                    
                                    
                            <input type="hidden" value="<?php echo $_POST['estAllerSimple'] ?>"  name="estAllerSimple" />
                            <input type="hidden" value="<?php echo $_POST['typeVoyages'] ?>"  name="typeVoyages" />
                            <input type="hidden" value="<?php echo $_POST['villeDepartVoyages'] ?>" name="villeDepartVoyages" />
                            <input type="hidden" value="<?php echo $_POST['villeArriveeVoyages'] ?>" name="villeArriveeVoyages" />
                            <input type="hidden" value="<?php echo $_POST['dateDepartVoyages'] ?>" name="dateDepartVoyages" />
                            <input type="hidden" value="<?php echo $_POST['dateRetourVoyages'] ?>" name="dateRetourVoyages" />
                            <input type="hidden" value="<?php echo $_POST['heureDepartVoyages'] ?>" name="heureDepartVoyages" />
                            <input type="hidden" value="<?php echo $_POST['heureRetourVoyages'] ?>"  name="heureRetourVoyages" />
									<!--<div class="form-group col-xs-12">
										<label for="emailAdress" class="control-label">Email Address*</label>
										<input type="email" class="form-control" id="emailAdress">
									</div>-->
								</div>
							</div>
							
							<div class="formSection">
								
								<div class="row">
									
									
								  <div class="form-group col-xs-12 mb0">
										<input type="submit" class="btn btn-primary" name="btnSave" value="&nbsp;&nbsp;Valider&nbsp;&nbsp;"/>
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
