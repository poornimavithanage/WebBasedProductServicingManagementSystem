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
                                <li><a style="text-decoration: none;" href="#" class="di">View Invoice Details</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/billing_c/bill_m_tbl_view" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
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
                                            <h3 class="panel-title"><strong>Billing Details:</strong> <?php echo $bill_m_details[0]->invoice_no; ?> | <?php echo $cus_details[0]->cus_name; ?> | <?php echo $bill_m_details[0]->total_amount; ?> | <?php echo $bill_m_details[0]->customer_id; ?> </h3>
                                            <span class="pull-right clickable" style="margin-top: -20px; font-size: 15px; cursor: pointer;"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                        </div>

                                        <div class="panel-body">
                                            <div class="row">
                                                <div class=" col-md-9 col-lg-9 "> 
                                                  <table class="table table-user-information">
                                                    <tbody>
                                                      <tr>
                                                        <td>Customer ID</td>
                                                        <td><?php echo $bill_m_details[0]->customer_id; ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td>Customer Name</td>
                                                        <td><strong><?php echo$cus_details[0]->cus_name; ?></strong></td>
                                                      </tr>
                                                      <tr>
                                                        <td>Invoice No</td>
                                                        <td><?php echo $bill_m_details[0]->invoice_no; ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td>Invoice Date</td>
                                                        <td><?php echo $bill_m_details[0]->invoice_date; ?></td>
                                                      </tr> 
                                                      <tr>
                                                        <td>Total Amount (Rs.)</td>
                                                        <td><strong><?php echo $bill_m_details[0]->total_amount; ?></strong></td>
                                                      </tr>
                                                    </tbody>
                                                  </table>                  
                                                </div>
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
                                        
                                        <strong>Invoice List</strong>
<!--                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#tab1primary" data-toggle="tab">Jobs</a></li>
                                                <li><a href="#tab2primary" data-toggle="tab">Purchasing</a></li>
                                                <li><a href="#tab3primary" data-toggle="tab">Backup</a></li>
                                            </ul>-->
                                    </div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <!--<div class="tab-pane fade in active" id="tab1primary">-->
                                             <div class="row">
                                                <div class=" col-md-12 col-lg-12 "> 
                                                  <table class="table table-user-information table-striped table-bordered table-list dataTables-example">

                                                    <thead>
                                                        <tr>
                                                            <th>Invoice No</th>
                                                            <th>Bill Line Item No</th>
                                                            <th>Category</th>
                                                            <th>Make</th>
                                                            <th>Model</th>
                                                            <th>Serial No</th>
                                                            <th>Invoice Date</th>
<!--                                                            <th style="width: 20%">Actions</th>-->
                                                        </tr> 
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        foreach ($Invoice_details as $ind) {

                                                            echo "<tr>";
                                                            echo "<td>" . $ind->invoice_no . "</td>";
                                                            echo "<td>" . $ind->bill_line_item_no . "</td>";
                                                            echo "<td>" . $ind->category . "</td>";
                                                            echo "<td>" . $ind->make . "</td>";
                                                            echo "<td>" . $ind->model . "</td>";
                                                            echo "<td>" . $ind->serial_no . "</td>";
                                                            echo "<td>" . $ind->invoice_date . "</td>";
//                                                            echo "<td><a target='_blank' href='". base_url()."/index.php/jobentry_c/generate_job_card/". $customer_job_detail->job_id ."' class='btn btn-danger btn-xs'><i class='icon-file' style='font-size:20px'></i>&nbsp;&nbsp;<strong>View JOB</strong></a></td>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>               
                                                    </tbody>
                                                  </table>                  
                                                </div>


                                                
                                            </div>
                                            <!--</div>-->
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

