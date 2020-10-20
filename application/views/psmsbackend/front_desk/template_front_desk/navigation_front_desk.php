            <!-- MENU SECTION -->
       <div id="left" >
             <div class="media user-media well-small">
                <a class="user-link" href="#">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url(); ?>psmsbackendtheme/img/user.gif" />
                </a>
                <br/>
                <div class="media-body">
                <h5 class="" style="color:black"> Front Desk Officer</h5>
                </div>
                <br/>
            </div>

            <ul id="menu" class="collapse">

                
                <li class="panel <?php if($nav == "dashboard"){ echo 'active';}else{ echo'';}?>">
                    <a href="<?php echo base_url(); ?>index.php/login_c/dashboard_fornt_desk">
                        <i class="icon-dashboard"></i> Dashboard
                    </a>                   
                </li>
                <li class="panel <?php if($nav == "customers"){ echo 'active';}else{ echo'';}?>">
                    <a href="<?php echo base_url(); ?>index.php/front_desk_c_view/customer_view" >
                        <i class="icon-user"></i> Customers                       
                    </a>                   
                </li>
                <li class="panel <?php if($nav == "suppliers"){ echo 'active';}else{ echo'';}?>">
                    <!-- <a href="<?php //echo base_url(); ?>index.php/supplier_c/supplier_view" >
                        <i class="icon-tasks"></i> Suppliers                       
                    </a> -->
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#supplier">
                        <i class="icon-building"></i> Suppliers
       
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="supplier">
                        <li class="<?php if($nav == "suppliers"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/front_desk_c_view/supplier_view"><i class="icon-angle-right"></i> Add Supplier </a>
                        </li>
                        <li class="<?php if($nav == "supplier_purchase"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/front_desk_c_view/supplier_purchase_view"><i class="icon-angle-right"></i> Supplier Purchase </a>
                        </li>
                        <li class="<?php if($nav == "serial nos"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/front_desk_c_view/serialno_view"><i class="icon-angle-right"></i> Serial Nos</a> 
                        </li>
                    </ul>                   
                </li>
                <li class="panel <?php if($nav == "warranty_details"){ echo 'active';}else{ echo'';}?>">
                    <a href="<?php echo base_url(); ?>index.php/front_desk_c_view/bill_m_tbl_view" >
                        <i class="icon-shopping-cart"></i> Sales Transaction                       
                    </a>                   
                </li>
                <li class="panel <?php if($nav == "parts_inventory"){ echo 'active';}else{ echo'';}?>">
                    <a href="<?php echo base_url(); ?>index.php/front_desk_c_view/parts_inventory_list" >
                        <i class="icon-hdd"></i> Parts Inventory                       
                    </a>                   
                </li>
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#job_trans">
                        <i class="icon-suitcase"></i> Job Transaction
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="job_trans">
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/front_desk_c_view/jobentry_view"><i class="icon-angle-right"></i> Job Entry </a></li>
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/front_desk_c_view/finished_not_collected_list"><i class="icon-angle-right"></i> Finished not Collected </a></li>
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/front_desk_c_view/order_finished_list"><i class="icon-angle-right"></i> Order Finished </a></li>
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/front_desk_c_view/job_estimation_list"><i class="icon-angle-right"></i> Estimations </a></li>
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/front_desk_c_view/on_hold_jobs_list"><i class="icon-angle-right"></i> On Hold Jobs </a></li>
                    <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/front_desk_c_view/on_hold_reject_job_list"><i class="icon-angle-right"></i> Rejected Jobs </a></li>
                        <!--<li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/front_desk_c_view/not_economical"><i class="icon-angle-right"></i> Not Economical </a></li>-->
                        
                    </ul>
                </li>
                
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#rma_trans">
                        <i class="icon-file"></i> Report Management 
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="rma_trans">
                        <li class="<?php if($nav == "Stock Inventory"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/front_desk_c_view/stock_inventory_report_view"><i class="icon-angle-right"></i> Stock Inventory </a></li>
                        <li class="<?php if($nav == "Job Report"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/front_desk_c_view/job_report_view"><i class="icon-angle-right"></i> Job Report</a></li>
                        
                    </ul>
                </li>  

            </ul>

        </div>
        <!--END MENU SECTION 