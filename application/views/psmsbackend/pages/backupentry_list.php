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
                                <li><a style="text-decoration: none;" href="#" class="di">Backup Entry</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <input data-toggle="modal" data-target="#add_backupentry" type="button" class="btn btn-primary btn-round-md btn-md" value="Add Backup Entry"/>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="panel with-nav-tabs panel-default">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#activeBackupentry" data-toggle="tab">Active Backup entry</a></li>
                                            <li class=""><a href="#removedBackupentry" data-toggle="tab">Removed Backup entry</a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body" >
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="activeBackupentry"><!-- 1st step: Add Tour Details Form -->

                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Backup No</th>
                                                            <th>Job No</th>
                                                            <th>Customer Name</th>
                                                            <th>Serial No</th>
                                                            <th>Make</th>
                                                            <th>Model</th>
                                                            <th>Accessories</th>
                                                            <th>Issued on</th>
                                                            <th>Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($active_backups as $act_bk) {

                                                            echo "<tr>";
                                                            echo "<td>" . $act_bk->backup_id . "</td>";
                                                            echo "<td>" . $act_bk->job_id . "</td>";
                                                            echo "<td>" . $act_bk->customer_id . "</td>";
                                                            echo "<td>" . $act_bk->backup_serial_no . "</td>";
                                                            echo "<td>" . $act_bk->backup_make . "</td>";
                                                            echo "<td>" . $act_bk->backup_model . "</td>";
                                                            echo "<td>" . $act_bk->accessories . "</td>";
                                                            echo "<td>" . $act_bk->backup_issue_date . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $act_bk->backup_id . "' href='#remove_confirmation_modal' data-toggle='modal' class='removeBackupentry btn btn-danger btn-xs'><i class='icon-remove-circle'></i>&nbsp;Remove</a>&nbsp; &nbsp;";
                                                            echo "<a id='" . $act_bk->backup_id . "' href='#editBackupentryModal' data-toggle='modal' class='editBackupentry btn btn-warning btn-xs'><i class='icon-edit'></i>&nbsp;Edit</a>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div><!--/. 1st step: P Type -->
                                            <div class="tab-pane fade" id="removedBackupentry"><!-- 2nd step: All Tours Table -->
                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Backup No</th>
                                                            <th>Job No</th>
                                                            <th>Customer Name</th>
                                                            <th>Serial No</th>
                                                            <th>Make</th>
                                                            <th>Model</th>
                                                            <th>Accessories</th>
                                                            <th>Issued on</th>
                                                            <th>Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($deactive_backups as $deact_bk) {

                                                            echo "<tr>";
                                                            echo "<td>" . $deact_bk->backup_id . "</td>";
                                                            echo "<td>" . $deact_bk->job_id . "</td>";
                                                            echo "<td>" . $deact_bk->customer_id . "</td>";
                                                            echo "<td>" . $deact_bk->backup_serial_no . "</td>";
                                                            echo "<td>" . $deact_bk->backup_make . "</td>";
                                                            echo "<td>" . $deact_bk->backup_model . "</td>";
                                                            echo "<td>" . $deact_bk->accessories . "</td>";
                                                            echo "<td>" . $deact_bk->backup_issue_date . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $deact_pro->backup_id . "' href='#restore_confirmation_modal' data-toggle='modal' class='restoreBackupentry btn btn-warning btn-xs'><i class='icon-remove-circle'></i>&nbsp;Restore</a>&nbsp; &nbsp;";
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


        <!-- add backup entry modal -->
        <div class="modal fade" id="add_backupentry" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add New Backup</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 hide" id="divmessage">
                                        <div id="spnmessage" class="alert alert-success alert-dismissible" role="alert">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" role="form" id="addbackupentryform" method="POST" action="">
                                        <!-- Text input-->
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Backup No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_id" name="backup_id" placeholder="Backup No" class="form-control">
                                            </div>
                                        </div>
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
                                            <label class="col-sm-5 control-label" for="textinput">Serial No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_serial_no" name="backup_serial_no" placeholder="Serial No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Make</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_make" name="backup_make" placeholder="Make" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Model</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_model" name="backup_model" placeholder="Model" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Accessories</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="accessories" name="accessories" placeholder="Accessories" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Issued on</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_issue_date" name="backup_issue_date" placeholder="Issued on" class="form-control">
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

        <!-- remove backup entry confirmation modal -->
        <div class="modal fade" id="remove_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Remove Backup</h4>
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
                                    <p><strong>Are you sure, you want to remove this order ? </strong></p>
                                    <form class="form-horizontal" role="form" id="removeBackupentryModalForm" method="POST" action="">

                                        <div class="form-group field_p_id hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Backup No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_id_remove_form" value="" name="backup_id_remove_form" placeholder="Backup No" class="form-control">
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
        
        <!-- restore backup entry confirmation modal -->
        <div class="modal fade" id="restore_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Restore Backup</h4>
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
                                    <p><strong>Are you sure, you want to restore this order ? </strong></p>
                                    <form class="form-horizontal" role="form" id="restoreBackupentryModalForm" method="POST" action="">

                                        <div class="form-group hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Backup No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_id_restore_form" value="" name="backup_id_restore_form" placeholder="" class="form-control">
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
        
        <!-- edit backup entry modal -->
        <div class="modal fade" id="editBackupentryModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Backup</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 hide" id="divmessageEditProduct">
                                        <div id="spnmessageEditProduct" class="alert alert-success alert-dismissible" role="alert">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" role="form" id="editbackupinventryform" method="POST" action="">
                                        <!-- Text input-->
                                         <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Backup No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_id" name="backup_id" placeholder="Backup No" class="form-control">
                                            </div>
                                        </div>
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
                                            <label class="col-sm-5 control-label" for="textinput">Serial No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_serial_no" name="backup_serial_no" placeholder="Serial No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Make</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_make" name="backup_make" placeholder="Make" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Model</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_model" name="backup_model" placeholder="Model" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Accessories</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="accessories" name="accessories" placeholder="Accessories" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Issued on</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_issue_date" name="backup_issue_date" placeholder="Issued on" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Received on</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_receive_date" name="backup_receive_date" placeholder="Received on" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Defective Status</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="backup_defect_status" name="backup_defect_status">
                                                    <option disabled selected value> - Please select- </option>
                                                    <option value="No Issue">No Issue</option>
                                                    <option value="Issue Found<">Issue Found</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Remarks</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_defect_desc" name="backup_defect_desc" textarea="" placeholder="Remarks" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Manager Status</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_defect_desc" name="backup_defect_desc" textarea="" placeholder="Manager Status" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Final Cost</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="backup_final_cost" name="backup_final_cost" textarea="" placeholder="Final Cost" class="form-control">
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
                    $('#addbackupentryform')[0].reset(); // reset the add backup entry modal form after closing it.
                });
            });
        </script>

        <!-- This handles the add backup entry modal form field validation -->
        <script>
            $(document).ready(function () {
                $("#addbackupentryform").validate({
                    rules: {
                        backup_id: "required",
                        job_id: "required",
                        customer_id: "required",
                        backup_serial_no: "required",
                        backup_make: "required",
                        backup_model: "required",
                        backup_issue_date: "required"
                    },
                    messages: {
                        backup_id: "Please enter backup no",
                        job_id: "Please enter job no",
                        customer_id: "Please enter customer name",
                        backup_serial_no: "Please enter serial no",
                        backup_make: "Please enter brand",
                        backup_model: "Please enter model",
                        backup_issue_date: "Please enter model"

                    }
                });
            });
        </script>
        
        <!-- this Jquery handles the add backup entry function : Add backup entry modal form -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#addbackupentryform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/backupentry_c/add_backupentry",
                        data: $("#addbackupentryform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#addbackupentryform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Backup Entry successfuly added to the system!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to add this Backup Entry please contact IT Department, thank you!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>
        
        <!-- This jquery handles remove backup entry function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#removeBackupentryModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;        
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/backupentry_c/remove_backupentry",
                        data: $("#removeBackupentryModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#removeBackupentryModalForm')[0].reset();
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").html('<p><strong>Backup Entry successfuly removed from the system!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").html('<p><strong>Unable to remove this Backup Entry please contact IT Department, thank you!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>
        
        <!-- This jquery handles the restore backup entry function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#restoreBackupentryModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;         
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/backupentry_c/restore_backupentry",
                        data: $("#restoreBackupentryModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#restoreBackupentryModalForm')[0].reset();
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").html('<p><strong>Backup Entry successfuly restored from the system!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").html('<p><strong>Unable to restore this Backup Entry please contact IT Department, thank you!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>

        <!-- get the backup_id from the table remove button and pass the backup_id to the remove modal form input field -->
        <script>
            $(".removeBackupentry").click(function () {
                baseurl = "http://localhost/psms/";
                bk_id = this.id;

                if (bk_id !== null) {
                    $("#backup_id_remove_form").attr('value',bk_id);
                    
                } else {
                    $("#backup_id_remove_form").val("no_value");
                }

            });
        </script>
        
         <!-- get the backup_id from the table restore button and pass the backup_id to the restore modal form input field -->
        <script>
            $(".restoreBackupentry").click(function () {
                baseurl = "http://localhost/psms/";
                bk_id = this.id;
                
                $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/backupentry_c/get_backupentry_details",
                        data: {'backup_id_for_edit':bk_id},
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#addbackupentryform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Backup Entry successfuly added to the system!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to add this Backup Entry please contact IT Department, thank you!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(2500).fadeOut(1500);
                            }
                        }
                    }); 

            });
        </script>
        
        <!-- This handles the edit form modal field filling data function  -->
        <script>
