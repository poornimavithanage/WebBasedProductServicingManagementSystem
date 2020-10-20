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
                                <li><a style="text-decoration: none;" href="#" class="di">Suppliers</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/supplier_c/supplier_view" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
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
                            <div class="col-lg-12">
                            <form class="form-horizontal" role="form" id="addsupplierform" method="POST" action="">
                                        <!-- Text input-->
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Supplier Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="supp_name" name="supp_name" placeholder="Supplier Name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Supplier Address</label>
                                            <div class="col-sm-5">
                                            <textarea id="supp_address" name="supp_address" rows="3" cols="4" class="form-control">
                                            </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Contact</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="sup_contact" name="sup_contact" placeholder="Contact" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">E-mail</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="sup_email" name="sup_email" placeholder="E-mail" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Fax</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="fax" name="fax" placeholder="Fax" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Category</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="category" name="category">                                                
                                                    <option disabled selected value> - select category- </option>
                                                    <option value="Projectors">Projectors</option>
                                                    <option value="Amplifiers">Amplifiers</option>
                                                    <option value="Mixers">Mixers</option>
                                                    <option value="Microphones">Microphones</option>
                                                    <option value="Electronics">Electronics</option>
                                                    <option value="Speakers">Speakers</option>
                                                    <option value="Conference">Conference</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Brand</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="brand" name="brand">
                                                    <option disabled selected value> - select brand- </option>
                                                    <option value="Infocus">Infocus</option>
                                                    <option value="Inter-M">Inter-M</option>
                                                    <option value="Panasonic">Panasonic</option>
                                                    <option value="Shure">Shure</option>
                                                    <option value="Kramer">Kramer</option>
                                                    <option value="Zoom">Zoom</option>
                                                    <option value="Hi-Tone">Hi-Tone</option>
                                                    <option value="Peavey">Peavey</option>
                                                    <option value="Lite-Puter">Lite-Puter</option>
                                                    <option value="Polycom">Polycom</option>
                                                </select>
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
                        </div><!-- /.col-md-12 -->
                    </div><!--/.row-->

                </div><!--/. inner -->
            </div><!--END PAGE CONTENT -->
        </div><!--END MAIN WRAPPER -->
    </div>    

       

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
                    $('#addsupplierform')[0].reset(); // reset the add supplier modal form after closing it.
                });
            });
        </script>

        <!-- This handles the add supplier modal form field validation -->
        <script>
            $(document).ready(function () {
                $("#addsupplierform").validate({
                    rules: {
                        supp_name: "required",
                        supp_address: "required",
                        sup_contact: "required",
                        sup_email: "required",
                        fax: "required",
                        category: "required",
                        brand: "required"
                    },
                    messages: {
                        supp_name: "Please enter supplier name",
                        supp_address: "Please enter address",
                        sup_contact: "Please enter contact no",
                        sup_email: "required",
                        fax: "Please enter fax no",
                        category: "Please select category",
                        brand: "Please select brand"

                    }
                });
            });
        </script>
        
        <!-- this Jquery handles the add supplier function : Add supplier modal form -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#addsupplierform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/supplier_c/add_suppliers",
                        data: $("#addsupplierform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#addsupplierform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Supplier successfuly added to the system!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    window.location.href = "<?php echo base_url(); ?>/index.php/supplier_c/supplier_view";
                                    //location.reload();
                                }, 5000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to add this supplier please contact administrator, thank you!</strong></p>');
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

