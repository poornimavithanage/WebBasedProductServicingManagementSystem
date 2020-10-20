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
        <!--<link href="<?php //echo base_url();                                                                                                                         ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
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

            html {
                overflow-x: hidden;
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
            <?php $this->load->view('psmsbackend/store_manager/template_store_manager/navigation_store_manager'); ?>
            <!--END MENU SECTION -->

            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height:1200px;">
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Dashboard</a></li>
                                <li><a style="text-decoration: none;" href="#" class="di">Estimation</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>index.php/store_mgr_c_view/job_new_view" class="btn btn-round-sm btn-sm btn-warning">Go Back</a>
                            </div>
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
                        <div class="col-md-12">
                            <form id="send_for_rma_form" class="form-horizontal" method="POST" action="">
                                <div class="row" style="margin-left: -0.5%;">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="job_id">Job Id</label>
                                                <input type="text" class="form-control" id="job_id" name="job_id" placeholder="Job Id" required="" readonly="" value="<?php echo $job_repair_info[0]->job_id; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 -->
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="job_created_date">Job Created Date</label>
                                                <input type="text" class="form-control" id="job_created_date" name="job_created_date" required="" readonly="" value="<?php echo $job_repair_info[0]->created_date; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="job_assigned_date">Job Assigned Date</label>
                                                <input type="text" class="form-control" id="job_assigned_date" name="job_assigned_date" required="" readonly="" value="<?php echo $job_repair_info[0]->assigned_date; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="customer_id">Customer ID</label>
                                                <input type="text" class="form-control" id="customer_id" name="customer_id" required="" readonly="" value="<?php echo $job_repair_info[0]->customer_id; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="warranty_type">Warranty Type</label>
                                                <input type="text" class="form-control" id="warranty_type" name="warranty_type" required="" readonly="" value="<?php echo $job_repair_info[0]->warranty_type; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                    </div><!-- /.col-md-12 --> 
                                </div><!-- /.row -->

                                <div class="row" style="margin-left: -0.5%;">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <input type="text" class="form-control" id="category" name="category" placeholder="Job Id" required="" readonly="" value="<?php echo $job_repair_info[0]->category; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 -->
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="make">Make</label>
                                                <input type="text" class="form-control" id="make" name="make" required="" readonly="" value="<?php echo $job_repair_info[0]->make; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="model">Model</label>
                                                <input type="text" class="form-control" id="model" name="model" required="" readonly="" value="<?php echo $job_repair_info[0]->model; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                        <div class="col-md-2" style="margin-left: 35px;">
                                            <div class="form-group">
                                                <label for="serial_no">Serial No</label>
                                                <input type="text" class="form-control" id="serial_no" name="serial_no" required="" readonly="" value="<?php echo $job_repair_info[0]->serial_no; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 
                                    </div><!-- /.col-md-12 --> 
                                </div><!-- /.row -->

                                <div class="row" style="margin-left: -0.5%;">
                                    <div class="col-md-12">
                                        <div class="col-md-4" style="">
                                            <div class="form-group">
                                                <label for="problem_description">Problem Description</label>
                                                <textarea placeholder="Problem Description" id="problem_description" name="problem_description" rows="3" cols="5" class="form-control" readonly=""><?php echo $job_repair_info[0]->problem_description ?></textarea>
                                            </div>
                                        </div><!-- /.col-lg-3 --> 

                                        <div class="col-md-2" style="margin-left: 5.5%;">
                                            <div class="form-group">
                                                <label for="status">Job Status</label>
                                                <input style="color: red" type="text" class="form-control" id="status" name="status" required="" readonly="" value="<?php echo $job_info[0]->current_status; ?>">
                                            </div>
                                        </div><!-- /.col-lg-3 --> 

                                    </div> 
                                </div>

                                <div class="row" id="tbl_form" style="margin-top: 0.5%;">
                                    <div class="col-md-12">
                                        <div class="col-lg-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <strong>Repair Information</strong>
                                                </div>
                                                <div class="panel-body" id="">
                                                    <table class="table table-bordered table-hover table-sortable table-responsive" id="tab_logic">
                                                        <thead>
                                                            <tr >
                                                                <!-- <th class="text-center hide">
                                                                    Job Id
                                                                </th> -->
                                                                <th class="text-center">
                                                                    Actual Defect
                                                                </th>
                                                                <th class="text-center">
                                                                    Solution
                                                                </th>                                                                
                                                                <th class="text-center">
                                                                    Part No
                                                                </th>
                                                                <th class="text-center">
                                                                    Description
                                                                </th>
                                                                <th class="text-center" style="width: 80px;">
                                                                    Qty
                                                                </th>
                                                                <th class="text-center">
                                                                    Remarks
                                                                </th>
<!--                                                                <th class="text-center" >
                                                                    Action
                                                                </th>-->
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $i = 0;

                                                            foreach ($job_repair_info as $repair_info) {

                                                                echo "<tr id='addr" . $i . "' data-id='" . $i . "' class=''>";

                                                                echo "<td data-id='actual_defect'>
                                                                    <textarea placeholder='Actual Defect' id='actual_defect" . $i . "' name='actual_defect[]' rows='3' cols='5' class='form-control actual_defect' readonly=''>" . $repair_info->actual_defect . "</textarea>
                                                                        </td>";

                                                                echo "<td data-id='solution'>
                                                                    <textarea placeholder='Solution' id='solution" . $i . "' name='solution[]' rows='3' cols='5' class='form-control solution' readonly=''>" . $repair_info->solution . "</textarea>
                                                                    </td>";

//                                                                echo "<td class='dis'>
//                                                                    <input type='text' value='" . $repair_info->part_no . "  &nbsp;&nbsp;- " . $repair_info->part_description . "'  id='part_ref_code" . $i . "' name='part_ref_code[]' class='form-control disp' readonly=''/>
//                                                                    </td>";
//                                                                echo "<td data-id='part_ref_code' class='prt'>
//                                                                     <input type='number' id='part_ref_code" . $i . "' name='part_ref_code[]' class='form-control qty' placeholder='0' value='" . $repair_info->part_no . "  &nbsp;&nbsp;- " . $repair_info->part_description . "' readonly=''/>"
//                                                                        . "</td>";                                                                

                                                                echo "<td data-id='part_no' class=''>
                                                                    <input type='text' value='" . $repair_info->part_no . "' placeholder='Part No' id='part_no" . $i . "' name='part_no[]' class='form-control part_no' readonly=''/>
                                                                    </td>";

                                                                echo "<td data-id='part_description' class=''>
                                                                    <input type='text' value='" . $repair_info->part_description . "' placeholder='Part Description' id='part_description" . $i . "' name='part_description[]' class='form-control part_description' readonly=''/>
                                                                    </td>";

                                                                echo "<td data-id='qty'>
                                                                    <input type='text' id='qty" . $i . "' name='qty[]' class='form-control qty' placeholder='0' value='" . $repair_info->qty . "' readonly=''/>
                                                                    </td>";

                                                                echo "<td data-id='remarks'>
                                                                    <textarea placeholder='Remarks' id='remarks" . $i . "' name='remarks[]' rows='3' cols='5' class='form-control remarks' readonly=''>" . $repair_info->remarks . "</textarea>
                                                                    </td>";

                                                                $i++;
                                                            }
                                                            ?>

                                                        </tbody>
                                                    </table>
                                                </div><!--/. panel-body -->
                                                <div class="panel-footer">

                                                </div>                                                
                                            </div><!--/. panel with-nav-tabs panel-default -->
                                        </div><!-- /.col-lg-12 -->
                                    </div><!-- /.col-md-12 -->
                                </div><!--/.row-->

                                <div class="row <?php
                                if ($job_info[0]->current_status === "Estimation Approved") {
                                    echo '';
                                } else {
                                    echo 'hide';
                                }
                                ?>" id="">
                                    <div class="col-md-12 col-lg-offset-5">
                                        <div class="col-lg-1">
                                            <input type="submit" class="btn btn-success" value="<?php
                                            if ($job_info[0]->current_status === "Estimation Approved") {
                                                echo 'Sent to technician';
                                            } else {
                                                echo'';
                                            }
                                            ?>" />
                                        </div><!-- /.col-lg-12 --> 
                                    </div><!-- /.col-md-12 --> 
                                </div>

                                <div class="row" style="margin-top: 2%;">
                                    <div class="container-fluid">
                                        <div class="col-md-12 hide" id="divmessage_1">
                                            <div id="spnmessage_1" class="alert alert-success alert-dismissible" role="alert">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
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
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-daterangepicker-master/js/bootstrap-datepicker.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-daterangepicker-master/locales/bootstrap-datepicker.en-GB.min.js" type="text/javascript">
        </script>

        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-selectpicker/js/bootstrap-select.min.js" type="text/javascript">
        </script>


        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/js/plugins/sortable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/js/fileinput.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/js/locales/fr.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/js/locales/es.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/themes/explorer-fa/theme.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/themes/fa/theme.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

    </body>    

    <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('#pg_msg1').attr('class', 'row hide');
                }, 4000);
            });
    </script>

    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $('#pg_msg2').attr('class', 'row hide');
            }, 4000);
        });
    </script>


    <script>
        $(document).ready(function () {


            var p = $('input[id^=part_cost_with_qty]').length;

            var parts_markup_limit = $("#parts_markup_limit").val();


            var total_parts_cost_qty = 0;
            for (var i = 0; i < p; i++) {

                total_parts_cost_qty += +parseInt($("#part_cost_with_qty" + i).val());

            }


            var markup_cost = ((total_parts_cost_qty * parts_markup_limit / 100));
            var total_parts_markup_cost_final = (markup_cost + total_parts_cost_qty);


            var markup_cost = markup_cost.toFixed(2);
            var total_parts_markup_cost_final = total_parts_markup_cost_final.toFixed(2);
            var total_parts_cost_qty = total_parts_cost_qty.toFixed(2);

            $('#parts_markup_cost_td').text(markup_cost);
            $('#parts_markup_cost').val(markup_cost);
            $('#all_parts_cost').val(total_parts_cost_qty);

            $('#total_parts_markup_cost_final_td').text(total_parts_markup_cost_final);
            $('#total_parts_markup_cost_final').val(total_parts_markup_cost_final);




        });
    </script>


    <script>
        $(document).ready(function () {

            var total_parts_markup_cost_final = $("#total_parts_markup_cost_final").val(); //total parts cost with markup 
            var labour_cost = $("#labour_cost").val(); //Labour Charges
            var vat_limit = $("#tax_vat_limit").val(); // vat %
            var nbt_limit = $("#tax_nbt_limit").val(); // NBT %


            if (!$("#labour_cost").val()) {
                labour_cost = 0.00;

                var labour_cost = parseFloat(labour_cost);
                var total_parts_markup_cost_final = parseFloat(total_parts_markup_cost_final);


                var labour_total_parts_with_markup = (labour_cost + total_parts_markup_cost_final);
                var vat = (labour_total_parts_with_markup * vat_limit / 100); // final vat cost
                var nbt = ((labour_total_parts_with_markup + vat) * nbt_limit / 100); // final nbt cost
                var total = (vat + nbt + labour_total_parts_with_markup); // final



                var vat = vat.toFixed(2);
                var nbt = nbt.toFixed(2);
                var total = total.toFixed(2);
                var labour_cost = labour_cost.toFixed(2);




                $("#tax_vat").val(vat);
                $("#tax_vat_td").text(vat);

                $("#tax_nbt").val(nbt);
                $("#tax_nbt_td").text(nbt);

                $("#total_job_cost_td").html("<strong>" + total + "</strong>");
                $("#total_job_cost").val(total);


                $("#labour_cost").val(labour_cost);

            }





        });
    </script>



    <!--keyup for labour cost changes calculation-->
    <script>
        $(document).on('keyup', '#labour_cost', function () {


            var total_parts_markup_cost_final = $("#total_parts_markup_cost_final").val(); //total parts cost with markup 
            var labour_cost = this.value;
            var vat_limit = $("#tax_vat_limit").val(); // vat %
            var nbt_limit = $("#tax_nbt_limit").val(); // NBT %


            if (!$("#labour_cost").val()) {
                var labour_cost_new = 0.00;

                var labour_cost = parseFloat(labour_cost_new);
                var total_parts_markup_cost_final = parseFloat(total_parts_markup_cost_final);


                var labour_total_parts_with_markup = (labour_cost + total_parts_markup_cost_final);
                var vat = (labour_total_parts_with_markup * vat_limit / 100); // final vat cost
                var nbt = ((labour_total_parts_with_markup + vat) * nbt_limit / 100); // final nbt cost
                var total = (vat + nbt + labour_total_parts_with_markup); // final



                var vat = vat.toFixed(2);
                var nbt = nbt.toFixed(2);
                var total = total.toFixed(2);


                $("#tax_vat").val(vat);
                $("#tax_vat_td").text(vat);

                $("#tax_nbt").val(nbt);
                $("#tax_nbt_td").text(nbt);

                $("#total_job_cost_td").html("<strong>" + total + "</strong>");
                $("#total_job_cost").val(total);




            } else {

                var labour_cost = parseFloat(labour_cost);
                var total_parts_markup_cost_final = parseFloat(total_parts_markup_cost_final);


                var labour_total_parts_with_markup = (labour_cost + total_parts_markup_cost_final);
                var vat = (labour_total_parts_with_markup * vat_limit / 100); // final vat cost
                var nbt = ((labour_total_parts_with_markup + vat) * nbt_limit / 100); // final nbt cost
                var total = (vat + nbt + labour_total_parts_with_markup); // final



                var vat = vat.toFixed(2);
                var nbt = nbt.toFixed(2);
                var total = total.toFixed(2);



                $("#tax_vat").val(vat);
                $("#tax_vat_td").text(vat);

                $("#tax_nbt").val(nbt);
                $("#tax_nbt_td").text(nbt);

                $("#total_job_cost_td").html("<strong>" + total + "</strong>");
                $("#total_job_cost").val(total);

            }

        });
    </script>


    <!--If Job warranty type is Supplier Warranty-->
    <script>
        $(document).ready(function () {
            baseurl = "http://localhost/psms/";
            $("#send_for_rma_form").submit(function (e) {
                e.preventDefault();
                if (!$(this).valid())
                    return false;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/store_mgr_c_view/send_for_rma",
                    data: $("#send_for_rma_form").serialize(),
                    dataType: 'json',
                    success: function (data) {
//                            console.log(data);
                        if (data.final_result === "success") {
                            // $('#addjobform')[0].reset();
                            $("#spnmessage_1").removeAttr("class", "alert alert-danger");
                            $("#spnmessage_1").attr("class", "alert alert-success");
                            $("#spnmessage_1").html('<p><strong>Job send for to technician</strong></p>');
                            $("#divmessage_1").removeAttr("class", "hide");
                            $("#divmessage_1").fadeIn(1500);
                            $("#divmessage_1").delay(3500).fadeOut(2500);
                            setTimeout(function () {
                                //location.reload();
                                window.location.href = "<?php echo base_url(); ?>index.php/store_mgr_c_view/job_new_view";
                            }, 5000);
                        } else if (data.final_result === "unsuccess") {
                            $("#spnmessage_1").removeAttr("class", "alert alert-success");
                            $("#spnmessage_1").attr("class", "alert alert-danger");
                            $("#spnmessage_1").html('<p><strong>Unable to sent technician, please contact administrator, thank you!</strong></p>');
                            $("#divmessage_1").removeAttr("class", "hide");
                            $("#divmessage_1").fadeIn(1500);
                            $("#divmessage_1").delay(2500).fadeOut(1500);
                        }
                    }
                });
            });
        });
    </script>


</html>

