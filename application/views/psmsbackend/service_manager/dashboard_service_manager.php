<!DOCTYPE html>
<html lang="en">

    <head>

        <!-- META -->
        <?php $this->load->view('psmsbackend/template/meta'); ?>
        <!-- END META -->
        <!-- Core CSS -->
        <?php $this->load->view('psmsbackend/template/head_css'); ?>

        <style>
            canvas {
                width: 100% !important;
                height: auto !important;
                margin-left: -25%;
            }
        </style>
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
            <?php $this->load->view('psmsbackend/service_manager/template_service_manager/navigation_service_manager'); ?>
            <!--END MENU SECTION -->

            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height:1200px;">
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Service Manager Dashboard</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row hide">
                        <div class="col-lg-12">
                            <h3><strong>Service Manager Dashboard</strong></h3>
                        </div>
                    </div>


                    <div class="row">                        
                        <div class="col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><strong>Job Analysis</strong></div>
                                <div class="<?php
                                if ($chart_1 === "no_data") {
                                    echo "hide";
                                } else {
                                    echo "";
                                }
                                ?>" id="canvas-holder" style="width:148%; margin-left: 13%;">
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
                        <div class="col-md-7">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><strong>In Progress Job Analysis</strong></div>
                                <div <?php
                                if ($chart_2 === "no_data") {
                                    echo "hide";
                                } else {
                                    echo "";
                                }
                                ?> id="canvas-holder" style="width:104%; margin-left: 23%;">
                                    <canvas id="chart-area-2"></canvas>

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

                    <div class="row">                        
                        <div class="col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><strong>Job Analysis By Product Category</strong></div>
                                <div class="<?php
                                if ($chart_3 === "no_data") {
                                    echo "hide";
                                } else {
                                    echo "";
                                }
                                ?>" id="canvas-holder" style="width:148%; margin-left: 13%;">
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
                        <div class="col-md-7">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><strong>Estimation Job Analysis</strong></div>
                                <div class="<?php
                                if ($chart_4 === "no_data") {
                                    echo "hide";
                                } else {
                                    echo "";
                                }
                                ?>" id="canvas-holder" style="width:104%; margin-left: 23%;">
                                    <canvas id="chart-area-4"></canvas>
                                </div>
                                <?php
                                if ($chart_4 === "no_data") {
                                    echo "<p style='margin-left: 44%;color: red;'><strong>Data not found</strong></p>";
                                } else {
                                    echo "";
                                }
                                ?>
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
<?php echo $in_progress__job_count; ?>],

                            backgroundColor: [
                                window.chartColors.green,
                                window.chartColors.orange
                            ],
                            label: 'Dataset 1'
                        }],
                    labels: [
                        'New Jobs',
                        'In Progress Jobs'
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
<?php echo $technician_wip_count; ?>,
<?php echo $sent_to_store_count; ?>,
<?php echo $store_manager_wip_count; ?>,
<?php echo $sent_to_technician_count; ?>,
<?php echo $finished_not_collected_count; ?>,
<?php echo $order_finished_count; ?>],

                            backgroundColor: [
                                window.chartColors.black,
                                window.chartColors.orange,
                                window.chartColors.yellow,
                                window.chartColors.green,
                                window.chartColors.blue,
                                window.chartColors.red
                            ],
                            label: 'Dataset 1'
                        }],
                    labels: [
                        'Technician WIP',
                        'Sent to store keeper',
                        'Store Manager WIP',
                        'Sent to Technician',
                        'Finished not collected',
                        'Order Finished'

                    ]
                },
                options: {
                    responsive: true
                }
            };


            //3rd Chart
            var config3 = {
                type: 'pie',
                data: {
                    datasets: [{data: [
<?php echo $projectors_count; ?>,
<?php echo $microphones_count; ?>,
<?php echo $amplifiers_count; ?>,
<?php echo $conference_count; ?>],

                            backgroundColor: [
                                window.chartColors.yellow,
                                window.chartColors.green,
                                window.chartColors.blue,
                                window.chartColors.red
                            ],
                            label: 'Dataset 1'
                        }],
                    labels: [
                        'Projectors',
                        'Microphones',
                        'Amplifiers',
                        'Conference'

                    ]
                },
                options: {
                    responsive: true
                }
            };
            
            //4rd Chart
            var config4 = {
                type: 'pie',
                data: {
                    datasets: [{data: [
<?php echo $new_estimate_count; ?>,
<?php echo $pending_estimate_count; ?>,
<?php echo $approved_estimate_count; ?>,
<?php echo $rejected_estimate_count; ?>],

                            backgroundColor: [
                                window.chartColors.blue,
                                window.chartColors.yellow,
                                window.chartColors.green,
                                window.chartColors.red
                            ],
                            label: 'Dataset 1'
                        }],
                    labels: [
                        'New Estimations',
                        'Pending Estimations',
                        'Approved Estimations',
                        'Rejected Estimations'

                    ]
                },
                options: {
                    responsive: true
                }
            };









            window.onload = function () {
                var ctx1 = document.getElementById('chart-area-1').getContext('2d');
                window.myPie = new Chart(ctx1, config1);

                var ctx2 = document.getElementById('chart-area-2').getContext('2d');
                window.myPie = new Chart(ctx2, config2);

                var ctx3 = document.getElementById('chart-area-3').getContext('2d');
                window.myPie = new Chart(ctx3, config3);
                
                var ctx4 = document.getElementById('chart-area-4').getContext('2d');
                window.myPie = new Chart(ctx4, config4);
            };
        </script>



<!--        <script>

    var config1 = {
        type: 'pie',
        data: {
//                    datasets: [{data: [5, 4], backgroundColor: [window.chartColors.Black, window.chartColors.orange
            datasets: [{data: [
        <?php //echo $technician_wip_count;   ?>,
        <?php //echo $sent_to_store_count;   ?>,
        <?php //echo $store_manager_wip_count;   ?>,
        <?php //echo $sent_to_technician_count;   ?>,
        <?php //echo $finished_not_collected_count;   ?>,
        <?php //echo $order_finished_count;   ?>],

                    backgroundColor: [
                        window.chartColors.Black,
                        window.chartColors.orange,
                        window.chartColors.yellow,
                        window.chartColors.green,
                        window.chartColors.blue,
                        window.chartColors.Red
                    ],
                    label: 'Dataset 1'
                }],
            labels: [
                'Technician WIP',
                'Sent to store keeper',
                'Store Manager WIP',
                'Sent to Technician',
                'Finished not collected',
                'Order Finished'
                
            ]
        },
        options: {
            responsive: true
        }
    };

    window.onload = function () {
        var ctx1 = document.getElementById('chart-area1').getContext('2d');
        window.myPie1 = new Chart(ctx1, config1);
    };
</script>-->



    </body>    
</html>
