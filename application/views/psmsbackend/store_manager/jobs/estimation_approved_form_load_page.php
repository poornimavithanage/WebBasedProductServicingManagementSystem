<!DOCTYPE html>
<html lang="en">

    <head>

        <!-- META -->
        <?php $this->load->view('psmsbackend/template/meta'); ?>
        <!-- END META -->
        <!-- Core CSS -->
        <?php $this->load->view('psmsbackend/template/head_css'); ?>
        <!-- END Core CSS -->
        <!-- Page Level CSS -->
        <!--<link href="<?php //echo base_url();                                                      ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
        <link href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap.css" rel="stylesheet"/>
        <style>
            .modal-dialog {
                width: 60%;
                /*   height: 100%; */
                padding: 10%;
            }

            .modal-content {
                height: 100%;
                border-radius: 0;
            }

            html {
                overflow-x: hidden;
            }

        </style>
        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/screen.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>



    </head>
    <body class="padTop53 " >

        <!-- MAIN WRAPPER -->
        <div id="wrap">


            <!-- HEADER SECTION -->
            <?php $this->load->view('psmsbackend/template/header'); ?>
            <!-- END HEADER SECTION -->

            <!-- MENU SECTION -->
            <?php $this->load->view('psmsbackend/store_manager/template_store_manager/navigation_store_manager'); ?>
            <!--END MENU SECTION -->

            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height:1200px;">
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Dashboard</a></li>
                                <li><a style="text-decoration: none;" href="#" class="di">Assign job card</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/store_mgr_c_view/job_card_list_assigned_to_me_page/" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <hr>
                            </div>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col-md-12">
                            <form id="sent_to_technician_estimation_approved_form" class="form-horizontal" method="POST" action="">
                                <div class="row" style="margin-left: -0.5%;">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="job_id">Job Id</label>
                                                <input type="text" class="form-control" id="job_id" name="job_id" placeholder="Job Id" required="" readonly="" value="<?php echo $job_info[0]->job_id; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 -->
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="job_created_date">Job Created Date</label>
                                                <input type="text" class="form-control" id="job_created_date" name="job_created_date" required="" readonly="" value="<?php echo $job_info[0]->job_date; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="job_assigned_date">Job Assigned Date</label>
                                                <input type="text" class="form-control" id="job_assigned_date" name="job_assigned_date" required="" readonly="" value="<?php echo $job_info[0]->job_date; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="customer_id">Customer ID</label>
                                                <input type="text" class="form-control" id="customer_id" name="customer_id" required="" readonly="" value="<?php echo $job_info[0]->customer_id; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="warranty_type">Warranty Type</label>
                                                <input type="text" class="form-control" id="warranty_type" name="warranty_type" required="" readonly="" value="<?php echo $job_info[0]->warranty_type; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                    </div><!-- /.col-md-12 --> 
                                </div><!-- /.row -->

                                <div class="row" style="margin-left: -0.5%;">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <input type="text" class="form-control" id="category" name="category" placeholder="Job Id" required="" readonly="" value="<?php echo $job_info[0]->category; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 -->
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="make">Make</label>
                                                <input type="text" class="form-control" id="make" name="make" required="" readonly="" value="<?php echo $job_info[0]->make; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="model">Model</label>
                                                <input type="text" class="form-control" id="model" name="model" required="" readonly="" value="<?php echo $job_info[0]->model; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="serial_no">Serial No</label>
                                                <input type="text" class="form-control" id="serial_no" name="serial_no" required="" readonly="" value="<?php echo $job_info[0]->serial_no; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                    </div><!-- /.col-md-12 --> 
                                </div><!-- /.row -->

                                <div class="row" style="margin-left: -0.5%;">
                                    <div class="col-md-12">
                                        <div class="col-md-4" style="">
                                            <div class="form-group">
                                                <label for="problem_description">Problem Description</label>
                                                <textarea placeholder="Problem Description" id="problem_description" name="problem_description" rows="3" cols="5" class="form-control" readonly=""><?php echo $job_info[0]->problem_description ?></textarea>
                                            </div>
                                        </div><!-- /.col-lg-3 -->     
                                        
                                        <div class="col-md-2" style="margin-left: 5.5%;">
                                            <div class="form-group">
                                                <label for="status">Job Status</label>
                                                <input style="color: red" type="text" class="form-control" id="status" name="status" required="" readonly="" value="<?php echo $job_info[0]->current_status; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 

                                       

                                    </div> 
                                </div>

                                <div class="row" style="margin-left: -0.5%;">
                                    <div class="col-md-12">
                                        <hr>
                                    </div><!-- /.col-md-12 --> 
                                </div>

                                <div class="row" style="margin-left: -0.5%;">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="pop_no">POP No</label>
                                                <input type="text" class="form-control" id="pop_no" name="pop_no" required="" readonly="" value="<?php echo $supplier_purchase_info[0]->sales_order_no; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 1.5%">
                                            <div class="form-group">
                                                <label for="pop_date">POP Date</label>
                                                <input type="text" class="form-control" id="pop_date" name="pop_date" required="" readonly="" value="<?php echo $supplier_purchase_info[0]->sales_date; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                    </div><!-- /.col-md-12 --> 
                                </div>

                                <div class="row" style="margin-left: -0.5%;">
                                    <div class="col-md-12">
                                        <div class="col-md-2 hide">
                                            <div class="form-group">
                                                <label for="supplier_id">Supplier ID</label>
                                                <input type="text" class="form-control" id="supplier_id" name="supplier_id" required="" readonly="" value="<?php echo $supplier_purchase_info[0]->supp_id; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 -->
                                        <div class="col-md-2" style="">
                                            <div class="form-group">
                                                <label for="supplier_name">Supplier Name</label>
                                                <input type="text" class="form-control" id="supplier_name" name="supplier_name" required="" readonly="" value="<?php echo $supplier_info[0]->supp_name; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 -->
                                        <div class="col-md-3" style="margin-left: 1.5%">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea placeholder="Onhold Note" id="address" name="address" cols="8" class="form-control" readonly=""><?php echo $supplier_info[0]->supp_address; ?></textarea>
                                            </div>
                                        </div><!-- /.col-lg-3 -->
                                        <div class="col-md-2" style="margin-left: 1.5%">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" required="" readonly="" value="<?php echo $supplier_info[0]->sup_email; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 -->
                                        <div class="col-md-2" style="margin-left: 1.5%">
                                            <div class="form-group">
                                                <label for="phone_no">Phone no</label>
                                                <input type="text" class="form-control" id="phone_no" name="phone_no" required="" readonly="" value="<?php echo $supplier_info[0]->sup_contact; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 -->
                                        <div class="col-md-2" style="margin-left: 1.5%">
                                            <div class="form-group">
                                                <label for="fax_no">Fax no</label>
                                                <input type="text" class="form-control" id="fax_no" name="fax_no" required="" readonly="" value="<?php echo $supplier_info[0]->fax; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 -->
                                    </div><!-- /.col-md-12 --> 
                                </div>

                                <div class="row" style="margin-top: 1%;">
                                    <div class="col-md-12">
                                        <div class="col-lg-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <strong>Repair Information</strong>
                                                </div>
                                                <div class="panel-body" >
                                                    <table class="table table-bordered table-hover table-sortable table-responsive" id="tab_logic">
                                                        <thead>
                                                            <tr>
                                                                <!-- <th class="text-center hide">
                                                                    Job Id
                                                                </th> -->
                                                                <th class="text-center">
                                                                    Part Ref Code
                                                                </th>
                                                                <th class="text-center">
                                                                    Part No
                                                                </th>
                                                                <th class="text-center">
                                                                    Part Description
                                                                </th>
                                                                <th class="text-center">
                                                                    Requested Qty
                                                                </th>
                                                                <th class="text-center">
                                                                    Store Qty
                                                                </th>
                                                                <th class="text-center">
                                                                    Availability
                                                                </th>
                                                                <!--<th class="text-center">
                                                                    RMA Applicability
                                                                </th> -->
                                                                <th>
                                                                    Order Type
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $i = 0;

                                                            foreach ($job_repair_info as $repair_info) {

                                                                echo "<tr id='addr" . $i . "' data-id='" . $i . "' class=''>";

                                                                echo "<td data-id='part_ref_code'>
                                                                   <input type='text' value='" . $repair_info->part_ref_code . "'  id='part_ref_code" . $i . "' name='part_ref_code[]' class='form-control' readonly=''/>
                                                                    </td>";

                                                                echo "<td data-id='part_no'>
                                                                    <input type='text' id='part_no" . $i . "' name='part_no[]' class='form-control' value='" . $repair_info->part_no . "' readonly/>
                                                                    </td>";

                                                                echo "<td data-id='part_description'>
                                                                    <input type='text' id='part_description" . $i . "' name='part_description[]' class='form-control' value='" . $repair_info->part_description . "' readonly/>
                                                                    </td>";

                                                                echo "<td data-id='qty'>
                                                                    <p>$repair_info->qty</p>
                                                                    <input type='text' id='qty" . $i . "' name='qty[]' class='form-control hide' value='" . $repair_info->qty . "' readonly/>
                                                                    </td>";
                                                                echo "<td data-id='store_qty'>
                                                                    <p>$repair_info->store_qty</p>
                                                                    <input type='text' id='store_qty" . $i . "' name='store_qty[]' class='form-control hide' value='" . $repair_info->store_qty . "' readonly/>
                                                                    </td>";

                                                                echo "<td data-id=''>";

                                                                if ($repair_info->store_qty >= $repair_info->qty) {
                                                                    echo "<p style='color:#15d515;'>Available</p>";
                                                                    echo "<input type='text' id='availability" . $i . "' name='availability[]' class='hide form-control availability' value='Available' readonly/>";
                                                                } else if ($repair_info->store_qty < $repair_info->qty && $repair_info->store_qty != 0) {
                                                                    echo "<p style='color:orange;'>Insuffient Quantity</p>";
                                                                    echo "<input type='text' id='availability" . $i . "' name='availability[]' class='hide form-control availability' value='Insuffient Quantity' readonly/>";
                                                                } else if ($repair_info->store_qty == 0) {
                                                                    echo "<p style='color:red'>Not Available</p>";
                                                                    echo "<input type='text' id='availability" . $i . "' name='availability[]' class='hide form-control availability' value='Not Available' readonly/>";
                                                                }



                                                                echo "</td>";

                                                                echo "<td data-id=''>";

                                                                if ($repair_info->rma_applicability == "Yes" && $job_info[0]->warranty_type == "Company Warranty") {
                                                                    echo "<p style=''>No</p>";
                                                                    echo "<input type='text' id='rma_applicability" . $i . "' name='rma_applicability[]' class='hide form-control' value='No' readonly/>";
                                                                } else if ($repair_info->rma_applicability == "No") {
                                                                    echo "<p style=''>No</p>";
                                                                    echo "<input type='text' id='rma_applicability" . $i . "' name='rma_applicability[]' class='hide form-control' value='No' readonly/>";
                                                                } else if ($repair_info->rma_applicability == "Yes" && $job_info[0]->warranty_type == "Supplier Warranty") {
                                                                    echo "<p style=''>Yes</p>";
                                                                    echo "<input type='text' id='rma_applicability" . $i . "' name='rma_applicability[]' class='hide form-control' value='Yes' readonly/>";
                                                                } else if ($repair_info->rma_applicability == "Yes" && $job_info[0]->warranty_type == "Customer Repair") {
                                                                    echo "<p style=''>No</p>";
                                                                    echo "<input type='text' id='rma_applicability" . $i . "' name='rma_applicability[]' class='hide form-control' value='No' readonly/>";
                                                                }
                                                                echo "</td>";


//                                                                echo "<td data-id='rma_applicability'>
//                                                                    <p style=''>$repair_info->rma_applicability</p>
//                                                                    <input type='text' id='rma_applicability" . $i . "' name='rma_applicability[]' class='hide form-control' value='" . $repair_info->rma_applicability . "' readonly/>
//                                                                    </td>";
                                                                if ($repair_info->store_qty >= $repair_info->qty && $repair_info->rma_applicability == "Yes" && $job_info[0]->warranty_type == "Company Warranty") {
                                                                    echo"<td>";
                                                                    echo"<p>Not Applicable</p>";
                                                                    echo "<input type='text' id='order_type" . $i . "' name='order_type[]' class='hide form-control' value='Not Applicable' readonly/>";
                                                                    echo"</td>";
                                                                } else if ($repair_info->store_qty >= $repair_info->qty && $repair_info->rma_applicability == "No") {
                                                                    echo"<td>";
                                                                    echo"<p>Not Applicable</p>";
                                                                    echo "<input type='text' id='order_type" . $i . "' name='order_type[]' class='hide form-control' value='Not Applicable' readonly/>";
                                                                    echo"</td>";
                                                                } else if ($repair_info->store_qty >= $repair_info->qty && $repair_info->rma_applicability == "Yes" && $job_info[0]->warranty_type == "Customer Repair") {
                                                                    echo"<td>";
                                                                    echo"<p>Not Applicable</p>";
                                                                    echo "<input type='text' id='order_type" . $i . "' name='order_type[]' class='hide form-control' value='Not Applicable' readonly/>";
                                                                    echo"</td>";
                                                                } else if ($repair_info->store_qty >= $repair_info->qty && $repair_info->rma_applicability == "Yes" && $job_info[0]->warranty_type == "Supplier Warranty") {
                                                                    echo "<td>";
                                                                    echo "<select onchange='OrderTypeValue(this)' name='order_type[]' id='order_type" . $i . "' class='form-control' >";
                                                                    echo "<option value='' disabled selected>select order type</option>";
                                                                    echo "<option value='Special Order'>Special Order</option>";
                                                                    echo "<option value='RMA'>RMA Order</option>";
                                                                    echo "<option value='Customer Repair'>Customer Repair</option>";
                                                                    echo "<option value='Customer Repair + Parts on Order'>Customer Repair + Parts on Order</option>";
                                                                    echo "</select>";
                                                                    echo "</td>";
                                                                } else if ($repair_info->store_qty < $repair_info->qty && $repair_info->rma_applicability == "Yes" && $job_info[0]->warranty_type == "Supplier Warranty") {
                                                                    echo "<td>";
                                                                    echo "<select onchange='OrderTypeValue(this)' name='order_type[]' id='order_type" . $i . "' class='form-control' >";
                                                                    echo "<option value='' disabled selected>select order type</option>";
                                                                    echo "<option value='Special Order'>Special Order</option>";
                                                                    echo "<option value='RMA'>RMA Order</option>";
                                                                    echo "<option value='Customer Repair'>Customer Repair</option>";
                                                                    echo "<option value='Customer Repair + Parts on Order'>Customer Repair + Parts on Order</option>";
                                                                    echo "</select>";
                                                                    echo "</td>";
                                                                } else if ($repair_info->store_qty < $repair_info->qty && $repair_info->rma_applicability == "Yes" && $job_info[0]->warranty_type == "Company Warranty") {
                                                                    echo "<td>";
                                                                    echo "<select onchange='OrderTypeValue(this)' name='order_type[]' id='order_type" . $i . "' class='form-control' >";
                                                                    echo "<option value='' disabled selected>select order type</option>";
                                                                    echo "<option value='Special Order'>Special Order</option>";
                                                                    echo "<option value='RMA'>RMA Order</option>";
                                                                    echo "<option value='Customer Repair'>Customer Repair</option>";
                                                                    echo "<option value='Customer Repair + Parts on Order'>Customer Repair + Parts on Order</option>";
                                                                    echo "</select>";
                                                                    echo "</td>";
                                                                } else if ($repair_info->store_qty < $repair_info->qty && $repair_info->rma_applicability == "No") {
                                                                    echo "<td>";
                                                                    echo "<select onchange='OrderTypeValue(this)' name='order_type[]' id='order_type" . $i . "' class='form-control' >";
                                                                    echo "<option value='' disabled selected>select order type</option>";
                                                                    echo "<option value='Special Order'>Special Order</option>";
                                                                    echo "<option value='RMA'>RMA Order</option>";
                                                                    echo "<option value='Customer Repair'>Customer Repair</option>";
                                                                    echo "<option value='Customer Repair + Parts on Order'>Customer Repair + Parts on Order</option>";
                                                                    echo "</select>";
                                                                    echo "</td>";
                                                                }
//                                                                echo "</td>";
//                                                                if ($repair_info->store_qty >= $repair_info->qty && $repair_info->rma_applicability == "No") {
//                                                                    echo"<td>";
//                                                                    echo"<p>Not Applicable</p>";
//                                                                    echo"</td>";
//                                                                } else {
//                                                                    echo "<td>";
//                                                                    echo "<select name='order_type[]' id='order_type" . $i . "' class='form-control' >";
//                                                                    echo "<option value='' disabled selected>select order type</option>";
//                                                                    echo "<option value='Special Order'>Special Order</option>";
//                                                                    echo "<option value='RMA'>RMA Order</option>";
//                                                                    echo "</select>";
//                                                                    echo "</td>";
//                                                                }

                                                                $i++;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!--/. panel with-nav-tabs panel-default -->
                                        </div><!-- /.col-lg-12 -->
                                    </div><!-- /.col-md-12 -->
                                </div><!--/.row-->



                                <div class="row" id="button_block">
                                    <div class="col-md-12 col-lg-offset-3">
                                        <div class="col-lg-1">
                                            <button class="btn btn-primary" id="send_to_rma" type="submit"> Sent to Technician</button>
                                        </div><!-- /.col-lg-1 --> 

                                    </div><!-- /.col-md-12 --> 
                                </div>
                            </form>
                            <div class="row" style="margin-top: 2%;">
                                <div class="container-fluid">
                                    <div class="col-md-12 hide" id="divmessage_1">
                                        <div id="spnmessage_1" class="alert alert-success alert-dismissible" role="alert">

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div><!--/. inner -->
            </div><!--END PAGE CONTENT -->
        </div><!--END MAIN WRAPPER -->



        <!-- FOOTER -->
        <?php $this->load->view('psmsbackend/template/footer'); ?>
        <!--END FOOTER -->
        <!-- GLOBAL SCRIPTS -->
        <?php $this->load->view('psmsbackend/template/head_js'); ?>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-daterangepicker-master/js/bootstrap-datepicker.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-daterangepicker-master/locales/bootstrap-datepicker.en-GB.min.js" type="text/javascript">
        </script>

        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-selectpicker/js/bootstrap-select.min.js" type="text/javascript">
        </script>


        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/js/plugins/sortable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/js/fileinput.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/js/locales/fr.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/js/locales/es.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/themes/explorer-fa/theme.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/themes/fa/theme.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

    </body>    
    
    <!--If Job warranty type is Customer Repair-->
    <script>
        $(document).ready(function () {
            baseurl = "http://localhost/psms/";
            $("#sent_to_technician_estimation_approved_form").submit(function (e) {
                e.preventDefault();
                if (!$(this).valid())
                    return false;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/store_mgr_c_view/send_to_technician_estimation_approved_job",
                    data: $("#sent_to_technician_estimation_approved_form").serialize(),
                    dataType: 'json',
                    success: function (data) {
//                            console.log(data);
                        if (data.final_result === "success") {
                            // $('#addjobform')[0].reset();
                            $("#spnmessage_1").removeAttr("class", "alert alert-danger");
                            $("#spnmessage_1").attr("class", "alert alert-success");
                            $("#spnmessage_1").html('<p><strong>Job sent to technician</strong></p>');
                            $("#divmessage_1").removeAttr("class", "hide");
                            $("#divmessage_1").fadeIn(1500);
                            $("#divmessage_1").delay(3500).fadeOut(2500);
                            setTimeout(function () {
                                //location.reload();
                                window.location.href = "<?php echo base_url(); ?>index.php/store_mgr_c_view/job_new_view";
                            }, 5000);
                        } else if (data.final_result === "unsuccess") {
                            $("#spnmessage_1").removeAttr("class", "alert alert-success");
                            $("#spnmessage_1").attr("class", "alert alert-danger");
                            $("#spnmessage_1").html('<p><strong>Unable to send to technician, please contact administrator, thank you!</strong></p>');
                            $("#divmessage_1").removeAttr("class", "hide");
                            $("#divmessage_1").fadeIn(1500);
                            $("#divmessage_1").delay(2500).fadeOut(1500);
                        }
                    }
                });
            });
        });
    </script>

    


</html>

