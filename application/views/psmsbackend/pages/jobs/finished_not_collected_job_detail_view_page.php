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
        <!--<link href="<?php //echo base_url();       ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
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

            .isDisabled {
                color: currentColor;
                cursor: not-allowed;
                opacity: 0.5;
                text-decoration: none;
            }
        </style>
        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/screen.css" rel="stylesheet" type="text/css"/>




    </head>
    <body class="padTop53 " >

        <!-- MAIN WRAPPER -->
        <div id="wrap">


            <!-- HEADER SECTION -->
            <?php $this->load->view('psmsbackend/template/header'); ?>
            <!-- END HEADER SECTION -->

            <!-- MENU SECTION -->
            <?php $this->load->view('psmsbackend/template/navigation'); ?>
            <!--END MENU SECTION -->

            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height:1200px;">
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Dashboard</a></li>
                                <li><a style="text-decoration: none;" href="#" class="di">Finished not Collected</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>index.php/jobentry_c/finished_not_collected_list" class="btn btn-round-sm btn-sm btn-warning">Go Back</a>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 457%;">
                                <a href="<?php echo base_url(); ?>index.php/jobentry_c/send_sms_finished_not_collected/<?php echo $job_repair_info[0]->job_id; ?>" class="btn btn-round-sm btn-sm btn-success">Send SMS</a>
                            </div>
                        </div>

                        <div class="col-md-2 <?php if($job_info[0]->sms_status === "Not Sent"){echo "hide";}else{echo"";}?>">
                            <div style="font-weight: bold; margin-left: 386%;">
                                <a href="<?php echo base_url(); ?>index.php/jobentry_c/order_finished/<?php echo $job_repair_info[0]->job_id; ?>" class="btn btn-round-sm btn-sm btn-danger">Order Finished</a>
                            </div>
                        </div>    
                    </div>
                
                    
                    <div class="row <?php
                    if ($page_msg === "sms_unsuccess") {
                        echo "";
                    } else {
                        echo "hide";
                    }
                    ?>" id="pg_msg_1">
                        <div class="container-fluid">
                            <div class="col-md-12" id="divmessage_4">
                                <div id="spnmessage_4" class="alert alert-warning alert-dismissible" role="alert">
                                    <strong>Unable to Order Finished!</strong> 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row <?php
                    if ($page_msg === "full_payment_success") {
                        echo "";
                    } else {
                        echo "hide";
                    }
                    ?>" id="pg_msg_1">
                        <div class="container-fluid">
                            <div class="col-md-12" id="divmessage_4">
                                <div id="spnmessage_4" class="alert alert-warning alert-dismissible" role="alert">
                                    <strong>Due payment completed</strong> 
                                </div>
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
                            <form id="job_complete_update_form" class="form-horizontal" method="POST" action="">
                                <div class="row" style="margin-left: -0.5%;">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="job_id">Job Id</label>
                                                <input type="text" class="form-control" id="job_id" name="job_id" placeholder="Job Id" required="" readonly="" value="<?php echo $job_repair_info[0]->job_id; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 -->
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="job_created_date">Job Created Date</label>
                                                <input type="text" class="form-control" id="job_created_date" name="job_created_date" required="" readonly="" value="<?php echo $job_repair_info[0]->created_date; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="job_assigned_date">Job Assigned Date</label>
                                                <input type="text" class="form-control" id="job_assigned_date" name="job_assigned_date" required="" readonly="" value="<?php echo $job_repair_info[0]->assigned_date; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="customer_id">Customer ID</label>
                                                <input type="text" class="form-control" id="customer_id" name="customer_id" required="" readonly="" value="<?php echo $job_repair_info[0]->customer_id; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="warranty_type">Warranty Type</label>
                                                <input type="text" class="form-control" id="warranty_type" name="warranty_type" required="" readonly="" value="<?php echo $job_repair_info[0]->warranty_type; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                    </div><!-- /.col-md-12 --> 
                                </div><!-- /.row -->

                                <div class="row" style="margin-left: -0.5%;">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <input type="text" class="form-control" id="category" name="category" placeholder="Job Id" required="" readonly="" value="<?php echo $job_repair_info[0]->category; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 -->
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="make">Make</label>
                                                <input type="text" class="form-control" id="make" name="make" required="" readonly="" value="<?php echo $job_repair_info[0]->make; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="model">Model</label>
                                                <input type="text" class="form-control" id="model" name="model" required="" readonly="" value="<?php echo $job_repair_info[0]->model; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="serial_no">Serial No</label>
                                                <input type="text" class="form-control" id="serial_no" name="serial_no" required="" readonly="" value="<?php echo $job_repair_info[0]->serial_no; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                    </div><!-- /.col-md-12 --> 
                                </div><!-- /.row -->

                                <div class="row" style="margin-left: -0.5%;">
                                    <div class="col-md-12">
                                        <div class="col-md-4" style="">
                                            <div class="form-group">
                                                <label for="problem_description">Problem Description</label>
                                                <textarea placeholder="Problem Description" id="problem_description" name="problem_description" rows="3" cols="5" class="form-control" readonly=""><?php echo $job_repair_info[0]->problem_description ?></textarea>
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                    </div> 
                                </div>

                                <div class="row" id="tbl_form" style="margin-top: 0.5%;">
                                    <div class="col-md-12">
                                        <div class="col-lg-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <strong>Repair Information</strong>
                                                </div>
                                                <div class="panel-body" id="">
                                                    <table class="table table-bordered table-hover table-sortable table-responsive" id="tab_logic">
                                                        <thead>
                                                            <tr >
                                                                <!-- <th class="text-center hide">
                                                                    Job Id
                                                                </th> -->
                                                                <th class="text-center">
                                                                    Actual Defect
                                                                </th>
                                                                <th class="text-center">
                                                                    Solution
                                                                </th>                                                                
                                                                <th class="text-center">
                                                                    Part No
                                                                </th>
                                                                <th class="text-center">
                                                                    Description
                                                                </th>
                                                                <th class="text-center" style="width: 80px;">
                                                                    Qty
                                                                </th>
                                                                <th class="text-center">
                                                                    Remarks
                                                                </th>
