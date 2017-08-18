</header>


<!-- DASHBOARD SECTION -->
<section class="clearfix signUpSection">
	<div class="container">
		<div class="row">
			
			<div class="col-sm-12 col-xs-12">
				<div class="signUpFormArea">
					<div class="priceTableTitle">
						<h2>Utilisateur</h2>
						 
					</div>
					<div class="signUpForm">
                    
						<form  method="post" action="<?php echo site_url('welcome/user_sys');?>">
							<div class="formSection">
								
								<div class="row">
									
									
                                    
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordFirst" class="control-label">Nom*</label>
										<input type="text"  value="<?php echo $nomUsers;?>" required class="form-control" id="password" name="nomUsers">
									</div>
									<div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Prenom*</label>
										<input type="text" value="<?php echo $prenomUsers;?>" required class="form-control" id="passwordAgain" name="prenomUsers" >
									</div>
                                    
                                    
                                    </div>
                                    <div class="row">
                                    
									
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Email*</label>
										<input type="email" value="<?php echo $emailUsers;?>" required name="emailUsers" class="form-control" id="passwordAgain" >
									</div>
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Téléphone*</label>
										<input type="number" value="<?php echo $telUsers;?>" required name="telUsers" class="form-control" id="passwordAgain">
									</div>
                                    </div>
                                    <div class="row">
									<div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Profil*</label>
										<select name="Profil" class="form-control">
	                                        <option <?php if ($Profil=='Administrateur')echo 'selected="selected"' ;?> value="Administrateur" >Administrateur</option>
	                                        <option <?php if ($Profil=='Charger de clientele')echo 'selected="selected"' ;?>  value="Charger de clientele"  >Charger de clientele</option>
	                                </select>
									</div>
                                    <div class="form-group col-sm-6 col-xs-12">
										<label for="passwordAgain" class="control-label">Actif*</label>
										 <input type="checkbox"  <?php if ($actif==1)echo 'checked="checked"' ;?>   name="statut" aria-label="...">
									</div>
                                    
                                    
                                    </div>
                                    
                                    
							</div>
							
							<div class="formSection">
								
								<div class="row">
									
									
								  <div class="form-group col-xs-12 mb0">
                                  <input type="submit" class="btn btn-primary" name="btnSave" value="&nbsp;&nbsp;Enregistrer&nbsp;&nbsp;"/>
										
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
								<th>Nom & Prenoms</th>
								<th data-priority="6">Profil</th>
								<th data-priority="2">Email</th>
								<th data-priority="6">Telephone</th>
								
								<th data-priority="3">Status</th>
								<th data-priority="2">Action</th>
							</tr>
						</thead>
						<tfoot>
						</tfoot>
                        <tbody>
                       <?php
   					$i=0;
					foreach ($user as $liste) 
					{
						$i=$i+1;
						echo "<tr>
							  <td>".($i)."</td>
							
							  <td>".$liste->nomUsers ."  ".$liste->prenomUsers 	."</td>
							  <td>".$liste->Profil."</td>
							  <td>".$liste->emailUsers."</td>
							  <td>".$liste->telUsers."</td>";
							  if ($liste->actif==1)
							   
							  echo "<td><span class='label label-success'>Actif</span></td>";
							  else
							  echo "<td><span class='label label-danger'>inactif</span></td>";
							  
							echo "	<td>
									<div class='btn-group'>
									
										
										<a class='btn btn-primary' href='".site_url('welcome/user_sys/'.$liste->idUsers)."' > Modifier</a>
										
										<a class='btn btn-primary' href='".site_url('welcome/user_init/'.$liste->idUsers)."' > Réinitialiser</a>
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

