   <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <ol class="breadcrumb pull-right">
                                        <li><a href="#">Gestion des utilisateurs</a></li>
                                
                                        <li class="active">utilisateur</li>
                                    </ol>
                                    <h4 class="page-title">utilisateur</h4>
                                </div>
                            </div>
                        </div>



                        <div class="row">
							

							<div class="col-lg-12">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>Ajout d'un utlisateur</b></h4>
									

									<form class="form-horizontal" id="differentForm" method="post" action="<?php echo site_url('admin/utilisateur');?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nom</label>
                      <div class="col-sm-4">
                       <input type="text" value="<?php echo $nom;?>" name="nom" class="form-control"  required="required" placeholder="Nom de l'utilisateur">

                      </div>
                      
                      <label for="inputEmail3" class="col-sm-2 control-label">Prénoms</label>
                      <div class="col-sm-4">
                        <input type="text" value="<?php echo $prenom;?>" name="prenom" class="form-control"  required="required" placeholder="Prénoms de l'utilisateur">
                       
                      </div>
                      
                    </div> 
                    
                    <div class="form-group">
                     
					 <label for="inputEmail3" class="col-sm-2 control-label">E-mail</label>
                      <div class="col-sm-4">
                      <input type="email" value="<?php echo $email;?>" name="email" class="form-control"   placeholder="E-mail de l'utilisateur">
                      </div>
                      
                      <label for="inputEmail3" class="col-sm-2 control-label">Telephone</label>
                      <div class="col-sm-4">
                        <input type="text" value="<?php echo $telephone;?>" name="telephone" class="form-control"  required="required" placeholder="Telephone de l'utilisateur">
                       
                      </div>
                      
                    </div>
                    
                     <label for="inputEmail3" class="col-sm-2 control-label">Profil</label>
                      <div class="col-sm-4">
									<select name="Profil" class="form-control">
	                                        <option value="Administrateur" >Administrateur</option>
	                                        <option value="Charge de clientele"  >Charge de clientele</option>
	                                </select>

                      </div>
                    
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Adresse  </label>
                      <div class="col-sm-4">
                    <input type="text" value="<?php echo $adresse;?>" name="adresse" class="form-control"   placeholder="Adresse ">

                      </div>
                      
                     
                      
                    </div>
                    
                    
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Mot de passe </label>
                      <div class="col-sm-4">
                      
                      <div class="input-group">
      <span class="input-group-addon">
        <input type="checkbox"  onclick="gocheck(id);" id="check_nbre_jr" name="check_pwd" aria-label="...">
      </span>
      <input type="password" value=""  name="passeword" id="passeword" class="form-control"  disabled="disabled"  placeholder="Mot de passe de l'utilisateur">
    </div>
                      </div>
                      
                      <label for="inputEmail3" class="col-sm-2 control-label">Confirmer mot de passe</label>
                      <div class="col-sm-4">
                        <input type="password" value="" name="confirmPassword"  id="confirmPassword" class="form-control"  disabled="disabled"  placeholder="Confirmer le mot de passe">
                       
                      </div>
                      
                    </div>
                    
                    
                    
                    <div class="form-group">
                      
                      
                      <label for="inputEmail3" class="col-sm-2 control-label">Actif</label>
                      <div class="col-sm-4">
                        <input type="checkbox"  <?php if ($actif==1)echo 'checked="checked"' ;?>  onclick="gocheck(id);" id="check_nbre_jr" name="actif" aria-label="...">
                       
                      </div>
                      
                    </div>
                    
                     <input value="<?php echo $key ;?>"  name="key"  type="hidden" >
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                   <a href="<?php echo site_url('admin/utilisateur');?>"  class="btn btn-default cancel"  >Cancel</a>     
				   
				  
 
 
                     <input  type="submit"  value="Enregistrer" name="btnSave" id="btnSave" class="btn btn-success pull-right btnSave"/>
                     
                       <?php
 if ($this->session->flashdata('reposne_querry'))
 echo "<span  class='pull-right'>" . $this->session->flashdata('reposne_querry') . " &nbsp;&nbsp;</span>";
$this->session->set_flashdata('reposne_querry', '');
 ?>
                     
                  
                  </div><!-- /.box-footer -->
                </form>
								</div>
							</div>
						</div>


