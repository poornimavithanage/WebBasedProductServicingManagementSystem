            <!-- MENU SECTION -->
       <div id="left" >
            <div class="media user-media well-small">
                <a class="user-link" href="#">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url(); ?>psmsbackendtheme/img/user.gif" />
                </a>
                <br/>
                <div class="media-body">
                <h5 class="" style="color:black"> Administrator</h5>
                </div>
                <br/>
            </div>

            <ul id="menu" class="collapse">

                
                <li class="panel <?php if($nav == "dashboard"){ echo 'active';}else{ echo'';}?>">
                    <a href="<?php echo base_url(); ?>index.php/admin/index">
                        <i class="icon-dashboard"></i> Dashboard
                    </a>                   
                </li>
                <li class="panel <?php if($nav == "customers"){ echo 'active';}else{ echo'';}?>">
                    <a href="<?php echo base_url(); ?>index.php/customer_c/customer_view" >
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
                        <li class="<?php if($nav == "suppliers"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/supplier_c/supplier_view"><i class="icon-angle-right"></i> Add Supplier </a>
                        </li>
                        <li class="<?php if($nav == "supplier_purchase"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/supplier_c/supplier_purchase_view"><i class="icon-angle-right"></i> Supplier Purchase </a>
                        </li>
                        <li class="<?php if($nav == "serial nos"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/serialno_c/serialno_view"><i class="icon-angle-right"></i> Serial Nos</a>
                        </li>
                    </ul>                   
                </li>
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#rma_trans">
                        <i class="icon-cogs"></i> RMA 
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="rma_trans">
                        <li class="<?php if($nav == "RMA"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/rma_c/rma_view"><i class="icon-angle-right"></i> Add RMA </a></li>
                        <li class="<?php if($nav == "RMA defective"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/rma_defective_c/rma_defective_view"><i class="icon-angle-right"></i> RMA Defective</a></li>
                        
                    </ul>
                </li>                
                <li class="panel <?php if($nav == "parts_inventory"){ echo 'active';}else{ echo'';}?>">
                    <a href="<?php echo base_url(); ?>index.php/parts_inventory_c/parts_inventory_list" >
                        <i class="icon-hdd"></i> Parts Inventory                       
                    </a>                   
                </li>
                <li class="panel <?php if($nav == "backup entry"){ echo 'active';}else{ echo'';}?>">
                    <a href="<?php echo base_url(); ?>index.php/backupentry_c/backupentry_view" >
                        <i class="icon-hdd"></i> Backup Entry                       
                    </a>                   
                </li>
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">
                        <i class="icon-pencil"></i> Sub Menu
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="form-nav">
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/jobentry_c/jobentry_view"><i class="icon-angle-right"></i> Job Entry </a></li>
                        <li class="<?php if($nav == "jobs progress"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/job_progress_c/job_progress_view"><i class="icon-angle-right"></i> Job Progress </a></li>
                        <li class="<?php if($nav == "Estimates"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/estimates_c/estimates_view"><i class="icon-angle-right"></i> Estimates </a></li>
                        <li class="<?php if($nav == "Backup Inventory"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/backupinventory_c/backupinventory_view"><i class="icon-angle-right"></i> Backup Inventory </a></li>
                        
                    </ul>
                </li>
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#sales_trans">
                        <i class="icon-shopping-cart"></i> Sales Transaction
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="sales_trans">
                        <li class="<?php if($nav == "warranty_details"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/billing_c/sales_warranty_view"><i class="icon-angle-right"></i> Sales Warranty </a></li>
                        <li class="<?php if($nav == "products"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/products_c/products_view"><i class="icon-angle-right"></i> Products </a></li>
                        
                    </ul>
                </li>
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#job_trans">
                        <i class="icon-suitcase"></i> Job Transaction
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="job_trans">
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/jobentry_c/jobentry_view"><i class="icon-angle-right"></i> Job Entry </a></li>
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/jobentry_c/finished_not_collected_list"><i class="icon-angle-right"></i> Finished not Collected </a></li>
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/jobentry_c/order_finished_list"><i class="icon-angle-right"></i> Order Finished </a></li>
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/jobentry_c/job_estimation_list"><i class="icon-angle-right"></i> Estimations </a></li>
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/jobentry_c/beyond_repair"><i class="icon-angle-right"></i> Beyond Repair </a></li>
                        <li class="<?php if($nav == "jobs"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/jobentry_c/not_economical"><i class="icon-angle-right"></i> Not Economical </a></li>
                        
                    </ul>
                </li>
                
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#user_mgt">
                        <i class="icon-group"></i> User Management 
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="user_mgt">
                        <li class="<?php if($nav == "Technicians"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/technician_c/technician_view"><i class="icon-angle-right"></i> Technician Details </a></li>
                        <li class="<?php if($nav == "FDO"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/fdo_c/fdo_view"><i class="icon-angle-right"></i> Front Desk Officer Details </a></li>
                        <li class="<?php if($nav == "Imports Manager"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/imports_c/imports_officer_view"><i class="icon-angle-right"></i> Imports Officer Details</a></li>
                        <li class="<?php if($nav == "Manager"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/manager_c/manager_view"><i class="icon-angle-right"></i> Managers Details</a></li>
                        <li class="<?php if($nav == "Employee"){ echo 'active';}else{ echo'';}?>"><a href="<?php echo base_url(); ?>index.php/employee_c/employee_view"><i class="icon-angle-right"></i> Employee Details</a></li>
                        
                    </ul>
                </li>

            </ul>

        </div>
        <!--END MENU SECTION 