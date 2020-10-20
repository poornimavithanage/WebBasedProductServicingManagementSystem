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
        <!--<link href="<?php //echo base_url();  ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
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
                                <li><a style="text-decoration: none;" href="#" class="di">Job Entry</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/jobentry_c/add_jobs_page_cus_search" class="btn btn-round-sm btn-sm btn-primary">Add Job</a>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="panel with-nav-tabs panel-default">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#activeJobs" data-toggle="tab">Active Jobs</a></li>
<!--                                            <li class=""><a href="#removedJobs" data-toggle="tab">Removed Jobs</a></li>-->
                                        </ul>
                                    </div>
                                    <div class="panel-body" >
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="activeJobs"><!-- 1st step: Add Tour Details Form -->

                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Job No</th>
                                                            <th>Customer ID</th>
                                                            <th>Category</th>
                                                            <th>Make</th>
                                                            <th>Model</th>
                                                            <th>Serial No</th>
                                                            <th>Repair Mode</th>
                                                            <th style="width: 21%">Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($active_jobs as $act_job) {

                                                            echo "<tr>";
                                                            echo "<td>" . $act_job->job_id . "</td>";
                                                            echo "<td>" . $act_job->customer_id . "</td>";
                                                            echo "<td>" . $act_job->category . "</td>";
                                                            echo "<td>" . $act_job->make . "</td>";
                                                            echo "<td>" . $act_job->model . "</td>";
                                                            echo "<td>" . $act_job->serial_no . "</td>";
                                                            echo "<td>" . $act_job->warranty_type . "</td>";
                                                            echo "<td>";
//                                                            echo "<a id='" . $act_job->job_id . "' href='#remove_confirmation_modal' data-toggle='modal' class='removeJob btn btn-warning btn-xs'><i class='icon-remove-circle'></i>&nbsp;Remove</a>&nbsp; &nbsp;";
//                                                            echo "<a id='" . $act_job->job_id . "' href='#editJobModal' data-toggle='modal' class='editJob btn btn-success btn-xs'><i class='icon-edit'></i>&nbsp;Edit</a>";
                                                            echo "<a href='". base_url()."/index.php/jobentry_c/generate_job_card/".$act_job->job_id."' class='btn btn-danger btn-xs'><i class='icon-file'></i>&nbsp;PDF</a>&nbsp; &nbsp;";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div><!--/. 1st step: P Type -->
                                            <div class="tab-pane fade" id="removedJobs"><!-- 2nd step: All Tours Table -->
                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Job No</th>
                                                            <th>Customer Name</th>
                                                            <th>Model</th>
                                                            <th>Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($deactive_jobs as $deact_job) {

                                                            echo "<tr>";
                                                            echo "<td>" . $deact_job->job_id . "</td>";
                                                            echo "<td>" . $deact_job->customer_id . "</td>";
                                                            echo "<td>" . $deact_job->model . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $deact_job->job_id . "' href='#restore_confirmation_modal' data-toggle='modal' class='restoreProduct btn btn-warning btn-xs'><i class='icon-remove-circle'></i>&nbsp;Restore</a>&nbsp; &nbsp;";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>										
                                            </div>
                                        </div><!--/. tab-content -->
                                    </div><!--/. panel-body -->
                                </div><!--/. panel with-nav-tabs panel-default -->
                            </div><!-- /.col-lg-12 -->
                        </div><!-- /.col-md-12 -->
                    </div><!--/.row-->




                </div><!--/. inner -->
            </div><!--END PAGE CONTENT -->
        </div><!--END MAIN WRAPPER -->


     

        <!-- remove job confirmation modal -->
        <div class="modal fade" id="remove_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Remove Job</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 hide" id="divmessageRemoveModal">
                                        <div id="spnmessageRemoveModal" class="alert alert-success alert-dismissible" role="alert">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Are you sure, you want to remove this job ? </strong></p>
                                    <form class="form-horizontal" role="form" id="removeJobModalForm" method="POST" action="">

                                        <div class="form-group field_p_id hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Model</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="job_id_remove_form" value="" name="job_id_remove_form" placeholder="Model" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-10">
                                                <div class="pull-left">
                                                    <input type="submit" class="btn btn-primary" value="Yes" />
                                                    <input type="button" class="btn btn-danger close_modal" data-dismiss="modal" value="No" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- restore job confirmation modal -->
        <div class="modal fade" id="restore_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Restore Job</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 hide" id="divmessageRestoreModal">
                                        <div id="spnmessageRestoreModal" class="alert alert-success alert-dismissible" role="alert">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Are you sure, you want to restore this job ? </strong></p>
                                    <form class="form-horizontal" role="form" id="restoreJobModalForm" method="POST" action="">

                                        <div class="form-group hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Job No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="job_id_restore_form" value="" name="job_id_restore_form" placeholder="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-10">
                                                <div class="pull-left">
                                                    <input type="submit" class="btn btn-primary" value="Yes" />
                                                    <input type="button" class="btn btn-danger close_modal" data-dismiss="modal" value="No" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- edit job modal -->
        <div class="modal fade" id="editJobModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Job</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 hide" id="divmessageEditJob">
                                        <div id="spnmessageEditJob" class="alert alert-success alert-dismissible" role="alert">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" role="form" id="editjobform" method="POST" action="">
                                        <!-- Text input-->
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Job No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="job_id" name="job_id" placeholder="Job No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Customer Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="customer_id" name="customer_id" placeholder="Customer Name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Address</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="cus_address" name="cus_address" placeholder="Address" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Invoice No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="invoice_id" name="invoice_id" placeholder="Invoice No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Job date</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="job_date" name="job_date" placeholder="Job date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Serial No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="serial_no" name="serial_no" placeholder="Serial No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Make</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="make" name="make" placeholder="Make" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Model</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="model" name="model" placeholder="Model" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Description</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="repair_description" name="repair_description" placeholder="Description" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Warranty Type</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="warranty_type" name="warranty_type">                                                
                                                    <option disabled selected value> - select warranty type- </option>
                                                    <option value="Supplier Warranty">Supplier Warranty</option>
                                                    <option value="Company Warranty">Company Warranty</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Backup Reason</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="backup_reason" name="backup_reason">
                                                    <option disabled selected value> - select backup reason - </option>
                                                    <option value="Under Warranty">Under Warranty</option>
                                                    <option value="Under Estimate">Under Estimate</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Backup Type</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="backup_type" name="backup_type">
                                                    <option disabled selected value> - select backup type - </option>
                                                    <option value="Customer Request">Customer Request</option>
                                                    <option value="Company Recommend">Company Recommend</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Sales Order No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="sales_order_no" name="sales_order_no" placeholder="Sales Order No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Technician Name</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="technician_id" name="technician_id">
                                                    <option disabled selected value> - select Technician Name - </option>
                                                    <option value="Amila Liyanage">Amila Liyanage</option>
                                                    <option value="Priyantha Liyanage">Priyantha Liyanage </option>
                                                    <option value="Jeewan Eranga">Jeewan Eranga </option>
                                                    <option value="S.D.Sampath">S.D.Sampath </option>
                                                    <option value="Supun Dias">Supun Dias </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Repair mode</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="repair_mode" name="repair_mode">
                                                    <option disabled selected value> - select Repair mode - </option>
                                                    <option value="Customer Repair">Customer Repair</option>
                                                    <option value="Warranty Repair">Warranty Repair</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Job Status</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="job_status" name="job_status">
                                                    <option disabled selected value> - select Job Status - </option>
                                                    <option value="WIP">WIP</option>
                                                    <option value="Estimated">Estimated </option>
                                                    <option value="NER">NER </option>
                                                    <option value="B/R ">B/R </option>
                                                    <option value="Parts on Order">Parts on Order</option>
                                                    <option value="Estimate-Approved">Estimate-Approved</option>
                                                    <option value="Finish Not Completed">Finish Not Completed</option>
                                                    <option value="Job Completed">Job Completed</option>
                                                    <option value="Auto Cancel Estimate">Auto Cancel Estimate</option>
                                                    <option value="Cancel by customer">Cancel by customer</option>
                                                    <option value="Re-Estimated">Re-Estimated</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-10">
                                                <div class="pull-left">
                                                    <input type="submit" class="btn btn-primary" value="Save" />
                                                    <input type="reset" class="btn btn-warning" value="Reset" />
                                                    <input type="button" class="btn btn-danger close_modal" data-dismiss="modal" value="Close" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <?php $this->load->view('psmsbackend/template/footer'); ?>
        <!--END FOOTER -->
        <!-- GLOBAL SCRIPTS -->
        <?php $this->load->view('psmsbackend/template/head_js'); ?>
        <!--<script src="<?php //echo base_url();  ?>psmsbackendtheme/plugins/dataTables/jquery.dataTables.js"></script>-->
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js" type="text/javascript"></script>
        <!--<script src="<?php //echo base_url();  ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>-->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable(); // jquery-bootstrap datatable 

                $('.close_modal').click(function () {
                    $('#addjobform')[0].reset(); // reset the add job modal form after closing it.
                });
            });
        </script>

        
        <!-- This jquery handles remove job function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#removeJobModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;        
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/jobentry_c/remove_jobs",
                        data: $("#removeJobModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#removeJobModalForm')[0].reset();
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").html('<p><strong>Job successfuly removed from the system!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").html('<p><strong>Unable to remove this job please contact administrator, thank you!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>
        
        <!-- This jquery handles the restore job function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#restoreJobModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;         
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/jobentry_c/restore_jobs",
                        data: $("#restoreJobModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#restoreJobModalForm')[0].reset();
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").html('<p><strong>Job successfuly restored from the system!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").html('<p><strong>Unable to restore this job please contact administrator, thank you!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>

        <!-- get the job_id from the table remove button and pass the job_id to the remove modal form input field -->
        <script>
            $(".removeJob").click(function () {
                baseurl = "http://localhost/psms/";
                j_id = this.id;

                if (j_id !== null) {
                    $("#job_id_remove_form").attr('value',j_id);
                    
                } else {
                    $("#job_id_remove_form").val("no_value");
                }

            });
        </script>
        
         <!-- get the job_id from the table restore button and pass the job_id to the restore modal form input field -->
        <script>
            $(".restoreJob").click(function () {
                baseurl = "http://localhost/psms/";
                j_id = this.id;
                
                $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/jobentry_c/get_job_details",
                        data: {'job_id_for_edit':j_id},
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#addjobform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Job successfuly added to the system!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to restore this job please contact administrator, thank you!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(2500).fadeOut(1500);
                            }
                        }
                    }); 

            });
        </script>
        
        <script>
            $(".restoreJob").click(function () {
                baseurl = "http://localhost/psms/";
                j_id = this.id;

                if (j_id !== null) {
                    $("#job_id_restore_form").attr('value',j_id);
                    
                } else {
                    $("#ob_id_restore_form").val("no_value");
                }

            });
        </script>

    </body>    
</html>
