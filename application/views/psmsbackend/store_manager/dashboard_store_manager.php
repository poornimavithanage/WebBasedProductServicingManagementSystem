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

    </head>
    <body class="padTop53 " >

        <!-- MAIN WRAPPER -->
        <div id="wrap">


            <!-- HEADER SECTION -->
            <?php $this->load->view('psmsbackend/template/header'); ?>
            <!-- END HEADER SECTION -->

            <!-- MENU SECTION -->
            <?php $this->load->view('psmsbackend/store_manager/template_store_manager/navigation_store_manager'); ?>
            <!--END MENU SECTION -->

            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height:1200px;">
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Store Manager Dashboard</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><strong>Job Analysis</strong></div>
                                <div class="<?php
                                if ($chart_1 === "no_data") {
                                    echo "hide";
                                } else {
                                    echo "";
                                }
                                ?>" id="canvas-holder" style="width:120%; margin-left: -10%;">
                                    <canvas id="chart-area-1"></canvas>
                                </div>
                                <?php
                                if ($chart_1 === "no_data") {
                                    echo "<p style='margin-left: 44%;color: red;'><strong>Data not found</strong></p>";
                                } else {
                                    echo "";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><strong>Category wise Stock Inventory </strong></div>
                                <div <?php
                                if ($chart_2 === "no_data") {
                                    echo "hide";
                                } else {
                                    echo "";
                                }
                                ?> id="canvas-holder" style="width:120%; margin-left: -10%;">
                                    <canvas id="chart-area-2" style="margin-left: 1%;"></canvas>

                                </div>
                                <?php
                                if ($chart_2 === "no_data") {
                                    echo "<p style='margin-left: 44%;color: red;'><strong>Data not found</strong></p>";
                                } else {
                                    echo "";
                                }
                                ?>
                            </div>
                        </div>

                    </div>

                    <!--                <div class="row">                        
                                            <div class="col-md-6">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading"><strong>Lamp Analysis</strong></div>
                                                    <div class="<?php
                    if ($chart_3 === "no_data") {
                        echo "hide";
                    } else {
                        echo "";
                    }
                    ?>" id="canvas-holder" style="width:120%; margin-left: -10%;">
                                                        <canvas id="chart-area-3"></canvas>
                                                    </div>
                    <?php
                    if ($chart_3 === "no_data") {
                        echo "<p style='margin-left: 44%;color: red;'><strong>Data not found</strong></p>";
                    } else {
                        echo "";
                    }
                    ?>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                    -->
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/charts/utils.js" type="text/javascript"></script>

        <script>


            //1st Chart
            var config1 = {
                type: 'pie',
                data: {
                    datasets: [{data: [
<?php echo $new_job_count; ?>,
<?php echo $sent_to_technician_count; ?>,
<?php echo $sent_to_service_manager_count; ?>,
<?php echo $completed_job_count; ?>],
                            backgroundColor: [
                                window.chartColors.green,
                                window.chartColors.red,
                                window.chartColors.yellow,
                                window.chartColors.blue
                            ],
                            label: 'Dataset 1'
                        }],
                    labels: [
                        'New Jobs',
                        'Sent to Technician Jobs',
                        'Sent to Service Manager Jobs',
                        'Completed Jobs'
                    ]
                },
                options: {
                    responsive: true
                }
            };

            //2nd Chart
            var config2 = {
                type: 'pie',
                data: {
                    datasets: [{data: [
<?php echo $fuse_count; ?>,
<?php echo $control_count; ?>,
<?php echo $lamp_count; ?>,
<?php echo $lens_count; ?>,
<?php //echo $transformer_count; ?>
<?php echo $pcb_count; ?>,
<?php echo $diaphram_count; ?>,
<?php echo $capasitors_count; ?>,
<?php //echo $eca_controllers_count; ?>
<?php //echo $resistors_count; ?>
<?php //echo $tunnels_count; ?>
<?php //echo $ballast_count; ?>
<?php //echo $transistor_count; ?>],
                            backgroundColor: [
                                window.chartColors.red,
                                window.chartColors.purple,
                                window.chartColors.black,
                                window.chartColors.green,
//                                window.chartColors.blue,
                                window.chartColors.grey,
                                window.chartColors.orange,
                                window.chartColors.pink
//                                window.chartColors.lightblue,
//                                window.chartColors.darkblue
//                                window.chartColors.darkyellow
//                                window.chartColors.navyblue,
//                                window.chartColors.yellow

                            ],
                            label: 'Dataset 1'
                        }],
                    labels: [
                        'Fuse',
                        'Control',
                        'Lamp',
                        'Lens',
//                        'Transformer',
                        'PCB',
                        'Diaphram',
                        'Capasitors'
//                        'ECA Controllers',
//                        'Resistors',
//                        'Tunnels'
//                        'Ballast'
//                        'Transistors'
                    ]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'top',
//                        labels: {
//                            boxWidth: 40,
//                            padding: 1
//                        }
                    },
                }
            };






            window.onload = function () {
                var ctx1 = document.getElementById('chart-area-1').getContext('2d');
                window.myPie = new Chart(ctx1, config1);

                var ctx2 = document.getElementById('chart-area-2').getContext('2d');
                window.myPie = new Chart(ctx2, config2);

                //                var ctx3 = document.getElementById('chart-area-3').getContext('2d');
                //                window.myPie = new Chart(ctx3, config3);

                //var ctx4 = document.getElementById('chart-area-4').getContext('2d');
                //window.myPie = new Chart(ctx4, config4);
            };

        </script>
    </body>    
</html>
