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
            <?php $this->load->view('psmsbackend/service_manager/template_service_manager/navigation_service_manager'); ?>
            <!--END MENU SECTION -->

            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height:1200px;">
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Dashboard</a></li>
                                <li><a style="text-decoration: none;" href="#" class="di">Job Entry</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row <?php if($page_msg === "sent_to_store_manager"){ echo "";}else{ echo "hide";} ?>" id="page_msg">
                        <div class="container-fluid">
                            <div class="col-md-12" id="divmessage_3">
                                <div id="spnmessage_3" class="alert alert-success alert-dismissible" role="alert">
                                    Job : <?php echo $job_id; ?> repair details successfully sent to store manager!
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="panel with-nav-tabs panel-default">
                                     <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <strong>Jobs Assigned to Me</strong>
                                        </ul>
                                    </div></div>
                                    <div class="panel-body" >
                                        <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Job No</th>
                                                    <th>Customer ID</th>
                                                    <th>Category</th>
                                                    <th>Make</th>
                                                    <th>Model</th>
                                                    <th>Serial No</th>
                                                    <th>Repair Mode</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr> 
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($assigned_to_me_job_list as $assigned_jobs) {

                                                    echo "<tr>";
                                                    echo "<td>" . $assigned_jobs->job_id . "</td>";
                                                    echo "<td>" . $assigned_jobs->customer_id . "</td>";
                                                    echo "<td>" . $assigned_jobs->category . "</td>";
                                                    echo "<td>" . $assigned_jobs->make . "</td>";
                                                    echo "<td>" . $assigned_jobs->model . "</td>";
                                                    echo "<td>" . $assigned_jobs->serial_no . "</td>";
                                                    echo "<td>" . $assigned_jobs->warranty_type . "</td>";
                                                    echo "<td>" . $assigned_jobs->current_status . "</td>";
                                                    echo "<td>";
                                                    echo "<a href='". base_url()."/index.php/service_manager_c_view/load_service_mgr_job_form_page_method/".$assigned_jobs->job_id."' class='btn btn-success btn-xs'><i class='icon-briefcase'></i>&nbsp;Update Job Card</a>&nbsp; &nbsp";
                                                    echo "<a href='". base_url()."/index.php/service_manager_c_view/view_job_detail_page?var1=".$assigned_jobs->job_id."' class='btn btn-warning btn-xs'><i class='icon-external-link'></i>&nbsp;View</a>&nbsp; &nbsp";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div><!--/. panel-body -->
                                </div><!--/. panel with-nav-tabs panel-default -->
                            </div><!-- /.col-lg-12 -->
                        </div><!-- /.col-md-12 -->
                    </div><!--/.row-->


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

                $('.close_modal').click(function () {
                    $('#addjobform')[0].reset(); // reset the add job modal form after closing it.
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function (){

                setTimeout(function(){
                  $("#page_msg").hide("Slow");
                }, 4000);

            });
        </script>
        

    </body>    
</html>
