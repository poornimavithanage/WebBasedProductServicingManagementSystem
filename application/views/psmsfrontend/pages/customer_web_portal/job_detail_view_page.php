<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">



        <!-- Bootstrap core CSS -->
        <?php $this->load->view('psmsfrontend/template/head_css'); ?>
        <?php $this->load->view('psmsfrontend/template/job_detail_page_css'); ?>

    </head>

    <body>

        <!-- Navigation -->
        <?php $this->load->view('psmsfrontend/template/header'); ?>

        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <!-- Blog Entries Column -->
                <div class="col-md-8">


                    <div class="row" style="margin-top: 3%;">
                        <div class="col-md-4">
                            <h3>Job Timeline</h3>
                        </div>
                    </div>




                    <!-- Blog Post -->
                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="row" style="margin-top: 0.5%;">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="timeline-centered">

                                        <article class="timeline-entry">  <!-- blue color -->

                                            <div class="timeline-entry-inner">
                                                <time class="timeline-time" datetime=""><span><?php echo $job_info[0]->status; ?></span><?php echo $job_info[0]->status_change_date; ?><span></span></time>

                                                <div class="timeline-icon bg-info">
                                                    <i class="entypo-feather"></i>
                                                </div>

                                            </div>

                                        </article>
                                        <article class="timeline-entry"> <!-- Orange Color -->

                                            <div class="timeline-entry-inner">
                                                <time class="timeline-time" datetime=""><span style="margin-left: -71px;"><?php
                                                        if ($job_info[1]->status === "Technician WIP") {
                                                            echo "Working Progress";
                                                        } else {
                                                            echo "";
                                                        }
                                                        ?></span><?php echo $job_info[0]->status_change_date; ?><span></span></time>

                                                <div class="timeline-icon bg-warning">
                                                    <i class="entypo-feather"></i>
                                                </div>

                                            </div>

                                        </article>
                                        <?php
                                        for ($b = 0; $b < count($job_info); $b++) {


                                            if ($job_info[$b]->final_status === "Finished not collected") {

                                                echo'<article class = "timeline-entry ">'; //Green Color
                                                echo'<div class = "timeline-entry-inner">';
                                                echo'<time class = "timeline-time abc" datetime = ""><span style="margin-left: -71px;">Ready to Collect</span>' . $job_info[$b]->status_change_date . '<span></span></time>';
                                                echo'<div class="timeline-icon bg-success">';
                                                echo'<i class="entypo-feather"></i>';
                                                echo'</div>';
                                                echo'</div>';
                                                echo'</article>';
                                            } else if ($job_info[$b]->final_status === "Order Finished") {

                                                echo'<article class = "timeline-entry begin">';
                                                echo'<div class = "timeline-entry-inner">';
                                                echo'<time class = "timeline-time abc" datetime = ""><span style="margin-left: -120px;">Close</span>' . $job_info[$b]->status_change_date . '<span></span></time>';
                                                echo'<div class="timeline-icon bg-secondary">';
                                                echo'<i class="entypo-feather"></i>';
                                                echo'</div>';
                                                echo'</div>';
                                                echo'</article>';
                                            } else if ($job_info[$b]->final_status === "Pending Estimation Approval") {

                                                echo'<article class = "timeline-entry ">';
                                                echo'<div class = "timeline-entry-inner">';
                                                echo'<time class = "timeline-time abc" datetime = ""><span style="margin-left: -120px;">Pending Estimation Approval</span>' . $job_info[$b]->status_change_date . '<span></span></time>';
                                                echo'<div class="timeline-icon bg-success">';
                                                echo'<i class="entypo-feather"></i>';
                                                echo'</div>';
                                                echo'</div>';
                                                echo'</article>';
                                            } else if ($job_info[$b]->final_status === "On Hold") {

                                                echo'<article class = "timeline-entry ">';
                                                echo'<div class = "timeline-entry-inner">';
                                                echo'<time class = "timeline-time abc" datetime = ""><span style="margin-left: -120px;">On Hold</span>' . $job_info[$b]->status_change_date . '<span></span></time>';
                                                echo'<div class="timeline-icon bg-success">';
                                                echo'<i class="entypo-feather"></i>';
                                                echo'</div>';
                                                echo'</div>';
                                                echo'</article>';
                                            } else if ($job_info[$b]->status === "Estimation Approved") {

                                                echo'<article class = "timeline-entry ">';
                                                echo'<div class = "timeline-entry-inner">';
                                                echo'<time class = "timeline-time abc" datetime = ""><span style="margin-left: -120px;">Estimation Approved</span>' . $job_info[$b]->status_change_date . '<span></span></time>';
                                                echo'<div class="timeline-icon bg-secondary">';
                                                echo'<i class="entypo-feather"></i>';
                                                echo'</div>';
                                                echo'</div>';
                                                echo'</article>';
                                            }
//                                    else {
//
//                                    }
//                                    echo'</div>';
//                                    echo'</article>';
                                        }
                                        ?>


                                    </div>                            
                                </div>
                            </div><!--/.row-->


                        </div>
                        <div class="card-footer text-muted">

                        </div>
                    </div>
                    
                    

                </div>
                
                

                <!-- Sidebar Widgets Column -->
                <div class="col-md-4">

                    <!-- Search Widget -->
