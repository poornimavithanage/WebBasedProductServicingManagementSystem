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
            <?php $this->load->view('psmsbackend/technician/template_technician/navigation_technician'); ?>
        <!--END MENU SECTION -->
        
        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner" style="min-height:1200px;">
                <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Technician Dashboard</a></li>
                            </ul>
                        </div>
                </div><!--/.row-->
                
                
                
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
                                ?>" id="canvas-holder" style="width:130%; margin-left: -13%;">
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
                                <div class="panel-heading"><strong>Repair Mode Job Analysis</strong></div>
                                <div <?php
                                if ($chart_2 === "no_data") {
                                    echo "hide";
                                } else {
                                    echo "";
                                }
                                ?> id="canvas-holder" style="width:104%; margin-left: -5%;">
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
<?php echo $assigned_to_me_job_count; ?>,
<?php echo $store_parts_received_job_count; ?>,
<?php echo $my_completed_job_count; ?>],

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
                        'Assigned Jobs',
                        'Store Parts Received Jobs',
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
<?php echo $customer_repair_job_count; ?>,
<?php echo $company_warranty_job_count; ?>],


                            backgroundColor: [
                                window.chartColors.red,
                                window.chartColors.yellow
                                
                                
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
 







            window.onload = function () {
                var ctx1 = document.getElementById('chart-area-1').getContext('2d');
                window.myPie = new Chart(ctx1, config1);

                var ctx2 = document.getElementById('chart-area-2').getContext('2d');
                window.myPie = new Chart(ctx2, config2);

                //var ctx3 = document.getElementById('chart-area-3').getContext('2d');
                //window.myPie = new Chart(ctx3, config3);
                
                //var ctx4 = document.getElementById('chart-area-4').getContext('2d');
                //window.myPie = new Chart(ctx4, config4);
            };
       
    </script>
</body>    
</html>
