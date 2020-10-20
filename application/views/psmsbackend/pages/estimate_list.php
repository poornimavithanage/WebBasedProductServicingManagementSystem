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
                                <li><a style="text-decoration: none;" href="#" class="di">Estimates</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <input data-toggle="modal" data-target="#add_estimates" type="button" class="btn btn-primary btn-round-md btn-md" value="Add Estimate"/>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="panel with-nav-tabs panel-default">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#activeEstimates" data-toggle="tab">Active Estimates</a></li>
                                            <li class=""><a href="#removedEstimates" data-toggle="tab">Removed Estimates</a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body" >
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="activeEstimates"><!-- 1st step: Add Tour Details Form -->

                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Job No</th>
                                                            <th>Customer Name</th>
                                                            <th>Inspection Fee</th>
                                                            <th>Total</th>
                                                            <th>Sent on</th>
                                                            <th>Expires on</th>
                                                            <th>Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($active_estimates as $act_est) {

                                                            echo "<tr>";
                                                            echo "<td>" . $act_est->job_estimate_id . "</td>";
                                                            echo "<td>" . $act_est->job_id . "</td>";
                                                            echo "<td>" . $act_est->customer_id . "</td>";
                                                            echo "<td>" . $act_est->est_inspect_fee . "</td>";
                                                            echo "<td>" . $act_est->total . "</td>";
                                                            echo "<td>" . $act_est->est_send_date . "</td>";
                                                            echo "<td>" . $act_est->est_expire_date . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $act_est->job_estimate_id . "' href='#remove_confirmation_modal' data-toggle='modal' class='removeEstimate btn btn-danger btn-xs'><i class='icon-remove-circle'></i>&nbsp;Remove</a>&nbsp; &nbsp;";
                                                            echo "<a id='" . $act_est->job_estimate_id . "' href='#editEstimateModal' data-toggle='modal' class='editEstimate btn btn-warning btn-xs'><i class='icon-edit'></i>&nbsp;Edit</a>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div><!--/. 1st step: P Type -->
                                            <div class="tab-pane fade" id="removedEstimates"><!-- 2nd step: All Tours Table -->
                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Job No</th>
                                                            <th>Customer Name</th>
                                                            <th>Inspection Fee</th>
                                                            <th>Total</th>
                                                            <th>Sent on</th>
                                                            <th>Expires on</th>
                                                            <th>Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($deactive_estimates as $deact_est) {

                                                            echo "<tr>";
                                                            echo "<td>" . $deact_est->job_estimate_id . "</td>";
                                                            echo "<td>" . $deact_est->job_id . "</td>";
                                                            echo "<td>" . $deact_est->customer_id . "</td>";
                                                            echo "<td>" . $deact_est->estimate_desc . "</td>";                                                            echo "<td>" . $deact_est->est_inspect_fee . "</td>";
                                                            echo "<td>" . $deact_est->total . "</td>";
                                                            echo "<td>" . $deact_est->est_send_date . "</td>";
                                                            echo "<td>" . $deact_est->est_expire_date . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $deact_est->job_estimate_id . "' href='#restore_confirmation_modal' data-toggle='modal' class='restoreEstimate btn btn-warning btn-xs'><i class='icon-remove-circle'></i>&nbsp;Restore</a>&nbsp; &nbsp;";
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


        <!-- add estimate modal -->
        <div class="modal fade" id="add_estimates" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add New Estimate</h4>
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
                                    <form class="form-horizontal" role="form" id="addestimateform" method="POST" action="">
                                        <!-- Text input-->
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">ID</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="job_estimate_id" name="job_estimate_id" placeholder="ID" class="form-control">
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
                                            <label class="col-sm-5 control-label" for="textinput">Serial No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="serial_no" name="serial_no" placeholder="Serial No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Estimate Particulars</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="estimate_desc" name="estimate_desc" placeholder="Estimate Particulars" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Inspection Fee</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="est_inspect_fee" name="est_inspect_fee" placeholder="Inspection Fee" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Cost</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="repair_cost" name="repair_cost" placeholder="Cost" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Tax Value</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="tax" name="tax" placeholder="Tax Value" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Total</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="total" name="total" placeholder="Total" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Sent on</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="est_send_date" name="est_send_date" placeholder="Sent on" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Expires on</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="est_expire_date" name="est_expire_date" placeholder="Expires on" class="form-control">
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

        <!-- remove estimate confirmation modal -->
        <div class="modal fade" id="remove_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Remove Estimate</h4>
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
                                    <p><strong>Are you sure, you want to remove this estimate ? </strong></p>
                                    <form class="form-horizontal" role="form" id="removeEstimateModalForm" method="POST" action="">

                                        <div class="form-group field_p_id hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">ID</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="job_estimate_id_remove_form" value="" name="job_estimate_id_remove_form" placeholder="ID" class="form-control">
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
        
        <!-- restore estimate confirmation modal -->
        <div class="modal fade" id="restore_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Restore Estimate</h4>
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
                                    <p><strong>Are you sure, you want to restore this Estimate ? </strong></p>
                                    <form class="form-horizontal" role="form" id="restoreEstimateModalForm" method="POST" action="">

                                        <div class="form-group hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Model</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="job_estimate_id_restore_form" value="" name="job_estimate_id_restore_form" placeholder="" class="form-control">
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
        
        <!-- edit estimate modal -->
        <div class="modal fade" id="editEstimateModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Estimate</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 hide" id="divmessageEditEstimate">
                                        <div id="spnmessageEditEstimate" class="alert alert-success alert-dismissible" role="alert">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" role="form" id="editestimateform" method="POST" action="">
                                        <!-- Text input-->
                                             <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">ID</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="job_estimate_id" name="job_estimate_id" placeholder="ID" class="form-control">
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
                                            <label class="col-sm-5 control-label" for="textinput">Serial No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="serial_no" name="serial_no" placeholder="Serial No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Estimate Particulars</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="estimate_desc" name="estimate_desc" placeholder="Estimate Particulars" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Inspection Fee</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="est_inspect_fee" name="est_inspect_fee" placeholder="Inspection Fee" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Cost</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="repair_cost" name="repair_cost" placeholder="Cost" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Tax Value</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="tax" name="tax" placeholder="Tax Value" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Total</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="total" name="total" placeholder="Total" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Sent on</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="est_send_date" name="est_send_date" placeholder="Sent on" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Expires on</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="est_expire_date" name="est_expire_date" placeholder="Expires on" class="form-control">
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
                    $('#addestimateform')[0].reset(); // reset the add estimate modal form after closing it.
                });
            });
        </script>

        <!-- This handles the add estimate modal form field validation -->
        <script>
            $(document).ready(function () {
                $("#addestimateform").validate({
                    rules: {
                        job_estimate_id: "required",
                        job_id: "required",
                        customer_id: "required",
                        make: "required",
                        model: "required",
                        serial_no: "required",
                        //estimate_desc: "required",
                        est_inspect_fee: "required",
                        repair_cost: "required",
                        tax: "required",
                        //total: "required",
                        est_send_datee: "required"
                        //est_expire_date: "required"
                    },
                    messages: {
                        job_estimate_id: "Please enter ID",
                        job_id: "Please enter job no",
                        customer_id: "Please enter customer name",
                        make: "Please enter brand",
                        model: "Please enter model",
                        serial_no: "Please enter serial no",
                        //estimate_desc: "Please enter particulars ",
                        est_inspect_fee: "Please enter inspection fee",
                        repair_cost: "Please enter repair cost",
                        tax: "Please enter tax value",
                        //total: "",
                        est_send_datee: "Please enter date"
                        //est_expire_date: "required"

                    }
                });
            });
        </script>
        
        <!-- this Jquery handles the add estimate function : Add estimate modal form -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#addestimateform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/estimates_c/add_estimates",
                        data: $("#addestimateform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#addestimateform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Estimate successfuly added to the system!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to add this Estimate please contact technical team, thank you!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>
        
        <!-- This jquery handles remove estimate function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#removeEstimateModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;        
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/estimates_c/remove_estimates",
                        data: $("#removeEstimateModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#removeEstimateModalForm')[0].reset();
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").html('<p><strong>Estimate successfuly removed from the system!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").html('<p><strong>Unable to remove this Estimate please contact technical team, thank you!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>
        
        <!-- This jquery handles the restore estimate function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#restoreEstimateModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;         
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/estimates_c/restore_estimates",
                        data: $("#restoreEstimateModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#restoreEstimateModalForm')[0].reset();
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").html('<p><strong>Estimate successfuly restored from the system!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").html('<p><strong>Unable to restore this Estimate please contact technical team, thank you!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>

        <!-- get the job_estimate_id from the table remove button and pass the job_estimate_id to the remove modal form input field -->
        <script>
            $(".removeEstimate").click(function () {
                baseurl = "http://localhost/psms/";
                e_id = this.id;

                if (e_id !== null) {
                    $("#job_estimate_id_remove_form").attr('value',e_id);
                    
                } else {
                    $("#job_estimate_id_remove_form").val("no_value");
                }

            });
        </script>
        
         <!-- get the job_estimate_id from the table restore button and pass the job_estimate_id to the restore modal form input field -->
        <script>
            $(".restoreProduct").click(function () {
                baseurl = "http://localhost/psms/";
                e_id = this.id;
                
                $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/estimates_c/get_estimate_details",
                        data: {'job_estimate_id_for_edit':e_id},
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#addestimateform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Estimate successfuly added to the system!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to add this Estimate please contact technical team, thank you!</strong></p>');
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
            $(".restoreEstimate").click(function () {
                baseurl = "http://localhost/psms/";
                e_id = this.id;

                if (e_id !== null) {
                    $("#job_estimate_id_restore_form").attr('value',e_id);
                    
                } else {
                    $("#job_estimate_id_restore_form").val("no_value");
                }

            });
        </script>

    </body>    
</html>