//            $(".editProduct").click(function () {
//                baseurl = "http://localhost/psms/";
//                p_id = this.id;
//                
//                $.ajax({
//                        type: "POST",
//                        url: baseurl + "index.php/admin/get_product_details",
//                        data: {'product_id_for_edit':p_id},
//                        dataType: 'json',
//                        success: function (data) {
//                            //console.log(data);
//                            if (data.final_result === "success") {
//                                
//                                $("#category_edit").append('<option value="'+ data.p_id + '>"'"</option>');
//                                
//                            } else if (data.final_result === "unsuccess") {
//                                $("#spnmessage").removeAttr("class", "alert alert-success");
//                                $("#spnmessage").attr("class", "alert alert-danger");
//                                $("#spnmessage").html('<p><strong>Unable to add this product please contact technical team, thank you!</strong></p>');
//                                $("#divmessage").removeAttr("class", "hide");
//                                $("#divmessage").fadeIn(1500);
//                                $("#divmessage").delay(2500).fadeOut(1500);
//                            }
//                        }
//                    }); 
//
//            });
        </script>
        
        
        
        
        <script>
            $(".restoreBackupentry").click(function () {
                baseurl = "http://localhost/psms/";
                bk_id = this.id;

                if (bk_id !== null) {
                    $("#backup_id_restore_form").attr('value',bk_id);
                    
                } else {
                    $("#backup_id_restore_form").val("no_value");
                }

            });
        </script>

    </body>    
</html>


