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
                                <li><a style="text-decoration: none;" href="#" class="di">Imports officer Details</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                               <a href="<?php echo base_url(); ?>/index.php/imports_c/add_imports_officer_page" class="btn btn-round-sm btn-sm btn-primary">Add Imports Officer</a>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="panel with-nav-tabs panel-default">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#activeImportsOfficer" data-toggle="tab">Active Imports Officer</a></li>
                                            <li class=""><a href="#removedImportsOfficer" data-toggle="tab">Removed Imports Officer</a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body" >
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="activeImportsOfficer"><!-- 1st step: Add Imports Officer Details Form -->

                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Code No</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Gender</th>
                                                            <th>Email</th>
                                                            <th>Contact No</th>
                                                            <th>NIC</th>
                                                            <th>Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($active_importsofficers as $act_imp) {

                                                            echo "<tr>";
                                                            echo "<td>" . $act_imp->imp_id . "</td>";
                                                            echo "<td>" . $act_imp->imp_first_name . "</td>";
                                                            echo "<td>" . $act_imp->imp_last_name . "</td>";
                                                            echo "<td>" . $act_imp->imp_gender . "</td>";
                                                            echo "<td>" . $act_imp->imp_email . "</td>";
                                                            echo "<td>" . $act_imp->imp_contact . "</td>";
                                                            echo "<td>" . $act_imp->imp_nic . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $act_imp->imp_id . "' href='#remove_confirmation_modal' data-toggle='modal' class='removeImportsOfficer btn btn-danger btn-xs'><i class='icon-remove-circle'></i>&nbsp;Remove</a>&nbsp; &nbsp;";
                                                            echo "<a id='" . $act_imp->imp_id . "' href='#edit_confirmation_modal' data-toggle='modal' class='editImportOfficer btn btn-warning btn-xs'><i class='icon-edit'></i>&nbsp;Edit</a>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div><!--/. 1st step: P Type -->
                                            <div class="tab-pane fade" id="removedImportsOfficer"><!-- 2nd step: All Imports Officer Table -->
                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Code No</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Gender</th>
                                                            <th>Email</th>
                                                            <th>Contact No</th>
                                                            <th>NIC</th>
                                                            <th>Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($deactive_importsofficers as $deact_imp) {

                                                            echo "<tr>";
                                                            echo "<td>" . $act_imp->imp_id . "</td>";
                                                            echo "<td>" . $act_imp->imp_first_name . "</td>";
                                                            echo "<td>" . $act_imp->imp_last_name . "</td>";
                                                            echo "<td>" . $act_imp->imp_gender . "</td>";
                                                            echo "<td>" . $act_imp->imp_email . "</td>";
                                                            echo "<td>" . $act_imp->imp_contact . "</td>";
                                                            echo "<td>" . $act_imp->imp_nic . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $deact_imp->imp_id . "' href='#restore_confirmation_modal' data-toggle='modal' class='restoreImportsOfficer btn btn-warning btn-xs'><i class='icon-remove-circle'></i>&nbsp;Restore</a>&nbsp; &nbsp;";
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


        
        
       
        <!-- remove imports officer confirmation modal -->
        <div class="modal fade" id="remove_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Remove Imports Officer</h4>
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
                                    <p><strong>Are you sure, you want to remove this Imports Officer ? </strong></p>
                                    <form class="form-horizontal" role="form" id="removeImportsOfficerModalForm" method="POST" action="">

                                        <div class="form-group field_p_id hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Model</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="imp_id_remove_form" value="" name="imp_id_remove_form" placeholder="Model" class="form-control">
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
        
        <!-- restore imports officer confirmation modal -->
        <div class="modal fade" id="restore_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Restore Imports Officer</h4>
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
                                    <p><strong>Are you sure, you want to restore this Imports Officer ? </strong></p>
                                    <form class="form-horizontal" role="form" id="restoreImportsOfficerModalForm" method="POST" action="">

                                        <div class="form-group hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Code No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="imp_id_restore_form" value="" name="imp_id_restore_form" placeholder="" class="form-control">
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
        
          <!-- edit imports officer confirmation modal -->
        <div class="modal fade" id="edit_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Imports Officer Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Are you sure, you want to edit this Imports Officer ? </strong></p>
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

                $('.close_modal').click(function () {
                    $('#addimportsofficerform')[0].reset(); // reset the add imports officer modal form after closing it.
                });
            });
        </script>

       
        
  
        
        <!-- This j query handles remove imports officer function -->
        
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#removeImportsOfficerModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;        
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/imports_c/remove_imports_officer",
                        data: $("#removeImportsOfficerModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#removeImportsOfficerModalForm')[0].reset();
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").html('<p><strong>Imports Officer successfuly removed from the system!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 5000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").html('<p><strong>Unable to remove this Imports Officer please contact administrator, thank you!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>
        
        <!-- This j query handles the restore Imports Officer function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#restoreImportsOfficerModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;         
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/imports_c/restore_imports_officer",
                        data: $("#restoreImportsOfficerModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#restoreImportsOfficerModalForm')[0].reset();
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").html('<p><strong>Imports Officer successfuly restored from the system!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").html('<p><strong>Unable to restore this Imports Officer please contact administrator, thank you!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>

        <!-- get the i_id from the table remove button and pass the i_id to the remove modal form input field -->
        <script>
            $(".removeImportsOfficer").click(function () {
                baseurl = "http://localhost/psms/";
                i_id = this.id;

                if (i_id !== null) {
                    $("#imp_id_remove_form").attr('value',i_id);
                    
                } else {
                    $("#imp_id_remove_form").val("no_value");
                }

            });
        </script>
        


        
        
        <script>
            $(".restoreImportsOfficer").click(function () {
                baseurl = "http://localhost/psms/";
                i_id = this.id;

                if (i_id !== null) {
                    $("#imp_id_restore_form").attr('value',i_id);
                    
                } else {
                    $("#imp_id_restore_form").val("no_value");
                }

            });
        </script>

        <script>
            $(".editImportOfficer").click(function () {
                i_id = this.id;

                if (i_id !== null) {
                    $("#edit_yes").attr('href','<?php echo base_url();?>/index.php/imports_c/edit_imports_officer_page/'+i_id);
                    
                } else {
                    $("#edit_yes").val("no_value");
                }

            });
    </script>
    
    </body>    
</html>

