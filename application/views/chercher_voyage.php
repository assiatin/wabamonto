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
  
  
<!-- DASHBOARD SECTION -->
<section class="clearfix signUpSection">
	<div class="container">
		<div class="row">
			
			<div class="col-sm-12 col-xs-12">
				<div class="signUpFormArea">
					<div class="priceTableTitle">
						<h2>Rechercher un voyage</h2>
						 
					</div>
					<div class="signUpForm">
						<form  method="post" action="<?php echo site_url('welcome/chercher_voyage');?>">
							<div class="formSection">
								
								<div class="row">
									
									
                                    
                                     <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordFirst" class="control-label">Ville départ*</label>
										<input type="text" value="<?php echo $villeDepartVoyages;?>" name="villeDepartVoyages"  class="form-control" id="ville_depart" placeholder="Saisir la ville">
									</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Ville destination*</label>
										<input type="text" value="<?php echo $villeArriveeVoyages;?>" placeholder="Saisir la ville" name="villeArriveeVoyages"  class="form-control" id="ville_arrive">
									</div>
                                    
                                    
                                    </div>
                                    <div class="row">
                                    
									
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordFirst" class="control-label">Date départ*</label>
                                        <div class="form-group">
							<div class="input-group date ed-datepicker filterDate" data-provide="datepicker">
								 
								<input type="text" name="dateDepartVoyages" class="form-control" id="findItem" placeholder="Date départ">
								<div class="input-group-addon addon-right"> <i class="fa fa-calendar" aria-hidden="true"></i></div>
							</div>
                    </div>
										<!--<input type="text" class="form-control date ed-datepicker filterDate" id="password">-->
									</div>
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordFirst" class="control-label">Date retour*</label>
                                        <div class="form-group">
							<div class="input-group date ed-datepicker filterDate" data-provide="datepicker">
								 
								<input type="text" class="form-control" name="dateRetourVoyages" id="findItem" placeholder="Date retour">
								<div class="input-group-addon addon-right"> <i class="fa fa-calendar" aria-hidden="true"></i></div>
							</div>
                    </div>
										
									</div>
                                    
                                    </div>
                                    <!--<div class="row">
									
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Heure Départ*</label>
										<input type="text" class="form-control" id="passwordAgain">
									</div>
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Heure retour*</label>
										<input type="text" class="form-control" id="passwordAgain">
									</div>
                                    </div>-->
                                    
                                    
							</div>
							
							<div class="formSection">
								<h2>Resulat de la recherche</h2>
								<div class="row">
									
									
								  <div class="form-group col-xs-12 mb0">
                                    <input type="submit" class="btn btn-primary" name="btnSave" value="&nbsp;&nbsp;Rechercher&nbsp;&nbsp;"/>
										 
									</div>
								</div>
							</div>
                            <div class="formSection">
								
								<div class="row">
									
									
								  <div class="col-xs-12">
				<div class="table-responsive bgAdd"  data-pattern="priority-columns">
					<table id="ordersTable" class="table table-small-font table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
                                <th>#</th>
								<th>Ville départ</th>
								<th >Ville Destination</th>
								<th >Date depart</th>
								<th >Date retour</th>
								<th >Heure depart</th>
								<th>Cout</th>
								 
								<th >Status</th>
								<th >Action</th>
							</tr>
						</thead>
						<tfoot>
						</tfoot>
                        <tbody>
                       <?php
   					$i=0;
					foreach ($liste_voyage as $liste) 
					{
						$i=$i+1;
						echo "<tr>
							  <td>".($i)."</td>
							
							  <td>".$liste->villeDepartVoyages ."</td>
							  <td>".$liste->villeArriveeVoyages."</td>
							  <td>".date('d-m-Y',strtotime($liste->dateDepartVoyages))."</td>
							  <td>".date('d-m-Y',strtotime($liste->dateRetourVoyages))."</td>
							  <td>".date('h:m',strtotime($liste->heureDepartVoyages))."</td>
							   
							  <td>".$liste->coutVoyages." F CFA</td>
							  <td><span class='label label-success'>Actif</span></td>";
							  
							echo "	<td>
									<div class='btn-group'>
									
										
										<a class='btn btn-primary' href='".site_url('welcome/detail_yoyage/'.$liste->idVoyages)."' > Detail</a>
										
										 
									</div>
								</td>
							   
							 
							</tr>";
					   
					}
					
					
                    ?>
                     
                    </tbody>
						
					</table>
				</div>
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