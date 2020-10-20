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
            <?php $this->load->view('psmsbackend/front_desk/template_front_desk/navigation_front_desk'); ?>
            <!--END MENU SECTION -->

            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height:1200px;">
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Front Officer Dashboard</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    


                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><strong>Status wise Job Analysis</strong></div>
                                <div class="<?php
                                if ($chart_1 === "no_data") {
                                    echo "hide";
                                } else {
                                    echo "";
                                }
                                ?>" id="canvas-holder" style="width:125%; margin-left: 15%;">
                                    <canvas id="chart-area-1" height="357"></canvas>
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
                                <div class="panel-heading"><strong>Repair Mode Job Analysis</strong></div>
                                <div <?php
                                if ($chart_2 === "no_data") {
                                    echo "hide";
                                } else {
                                    echo "";
                                }
                                ?> id="canvas-holder" style="width:135%; margin-left: 15%;">
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
                         <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><strong>Employee Analysis</strong></div>
                                <div class="<?php
                                if ($chart_3 === "no_data") {
                                    echo "hide";
                                } else {
                                    echo "";
                                }
                                ?>" id="canvas-holder" style="width:135%; margin-left: 15%;">
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
                        
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><strong>Payment Job Analysis</strong></div>
                                <div class="<?php
                                if ($chart_4 === "no_data") {
                                    echo "hide";
                                } else {
                                    echo "";
                                }
                                ?>" id="canvas-holder" style="width:135%; margin-left: 15%;">
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
<?php echo $pending_job_count; ?>,
<?php echo $tech_WIP_job_count; ?>,
<?php echo $estimate_approval_pending_job_count; ?>,
<?php echo $Store_Manager_WIP_job_count; ?>,
<?php echo $Order_Finished_job_count; ?>],

                            backgroundColor: [
                                window.chartColors.navyblue,
                                window.chartColors.black,
                                window.chartColors.pink,
                                window.chartColors.lightgreen,
                                window.chartColors.yellow
                                
                            ],
                            label: 'Dataset 1'
                        }],
                    labels: [
                        'Pending Jobs',
                        'Technician WIP Jobs',
                        'Pending Approval Jobs',
                        'Store Manager WIP Jobs',
                        'Order Finished Jobs'
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
<?php echo $customer_repair_job_count; ?>,
<?php echo $company_warranty_job_count; ?>],


                            backgroundColor: [
                                window.chartColors.red,
                                window.chartColors.purple
                               
                                
                            ],
                            label: 'Dataset 1'
                        }],
                    labels: [
                        'Customer Repair',
                        'Company Warranty'
                        
                       ]
                },
                options: {
                    responsive: true
                }
            };

          //3st Chart
            var config3 = {
                type: 'pie',
                data: {
                    datasets: [{data: [
<?php echo $front_desk_employee_count; ?>,
<?php echo $technician_count; ?>,
<?php echo $service_manager_count; ?>,
<?php echo $store_keeper_count; ?>],

                            backgroundColor: [
                                window.chartColors.navyblue,
                                window.chartColors.lightgreen,
                                window.chartColors.grey,
                                window.chartColors.orange
                               
                            ],
                            label: 'Dataset 1'
                        }],
                    labels: [
                        'Front Desk',
                        'Technicians',
                        'Service Managers',
                        'Store Keepers'
                        
                    ]
                },
                options: {
                    responsive: true
                }
            };

//4th Chart
            var config4 = {
                type: 'pie',
                data: {
                    datasets: [{data: [
<?php echo $full_paid_job_count; ?>,
<?php echo $pending_job_count; ?>],


                            backgroundColor: [
                                window.chartColors.navyblue,
                                window.chartColors.orange
                              
                               
                            ],
                            label: 'Dataset 1'
                        }],
                    labels: [
                        'Full Paid Jobs',
                        'Pending Payment Jobs'
                       
                        
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
