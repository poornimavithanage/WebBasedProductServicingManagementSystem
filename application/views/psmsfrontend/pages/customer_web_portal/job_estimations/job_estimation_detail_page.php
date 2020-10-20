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

        <style>
            .invisible {
                visibility: hidden;
            }
        </style>

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
                            <h4>Job Timeline</h4>
                        </div>
                    </div>




                    <!-- Blog Post -->
                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="row" style="margin-top: 0.5%;">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="timeline-centered">

                                        <article class="timeline-entry">

                                            <div class="timeline-entry-inner">
                                                <time class="timeline-time" datetime=""><span><?php echo $job_info[0]->status; ?></span><?php echo $job_info[0]->status_change_date; ?><span></span></time>

                                                <div class="timeline-icon bg-info">
                                                    <i class="entypo-feather"></i>
                                                </div>

                                            </div>

                                        </article>
                                        <article class="timeline-entry">

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

                                                echo'<article class = "timeline-entry">';
                                                echo'<div class = "timeline-entry-inner">';
                                                echo'<time class = "timeline-time abc" datetime = ""><span style="margin-left: -71px;">Ready to Collect</span>' . $job_info[$b]->status_change_date . '<span></span></time>';
                                                echo'<div class="timeline-icon bg-success">';
                                                echo'<i class="entypo-feather"></i>';
                                                echo'</div>';
                                                echo'</div>';
                                                echo'</article>';
                                            } else if ($job_info[$b]->final_status === "Pending Estimation Approval") {

                                                echo'<article class = "timeline-entry">';
                                                echo'<div class = "timeline-entry-inner">';
                                                echo'<time class = "timeline-time abc" datetime = ""><span style="margin-left: -120px;">Pending Estimation Approval</span>' . $job_info[$b]->status_change_date . '<span></span></time>';
                                                echo'<div class="timeline-icon bg-secondary">';
                                                echo'<i class="entypo-feather"></i>';
                                                echo'</div>';
                                                echo'</div>';
                                                echo'</article>';
                                            } else if ($job_info[$b]->status === "Estimation Approved") {

                                                echo'<article class = "timeline-entry">';
                                                echo'<div class = "timeline-entry-inner">';
                                                echo'<time class = "timeline-time abc" datetime = ""><span style="margin-left: -120px;">Estimation Approved</span>' . $job_info[$b]->status_change_date . '<span></span></time>';
                                                echo'<div class="timeline-icon bg-success">';
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

                    <div class="row" style="margin-top: 3%;">
                        <div class="col-md-4">
                            <h4>Estimation</h4>
                        </div>
                    </div>



                    <!-- Estimate Block -->
                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="row" style="margin-top: 0.5%;">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <table class="table table-bordered table-hover table-sortable table-responsive" id="tab_logic">
                                        <thead>
                                            <tr>                                               
                                                <th class="text-center" style="width: 81.9%;">
                                                    Description
                                                </th>
                                                <th class="text-center">
                                                    Amount (Rs.)
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Repair Parts</td>
                                                <td><?php echo $job_estimate[0]->total_parts_markup_cost_final; ?></td>
                                            </tr>
                                            <tr>
                                                <td>VAT (<?php echo number_format((float) ($job_estimate[0]->tax_vat_limit), 2, '.', '') . " %"; ?>)</td>
                                                <td><?php echo $job_estimate[0]->tax_vat; ?></td>
                                            </tr>
                                            <tr>
                                                <td>NBT (<?php echo $job_estimate[0]->tax_nbt_limit . " %"; ?>)</td>
                                                <td><?php echo $job_estimate[0]->tax_nbt; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Technician Charges</td>
                                                <td><?php echo $job_estimate[0]->labour_cost; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                <td><strong><?php echo $job_estimate[0]->total_job_cost; ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!--/.row-->


                        </div>
                        <div class="card-footer text-muted">
                            <a style="color: black; text-decoration: none; margin-left: 74.5%;" target="_new" class="btn btn-primary" href="<?php echo base_url(); ?>index.php/customer_web_portal_c/job_estimate_pdf/<?php echo $cus_job_info[0]->job_id; ?>">Download Estimation</a>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 3%;">
                        <div class="col-md-6">
                            <h4>Terms and Condition</h4>
                        </div>
                    </div>



                    <!-- Estimate Block -->
                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="row" style="margin-top: 0.5%;">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p>Whilst in the process of repairing, should we find other parts defective, a subsequent estimate will be forwarded to you for your approval.</p>
                                    <p>Repairs will only commence on receipt of your confirmation together with 50% advance payment. Payments may be made in cash, credit card or by cheque drawn in favour of Swedish Trading Audio Visual (Private) Limited. Balance payment should be made when collect the repaired equipment. </p>
                                    <p><strong>Please note that no product will be released without the original Job Card.</strong></p>
                                    <!--                                    <br>
                                                                        <p>Thanking you.</p>
                                                                        <p>Yours faithfully, </p>
                                                                        <p>Swedish Trading Audio Visual (Private) Limited</p>-->

                                </div>
                            </div><!--/.row-->


                        </div>
                        <div class="card-footer text-muted">

                        </div>
                    </div>

                </div>



                <!-- Sidebar Widgets Column -->
                <div class="col-md-4" style="margin-top: 3%">



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
                                            } else if ($cus_job_info[0]->current_status === "Sent for estimation approval") {
                                                echo "orange";
                                            } else if ($cus_job_info[0]->current_status === "Estimation Approved") {
                                                echo "orange";
                                            }
                                            ?> "><?php
                                                    if ($cus_job_info[0]->job_status === "Order Finished") {
                                                        echo "Closed";
                                                    } else if ($cus_job_info[0]->current_status === "Sent for estimation approval") {
                                                        echo "Pending Approval";
                                                    } else if ($cus_job_info[0]->current_status === "Estimation Approved") {
                                                        echo "Estimation Approved";
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
                                            <td><?php if($warranty_end_date === "1970-01-01"){echo "Not Applicable";}else{echo $warranty_end_date;} ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-my-4 -->

                    <!-- Approval Details -->
                    <div class="card my-4 <?php if($job_estimate[0]->status ==="Pending"){ echo ""; }else { echo "invisible";} ?>">
                        <h5 class="card-header">Estimation Approval Action</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="form" id="job_estimate_customer_submit_form" method="POST" action="">
                                        <div class="row invisible">
                                            <div class="col-md-8">                                                
                                                <input class="form-control" type="text" id="job_id" name="job_id" value="<?php echo $cus_job_info[0]->job_id; ?>" />
                                            </div>
                                        </div>
                                        <div id="approve_reject_button_block" class="row" style="margin-left: 20%">
                                            <div class="col-md-3" style="margin-right: 5%">                                                
                                                <input class="btn btn-sm btn-success" type="button" id="approve" name="approve" value="Approve"/>
                                            </div>
                                            <div class="col-md-3">                                                
                                                <input class="btn btn-sm btn-warning" type="button" id="reject" name="reject" value="Reject"/>
                                            </div>
                                        </div>

                                        <div class="row invisible" id="submit_confirm_block" style="margin-left: 9%">
                                            <p id="msg"></p>
                                            <div class="col-md-5 invisible">                                                
                                                <input class="form-control" type="text" id="approval_status" name="approval_status" value="" />
                                            </div>
                                            <div class="col-md-3" style="margin-left: -25%;">                                                
                                                <input class="btn btn-xs btn-primary" type="submit" id="submit_button" name="submit_button" value="Yes"/>
                                            </div>
                                            <div class="col-md-3">                                                
                                                <input class="btn btn-xs btn-danger" type="button" id="no" name="no" value="No"/>
                                            </div>
                                        </div>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12 invisible" id="divmessage">
                                                    <div id="spnmessage" class="alert alert-success alert-dismissible" role="alert">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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


        <script>
            $(document).ready(function () {
                $("#approve").on("click", function () {
                    $("#submit_confirm_block").removeAttr('class');
                    $("#submit_confirm_block").attr('class', 'row');
                    $("#approval_status").val("Approved");
                    $("#msg").html("<strong>Are you sure you want to approve ?</strong>");
                    $("#approve_reject_button_block").attr('class', 'row invisible');
                });


                $("#reject").on("click", function () {
                    $("#submit_confirm_block").removeAttr('class');
                    $("#submit_confirm_block").attr('class', 'row');
                    $("#approval_status").val("Rejected");
                    $("#msg").html("<strong>Are you sure you want to reject ?</strong>");
                    $("#approve_reject_button_block").attr('class', 'row invisible');
                });


                $("#no").on("click", function () {
                    $("#submit_confirm_block").attr('class', 'row invisible');
                    $("#approve_reject_button_block").removeAttr('class');
                    $("#approve_reject_button_block").attr('class', 'row');
                    $("#approval_status").val("");
                });
            });
        </script>


        <!-- this Jquery handles the add customer function : Add customer modal form -->
        <script>
            $(document).ready(function () {
                $("#job_estimate_customer_submit_form").submit(function (e) {
                    e.preventDefault();
//                    if (!$(this).valid())
//                        return false;
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/customer_web_portal_c/customer_job_estimation_submit",
                        data: $("#job_estimate_customer_submit_form").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<strong> Successfuly' + data.status+ '</strong>');
                                $("#divmessage").removeAttr("class", "invisible");
                                $("#divmessage").attr("class", "col-md-12");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    //location.reload();
                                    window.location.href = "<?php echo base_url(); ?>/index.php/customer_web_portal_c/customer_web_portal_dashboard";
                                }, 5000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<strong>Unable to approve the estimation');
                                $("#divmessage").removeAttr("class", "invisible");
                                $("#divmessage").attr("class", "col-md-12");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>

    </body>

</html>
