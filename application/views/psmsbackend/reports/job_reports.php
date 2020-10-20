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
        <!--<link href="<?php //echo base_url();      ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
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
        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-daterangepicker-master/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
       <!--  <link href="<?php //echo base_url();     ?>psmsbackendtheme/plugins/bootstrap-daterangepicker-master/css/daterangepicker.css" rel="stylesheet" type="text/css"/> -->

        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>

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
                                <li><a style="text-decoration: none;" href="#" class="di">Job Reports</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <div style="font-weight: bold; margin-left: 10%;">
                                    <a href="<?php echo base_url(); ?>/index.php/login_c/dashboard_admin" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 hide" id="divmessage">
                                <div id="spnmessage" class="alert alert-success alert-dismissible" role="alert">

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <!-- Text input-->
                            <form class="form-horizontal" role="form" id="getjobstatusform" method="POST" action="">
                                <div class="form-group" style="margin-right:10%">
                                    <label class="col-md-5 control-label" for="textinput">Job Status</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="status" name="status">                                                
                                            <option disabled selected value> - Job Status - </option>
                                            <option value="Pending">Pending</option>
                                            <option value="Technician WIP">Technician WIP</option>
                                            <option value="Sent for estimation approval">Sent for estimation approval</option>
                                            <option value="Order Finished">Completed Jobs</option>

                                        </select>
                                    </div>
                                    <!--                                <label for="current_status" class="error" style="display:none; font-style: italic; font-weight: bold; margin-left: 43%;"></label>-->
                                </div>

                                <div class="form-group" style="margin-right:10%">
                                    <label class="col-sm-5 control-label" for="textinput">From</label>
                                    <div class="col-sm-4" id="sales_date_block">
                                        <div class="input-group date">
                                            <input type="text" class="form-control" id="from" name="from" data-date-format="yyyy-mm-dd" />
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-th"></i>
                                            </span>
                                        </div>                                           
                                    </div>
                                </div>

                                <div class="form-group" style="margin-right:10%">
                                    <label class="col-sm-5 control-label" for="textinput">To</label>
                                    <div class="col-sm-4" id="sales_date_block_1">
                                        <div class="input-group date">
                                            <input type="text" class="form-control" id="to" name="to" data-date-format="yyyy-mm-dd" />
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-th"></i>
                                            </span>
                                        </div>                                           
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-10" style="margin-left: 61%">
                                        <div class="pull-left">
    <!--                                        <button type="button" class=" pull-right btn btn-primary generate_btn"  id="generate" name="generate"><i class="fa fa-spinner"></i> Generate</button> -->
                                            <input type="submit" class="btn btn-primary" value="Generate" id=""/>
                                            <input type="reset" class="btn btn-warning" value="Reset" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.col-md-12 -->
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div id="report">

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

        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable(); // jquery-bootstrap datatable 

                $('.close_modal').click(function () {
                    $('#getjobstatusform')[0].reset(); // reset the job report madel form after closing it.
                });
            });
        </script>

        <!-- This handles get report modal form field validation -->
        <script>
            $(document).ready(function () {
                $("#getjobstatusform").validate({
                    rules: {
                        status: "required",
                        from: "required",
                        to: "required"

                    },
                    messages: {
                        status: "Please select job status",
                        from: "Please select date",
                        to: "Please select date"


                    }
                });
            });
        </script>

        <!-- this Jquery handles the get report status function :  -->
        <script>
            $(document).ready(function () {
                $("#getjobstatusform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/report_c/get_the_report_data",
                        data: $("#getjobstatusform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#getjobstatusform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>data successfully filtered from the system </strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                              
                                setTimeout(function () {
                                    window.open('<?php echo base_url(); ?>index.php/report_c/generate_report_pdf?var1=' + data.from +'&var2=' + data.to + '&var3=' + data.status , '_blank');
                                }, 5000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>No data found!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {

                $('#sandbox-container .input-daterange').datepicker({
                    format: "yyyy-mm-dd",
                    todayBtn: true,
                    todayHighlight: true
                });

                $('#sales_date_block .input-group.date').datepicker({
                    format: "yyyy-mm-dd",
                    endDate: "+d",
                    todayBtn: "linked",
                    todayHighlight: true
                });

            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {

                $('#sandbox-container .input-daterange').datepicker({
                    format: "yyyy-mm-dd",
                    todayBtn: true,
                    todayHighlight: true
                });

                $('#sales_date_block_1 .input-group.date').datepicker({
                    format: "yyyy-mm-dd",
                    endDate: "+d",
                    todayBtn: "linked",
                    todayHighlight: true
                });

            });
        </script>



    </body>    
</html>
