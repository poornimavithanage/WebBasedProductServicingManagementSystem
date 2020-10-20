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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        




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
                                <li><a style="text-decoration: none;" href="#" class="di">View Purchase Order Details</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/supplier_c/supplier_purchase_view" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div style="padding-top: 0px;">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><strong>Supplier Purchase Details:</strong> <?php echo $purchase_details[0]->supplier_purchase_id; ?> | <?php echo $supplier_details[0]->supp_id; ?> | <?php echo $supplier_details[0]->supp_name; ?></h3>
                                            <span class="pull-right clickable" style="margin-top: -20px; font-size: 15px; cursor: pointer;"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                        </div>

                                        <div class="panel-body">
                                            <div class="row">
                                                <div class=" col-md-4 col-lg-4 "> 
                                                  <table class="table table-user-information table-striped">
                                                    <tbody>
                                                      <tr>
                                                        <td><strong>Purchase ID:</strong></td>
                                                        <td><?php echo $purchase_details[0]->supplier_purchase_id; ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td><strong>Supplier ID:<strong></td>
                                                        <td><?php echo $supplier_details[0]->supp_id; ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td><strong>Supplier Name:</strong></td>
                                                        <td><?php echo $supplier_details[0]->supp_name; ?></td>
                                                      </tr>    
                                                      <tr>
                                                        <td><strong>Sales Order No:</strong></td>
                                                        <td><?php echo $purchase_details[0]->sales_order_no; ?></td>
                                                      </tr>                    
                                                    </tbody>
                                                  </table>                  
                                                </div>
                                                <!-- <div class=" col-md-4 col-lg-4 "> 
                                                  <table class="table table-user-information table-striped">
                                                    <tbody>
                                                      <tr>
                                                        <td><strong>Purchase ID:</strong></td>
                                                        <td><?php echo $purchase_details[0]->supplier_purchase_id; ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td><strong>Supplier ID:<strong></td>
                                                        <td><?php echo $supplier_details[0]->supp_id; ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td><strong>Supplier Name:</strong></td>
                                                        <td><?php echo $supplier_details[0]->supp_name; ?></td>
                                                      </tr>    
                                                      <tr>
                                                        <td><strong>Sales Order No:</strong></td>
                                                        <td><?php echo $purchase_details[0]->sales_order_no; ?></td>
                                                      </tr>                    
                                                    </tbody>
                                                  </table>                  
                                                </div> -->
                                            </div><!--/.row -->
                                        </div><!--/. panel body -->
                                    </div><!--/. pannel info -->
                                </div><!--/.style tag-->
                            </div><!-- /.col-lg-12 -->
                        </div><!-- /.col-md-12 -->
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="panel with-nav-tabs panel-primary">
                                    <div class="panel-heading">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#pop" data-toggle="tab">Proof of Purchase</a></li>
                                                <li><a href="#tab2primary" data-toggle="tab">Purchasing</a></li>
                                                <li><a href="#tab3primary" data-toggle="tab">Backup</a></li>
                                            </ul>
                                    </div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="pop">

                                                <div class="row">
                                                <div class=" col-md-12 col-lg-12 "> 
                                                  <table class="table table-user-information table-striped table-bordered table-list dataTables-example">

                                                    <thead>
                                                        <tr>
                                                            <th>Supplier Purchase No</th>
                                                            <th>Supplier ID</th>
                                                            <th>Sales Order No</th>
                                                            <th>Sales Date</th>
                                                            <th style="width: 20%">Actions</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        foreach ($purchase_details as $sup_purch_details) {

                                                            echo "<tr>";
                                                            echo "<td>" . $sup_purch_details->supplier_purchase_id . "</td>";
                                                            echo "<td>" . $sup_purch_details->supp_id . "</td>";
                                                            echo "<td>" . $sup_purch_details->sales_order_no . "</td>";
                                                            echo "<td>" . $sup_purch_details->sales_date . "</td>";
                                                            echo "<td><a target='_blank' href='". base_url()."/uploads/proof_of_purchase/". $sup_purch_details->supp_id ."/".$sup_purch_details->sales_year."/" . $sup_purch_details->sales_order_no . "/".$sup_purch_details->document_name."' class='btn btn-danger btn-xs'><i class='fa fa-file-pdf-o' style='font-size:20px'></i>&nbsp;&nbsp;<strong>View POP</strong></a></td>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>               
                                                    </tbody>
                                                  </table>                  
                                                </div>


                                                
                                            </div>
                                            <div class="tab-pane fade" id="tab2primary">Purchasing History Tables</div>
                                            <div class="tab-pane fade" id="tab3primary">Backup History Tables</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        <!-- for panel Collapsible -->
        <script type="text/javascript">
            jQuery(function ($) {
                $('.panel-heading span.clickable').on("click", function (e) {
                    if (($(this).hasClass('panel-collapsed'))) {
                        // expand the panel
                        $(this).parents('.panel').find('.panel-body').slideDown();
                        $(this).removeClass('panel-collapsed');
                        $(this).find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                    }
                    else {
                        // collapse the panel
                        $(this).parents('.panel').find('.panel-body').slideUp();
                        $(this).addClass('panel-collapsed');
                        $(this).find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');

                    }
                });
            });
        </script>

    </body>    
</html>

