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
        <!--<link href="<?php //echo base_url();    ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
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
                                <li><a style="text-decoration: none;" href="#" class="di">Job Entry</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row <?php
                    if ($page_msg === "sms_success") {
                        echo "";
                    } else {
                        echo "hide";
                    }
                    ?>" id="pg_msg">
                        <div class="container-fluid">
                            <div class="col-md-12" id="divmessage_3">
                                <div id="spnmessage_3" class="alert alert-success alert-dismissible" role="alert">
                                    <strong>Successfully sent the SMS!</strong> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row <?php
                    if ($page_msg === "sms_unsuccess") {
                        echo "";
                    } else {
                        echo "hide";
                    }
                    ?>" id="pg_msg_1">
                        <div class="container-fluid">
                            <div class="col-md-12" id="divmessage_4">
                                <div id="spnmessage_4" class="alert alert-warning alert-dismissible" role="alert">
                                    <strong>Unable to send the sms, Please check the network!</strong> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row <?php
                    if ($page_msg === "job_not_found") {
                        echo "";
                    } else {
                        echo "hide";
                    }
                    ?>" id="pg_msg_2">
                        <div class="container-fluid">
                            <div class="col-md-12" id="divmessage_5">
                                <div id="spnmessage_5" class="alert alert-danger alert-dismissible" role="alert">
                                    <strong>Job not found</strong> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row <?php
                    if ($page_msg === "order_finished_success") {
                        echo "";
                    } else {
                        echo "hide";
                    }
                    ?>" id="pg_msg_3">
                        <div class="container-fluid">
                            <div class="col-md-12" id="divmessage_6">
                                <div id="spnmessage_6" class="alert alert-success alert-dismissible" role="alert">
                                    <strong>Job status changed to Order Finished</strong> 
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
                                                <strong>Finished not Collected</strong>
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
                                                    <th>SMS Status</th>
                                                    <th>Actions</th>
                                                </tr> 
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($finished_not_collected_list as $list) {

                                                    echo "<tr>";
                                                    echo "<td>" . $list->job_id . "</td>";
                                                    echo "<td>" . $list->customer_id . "</td>";
                                                    echo "<td>" . $list->category . "</td>";
                                                    echo "<td>" . $list->make . "</td>";
                                                    echo "<td>" . $list->model . "</td>";
                                                    echo "<td>" . $list->serial_no . "</td>";
                                                    echo "<td>" . $list->warranty_type . "</td>";
                                                    echo "<td>" . $list->job_date . "</td>";
                                                    echo "<td>" . $list->sms_status . "</td>";
                                                    echo "<td>";
                                                    echo "<a href='" . base_url() . "index.php/front_desk_c_view/view_job_finished_not_collected?var1=" . $list->job_id . "' class='btn btn-success btn-xs'><i class='icon-briefcase'></i>&nbsp;View</a>&nbsp; &nbsp";
                                                    echo "<a href='" . base_url() . "index.php/front_desk_c_view/send_sms_finished_not_collected/" . $list->job_id . "' class='btn btn-warning btn-xs'><i class='icon-external-link'></i>&nbsp;Send SMS</a>&nbsp; &nbsp";
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
        <!--<script src="<?php //echo base_url();    ?>psmsbackendtheme/plugins/dataTables/jquery.dataTables.js"></script>-->
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js" type="text/javascript"></script>
        <!--<script src="<?php //echo base_url();    ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>-->
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