<div class="row">
							

							<div class="col-lg-12">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>Ajout d'un utlisateur</b></h4>
									

									
								</div>
							</div>
						</div>
                        
                        
						<div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">

                                    <h4 class="m-t-0 header-title"><b>Liste des Utilisateurs</b></h4>
                                    <!--<p class="text-muted font-13 m-b-30">
                                        Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
                                    </p>-->
                                     <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                    <thead>
                      <tr>
                      <th width="2%" ></th>
                      <th>Email  </th>
                      <th>Utilisateur </th>
                      <th>Profil  </th>
                      <th width=""></th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php
   					$i=0;
					foreach ($utilisateur as $liste) 
					{
						$i=$i+1;
						echo "<tr>
							  <td>".($i)."</td>
							 <td>".$liste->emailUsers."</td>
							  <td>".$liste->nomUsers ."  ".$liste->prenomUsers 	."</td>
							  <td>".$liste->Profil."</td>
							   <td align='right'  ><a href='".  site_url('admin/utilisateur/'.$liste->idUsers) ."' class='fa fa-pencil label label-info'> mod</a>&nbsp;";
							   if ($liste->actif!=1)
							 	 echo" <a href='".  site_url('admin/user_activer/'.$liste->idUsers.'/1') ."' onclick='go_activer(".$liste->idUsers.",0)' id='".$liste->idUsers."' class='fa fa-check label label-success '> activer &nbsp;&nbsp;&nbsp;&nbsp;</a>";
							  else
							  	 echo" <a href='".  site_url('admin/user_activer/'.$liste->idUsers.'/0') ."' onclick='go_activer(".$liste->idUsers.",1)' id='".$liste->idUsers."' class='fa fa-check label label-danger '> desactiver</a>";
							   
							  " </td>
							   
							 
							</tr>";
					   
					}
					
					
                    ?>
                      <!--<tr>
                        <td>Other browsers</td>
                        <td>All others</td>
                        <td>-</td>
                        <td>-</td>
                        <td>U</td>
                      </tr>-->
                    </tbody>
                    <!--<tfoot>
                      <tr>
                       <th width="2%" ></th>
                      <th>Login  </th>
                      <th>Utilisateur </th>
                      <th>Profil  </th>
                      <th width=""></th>
                      </tr>
                    </tfoot>-->
                  </table>
                                    
                                </div>
                            </div>
                        </div>



                    </div>
                    <!-- end container -->

                </div>
                <!-- end content -->
				
				
				      <script>
	 
	$(function() { <?php echo $notification; ?> }); 
	 function gocheck(id){
    if(document.getElementById(id).checked == true){
         document.getElementById('passeword').disabled = false;
		 document.getElementById('confirmPassword').disabled = false;
    }
    else{ 
	//document.getElementById("idform").elements["nbre_jr"].value = '0';
       document.getElementById('passeword').disabled = true;
	   document.getElementById('confirmPassword').disabled = true;
	  
    }
}
	 
	 
	 
	/* function go_activer(id,activer)
	 {
		 var baseURL = $('body').data('data-baseurl');
		 alert(baseURL);
		if(activer != 1)
		{
			 var baseURL = $('body').data('siteurl');
 			   window.location.href = baseURL+"/admin/user_activer/"+id+"/1";
		}
		else
		{ 
		 var baseURL = $('body').data('siteurl');
 			   window.location.href = baseURL+"/admin/user_activer/"+id+"/0";
		  
		}
	}*/
	 
	 
	 
/*var baseURL = $('body').data('siteurl');
  $('#bureau_id').html('<option>Chargement...</option>');  
 $.ajax({ type: "POST", url: baseURL+"/welcome/bureau_dune_agence/"+$('#agence_id').val(),
 success: function(msg){ 
 console.log(msg);
 $('#bureau_id').html(''); 
 $('#bureau_id').html(msg); 
 },
error: function(){ }});*/

 
	   

	  
	  
	  
/* $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });*/
	
	
/*		$(document).on('click','.btnSave',function(e) {
		
		
		   
		var elmtid=e.target.id;
		var pwd=document.getElementById('passeword').value;
		var pwd_conf= document.getElementById('confirmPassword').value;
		
		if (pwd==pwd_conf)
		document.getElementById("differentForm").submit();
		else
		alert(0);
		  
	});*/
	
	 
	$(document).on('click','.btn_sup',function(e) {
		
		
		   
		var elmtid=e.target.id;
		 bootbox.confirm("Confirmez vous la suppresion?  ", function(result) {
 			 if(result==true)
 			 {
 			   var baseURL = $('body').data('siteurl');
 			   window.location.href = baseURL+"/welcome/profil_droit_del/"+elmtid;
 			 }
			});
	});
</script>




<script>
      $(function () {
		  $('#example1').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/French.json"
        }
    } );
        
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
    


