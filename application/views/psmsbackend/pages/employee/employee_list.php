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
                                <li><a style="text-decoration: none;" href="#" class="di">Employees</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/employee_c/add_employee_page" class="btn btn-round-sm btn-sm btn-primary">Add Employee Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="panel with-nav-tabs panel-default">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#activeEmployees" data-toggle="tab">Active Employees</a></li>
                                            <li class=""><a href="#removedEmployees" data-toggle="tab">Deactivated Employees</a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body" >
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="activeEmployees">

                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Employee Type</th>
                                                            <th>Employee Name</th>
                                                            <th>Email Address</th>
                                                            <th>Contact No</th>
                                                            <th>NIC</th>
                                                            <th>Address</th>
                                                            <th style="width: 21%">Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($active_employees as $act_emp) {

                                                            echo "<tr>";
                                                            echo "<td>" . $act_emp->emp_id . "</td>";
                                                            echo "<td>" . $act_emp->emp_type . "</td>";
                                                            echo "<td>" . $act_emp->emp_name . "</td>";
                                                            echo "<td>" . $act_emp->email . "</td>";
                                                            echo "<td>" . $act_emp->contact_1 . "</td>";
                                                            echo "<td>" . $act_emp->NIC . "</td>";
                                                            echo "<td>" . $act_emp->Address . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $act_emp->emp_id . "' href='#remove_confirmation_modal' data-toggle='modal' class='removeEmployee btn btn-danger btn-xs'><i class='icon-remove-circle'></i>&nbsp;Remove</a>&nbsp; &nbsp;";
                                                            echo "<a id='" . $act_emp->emp_id . "' href='#edit_confirmation_modal' data-toggle='modal' class='editEmployee btn btn-warning btn-xs'><i class='icon-edit'></i>&nbsp;Edit</a>&nbsp; &nbsp;";
                                                            echo "<a href='". base_url()."/index.php/employee_c/employee_detail_view/".$act_emp->emp_id."' class='btn btn-info btn-xs'><i class='icon-external-link'></i>&nbsp;View</a>&nbsp; &nbsp;";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div><!--/. 1st step: P Type -->
                                            <div class="tab-pane fade" id="removedEmployees">
                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Employee Type</th>
                                                            <th>Employee Name</th>
                                                            <th>Email Address</th>
                                                            <th>Contact No</th>
                                                            <th>NIC</th>
                                                            <th>Address</th>
                                                            <th style="width: 21%">Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($deactive_employees as $deact_emp) {

                                                            echo "<tr>";
                                                            echo "<td>" . $deact_emp->emp_id . "</td>";
                                                            echo "<td>" . $deact_emp->emp_type . "</td>";
                                                            echo "<td>" . $deact_emp->emp_name . "</td>";
                                                            echo "<td>" . $deact_emp->email . "</td>";
                                                            echo "<td>" . $deact_emp->contact_1 . "</td>";
                                                            echo "<td>" . $deact_emp->NIC . "</td>";
                                                            echo "<td>" . $deact_emp->Address . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $deact_emp->emp_id . "' href='#restore_confirmation_modal' data-toggle='modal' class='restoreEmployee btn btn-warning btn-xs'><i class='icon-remove-circle'></i>&nbsp;Restore</a>&nbsp; &nbsp;";
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


    <!-- remove employee confirmation modal -->
        <div class="modal fade" id="remove_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Remove Employee</h4>
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
                            <div class="row" id="yes_no_code_block_remove">
                                <div class="col-md-12">
                                    <p><strong>Are you sure, you want to remove this employee ? </strong></p>
                                    <form class="form-horizontal" role="form" id="removeEmployeeModalForm" method="POST" action="">

                                        <div class="form-group field_p_id hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="emp_id_remove_form" value="" name="emp_id_remove_form" placeholder="Name" class="form-control">
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
        
        <!-- restore  confirmation modal -->
        <div class="modal fade" id="restore_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Restore Employee</h4>
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
                            <div class="row" id="yes_no_code_block_restore">
                                <div class="col-md-12">
                                    <p><strong>Are you sure, you want to restore this employee ? </strong></p>
                                    <form class="form-horizontal" role="form" id="restoreEmployeeModalForm" method="POST" action="">

                                        <div class="form-group hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="emp_id_restore_form" value="" name="emp_id_restore_form" placeholder="" class="form-control">
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
        
        <!-- edit employee confirmation modal -->
        <div class="modal fade" id="edit_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Employee Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Are you sure, you want to edit this employee details ? </strong></p>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-left: 34%">
                                   <a href="" id="edit_yes" class="btn btn-primary">Yes</a>
                                   <input type="button" class="btn btn-danger close_modal" data-dismiss="modal" value="No" />
                                </div>                                    
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

            });
        </script>
        <!-- **** Below two JS Scripts handles the remove function **** -->
        <!-- get the emp_id from the table remove button and pass the emp_id to the remove modal form input field -->
        <script>
            $(".removeEmployee").click(function () {
                baseurl = "http://localhost/psms/";
                e_id = this.id;

                if (e_id !== null) {
                    $("#emp_id_remove_form").attr('value',e_id);
                    
                } else {
                    $("#emp_id_remove_form").val("no_value");
                }

            });
        </script>
        
   
        
        <!-- This jquery handles remove employee function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#removeEmployeeModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;        
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/employee_c/remove_employees",
                        data: $("#removeEmployeeModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#removeEmployeeModalForm')[0].reset();
                                $('#yes_no_code_block_remove').attr('class','hide');
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").html('<p><strong>Employee successfuly removed from the system!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 3000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").html('<p><strong>Unable to remove this employee please contact administrator, thank you!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>
        
        <!-- **** Below two JS Scripts handles the restore function **** -->
         <!-- get the emp_id from the table restore button and pass the emp_id to the restore modal form input field -->
        <script>
            $(".restoreEmployee").click(function () {
               //
                baseurl = "http://localhost/psms/";
                e_id = this.id;

                if (e_id !== null) {
                    $("#emp_id_restore_form").attr('value',e_id);
                    
                } else {
                    $("#emp_id_restore_form").val("no_value");
                }

            });
        </script>
        <!-- This jquery handles the restore employee function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#restoreEmployeeModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;         
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/employee_c/restore_employees",
                        data: $("#restoreEmployeeModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#restoreEmployeeModalForm')[0].reset();
                                $('#yes_no_code_block_restore').attr('class','hide');
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").html('<p><strong>Employee successfuly restored from the system!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 3000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").html('<p><strong>Unable to restore this employee please contact administrator, thank you!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>


   
    <script>
            $(".editEmployee").click(function () {
                e_id = this.id;

                if (e_id !== null) {
                    $("#edit_yes").attr('href','<?php echo base_url();?>/index.php/employee_c/edit_employee_page/'+e_id);
                    
                } else {
                    $("#edit_yes").val("no_value");
                }

            });
    </script>
        
        
        
        
        

    </body>    
</html>

