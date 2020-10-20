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
        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />


        <style>

            #menu > li.panel.active ul > li.active > a::after {

                position: absolute;
                right: 0;
                border-color: transparent #c8bbbb4d transparent transparent;
                border-style: solid;
                border-width: 10px;
                content: "";

            }
        </style>

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
                                <li><a style="text-decoration: none;" href="#" class="di">Pending Estimation</a></li>
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
                                                <strong>Pending Estimations</strong>
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
                                                    <th style="width: 217.2px;">Actions</th>
                                                </tr> 
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($pending_estimation_list as $list) {

                                                    echo "<tr>";
                                                    echo "<td>" . $list->job_id . "</td>";
                                                    echo "<td>" . $list->customer_id . "</td>";
                                                    echo "<td>" . $list->category . "</td>";
                                                    echo "<td>" . $list->make . "</td>";
                                                    echo "<td>" . $list->model . "</td>";
                                                    echo "<td>" . $list->serial_no . "</td>";
                                                    echo "<td>";
                                                    echo "<a href='" . base_url() . "/index.php/service_manager_c_view/view_estimation_detail_page?var1=" . $list->job_id . "' class='btn btn-warning btn-xs'><i class='icon-external-link'></i>&nbsp;View</a>&nbsp; &nbsp";
                                                    echo "<a target='_new' href='" . base_url() . "/index.php/service_manager_c_view/generate_estimation_pdf/" . $list->job_id . "' class='btn btn-primary btn-xs'><i class='icon-external-link'></i>&nbsp;Generate Estimation</a>";
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
        <!-- END GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable();
            });
        </script>
    </body>    
</html>
