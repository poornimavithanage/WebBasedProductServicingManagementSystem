            <!-- MENU SECTION -->
       <div id="left" >
            <div class="media user-media well-small">
                <a class="user-link" href="#">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url(); ?>psmsbackendtheme/img/user.gif" />
                </a>
                <br/>
                <div class="media-body">
                <h5 class="" style="color:black"> Service Manager</h5>
                </div>
                <br/>
            </div>

            <ul id="menu" class="collapse">                
                <li class="panel <?php if($nav == "dashboard"){ echo 'active';}else{ echo'';}?>">
                    <a href="<?php echo base_url(); ?>index.php/service_manager_c_view/dashboard_storemgr">
                        <i class="icon-dashboard"></i> Dashboard
                    </a>                   
                </li>
                <li class="panel <?php if($nav == "estimations"){ echo 'active';}else{ echo'';}?>">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#estimations">
                        <i class="icon-suitcase"></i> Estimations
       
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="estimations">
                        <li class="<?php if($nav == "estimations"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/service_manager_c_view/new_estimation_list"><i class="icon-angle-right"></i>New Estimations &nbsp; <span class="label label-danger" style="margin-left: 27.1%"><?php echo $new_estimation_count; ?></span> </a> </li>
                        <li class="<?php if($nav == "estimations"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/service_manager_c_view/pending_estimation_list"><i class="icon-angle-right"></i>Pending Estimations &nbsp; <span class="label label-danger" style="margin-left: 14.2%"><?php echo $pending_estimation_count; ?></span> </a> </li>
<!--                        <li class="<?php if($nav == "estimations"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/service_manager_c_view/approved_estimation_list"><i class="icon-angle-right"></i>Approved Estimations &nbsp; <span class="label label-danger" style="margin-left: 9.7%"><?php echo $approved_estimation_count; ?></span> </a> </li>
                        <li class="<?php if($nav == "estimations"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/service_manager_c_view/rejected_estimation_list"><i class="icon-angle-right"></i>Rejected Estimations &nbsp; <span class="label label-danger" style="margin-left: 12.2%"><?php echo $rejected_estimation_count; ?></span> </a> </li>                      -->
                    </ul>
                </li>
<!--                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#rma">
                        <i class="icon-suitcase"></i> RMA
       
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="rma">
                        <li class="<?php if($nav == "rma"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/service_manager_c_view/new_rma_list"><i class="icon-angle-right"></i>New RMA &nbsp; <span class="label label-danger" style="margin-left: 48.2%;"><?php echo $new_estimation_count; ?></span> </a> </li>
                        <li class="<?php if($nav == "rma"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/service_manager_c_view/pending_rma_list"><i class="icon-angle-right"></i>Pending RMA &nbsp; <span class="label label-danger" style="margin-left: 36.2%;"><?php echo $pending_estimation_count; ?></span> </a> </li>
                        <li class="<?php if($nav == "rma"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/service_manager_c_view/received_rma_list"><i class="icon-angle-right"></i>Received RMA &nbsp; <span class="label label-danger" style="margin-left: 33.2%;"><?php echo $approved_estimation_count; ?></span> </a> </li>                  
                    </ul>
                </li>-->
<!--                <li class="panel <?php if($nav == "beyond_repair"){ echo 'active';}else{ echo'';}?>">
                    <a href="#">
                        <i class="icon-dashboard"></i> Beyond Repair
                    </a>                   
                </li>
                <li class="panel <?php if($nav == "=ner"){ echo 'active';}else{ echo'';}?>">
                    <a href="#">
                        <i class="icon-dashboard"></i> Not Economical Repair
                    </a>                   
                </li>-->

            </ul>

        </div>
        <!--END MENU SECTION 