<!--                                                                <th class="text-center" >
                                                                    Action
                                                                </th>-->
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $i = 0;

                                                            foreach ($job_repair_info as $repair_info) {

                                                                echo "<tr id='addr" . $i . "' data-id='" . $i . "' class=''>";

                                                                echo "<td data-id='actual_defect'>
                                                                    <textarea placeholder='Actual Defect' id='actual_defect" . $i . "' name='actual_defect[]' rows='3' cols='5' class='form-control actual_defect' readonly=''>" . $repair_info->actual_defect . "</textarea>
                                                                        </td>";

                                                                echo "<td data-id='solution'>
                                                                    <textarea placeholder='Solution' id='solution" . $i . "' name='solution[]' rows='3' cols='5' class='form-control solution' readonly=''>" . $repair_info->solution . "</textarea>
                                                                    </td>";

//                                                                echo "<td class='dis'>
//                                                                    <input type='text' value='" . $repair_info->part_no . "  &nbsp;&nbsp;- " . $repair_info->part_description . "'  id='part_ref_code" . $i . "' name='part_ref_code[]' class='form-control disp' readonly=''/>
//                                                                    </td>";
//                                                                echo "<td data-id='part_ref_code' class='prt'>
//                                                                     <input type='number' id='part_ref_code" . $i . "' name='part_ref_code[]' class='form-control qty' placeholder='0' value='" . $repair_info->part_no . "  &nbsp;&nbsp;- " . $repair_info->part_description . "' readonly=''/>"
//                                                                        . "</td>";                                                                

                                                                echo "<td data-id='part_no' class=''>
                                                                    <input type='text' value='" . $repair_info->part_no . "' placeholder='Part No' id='part_no" . $i . "' name='part_no[]' class='form-control part_no' readonly=''/>
                                                                    </td>";

                                                                echo "<td data-id='part_description' class=''>
                                                                    <input type='text' value='" . $repair_info->part_description . "' placeholder='Part Description' id='part_description" . $i . "' name='part_description[]' class='form-control part_description' readonly=''/>
                                                                    </td>";

                                                                echo "<td data-id='qty'>
                                                                    <input type='text' id='qty" . $i . "' name='qty[]' class='form-control qty' placeholder='0' value='" . $repair_info->qty . "' readonly=''/>
                                                                    </td>";

                                                                echo "<td data-id='remarks'>
                                                                    <textarea placeholder='Remarks' id='remarks" . $i . "' name='remarks[]' rows='3' cols='5' class='form-control remarks' readonly=''>" . $repair_info->remarks . "</textarea>
                                                                    </td>";


//                                                                echo "<td data-id='del'>
//                                                                    <button name='del[]' id='del" . $i . "' class='del btn btn-danger btn-xs row-remove' type='button' value >Remove</button>
//                                                                    </td>";
                                                                $i++;
                                                            }
                                                            ?>

                                                        </tbody>
                                                    </table>
                                                </div><!--/. panel-body -->
                                                <div class="panel-footer">

                                                </div>                                                
                                            </div><!--/. panel with-nav-tabs panel-default -->
                                        </div><!-- /.col-lg-12 -->
                                    </div><!-- /.col-md-12 -->
                                </div><!--/.row-->

                                <div class="row hide" id="submit_reset_buttons">
                                    <div class="col-md-12 col-lg-offset-5">
                                        <div class="col-lg-1">
                                            <a href="<?php echo base_url(); ?>index.php/technician_c_view/complete_job_form_submit/<?php echo $job_repair_info[0]->job_id; ?>" class="btn btn-success">Complete Job</a>
                                            <!--<button class="btn btn-success" type="submit">Complete Job</button>-->
                                        </div><!-- /.col-lg-12 --> 
                                    </div><!-- /.col-md-12 --> 
                                </div>

                            </form>
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
        <!--<script src="<?php //echo base_url();       ?>psmsbackendtheme/plugins/dataTables/jquery.dataTables.js"></script>-->
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js" type="text/javascript"></script>
        <!--<script src="<?php //echo base_url();       ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>-->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable(); // jquery-bootstrap datatable 

            });
        </script>
        
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('#pg_msg_1').attr('class', 'row hide');
                }, 4000);
            });
        </script>

    </body>    
</html>
