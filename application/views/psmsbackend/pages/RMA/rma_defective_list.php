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
                                <li><a style="text-decoration: none;" href="#" class="di">Defective RMA</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <input data-toggle="modal" data-target="#add_defectives" type="button" class="btn btn-primary btn-round-md btn-md" value="Add RMA Defectives"/>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="panel with-nav-tabs panel-default">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#activeDefectives" data-toggle="tab">Active Defectives</a></li>
                                            <li class=""><a href="#removedDefectives" data-toggle="tab">Removed Defectives</a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body" >
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="activeDefectives"><!-- 1st step: Add Tour Details Form -->

                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>RMA No</th>
                                                            <th>Job No</th>
                                                            <th>Part No</th>
                                                            <th>Description</th>
                                                            <th>Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($active_rmadefective as $act_def) {

                                                            echo "<tr>";
                                                            echo "<td>" . $act_def->rma_no . "</td>";
                                                            echo "<td>" . $act_def->job_id . "</td>";
                                                            echo "<td>" . $act_def->part_no . "</td>";
                                                            echo "<td>" . $act_def->item_desc . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $act_def->rma_defect_id . "' href='#remove_confirmation_modal' data-toggle='modal' class='removeRMADefective btn btn-danger btn-xs'><i class='icon-remove-circle'></i>&nbsp;Remove</a>&nbsp; &nbsp;";
                                                            echo "<a id='" . $act_def->rma_defect_id . "' href='#editRMADefectiveModal' data-toggle='modal' class='editRMADefective btn btn-warning btn-xs'><i class='icon-edit'></i>&nbsp;Edit</a>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div><!--/. 1st step: P Type -->
                                            <div class="tab-pane fade" id="removedDefectives"><!-- 2nd step: All Tours Table -->
                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>RMA No</th>
                                                            <th>Job No</th>
                                                            <th>Part No</th>
                                                            <th>Description</th>
                                                            <th>Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($deactive_rmadefective as $deact_def) {

                                                            echo "<tr>";
                                                            echo "<td>" . $deact_def->category . "</td>";
                                                            echo "<td>" . $deact_def->brand . "</td>";
                                                            echo "<td>" . $deact_def->model . "</td>";
                                                            echo "<td>" . $deact_def->item_desc . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $deact_def->rma_defect_id . "' href='#restore_confirmation_modal' data-toggle='modal' class='restoreRMADefective btn btn-warning btn-xs'><i class='icon-remove-circle'></i>&nbsp;Restore</a>&nbsp; &nbsp;";
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


        <!-- add RMA Defective modal -->
        <div class="modal fade" id="add_defectives" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add RMA Defectives</h4>
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
                                    <form class="form-horizontal" role="form" id="addrmadefectiveform" method="POST" action="">
                                        <!-- Text input-->
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">ID</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="rma_defect_id" name="rma_defect_id" placeholder="ID" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Job No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="job_id" name="job_id" placeholder="Job No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">RMA No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="rma_no" name="rma_no" placeholder="RMA No" class="form-control">
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
                                                <input type="text" id="serial_no" name="serial_no" placeholder="Serial No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Part No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="part_no" name="part_no" placeholder="Part No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Description</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="item_desc" name="item_desc" placeholder="Description" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">SO No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="sales_order_no" name="sales_order_no" placeholder="SO No" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Defective Status</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="rma_defect_part_status" name="rma_defect_part_status">                                                
                                                    <option disabled selected value> - select status- </option>
                                                    <option value="In Stock">In Stock</option>
                                                    <option value="sent to supplier">sent to supplier</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Qty</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="qty" name="qty" placeholder="Qty" class="form-control">
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

        <!-- remove RMA Defective confirmation modal -->
        <div class="modal fade" id="remove_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Remove RMA Defective</h4>
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
                                    <p><strong>Are you sure, you want to remove this defective item ? </strong></p>
                                    <form class="form-horizontal" role="form" id="removeRMADefectiveModalForm" method="POST" action="">

                                        <div class="form-group field_p_id hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">ID</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="defect_id_remove_form" value="" name="defect_id_remove_form" placeholder="ID" class="form-control">
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
        
        <!-- restore RMA Defective confirmation modal -->
        <div class="modal fade" id="restore_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Restore RMA Defective</h4>
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
                                    <p><strong>Are you sure, you want to restore this defective item ? </strong></p>
                                    <form class="form-horizontal" role="form" id="restoreRMADefectiveModalForm" method="POST" action="">

                                        <div class="form-group hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">ID</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="defect_id_restore_form" value="" name="defect_id_restore_form" placeholder="" class="form-control">
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
        
        <!-- edit RMA Defective modal -->
        <div class="modal fade" id="editRMADefectiveModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit RMA Defective</h4>
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
                                    <form class="form-horizontal" role="form" id="editRMADefectiveform" method="POST" action="">
                                        <!-- Text input-->
                                             <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">ID</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="rma_defect_id" name="rma_defect_id" placeholder="ID" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Job No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="job_id" name="job_id" placeholder="Job No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">RMA No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="rma_no" name="rma_no" placeholder="RMA No" class="form-control">
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
                                                <input type="serial_no" id="job_id" name="serial_no" placeholder="Serial No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Part No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="part_no" name="part_no" placeholder="Part No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Description</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="item_desc" name="item_desc" placeholder="Description" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">SO No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="sales_order_no" name="sales_order_no" placeholder="SO No" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Dective Status</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="rma_defect_part_status" name="rma_defect_part_status">                                                
                                                    <option disabled selected value> - select status- </option>
                                                    <option value="In Stock">In Stock</option>
                                                    <option value="sent to supplier">sent to supplier</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Qty</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="qty" name="qty" placeholder="Qty" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Sent Date</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="sent_date" name="sent_date" type="date" placeholder="Sent Date" class="form-control">
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
                    $('#addrmadefectiveform')[0].reset(); // reset the add RMA defective modal form after closing it.
                });
            });
        </script>

        <!-- This handles the add RMA defective modal form field validation -->
        <script>
            $(document).ready(function () {
                $("#addrmadefectiveform").validate({
                    rules: {
                        rma_defect_id: "required",
                        job_id: "required",
                        rma_no: "required",
                        customer_id: "required",
                        serial_no: "required",
                        part_no: "required",
                        item_desc: "required",
                        sales_order_no: "required",
                        rma_defect_part_status: "required",
                        qty: "required"
                    },
                    messages: {
                        rma_defect_id: "please enter ID",
                        job_id: "please enter Job no",
                        rma_no: "please enter RMA No",
                        customer_id: "please enter customer name",
                        serial_no: "please enter serial no",
                        part_no: "please enter part no",
                        item_desc: "please enter description",
                        sales_order_no: "please enter sales order no",
                        rma_defect_part_status: "pls select status",
                        qty: "please enter qty"

                    }
                });
            });
        </script>
        
        <!-- this Jquery handles the add RMA Defective function : Add RMA Defective modal form -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#addrmadefectiveform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/rma_defective_c/add_defectives",
                        data: $("#addrmadefectiveform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#addrmadefectiveform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Defective item successfuly added to the system!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to add this item please contact administrator, thank you!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>
        
        <!-- This jquery handles remove RMA Defective function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#removeRMADefectiveModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;        
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/rma_defective_c/remove_defectives",
                        data: $("#removeRMADefectiveModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#removeRMADefectiveModalForm')[0].reset();
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").html('<p><strong>Item successfuly removed from the system!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").html('<p><strong>Unable to remove this item please contact administrator, thank you!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>
        
        <!-- This jquery handles the restore RMA Defective function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#restoreRMADefectiveModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;         
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/rma_defective_c/restore_defectives",
                        data: $("#restoreRMADefectiveModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#restoreRMADefectiveModalForm')[0].reset();
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").html('<p><strong>Item successfuly restored from the system!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").html('<p><strong>Unable to restore this item please contact administrator, thank you!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>

        <!-- get the defect_id from the table remove button and pass the defect_id to the remove modal form input field -->
        <script>
            $(".removeRMADefective").click(function () {
                baseurl = "http://localhost/psms/";
                d_id = this.id;

                if (d_id !== null) {
                    $("#defect_id_remove_form").attr('value',d_id);
                    
                } else {
                    $("#defect_id_remove_form").val("no_value");
                }

            });
        </script>
        
         <!-- get the defect_id from the table restore button and pass the defect_id to the restore modal form input field -->
        <script>
            $(".restoreRMADefective").click(function () {
                baseurl = "http://localhost/psms/";
                d_id = this.id;
                
                $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/rma_defective_c/get_rmadefective_details",
                        data: {'defect_id_for_edit':d_id},
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#addrmadefectiveform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Item successfuly added to the system!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to add this item please contact admnistrator, thank you!</strong></p>');
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
            $(".restoreRMADefective").click(function () {
                baseurl = "http://localhost/psms/";
                d_id = this.id;

                if (d_id !== null) {
                    $("#defect_id_restore_form").attr('value',d_id);
                    
                } else {
                    $("#defect_id_restore_form").val("no_value");
                }

            });
        </script>

    </body>    
</html>

