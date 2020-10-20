            <!-- MENU SECTION -->
       <div id="left" >
            <div class="media user-media well-small">
                <a class="user-link" href="#">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url(); ?>psmsbackendtheme/img/user.gif" />
                </a>
                <br/>
                <div class="media-body">
                <h5 class="" style="color:black"> Technician</h5>
                </div>
                <br/>
            </div>

            <ul id="menu" class="collapse">

                
                <li class="panel <?php if($nav == "dashboard"){ echo 'active';}else{ echo'';}?>">
                    <a href="<?php echo base_url(); ?>index.php/login_c/dashboard_technician">
                        <i class="icon-dashboard"></i> Dashboard
                    </a>                   
                </li>
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#jobs">
                        <i class="icon-suitcase"></i> Job Transaction 
       
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="jobs">
                      


                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/technician_c_view/job_new_view"><i class="icon-angle-right"></i> New Jobs &nbsp; <span class="label label-danger" style="margin-left: 31.2%;"><?php echo $new_job_count; ?></span> </a> </li>

                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/technician_c_view/job_card_list_assigned_to_me_page"><i class="icon-angle-right"></i> Assigned to me &nbsp; <span class="label label-warning" style="margin-left: 13.4%;"><?php echo $assigned_to_me_job_count; ?></span> </a> </li>

                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/technician_c_view/job_card_list_store_parts_recieved_page"><i class="icon-angle-right"></i> Store Parts Received &nbsp; <span class="label label-warning" style="margin-left: -5.6%;"><?php echo $store_parts_recieved_count; ?></span> </a> </li>
                        
<!--                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/technician_c_view/jobentry_view"><i class="icon-angle-right"></i> Parts on Order &nbsp; <span class="label label-success" style="margin-left: 16.2%;">4</span> </a> </li>-->

                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/technician_c_view/my_completed_job_list"><i class="icon-angle-right"></i> My Completed Jobs &nbsp; <span class="label label-primary"><?php echo $store_my_completed_job_count; ?></span> </a> </li>

<!--                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/technician_c_view/jobentry_view"><i class="icon-angle-right"></i> All Completed Jobs &nbsp; <span class="label label-default" style="margin-left: 1.4%;">4</span> </a> </li>-->
                        
                        

                        
                    </ul>
                </li>

            </ul>

        </div>
        <!--END MENU SECTION 