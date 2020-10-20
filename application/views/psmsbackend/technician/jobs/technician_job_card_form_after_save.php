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
            <?php $this->load->view('psmsbackend/technician/template_technician/navigation_technician'); ?>
            <!--END MENU SECTION -->

            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height:1200px;">
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Dashboard</a></li>
                                <li><a style="text-decoration: none;" href="#" class="di">Assign job card</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/technician_c_view/technician_job_card_form_delete?var1=<?php echo $job_repair_info[0]->job_id; ?>" class="btn btn-round-sm btn-sm btn-danger">Delete</a>
                            </div>
                        </div>
                        <div class="col-sm-5 serial_check_status_block_2" style="margin-left: -9%;">
                            <input type="button" id="edit_button" class="btn btn-round-sm btn-sm btn-warning" value="Edit" />
                        </div>
                        <div class="col-md-2" id="send_to_store_manager_button_block">
                            <div style="font-weight: bold; margin-left: -262%;">
                                <a href="<?php echo base_url(); ?>/index.php/technician_c_view/send_to_store_manager?var1=<?php echo $job_repair_info[0]->job_id; ?>" class="btn btn-round-sm btn-sm btn-success">Send to Store Manager</a>
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
                        <div class="container-fluid">
                            <div class="col-md-12 hide" id="divmessage_2">
                                <div id="spnmessage_2" class="alert alert-success alert-dismissible" role="alert">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form id="class_add_form" class="form-horizontal" method="POST" action="<?php echo base_url(); ?>index.php/technician_c_view/technician_job_card_form_save_changes">
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
                                                                    Part
                                                                </th>
                                                                <th class="text-center" style="width: 80px;">
                                                                    Qty
                                                                </th>
                                                                <th class="text-center">
                                                                    Remarks
                                                                </th>                                                                
                                                                <th class="text-center">
                                                                    Part No
                                                                </th>
                                                                <th class="text-center">
                                                                    Description
                                                                </th>
                                                                <th class="text-center" >
                                                                    Action
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $i = 0;

                                                            foreach ($job_repair_info as $repair_info) {

                                                                echo "<tr id='addr" . $i . "' data-id='" . $i . "' class=''>";

                                                                echo "<td data-id='actual_defect'>
                                                                    <textarea placeholder='Actual Defect' id='actual_defect" . $i . "' name='actual_defect[]' rows='3' cols='5' class='form-control actual_defect' readonly>" . $repair_info->actual_defect . "</textarea>
                                                                        </td>";

                                                                echo "<td data-id='solution'>
                                                                    <textarea placeholder='Solution' id='solution" . $i . "' name='solution[]' rows='3' cols='5' class='form-control solution' readonly>" . $repair_info->solution . "</textarea>
                                                                    </td>";
                                                                
                                                                echo "<td class='dis'>
                                                                    <input type='text' value='" . $repair_info->part_no . "  &nbsp;&nbsp;- " . $repair_info->part_description . "'  id='' name='' class='form-control disp' readonly=''/>
                                                                    </td>";

                                                                echo "<td data-id='part_ref_code' class='hide prt'>
                                                                    <select onchange='AlertVal(this)' class='select_picker part_ref_code' id='part_ref_code" . $i . "' name='part_ref_code[]' data-live-search='true'> 
                                                                        <option value='" . $repair_info->part_ref_code . "'>" . $repair_info->part_no . "  &nbsp;&nbsp;- " . $repair_info->part_description . "</option>";
                                                                foreach ($parts_inventory as $list) {
                                                                    echo"<option value='" . $list->part_ref_code . "'>" . $list->part_no . " &nbsp;&nbsp;- " . $list->description . "</option>";
                                                                }
                                                                echo "</select>
                                                                    </td>";

                                                                echo "<td data-id='qty'>
                                                                    <input type='number' id='qty" . $i . "' name='qty[]' class='form-control qty' placeholder='0' value='" . $repair_info->qty . "' readonly/>
                                                                    </td>";

                                                                echo "<td data-id='remarks'>
                                                                    <textarea placeholder='Remarks' id='remarks" . $i . "' name='remarks[]' rows='3' cols='5' class='form-control remarks' readonly>" . $repair_info->remarks . "</textarea>
                                                                    </td>";

                                                                echo "<td data-id='part_no' class=''>
                                                                    <input type='text' value='" . $repair_info->part_no . "' placeholder='Part No' id='part_no" . $i . "' name='part_no[]' class='form-control part_no' readonly=''/>
                                                                    </td>";

                                                                echo "<td data-id='part_description' class=''>
                                                                    <input type='text' value='" . $repair_info->part_description . "' placeholder='Part Description' id='part_description" . $i . "' name='part_description[]' class='form-control part_description' readonly=''/>
                                                                    </td>";

                                                                echo "<td data-id='del'>
                                                                    <button name='del[]' id='del" . $i . "' class='del btn btn-danger btn-xs row-remove' type='button' value disabled>Remove</button>
                                                                    </td>";
                                                                $i++;
                                                            }
                                                            ?>

                                                        </tbody>
                                                    </table>
                                                </div><!--/. panel-body -->
                                                <div class="panel-footer">
                                                    <div id="add_row_footer_text">Click Add Row to insert spare parts information</div>
                                                    <input type="button" id="add_row" name="" class="btn btn-sm btn-default pull-right" value="Add Row" style="margin-top: -2.0%;" />
                                                    <!-- <a id="add_row" class="btn btn-default pull-right">Add Row</a> -->
                                                </div>                                                
                                            </div><!--/. panel with-nav-tabs panel-default -->
                                        </div><!-- /.col-lg-12 -->
                                    </div><!-- /.col-md-12 -->
                                </div><!--/.row-->

                                <div class="row" id="submit_reset_buttons">
                                    <div class="col-md-12 col-lg-offset-4">
                                        <div class="col-lg-1">
                                            <button class="btn btn-success" type="submit">Save Changes</button>
                                        </div><!-- /.col-lg-12 --> 
                                        <div class="col-lg-3" style="margin-left: 38px;">
                                            <button class="btn btn-primary" type="reset">Reset</button>
                                        </div><!-- /.col-lg-12 --> 
                                    </div><!-- /.col-md-12 --> 
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


        <script type="text/javascript">
            $(document).ready(function () {
                
//                window.history.forward(-1);
                
//                window.open ("http://localhost/psms/index.php/technician_c_view/technician_job_card_form_after_save_page/35011","mywindow","status=1,toolbar=0");
                
//                $('.dis').removeAttr('class');
//                $('.dis').attr('class');
                

                $("#add_row").hide();
                $("#submit_reset_buttons").hide();
                $("#add_row_footer_text").hide();

                $("#edit_button").on("click", function () {

                    $("#add_row").show();
                    $("#submit_reset_buttons").show();

                    $(".actual_defect").removeAttr("readonly", "readonly");
                    $(".solution").removeAttr("readonly", "readonly");
                    $(".prt").removeAttr('class');
                    $(".dis").remove();
//                    $('.part_ref_code').attr('disabled',false);
//                    $('#part_ref_code0').prop('disabled', false);
                    $(".qty").removeAttr("readonly", "readonly");
                    $(".remarks").removeAttr("readonly", "readonly");
                    $(".del").removeAttr("disabled", "disabled");
                    $("#add_row_footer_text").show();
//                    $("#del0").attr("disabled","disabled");
                    $("#actual_defect0").focus();

                    $('html, body').animate({
                        'scrollTop': $("#tbl_form").position().top
                    });

                    $("#edit_button").hide();
                    $("#send_to_store_manager_button_block").hide();


                });


            });
        </script>

        <script>
            function AlertVal(e) {

                var a = (e.options[e.selectedIndex].value);
                var id_value = e.id;

//                alert(a);

                var index_no = id_value.replace(/[^\d.]/g, '');
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/technician_c_view/get_part_details/" + a,
                    // data: {grade_id: grade_id},
                    dataType: 'json',
                    success: function (data) {
//                        console.log(data);

//                         alert(index_no);
//                        alert(data.description);
//                        alert(data.part_no);


                        $('#part_description' + index_no).val(data.description);
                        $('#part_no' + index_no).val(data.part_no);
                    }

                });
            }
            ;
        </script>



        //select picker
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


                $(".row-remove").on("click", function () {
                    $(this).closest("tr").remove();
                });


            });
        </script>

        //dynamic table form : CRITICAL
        <script type="text/javascript">
            $(document).ready(function () {

                // $(".job_id").attr("class", "hide");

                $("#add_row").on("click", function () {
                    // Dynamic Rows Code



                    // Get max row id and set new id
                    var newid = 0;
                    $.each($("#tab_logic tr"), function () {
                        if (parseInt($(this).data("id")) > newid) {
                            newid = parseInt($(this).data("id"));

                        }



                    });
                    newid++;

                    var tr = $("<tr></tr>", {
                        id: "addr" + newid,
                        "data-id": newid
                    });

                    // loop through each td and create new elements with name of newid
                    $.each($("#tab_logic tbody tr:nth(0) td"), function () {
                        var cur_td = $(this);

                        var children = cur_td.children();

                        // add new td and element if it has a nane
                        if ($(this).data("id") != undefined) {
                            var td = $("<td></td>", {
                                "data-id": $(cur_td).data("id"),

                            });

                            var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                            c.attr("id", $(cur_td).data("id") + newid);
                            // $(".job_id").attr("class", "hide");
                            c.appendTo($(td));
                            td.appendTo($(tr));
                        } else {
                            var td = $("<td></td>", {
                                'text': $('#tab_logic tr').length
                            }).appendTo($(tr));
                        }
                    });


                    // add the new row
                    $(tr).appendTo($('#tab_logic'));
                    $('.select_picker').selectpicker('render');



                    $(tr).find("td button.row-remove").on("click", function () {
                        $(this).closest("tr").remove();
                        $("#del0").attr("disabled", "disabled");
                    });
                });

                // Sortable Code
                var fixHelperModified = function (e, tr) {
                    var $originals = tr.children();
                    var $helper = tr.clone();

                    $helper.children().each(function (index) {
                        $(this).width($originals.eq(index).width())
                    });

                    return $helper;
                };

                $(".table-sortable tbody").sortable({
                    helper: fixHelperModified
                }).disableSelection();

                $(".table-sortable thead").disableSelection();

                $("#add_row").trigger("click");
            });
        </script>







    </body>    
</html>

