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
            <?php $this->load->view('psmsbackend/front_desk/template_front_desk/navigation_front_desk'); ?>
            <!--END MENU SECTION -->

            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height:1200px;">
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Dashboard</a></li>
                                <li><a style="text-decoration: none;" href="#" class="di">Serial Nos</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <!--<div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/front_desk_c_view/add_serial_nos_page_sales_order_search" class="btn btn-round-sm btn-sm btn-primary">Add serial no</a>
                            </div>
                        </div>
                    </div> -->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="panel with-nav-tabs panel-default">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#activeSerialnos" data-toggle="tab">Active Serial Nos</a></li>
                                            <!--<li class=""><a href="#removedSerialnos" data-toggle="tab">Removed Serial Nos</a></li>-->
                                        </ul>
                                    </div>
                                    <div class="panel-body" >
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="activeSerialnos"><!-- 1st step: Add Tour Details Form -->

                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Sales order no</th>
                                                            <th>Category</th>
                                                            <th>Make</th>
                                                            <th>Model</th>
                                                            <th>Serial No</th>
                                                            <!--<th>Actions</th>-->
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($active_serialnos as $act_sno) {

                                                            echo "<tr>";
                                                            echo "<td>" . $act_sno->sales_order_no . "</td>";
                                                            echo "<td>" . $act_sno->category . "</td>";
                                                            echo "<td>" . $act_sno->make . "</td>";
                                                            echo "<td>" . $act_sno->model . "</td>";
                                                            echo "<td>" . $act_sno->serial_no . "</td>";
//                                                            echo "<td>";
//                                                            echo "<a id='" . $act_sno->supp_product_sno_id . "' href='#remove_confirmation_modal' data-toggle='modal' class='removeSerialno btn btn-danger btn-xs'><i class='icon-remove-circle'></i>&nbsp;Remove</a>&nbsp; &nbsp;";
//                                                            echo "<a id='" . $act_sno->supp_product_sno_id . "' href='#editSerialnotModal' data-toggle='modal' class='editProduct btn btn-warning btn-xs'><i class='icon-edit'></i>&nbsp;Edit</a>";
//                                                            echo "</td>";
//                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div><!--/. 1st step: P Type -->
                                            <div class="tab-pane fade" id="removedSerialnos"><!-- 2nd step: All Tours Table -->
                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>SO No</th>
                                                            <th>Serial No</th>
                                                            <th>Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($deactive_serialnos as $deact_sno) {

                                                            echo "<tr>";
                                                            echo "<td>" . $deact_sno->sales_order_no . "</td>";
                                                            echo "<td>" . $deact_sno->serial_no . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $deact_sno->supp_product_sno_id . "' href='#restore_confirmation_modal' data-toggle='modal' class='restoreSerialnos btn btn-warning btn-xs'><i class='icon-remove-circle'></i>&nbsp;Restore</a>&nbsp; &nbsp;";
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



        <!-- remove serial nos confirmation modal -->
        <div class="modal fade" id="remove_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Remove Serial No</h4>
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
                                    <p><strong>Are you sure, you want to remove this serial no ? </strong></p>
                                    <form class="form-horizontal" role="form" id="removeSerialnoModalForm" method="POST" action="">

                                        <div class="form-group field_p_id hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Serial No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="supp_product_sno_id_remove_form" value="" name="supp_product_sno_id_remove_form" placeholder="Serial No" class="form-control">
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

    
        
        <!-- This jquery handles remove serial no function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#removeSerialnoModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;        
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/front_desk_c_view/remove_serial_nos",
                        data: $("#removeSerialnoModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#removeSerialnoModalForm')[0].reset();
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").html('<p><strong>Serial no successfuly removed from the system!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").html('<p><strong>Unable to remove this Serial no please contact sales team, thank you!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>
        
        <!-- This jquery handles the restore serial no function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#restoreSerialnoModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;         
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/front_desk_c_view/restore_serial_nos",
                        data: $("#restoreSerialnoModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#restoreSerialnoModalForm')[0].reset();
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").html('<p><strong>Serial no successfuly restored from the system!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").html('<p><strong>Unable to restore this Serial no, Please contact sales team, Thank You!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>

        <!-- get the supp_product_sno_id from the table remove button and pass the supp_product_sno_id to the remove modal form input field -->
        <script>
            $(".removeSerialNo").click(function () {
                baseurl = "http://localhost/psms/";
                sno_id = this.id;

                if (sno_id !== null) {
                    $("#supp_product_sno_id_remove_form").attr('value',sno_id);
                    
                } else {
                    $("#supp_product_sno_id_remove_form").val("no_value");
                }

            });
        </script>
        
         <!-- get the supp_product_sno_id from the table restore button and pass the supp_product_sno_id to the restore modal form input field -->
        <script>
            $(".restoreSerialNo").click(function () {
                baseurl = "http://localhost/psms/";
                sno_id = this.id;
                
                $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/front_desk_c_view/restore_serial_nos",
                        data: {'supp_product_sno_id_for_edit':sno_id},
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#addserialnosform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Serial no successfuly add to the system!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to add this Serial no please contact sales team, thank you!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(2500).fadeOut(1500);
                            }
                        }
                    }); 

            });
        </script>
        
        <script>
            $(".editSerailno").click(function () {
                sn_id = this.id;

                if (sn_id !== null) {
                    $("#edit_yes").attr('href','<?php echo base_url();?>/index.php/supplier_c/edit_serialno_page/'+sn_id);
                    
                } else {
                    $("#edit_yes").val("no_value");
                }

            });
        </script>
        
        
        <script>
            $(".restoreSerialNo").click(function () {
                baseurl = "http://localhost/psms/";
                sno_id = this.id;

                if (sno_id !== null) {
                    $("#supp_product_sno_id_restore_form").attr('value',sno_id);
                    
                } else {
                    $("#supp_product_sno_id_restore_form").val("no_value");
                }

            });
        </script>

    </body>    
</html>
