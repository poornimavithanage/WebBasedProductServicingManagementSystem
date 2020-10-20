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
            <?php $this->load->view('psmsbackend/template/navigation'); ?>
            <!--END MENU SECTION -->

            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height:1200px;">
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Dashboard</a></li>
                                <li><a style="text-decoration: none;" href="#" class="di">Customers</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/customer_c/customer_view" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
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
                            <div class="col-lg-12">
                                <form class="form-horizontal" role="form" id="addcustomerform" method="POST" action="">
                                    <!-- Text input-->
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-md-5 control-label" for="textinput">Title</label>
                                        <div class="col-sm-5">
                                            <select class="form-control" id="title" name="title">                                                
                                                <option disabled selected value> - title - </option>
                                                <option value="Ms.">Ms.</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Rev.">Rev.</option>
                                                <option value="Father.">Father.</option>
                                                <option value="Sister.">Sister.</option>
                                                <option value="Dr.">Dr.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Name</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="cus_name" name="cus_name" placeholder="Name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Address</label>
                                        <div class="col-sm-5">
                                            <textarea placeholder="Address" id="address" name="address" rows="3" cols="4" class="form-control"></textarea>
                                        </div>
                                    </div>    


                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Contact No</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="contact_no" name="contact_no" placeholder="Mobile" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Contact No</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="contact_no1" name="contact_no1" placeholder="Telephone" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">NIC</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="NIC" name="NIC" placeholder="NIC" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">Fax</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="fax" name="fax" placeholder="Fax" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-right:10%">
                                        <label class="col-sm-5 control-label" for="textinput">E-mail</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="email" name="email" placeholder="E-mail" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12" style="margin-left: 60%">
                                            <div class="pull-left">
                                                <input type="submit" class="btn btn-primary" value="Save" />
                                                <input type="reset" class="btn btn-warning" value="Reset" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.col-lg-12 -->
                        </div><!-- /.col-md-12 -->
                    </div><!--/.row-->




                </div><!--/. inner -->
            </div><!--END PAGE CONTENT -->
        </div><!--END MAIN WRAPPER -->

        <!-- FOOTER -->
        <?php $this->load->view('psmsbackend/template/footer'); ?>
        <!--END FOOTER -->
        <!-- GLOBAL SCRIPTS -->
        <?php $this->load->view('psmsbackend/template/head_js'); ?>
        <!--<script src="<?php //echo base_url();    ?>psmsbackendtheme/plugins/dataTables/jquery.dataTables.js"></script>-->
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js" type="text/javascript"></script>
        <!--<script src="<?php //echo base_url();    ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>-->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable(); // jquery-bootstrap datatable 

                $('.close_modal').click(function () {
                    $('#addcustomerform')[0].reset(); // reset the add product modal form after closing it.
                });
            });
        </script>

        <!-- This handles the add customer modal form field validation -->
        <script>
            $(document).ready(function () {
                $("#addcustomerform").validate({
                    rules: {
                        title: "required",
                        cus_name: "required",
                        cus_address: "required",
                        contact_no: "required",
                        contact_no1: "required",
                        NIC: "required",
                        // fax: "required",
                        email: "required"
                    },
                    messages: {
                        title: "Please select a title",
                        cus_name: "Please enter name",
                        cus_address: "Please enter address",
                        contact_no: "Please enter contact",
                        contact_no1: "Please enter contact",
                        NIC: "Please enter NIC",
                        // fax: "Please enter fax no",
                        email: "Please enter email address"

                    }
                });
            });
        </script>

        <!-- this Jquery handles the add customer function : Add customer modal form -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#addcustomerform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/customer_c/add_customers",
                        data: $("#addcustomerform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#addcustomerform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Customer successfuly added to the system!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    //location.reload();
                                    window.location.href = "<?php echo base_url(); ?>/index.php/customer_c/customer_view";
                                }, 5000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to add this customer please contact administrator, thank you!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
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

