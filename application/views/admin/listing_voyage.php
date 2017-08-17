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
                                        <li><a href="#">Espace </a></li>
                                
                                        <li class="active">Recherche avancée voyage</li>
                                    </ol>
                                    <h4 class="page-title">Recherche avancée voyage</h4>
                                </div>
                            </div>
                        </div>



                        <div class="row">
							
<section class="section" id="faq" style="padding-top: 0px;">
    <div class="container">
      
	   <div class="row">
							

							<div class="col-lg-12">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>Recherche voyage</b></h4>
									

									<form class="form-horizontal" method="post" role="form" action="<?php echo site_url('admin/voyage');?>" data-parsley-validate novalidate>
										
                                                                            
                                                                                 
                                                                                 
                                                                                
                                                                                
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label class="col-md-2 control-label">Niveau d etudes</label>
                                                                                     
                                                                                </div>
                                                                                
                                                                                
                                                                                <div class="form-group">
                                                                                    <label class="col-md-2 control-label">Date de voyage</label>
                                                                                    <div class="col-md-10">
                                                                                        <div class="input-group">
												<input type="text" value="<?php if ($rechercher->datedecloture!='01-01-1970') echo $rechercher->datedecloture; ?>" class="form-control" placeholder="dd-mm-yyyy"  name="datedecloture" id="datepicker-autoclose2">
												<span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
											</div><!-- input-group -->
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                
                                                                                <div class="form-group">&nbsp;<br/><br/>
                                                                                    <?php /*?><label class="col-md-2 control-label">Non cloturées</label><?php */?>
                                                                                    <div class="col-md-10">
                                                                                        <?php /*?><div class="input-group"> <input type="checkbox" id="radio_candidat" value="candidat" name="type"  checked>
												<input type="text" value="<?php if ($rechercher->datedepublication!='01-01-1970') echo $rechercher->datedepublication; ?>" class="form-control" placeholder="dd-mm-yyyy"  name="datedepublication" id="datepicker-autoclose">
												
											</div><?php */?><!-- input-group -->
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="form-group">
											<div class="text-right col-sm-12">
											<input  type="submit"  value="Rechercher" name="btnSave" class="btn btn-primary "/>
												  <a href="<?php echo site_url('welcome/offre_emploi'); ?>"  class="btn btn-default cancel"  >Annuler</a>	
											</div>
										</div>
                                                                                
                                                                                
                                                                            </div>                                                                            <div class="col-md-6"></div>    

                                                                            
                                                                            <div class="form-group">
												
                                                                            </div>
																													
									</form>
								</div>
							</div>
						</div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Liste des voyages</b></h4>
                                    <!--<p class="text-muted font-13 m-b-30">
                                        Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
                                    </p>-->

                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                
                                                <th>Poste</th>
                                                <th>Nb. Postes</th>
                                                <th>Lieu</th>
                                                <th>Clôture</th>
                                                <th>Statut</th>
												<th>Détails</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
												$date = new DateTime('now');
        $currentDate = $date->format('Y-m-d');
												
                                                foreach ($top50offres as $offre ){
                                                ?>
											<tr>
                                                
                                                <td><?php echo $offre->posteOffre; ?></td>
                                                <td><?php echo $offre->nombrePostesOffre; ?></td>
                                                <td><?php echo $offre->lieuTravailOffre; ?></td>
                                                <td><?php echo date('d-m-Y',strtotime($offre->dateClotureOffre)) ; ?></td>
                                                <td>
                                                    <?php 
                                                        
                                                        if($currentDate<=$offre->dateClotureOffre){
                                                            $label = "success";
                                                            $text = "en cours";
                                                        } 
                                                        else
                                                        {
                                                            
															$label="danger";
                                                            $text = "cloture";
                                                            
															
                                                        }
                                                    ?>
                                                    
                                                    <span class="label label-<?php echo $label; ?>"><?php echo $text; ?></span></td>
													<td><a href="<?php echo site_url('admin/detailOffre/'.$offre->idOffre); ?>"><span class="label label-default">En savoir plus</span></a>&nbsp;<a  href="<?php 
													$data_session = $this->session->userdata("sysuser");
													if (trim(array_search("uc_conseiller_07", $data_session["droit"]))!="")
													 echo site_url('admin/traiterOffre/'.$offre->idOffre);
													 else
													 echo site_url('admin/pas_droit');
													 
													  ?>"><span class="label label-primary">Traiter</span></a></td>
                                            </tr>
											  <?php   } ?>
                                           
                                        </tbody>
                                        <!--<tfoot>
                                            <tr>
                                                <td colspan="6"></td>
                                                
                                            </tr>   
                                        </tfoot>-->
                                    </table>
                                </div>
                            </div>
                        </div>
	  
	 
<!--
      <div class="row">
        <div class="col-md-5 col-md-offset-1">
          <!-- Question/Answer
          <div class="animated fadeInLeft wow" data-wow-delay=".1s">
            <h4 class="question" data-wow-delay=".1s">What is Lorem Ipsum?</h4>
            <p class="answer">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
          </div>

          <!-- Question/Answer 
          <div class="animated fadeInLeft wow" data-wow-delay=".3s">
            <h4 class="question">Why use Lorem Ipsum?</h4>
            <p class="answer m-b-0">Lorem ipsum dolor sit amet, in mea nonumes dissentias dissentiunt, pro te solet oratio iriure. Cu sit consetetur moderatius intellegam, ius decore accusamus te. Ne primis suavitate disputando nam. Mutat convenirete.</p>
          </div>

        </div>
        <!--/col-md-5 

        <div class="col-md-5">
          <!-- Question/Answer
          <div class="animated fadeInRight wow" data-wow-delay=".2s">
            <h4 class="question">Is safe use Lorem Ipsum?</h4>
            <p class="answer">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
          </div>

          <!-- Question/Answer 
          <div class="animated fadeInRight wow" data-wow-delay=".4s">
            <h4 class="question">When can be used?</h4>
            <p class="answer m-b-0">Lorem ipsum dolor sit amet, in mea nonumes dissentias dissentiunt, pro te solet oratio iriure. Cu sit consetetur moderatius intellegam, ius decore accusamus te. Ne primis suavitate disputando nam. Mutat convenirete.</p>
          </div>

        </div>
        <!--/col-md-5-->
      </div>

  <!--  </div>-->
  </section>
								</div>
							</div>
						</div>


                        
                        
						



                    </div>
                    <!-- end container -->

                </div>
                <!-- end content -->
				
				
				      


