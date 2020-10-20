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
        <!--<link href="<?php //echo base_url();  ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
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
                                <li><a style="text-decoration: none;" href="#" class="di">Add Technicians</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/technician_c/technician_view" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
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
                                <form class="form-horizontal" role="form" id="addtechnicianform" method="POST" action="">
                                        <!-- Text input-->
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Code No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="tech_id" name="tech_id" value="<?php echo $tech_id; ?>" class="form-control"  readonly>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">First Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="tech_first_name" name="tech_first_name" placeholder="First Name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Last Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="tech_last_name" name="tech_last_name" placeholder="Last Name" class="form-control">
                                            </div>
                                        </div>
                                         <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Gender</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="tech_gender" name="tech_gender">                                                
                                                    <option disabled selected value> - select gender- </option>
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Email</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="tech_email" name="tech_email" placeholder="Email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Contact No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="tech_contact" name="tech_contact" placeholder="Contact No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">NIC</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="tech_nic" name="tech_nic" placeholder="NIC" class="form-control">
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
        <!--<script src="<?php //echo base_url();  ?>psmsbackendtheme/plugins/dataTables/jquery.dataTables.js"></script>-->
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js" type="text/javascript"></script>
        <!--<script src="<?php //echo base_url();  ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>-->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable(); // jquery-bootstrap datatable 

                $('.close_modal').click(function () {
                    $('#addtechnicianform')[0].reset(); // reset the add technician modal form after closing it.
                });
            });
        </script>

      <!-- This handles the add technician modal form field validation -->
        <script>
            $(document).ready(function () {
                $("#addtechnicianform").validate({
                    rules: {
                        tech_id: "required",
                        tech_first_name: "required",
                        tech_last_name: "required",
                        tech_gender: "required",
                        tech_email: "required",
                        tech_contact: "required",
                        tech_nic: "required"
                    },
                    messages: {
                        tech_id: "Please enter code no",
                        tech_first_name: "Please enter first name",
                        tech_last_name: "Please enter last name",
                        tech_gender: "Please select gender",
                        tech_email: "Please enter email",
                        tech_contact: "Please enter contact",
                        tech_nic: "Please enter NIC"

                    }
                });
            });
        </script>
        
        
        <!-- this Jquery handles the add technician function : Add technician modal form -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#addtechnicianform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;

                    var fd = new FormData(document.getElementById("addtechnicianform"));

                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/technician_c/add_technicians",                        
                        processData: false,
                        contentType: false,
                        data: $("#addtechnicianform").serialize() && fd,
                        dataType: 'json',
                        success: function (data) {
//                            console.log(data);
                            if (data.final_result === "success") {
                                $('#addtechnicianform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>successfuly added to the system!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    //location.reload();
                                     window.location.href = "<?php echo base_url(); ?>/index.php/technician_c/technician_view";
                                }, 5000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to add.Please contact Administrator. thank you!</strong></p>');
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




