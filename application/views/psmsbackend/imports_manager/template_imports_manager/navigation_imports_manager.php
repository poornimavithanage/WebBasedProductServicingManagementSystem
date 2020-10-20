            <!-- MENU SECTION -->
       <div id="left" >
            <div class="media user-media well-small">
                <a class="user-link" href="#">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url(); ?>psmsbackendtheme/img/user.gif" />
                </a>
                <br/>
                <div class="media-body">
                <h5 class="" style="color:black"> Imports Manager</h5>
                </div>
                <br/>
            </div>

            <ul id="menu" class="collapse">                
                <li class="panel <?php if($nav == "dashboard"){ echo 'active';}else{ echo'';}?>">
                    <a href="<?php echo base_url(); ?>index.php/login_c/dashboard_storemgr">
                        <i class="icon-dashboard"></i> Dashboard
                    </a>                   
                </li>
                <li class="panel <?php if($nav == "RMA"){ echo 'active';}else{ echo'';}?>">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#RMA">
                        <i class="icon-suitcase"></i> RMA 
       
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="RMA">
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_manager_c_view/unassigned_rma_list"><i class="icon-angle-right"></i>Unassigned RMA &nbsp; <span class="<?php if($rma_unassigned_count >0 ){echo "label label-danger";}else{ echo "label label-warning";} ?>" style="margin-left: 24.2%;"><?php echo $rma_unassigned_count; ?></span> </a> </li>
                        
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_manager_c_view/pending_rma_list"><i class="icon-angle-right"></i>Pending RMA &nbsp; <span class="<?php if($rma_pending_count >0 ){echo "label label-danger";}else{ echo "label label-warning";} ?>" style="margin-left: 35.2%;"><?php echo $rma_pending_count; ?></span> </a> </li>
                        
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_manager_c_view/approved_rma_list"><i class="icon-angle-right"></i>Approved RMA &nbsp; <span class="<?php if($rma_approved_count >0 ){echo "label label-danger";}else{ echo "label label-warning";} ?>" style="margin-left: 31.2%;"><?php echo $rma_approved_count; ?></span> </a> </li>
                        
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_manager_c_view/sent_rma_list"><i class="icon-angle-right"></i>Sent RMA &nbsp; <span class="<?php if(0 >0 ){echo "label label-danger";}else{ echo "label label-warning";} ?>" style="margin-left: 47.4%;"><?php echo "0"; ?></span> </a> </li>
                        
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_manager_c_view/received_rma_list"><i class="icon-angle-right"></i>Received  RMA &nbsp; <span class="<?php if(0 >0 ){echo "label label-danger";}else{ echo "label label-warning";} ?>" style="margin-left: 32.4%;"><?php echo "0"; ?></span> </a> </li>
                        
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_manager_c_view/onhold_rma_list"><i class="icon-angle-right"></i>Onhold  RMA &nbsp; <span class="<?php if($rma_onhold_count >0 ){echo "label label-danger";}else{ echo "label label-warning";} ?>" style="margin-left: 39.4%;"><?php echo $rma_onhold_count; ?></span> </a> </li>
                        
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_manager_c_view/rejected_rma_list"><i class="icon-angle-right"></i>Rejected  RMA &nbsp; <span class="<?php if($rma_rejected_count >0 ){echo "label label-danger";}else{ echo "label label-warning";} ?>" style="margin-left: 34.4%;"><?php echo $rma_rejected_count; ?></span> </a> </li>
                     </ul>
                </li>
                
                <li class="panel <?php if($nav == "POO"){ echo 'active';}else{ echo'';}?>">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#POO">
                        <i class="icon-suitcase"></i> Parts on Order 
       
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="POO">
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_manager_c_view/pending_poo_list"><i class="icon-angle-right"></i>Pending POO &nbsp; <span class="<?php if($poo_pending_count >0 ){echo "label label-danger";}else{ echo "label label-warning";} ?>" style="margin-left: 35.2%;"><?php echo $poo_pending_count; ?></span> </a> </li>
                        
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_manager_c_view/approved_poo_list"><i class="icon-angle-right"></i>Approved POO &nbsp; <span class="<?php if($poo_approved_count >0 ){echo "label label-danger";}else{ echo "label label-warning";} ?>" style="margin-left: 31.2%;"><?php echo $poo_approved_count; ?></span> </a> </li>
                        
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_manager_c_view/sent_rma_list"><i class="icon-angle-right"></i>Sent POO &nbsp; <span class="<?php if(0 >0 ){echo "label label-danger";}else{ echo "label label-warning";} ?>" style="margin-left: 47.4%;"><?php echo "0"; ?></span> </a> </li>
                        
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_manager_c_view/received_rma_list"><i class="icon-angle-right"></i>Received  POO &nbsp; <span class="<?php if(0 >0 ){echo "label label-danger";}else{ echo "label label-warning";} ?>" style="margin-left: 32.4%;"><?php echo "0"; ?></span> </a> </li>
                        
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_manager_c_view/onhold_poo_list"><i class="icon-angle-right"></i>Onhold  POO &nbsp; <span class="<?php if($poo_onhold_count >0 ){echo "label label-danger";}else{ echo "label label-warning";} ?>" style="margin-left: 39.4%;"><?php echo $poo_onhold_count; ?></span> </a> </li>
                        
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_manager_c_view/rejecte_poo_list"><i class="icon-angle-right"></i>Rejected  POO &nbsp; <span class="<?php if($poo_rejected_count >0 ){echo "label label-danger";}else{ echo "label label-warning";} ?>" style="margin-left: 34.4%;"><?php echo $poo_rejected_count; ?></span> </a> </li>
                     </ul>
                </li>

            </ul>
        </div>
        <!--END MENU SECTION 