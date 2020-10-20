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
        <!--<link href="<?php //echo base_url();      ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
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
                                <li><a style="text-decoration: none;" href="#" class="di">On Hold Jobs</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->


                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="panel with-nav-tabs panel-default">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <ul class="nav nav-tabs">
                                                <strong>On Hold Jobs</strong>
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
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr> 
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($job_on_hold as $list) {

                                                    echo "<tr>";
                                                    echo "<td>" . $list->job_id . "</td>";
                                                    echo "<td>" . $list->customer_id . "</td>";
                                                    echo "<td>" . $list->category . "</td>";
                                                    echo "<td>" . $list->make . "</td>";
                                                    echo "<td>" . $list->model . "</td>";
                                                    echo "<td>" . $list->serial_no . "</td>";
                                                    echo "<td>" . $list->current_status . "</td>";
                                                    echo "<td>";
                                                    echo "<a href='" . base_url() . "index.php/jobentry_c/view_on_hold_job_detail_page?var1=" . $list->job_id . "' class='btn btn-success btn-xs'><i class='icon-briefcase'></i>&nbsp;View</a>&nbsp; &nbsp";
                                                    echo "</td>";
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
        <!--<script src="<?php //echo base_url();      ?>psmsbackendtheme/plugins/dataTables/jquery.dataTables.js"></script>-->
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js" type="text/javascript"></script>
        <!--<script src="<?php //echo base_url();      ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>-->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable(); // jquery-bootstrap datatable 

            });
        </script>

        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('#pg_msg').attr('class', 'row hide');
                }, 4000);
            });
        </script>

        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('#pg_msg_1').attr('class', 'row hide');
                }, 4000);
            });
        </script>
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('#pg_msg_2').attr('class', 'row hide');
                }, 4000);
            });
        </script>

        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('#pg_msg_3').attr('class', 'row hide');
                }, 4000);
            });
        </script>

    </body>    
</html>