<!--                    <div class="card my-4">
                        <h5 class="card-header">Search Job</h5>
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Job Id...">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="button">Go!</button>
                                </span>
                            </div>
                        </div>
                    </div>-->

                    <!-- Asset Details -->
                    <div class="card my-4">
                        <h5 class="card-header">Job Details</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-list ">
                                        <tr>
                                            <th>Job No</th>
                                            <td><?php echo $cus_job_info[0]->job_id; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Created Date</th>
                                            <td><?php echo $cus_job_info[0]->job_date; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Current Status</th>
                                            <td style="color:<?php
                                            if ($cus_job_info[0]->job_status === "Order Finished") {
                                                echo "red";
                                            } else if($cus_job_info[0]->current_status === "Sent for estimation approval"){
                                                echo "orange";
                                            }
                                            ?> "><?php
                                                    if ($cus_job_info[0]->job_status === "Order Finished") {
                                                        echo "Closed";
                                                    } else if($cus_job_info[0]->current_status === "Sent for estimation approval"){
                                                        echo "Pending Approval";
                                                    }
                                                    ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Problem Description</th> 
                                        </tr>
                                    </table>
                                    <table class="table-list" style="margin-top: -6%; margin-left: 4%;">
                                        <tr> <td><?php echo $cus_job_info[0]->problem_description; ?></td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Asset Details -->
                    <div class="card my-4">
                        <h5 class="card-header">Asset Details</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-list ">
                                        <tr>
                                            <th>Category</th>
                                            <td><?php echo $cus_job_info[0]->category; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Make</th>
                                            <td><?php echo $cus_job_info[0]->make; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Model</th>
                                            <td><?php echo $cus_job_info[0]->model; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Serial No</th>
                                            <td><?php echo $cus_job_info[0]->serial_no; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Warrenty Details -->
                    <div class="card my-4">
                        <h5 class="card-header">Warranty Details</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-list ">
                                        <tr>
                                            <th>Invoice No</th>
                                            <td><?php echo $invoice_no; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Invoice Date</th>
                                            <td><?php echo $invoice_date; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Warranty End </th>
                                            <td><?php echo $warranty_end_date; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-my-4 -->
                </div>
                <!-- /.col-md-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

        <!-- Footer -->
        <?php $this->load->view('psmsfrontend/template/footer'); ?>



        <!-- Bootstrap core JavaScript -->
        <?php $this->load->view('psmsfrontend/template/head_js'); ?>

    </body>

</html>
