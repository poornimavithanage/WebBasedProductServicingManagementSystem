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
        <!--<link href="<?php //echo base_url();   ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
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
            <?php $this->load->view('psmsbackend/technician/template_technician/navigation_technician'); ?>
            <!--END MENU SECTION -->

            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height:1200px;">
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Dashboard</a></li>
                                <li><a style="text-decoration: none;" href="#" class="di">New Jobs</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row <?php if ($page_msg === "unsucces") {echo "";} else { echo "hide";} ?>" id="pg_msg">
                        <div class="container-fluid">
                            <div class="col-md-12" id="divmessage_3">
                                <div id="spnmessage_3" class="alert alert-warning alert-dismissible" role="alert">
                                    <strong>Unable to assign this job to you,  Please contact administrator</strong> 
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
                                                <strong>New Jobs</strong>
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
                                                    <th>Job Open Date</th>
                                                    <th>Actions</th>
                                                </tr> 
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($new_job_list as $act_job) {

                                                    echo "<tr>";
                                                    echo "<td>" . $act_job->job_id . "</td>";
                                                    echo "<td>" . $act_job->customer_id . "</td>";
                                                    echo "<td>" . $act_job->category . "</td>";
                                                    echo "<td>" . $act_job->make . "</td>";
                                                    echo "<td>" . $act_job->model . "</td>";
                                                    echo "<td>" . $act_job->serial_no . "</td>";
                                                    echo "<td>" . $act_job->warranty_type . "</td>";
                                                    echo "<td>" . $act_job->job_date . "</td>";
                                                    echo "<td>";
                                                  //  echo "<a href='" . base_url() . "/index.php/technician_c_view/assign_job_to_me?var1=" . $act_job->job_id . "&var2=" . $tech_id . "' class='btn btn-success btn-xs'><i class='icon-briefcase'></i>&nbsp;Assign to me</a>&nbsp; &nbsp";
                                                    echo "<a href='" . base_url() . "/index.php/technician_c_view/new_job_detail_view/" . $act_job->job_id . "' class='btn btn-warning btn-xs'><i class='icon-external-link'></i>&nbsp;View</a>&nbsp; &nbsp";
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
        <!--<script src="<?php //echo base_url();   ?>psmsbackendtheme/plugins/dataTables/jquery.dataTables.js"></script>-->
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js" type="text/javascript"></script>
        <!--<script src="<?php //echo base_url();   ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>-->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
            $('.dataTables-example').dataTable(); // jquery-bootstrap datatable 
        });
        </script>
        
        <script>
            $(document).ready(function (){
                setTimeout(function(){ 
                    $('#pg_msg').attr('class', 'row hide');
                }, 4000);
            });
        </script>

    </body>    
</html>
