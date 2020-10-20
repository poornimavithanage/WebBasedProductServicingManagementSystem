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
        <!--<link href="<?php //echo base_url();     ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
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

        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>



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
                                <li><a style="text-decoration: none;" href="#" class="di">Create job card</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/jobentry_c/add_jobs_page_cus_search" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
                            </div>
                        </div>
                        <div class="col-sm-5 serial_check_status_block_2" style="margin-left: -8.4%;">
                            <input type="button" id="" class="btn btn-round-sm btn-sm btn-warning refresh_button" value="Refresh" />
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <hr>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="container-fluid">
                            <div class="col-md-12 hide" id="divmessage_1">
                                <div id="spnmessage_1" class="alert alert-success alert-dismissible" role="alert">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="serial_check_status_block_2">

                        <div class="row">
                            <div class="container-fluid">
                                <div class="col-md-12" id="divmessage_3">
                                    <div id="spnmessage_3" class="alert alert-warning alert-dismissible" role="alert">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <form class="form-horizontal" role="form" id="addjobform" method="POST" action="<?php echo base_url(); ?>index.php/jobentry_c/add_jobs">
                                    <!-- Text input-->
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Job No</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="job_id" name="job_id" value="<?php echo $job_id; ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Customer ID</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="customer_id" name="customer_id" placeholder="Customer Name" class="form-control" value="<?php echo $cus_personal_details[0]->customer_id; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Customer Name</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="cus_name" name="cus_name" placeholder="Customer Name" class="form-control" value="<?php echo $cus_personal_details[0]->cus_name; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Address</label>
                                        <div class="col-sm-5">
                                            <textarea placeholder="Address" id="address" name="address" rows="3" cols="4" class="form-control" readonly=""><?php echo $cus_personal_details[0]->cus_address; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Invoice No</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="invoice_no" name="invoice_no" value="<?php echo $invoice_no; ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Invoice Date</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="invoice_date" name="invoice_date" value="<?php echo $invoice_date; ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Job date</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="job_date" name="job_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Serial No</label>
                                        <div class="col-sm-7">
                                            <select class="select_picker show-tick" id="serial_no" name="serial_no" data-live-search="true">                                                
                                                <option disabled selected value> - select serial no - </option>
                                                <?php
                                                foreach ($serial_number_details as $serial_info) {
                                                    echo"<option value='" . $serial_info->serial_no . "'>" . $serial_info->serial_no . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!--                                    <div class="form-group" style="margin-right:10%">
                                                                            <label class="col-sm-5 control-label" for="textinput">Serial No</label>
                                                                            <div class="col-sm-5">
                                                                                <input type="text" id="serial_no" name="serial_no" class="form-control" autofocus>
                                                                            </div>
                                                                        </div> -->
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Category</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="category" name="category" placeholder="Category" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Make</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="make" name="make" placeholder="Make" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Model</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="model" name="model" placeholder="Model" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Sales Order No</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="sales_order_no" name="sales_order_no" placeholder="Sales Order No" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Sales Order Date</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="sales_order_date" name="sales_order_date" placeholder="Sales Order Date" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Warranty Type</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="warranty_type" name="warranty_type" placeholder="Warranty Type" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Problem Area</label>
                                        <div class="col-sm-5">
                                            <select class="form-control" id="technician_id" name="technician_id">
                                                <option disabled selected value> - select problem area - </option>
                                                <option value="Amila Liyanage">Not power up</option>
                                                <option value="Priyantha Liyanage">Lamp cutoff </option>
                                                <option value="Jeewan Eranga">Mother board defective</option>
                                                <option value="S.D.Sampath">Tampered</option>
                                                <option value="Supun Dias">Other</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div id="serial_check_status_block_1">
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Problem Description</label>
                                            <div class="col-sm-5">
                                                <textarea placeholder="Problem Description" id="problem_description" name="problem_description" rows="3" cols="4" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-10" style="margin-left: 59%;">
                                                <div class="pull-left">
                                                    <input type="submit" class="btn btn-primary" value="Save" />
                                                    <input type="button" class="btn btn-warning refresh_button" value="Refresh" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="serial_check_status_block_2">
                                        <div class="row">
                                            <div class="col-sm-5" style="margin-left: 64.6%; margin-bottom: 0.5%;">
                                                <input type="button" id="" class="btn btn-warning refresh_button" value="Refresh" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="container-fluid">
                                                <div class="col-md-12" id="divmessage_4">
                                                    <div id="spnmessage_4" class="alert alert-warning alert-dismissible" role="alert">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.col-lg-12 -->
                        </div><!-- /.col-md-12 -->
                    </div><!--/.row-->

                    <div class="row">
                        <div class="container-fluid">
                            <div class="col-md-12 hide" id="divmessage_2">
                                <div id="spnmessage_2" class="alert alert-success alert-dismissible" role="alert">

                                </div>
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
        <!--<script src="<?php //echo base_url();     ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>-->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-selectpicker/js/bootstrap-select.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready(function () {

                $('.select_picker').selectpicker();

                $('form').on('reset', function (event) {
                    $('.select_picker', this).each(function (index, element) {
                        var $this = $(this);
                        setTimeout(function () {
                            $this.selectpicker('val', $this.val());
                        }, 0);
                    });
                });


            });
        </script>

        <!-- This handles the add job modal form field validation -->
        <script>
            $(document).ready(function () {
                $("#addjobform").validate({
                    rules: {
                        job_id: "required",
                        customer_id: "required",
                        invoice_no: "required",
                        job_date: "required",
                        serial_no: "required",
                        make: "required",
                        model: "required",
                        problem_description: "required",
                        warranty_type: "required",
                        //backup_reason: "required",
                        //backup_type: "required",
                        sales_order_no: "required",
                        //technician_id: "required",
                        repair_mode: "required",
                        job_status: "required"
                    },
                    messages: {
                        job_id: "Please enter job no",
                        customer_id: "Please select customer name",
                        invoice_no: "Please enter invoice no",
                        job_date: "Please enter job date",
                        serial_no: "Please enter serial no",
                        make: "Please enter brand",
                        model: "Please enter model",
                        problem_description: "Please enter repair fault",
                        warranty_type: "Please select warranty type",
                        //backup_reason: "Please select backup reason",
                        //backup_type: "Please select backup type",
                        sales_order_no: "Please enter SO no",
                        //technician_id: "Please select technician name",
                        repair_mode: "Please select repair mode",
                        job_status: "Please select job status"

                    }
                });
            });
        </script>


        <script type="text/javascript">
            $(document).ready(function () {

                $(".serial_check_status_block_2").hide();

                var barcode = "";
                $('#serial_no').on('change', function (e) {

                    $("#make").val("");
                    $("#model").val("");
                    $("#sales_order_no").val("");
                    $("#sales_order_date").val("");

                    barcode = $("#serial_no").val();
                    var invoice_no = $('#invoice_no').val();

                    var code = (e.keyCode ? e.keyCode : e.which);
//                    if (code == 13)// Enter key hit
//                    {

                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/jobentry_c/get_invoice_warranty_info?var1=" + invoice_no + "&var2=" + barcode,
                        // data: $("#addjobform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);

                            if (data.result === "no_data") {

                                alert("Not valide serial no");

                            } else {


                                if (data.serial_check === "serial_not_okay") {

                                    $("#serial_check_status_block_1").hide();
                                    $(".serial_check_status_block_2").show();

                                    $("#spnmessage_3").html("<strong>There is an exisitng job for the entered serial no " + data.serial_no + "</strong><br/> Please <a href='<?php echo base_url(); ?>index.php/jobentry_c/view_job_detail_page?var1=" + data.job_id + "'>click here </a> to view");

                                    $("#spnmessage_4").html("<strong>There is an exisitng job for the entered serial no " + data.serial_no + "</strong><br/> Please <a href='<?php echo base_url(); ?>index.php/jobentry_c/view_job_detail_page?var1=" + data.job_id + "'>click here </a> to view");

                                    var make = data.info[0]["supp_product_sno_id"];

                                    $("#category").val(data.info[0]["category"]);
                                    $("#make").val(data.info[0]["make"]);
                                    $("#model").val(data.info[0]["model"]);
                                    $("#sales_order_no").val(data.info[0]["sales_order_no"]);
                                    $("#sales_order_date").val(data.info[0]["sales_date"]);
                                    $("#warranty_type").val(data.warranty_info);

                                    $("#serial_no").attr("readonly", "readonly");


                                } else {


                                    $(".serial_check_status_block_2").hide();
                                    $("#serial_check_status_block_1").show();

                                    $("#problem_description").focus();

                                    var make = data.info[0]["supp_product_sno_id"];

                                    $("#category").val(data.info[0]["category"]);
                                    $("#make").val(data.info[0]["make"]);
                                    $("#model").val(data.info[0]["model"]);
                                    $("#sales_order_no").val(data.info[0]["sales_order_no"]);
                                    $("#sales_order_date").val(data.info[0]["sales_date"]);
                                    $("#warranty_type").val(data.warranty_info);

                                    $("#serial_no").attr("readonly", "readonly");

                                }



                            }

                        }
                    });
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {

                $('.refresh_button').click(function () {
                    location.reload();
                });

            });
        </script>


        <!-- this Jquery handles the add job card function : Add jobcard modal form -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#addjobform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/jobentry_c/add_jobs",
                        data: $("#addjobform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            if (data.final_result === "success") {
                                // $('#addjobform')[0].reset();
                                $("#spnmessage_1").removeAttr("class", "alert alert-danger");
                                $("#spnmessage_1").attr("class", "alert alert-success");
                                $("#spnmessage_1").html('<p><strong>Job has created, SMS sent successfuly</strong></p>');
                                $("#divmessage_1").removeAttr("class", "hide");
                                $("#divmessage_1").fadeIn(1500);
                                $("#divmessage_1").delay(3500).fadeOut(2500);

                                $("#spnmessage_2").removeAttr("class", "alert alert-danger");
                                $("#spnmessage_2").attr("class", "alert alert-success");
                                $("#spnmessage_2").html('<p><strong>Job has created, SMS sent successfuly</strong></p>');
                                $("#divmessage_2").removeAttr("class", "hide");
                                $("#divmessage_2").removeAttr("class", "col-md-12");
                                $("#divmessage_2").fadeIn(1500);
                                $("#divmessage_2").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    //location.reload();
//                                    window.location.href = "<?php // echo base_url();   ?>index.php/jobentry_c/generate_job_card/" + data.job_id;


                                    window.open(
                                            '<?php echo base_url(); ?>index.php/jobentry_c/generate_job_card/' + data.job_id,
                                            '_blank' // <- This is what makes it open in a new window.
                                            );


                                }, 5000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage_1").removeAttr("class", "alert alert-success");
                                $("#spnmessage_1").attr("class", "alert alert-danger");
                                $("#spnmessage_1").html('<p><strong>Unable to create this job please contact administrator, thank you!</strong></p>');
                                $("#divmessage_1").removeAttr("class", "hide");
                                $("#divmessage_1").fadeIn(1500);
                                $("#divmessage_1").delay(2500).fadeOut(1500);

                                $("#spnmessage_2").removeAttr("class", "alert alert-success");
                                $("#spnmessage_2").attr("class", "alert alert-danger");
                                $("#spnmessage_2").html('<p><strong>Unable to create this job please contact administrator, thank you!</strong></p>');
                                $("#divmessage_2").removeAttr("class", "hide");
                                $("#divmessage_2").fadeIn(1500);
                                $("#divmessage_2").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>




    </body>    
</html>

