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
                                <li><a style="text-decoration: none;" href="#" class="di">Supplier Purchase</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/supplier_c/add_supplier_purchase_page_new" class="btn btn-round-sm btn-sm btn-primary">Add Supplier Purchase</a>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="panel with-nav-tabs panel-default">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#activeSupplierWarranty" data-toggle="tab">Supplier Purchase</a></li>
<!--                                            <li class=""><a href="#removedSupplierWarranty" data-toggle="tab">Advance Search</a></li>-->
                                        </ul>
                                    </div>
                                    <div class="panel-body" >
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="activeSupplierWarranty"><!-- 1st step: Add Tour Details Form -->

                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Supplier Purchase No</th>
<!--                                                            <th>Supplier ID</th>-->
                                                            <th>Sales Order No</th>
                                                            <th>Sales Date</th>
                                                            <th>Category</th>
                                                            <th>Make</th>
                                                            <th>Model</th>
<!--                                                            <th>warranty applicability</th>-->
                                                            <th>warranty period</th>
                                                            <th>Warranty Start</th>
                                                            <th>Warranty End</th>
                                                            <th style="width: 20%">Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($active_supplier_warranty as $act_supwarr) {

                                                            echo "<tr>";
                                                            echo "<td>" . $act_supwarr->supplier_purchase_id . "</td>";
//                                                            echo "<td>" . $act_supwarr->supp_id . "</td>";
                                                            echo "<td>" . $act_supwarr->sales_order_no . "</td>";
                                                            echo "<td>" . $act_supwarr->sales_date . "</td>";
                                                            echo "<td>" . $act_supwarr->category . "</td>";
                                                            echo "<td>" . $act_supwarr->make . "</td>";
                                                            echo "<td>" . $act_supwarr->model . "</td>";
//                                                            echo "<td>" . $act_supwarr->warranty_applicability . "</td>";
                                                            echo "<td>" . $act_supwarr->warranty_years_text . "</td>";   
                                                            echo "<td>" . $act_supwarr->supplier_warranty_start . "</td>";
                                                            echo "<td>" . $act_supwarr->supplier_warranty_end . "</td>";
                                                            echo "<td>";
                                                          //  echo "<a id='" . $act_supwarr->supplier_purchase_id . "' href='#edit_confirmation_modal' data-toggle='modal' class='editSupplierWarranty btn btn-warning btn-xs' style='margin-right: 5%;'><i class='icon-edit'></i>&nbsp;Edit</a>";
                                                            echo "<a href='". base_url()."/index.php/supplier_c/supplier_purchase_detail_view/".$act_supwarr->supplier_purchase_id."' class='btn btn-info btn-xs'><i class='icon-external-link'></i>&nbsp;View</a>&nbsp; &nbsp;";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div><!--/. 1st step: P Type -->
                                            
                                        </div><!--/. tab-content -->
                                    </div><!--/. panel-body -->
                                </div><!--/. panel with-nav-tabs panel-default -->
                            </div><!-- /.col-lg-12 -->
                        </div><!-- /.col-md-12 -->
                    </div><!--/.row-->




                </div><!--/. inner -->
            </div><!--END PAGE CONTENT -->
        </div><!--END MAIN WRAPPER -->
       
                <!-- edit supplier warranty modal -->
        <div class="modal fade" id="edit_confirmation_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Supplier Purchase Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Are you sure, you want to edit this details ? </strong></p>
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

        <script>
            $(".editSupplierWarranty").click(function () {
                sw_id = this.id;

                if (sw_id !== null) {
                    $("#edit_yes").attr('href','<?php echo base_url();?>/index.php/supplier_c/edit_supplier_purchase_page/'+sw_id);
                    
                } else {
                    $("#edit_yes").val("no_value");
                }

            });
    </script>
        
    </body>    
</html>
