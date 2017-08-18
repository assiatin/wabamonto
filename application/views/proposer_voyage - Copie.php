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
						<form action="#">
							<div class="formSection">
								
								<div class="row">
									
									<div class="form-group col-sm-6 col-xs-12" style="padding-top:20px;">
										<label class="radio-inline"><input checked type="radio" name="optradio">Aller simple</label>
										<label class="radio-inline"><input type="radio" name="optradio">Aller-retour</label>
									</div>
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="firstName" class="control-label">Type de voyage *</label>
										
                                        <select class="form-control" id="sel1">
    <option>Courte distance (urbain)</option>
    <option>Longue distance</option>
    
  </select>
									</div>
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordFirst" class="control-label">Ville départ*</label>
										<input type="text" class="form-control" id="password">
									</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Ville destination*</label>
										<input type="text" class="form-control" id="passwordAgain">
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
								 
								<input type="text" class="form-control" id="findItem" placeholder="Date départ">
								<div class="input-group-addon addon-right"> <i class="fa fa-calendar" aria-hidden="true"></i></div>
							</div>
                    </div>
										<!--<input type="text" class="form-control date ed-datepicker filterDate" id="password">-->
									</div>
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Heure Départ*</label>
										<input type="text" class="form-control" id="passwordAgain">
									</div>
                                    </div>
                                    <div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="passwordFirst" class="control-label">Date retour*</label>
                                        <div class="form-group">
							<div class="input-group date ed-datepicker filterDate" data-provide="datepicker">
								 
								<input type="text" class="form-control" id="findItem" placeholder="Date retour">
								<div class="input-group-addon addon-right"> <i class="fa fa-calendar" aria-hidden="true"></i></div>
							</div>
                    </div>
										
									</div>
                                    
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Heure retour*</label>
										<input type="text" class="form-control" id="passwordAgain">
									</div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="firstName" class="control-label">Bagage*</label>
										
                                        <select class="form-control" id="sel1">
    <option>Pas de bagage </option>
    <option>Petit bagage</option>
    <option>Moyen</option>
    <option>Grand bagage</option>
    
  </select>
									</div>
                                    
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Nombre de place*</label>
										<input type="number" min="1" max="3" class="form-control" id="passwordAgain" value="1">
									</div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Coût de voyage*</label>
										<input type="number"  class="form-control" id="passwordAgain" >
									</div>
                                    
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Retard accodé (mn)*</label>
										<input type="number" min="0" max="30" class="form-control" id="passwordAgain" value="0">
									</div>
                                    
                                    <div class="form-group col-xs-12">
										<label for="usernames" class="control-label">Description*</label>
                                        <textarea rows="2" class="form-control" id="usernames"></textarea>
										
									</div>
                                    
									<!--<div class="form-group col-xs-12">
										<label for="emailAdress" class="control-label">Email Address*</label>
										<input type="email" class="form-control" id="emailAdress">
									</div>-->
								</div>
							</div>
							
							<div class="formSection">
								
								<div class="row">
									
									
								  <div class="form-group col-xs-12 mb0">
										<button type="submit" class="btn btn-primary">Valider</button>
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
