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
                                <li><a style="text-decoration: none;" href="#" class="di">Products</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/products_c/add_products_page" class="btn btn-round-sm btn-sm btn-primary">Add Product</a>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="panel with-nav-tabs panel-default">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#activeProducts" data-toggle="tab">Active Products</a></li>
                                            <li class=""><a href="#removedProducts" data-toggle="tab">Removed Products</a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body" >
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="activeProducts"><!-- 1st step: Add Tour Details Form -->

                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Category</th>
                                                            <th>Brand</th>
                                                            <th>Model</th>
                                                            <th>Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($active_products as $act_pro) {

                                                            echo "<tr>";
                                                            echo "<td>" . $act_pro->category . "</td>";
                                                            echo "<td>" . $act_pro->brand . "</td>";
                                                            echo "<td>" . $act_pro->model . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $act_pro->item_product_m_id . "' href='#remove_confirmation_modal' data-toggle='modal' class='removeProduct btn btn-danger btn-xs'><i class='icon-remove-circle'></i>&nbsp;Remove</a>&nbsp; &nbsp;";
                                                            echo "<a id='" . $act_pro->item_product_m_id . "' href='#edit_confirmation_modal' data-toggle='modal' class='editProduct btn btn-warning btn-xs'><i class='icon-edit'></i>&nbsp;Edit</a>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div><!--/. 1st step: P Type -->
                                            <div class="tab-pane fade" id="removedProducts"><!-- 2nd step: All Tours Table -->
                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Category</th>
                                                            <th>Brand</th>
                                                            <th>Model</th>
                                                            <th>Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($deactive_products as $deact_pro) {

                                                            echo "<tr>";
                                                            echo "<td>" . $deact_pro->category . "</td>";
                                                            echo "<td>" . $deact_pro->brand . "</td>";
                                                            echo "<td>" . $deact_pro->model . "</td>";
                                                            echo "<td>";
                                                            echo "<a id='" . $deact_pro->item_product_m_id . "' href='#restore_confirmation_modal' data-toggle='modal' class='restoreProduct btn btn-warning btn-xs'><i class='icon-remove-circle'></i>&nbsp;Restore</a>&nbsp; &nbsp;";
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


        <!-- remove product confirmation modal -->
        <div class="modal fade" id="remove_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Remove Product</h4>
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
                                    <p><strong>Are you sure, you want to remove this product ? </strong></p>
                                    <form class="form-horizontal" role="form" id="removeProduuctModalForm" method="POST" action="">

                                        <div class="form-group field_p_id hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Model</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="product_id_remove_form" value="" name="product_id_remove_form" placeholder="Model" class="form-control">
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
        
        <!-- restore product confirmation modal -->
        <div class="modal fade" id="restore_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Restore Product</h4>
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
                                    <p><strong>Are you sure, you want to restore this product ? </strong></p>
                                    <form class="form-horizontal" role="form" id="restoreProduuctModalForm" method="POST" action="">

                                        <div class="form-group hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Model</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="product_id_restore_form" value="" name="product_id_restore_form" placeholder="" class="form-control">
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
        
        <!-- edit product confirmation modal -->
        <div class="modal fade" id="edit_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Product Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Are you sure, you want to edit this product ? </strong></p>
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
      <!-- get the product_id from the table remove button and pass the product_id to the remove modal form input field -->
        <script>
            $(".removeProduct").click(function () {
                baseurl = "http://localhost/psms/";
                p_id = this.id;

                if (p_id !== null) {
                    $("#product_id_remove_form").attr('value',p_id);
                    
                } else {
                    $("#product_id_remove_form").val("no_value");
                }

            });
        </script>
        
                
        <!-- This jquery handles remove product function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#removeProduuctModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;        
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/products_c/remove_products",
                        data: $("#removeProduuctModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#removeProduuctModalForm')[0].reset();
                                $('#yes_no_code_block_remove').attr('class','hide');
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").html('<p><strong>Product successfuly removed from the system!</strong></p>');
                                $("#divmessageRemoveModal").removeAttr("class", "hide");
                                $("#divmessageRemoveModal").fadeIn(1500);
                                $("#divmessageRemoveModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 5000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRemoveModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRemoveModal").attr("class", "alert alert-danger");
                                $("#spnmessageRemoveModal").html('<p><strong>Unable to remove this product please contact technical team, thank you!</strong></p>');
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
        <!-- get the product_id from the table restore button and pass the product_id to the restore modal form input field -->
        <script>
            $(".restoreProduct").click(function () {
                baseurl = "http://localhost/psms/";
                p_id = this.id;

                if (p_id !== null) {
                    $("#product_id_restore_form").attr('value',p_id);
                    
                } else {
                    $("#product_id_restore_form").val("no_value");
                }

            });
        </script>
        
        <!-- This jquery handles the restore product function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#restoreProduuctModalForm").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;         
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/products_c/restore_products",
                        data: $("#restoreProduuctModalForm").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#restoreProduuctModalForm')[0].reset();
                                $('#yes_no_code_block_restore').attr('class','hide');
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").html('<p><strong>Product successfuly restored from the system!</strong></p>');
                                $("#divmessageRestoreModal").removeAttr("class", "hide");
                                $("#divmessageRestoreModal").fadeIn(1500);
                                $("#divmessageRestoreModal").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 6000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessageRestoreModal").removeAttr("class", "alert alert-success");
                                $("#spnmessageRestoreModal").attr("class", "alert alert-danger");
                                $("#spnmessageRestoreModal").html('<p><strong>Unable to restore this product please contact technical team, thank you!</strong></p>');
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
            $(".editProduct").click(function () {
                p_id = this.id;

                if (p_id !== null) {
                    $("#edit_yes").attr('href','<?php echo base_url();?>/index.php/products_c/edit_products_page/'+p_id);
                    
                } else {
                    $("#edit_yes").val("no_value");
                }

            });
        </script>
        
       

    </body>    
</html>
