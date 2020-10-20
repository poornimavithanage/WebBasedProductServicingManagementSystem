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
                                <li><a style="text-decoration: none;" href="#" class="di">Edit Customers</a></li>
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
                                <form class="form-horizontal" role="form" id="editcustomerform" method="POST" action="">
                                        <!-- Text input-->
                                        <!-- hidden field for include customer id : update the relevant record in db -->
                                        <div class="form-group hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Customer ID</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="customer_id" name="customer_id" value="<?php echo $customer_details[0]->customer_id; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Title</label>
                                            <div class="col-sm-5">
                                            <select class="form-control" id="title" name="title">                                                
                                            <!-- <option disabled selected value> - select title- </option> -->
                                            <?php 

                                                    echo"<option value='".$customer_details[0]->title."'>".$customer_details[0]->title."</option>";

                                                     ?>

                                                     <?php 
                                                    //not displaying Ms.if the result is Ms.
                                                    if($customer_details[0]->title === 'Ms'){

                                                        echo"<option value='Mr.'>Mr.</option>";
                                                        echo"<option value='Rev.'>Rev.</option>";
                                                        echo"<option value='Father.'>Father.</option>";
                                                        echo"<option value='Sister.'>Sister.</option>";
                                                        echo"<option value='Dr.'>Dr.</option>";
                                                    
                                                    //not displaying Mr.if the the result is Mr.
                                                    }else if($customer_details[0]->title === 'Mr'){

                                                        echo"<option value='Ms.'>Ms.</option>";
                                                        echo"<option value='Rev.'>Rev.</option>";
                                                        echo"<option value='Father.'>Father.</option>";
                                                        echo"<option value='Sister.'>Sister.</option>";
                                                        echo"<option value='Dr.'>Dr.</option>";
                                                        
                                                    //not displaying Rev.if the the result is Rev.
                                                    }else if($customer_details[0]->title === 'Rev'){

                                                        echo"<option value='Ms.'>Ms.</option>";
                                                        echo"<option value='Mr.'>Mr.</option>";
                                                        echo"<option value='Father.'>Father.</option>";
                                                        echo"<option value='Sister.'>Sister.</option>";
                                                        echo"<option value='Dr.'>Dr.</option>";
                                                        
                                                    //not displaying Father.if the the result is Father.
                                                    }else if($customer_details[0]->title === 'Father'){

                                                        echo"<option value='Ms.'>Ms.</option>";
                                                        echo"<option value='Rev.'>Rev.</option>";
                                                        echo"<option value='Mr.'>Mr.</option>";
                                                        echo"<option value='Sister.'>Sister.</option>";
                                                        echo"<option value='Dr.'>Dr.</option>";
                                                    
                                                    //not displaying Sister.if the the result is Sister.
                                                    }else if($customer_details[0]->title === 'Sister'){

                                                        echo"<option value='Ms.'>Ms.</option>";
                                                        echo"<option value='Rev.'>Rev.</option>";
                                                        echo"<option value='Father.'>Father.</option>";
                                                        echo"<option value='Mr.'>Mr.</option>";
                                                        echo"<option value='Dr.'>Dr.</option>";
                                                        
                                                    //not displaying Dr if the result is Dr
                                                    }else{ 

                                                        echo"<option value='Ms.'>Ms.</option>";
                                                        echo"<option value='Mr.'>Mr.</option>";
                                                        echo"<option value='Rev.'>Rev.</option>";
                                                        echo"<option value='Father.'>Father.</option>";
                                                        echo"<option value='Sister.'>Sister.</option>";

                                                    }
                                                    
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
 
                                            
                                       
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="cus_name" name="cus_name" value="<?php echo $customer_details[0]->cus_name; ?>"class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Address</label>
                                            <div class="col-sm-5">
                                                <textarea id="cus_address" name="cus_address" rows="3" cols="4" class="form-control"><?php echo $customer_details[0]->cus_address; ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Contact No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="contact_no" name="contact_no" value="<?php echo $customer_details[0]->contact_no; ?>" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Contact No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="contact_no1" name="contact_no1" value="<?php echo $customer_details[0]->contact_no1; ?>"class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">NIC</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="NIC" name="NIC" value="<?php echo $customer_details[0]->NIC; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Fax</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="fax" name="fax" value="<?php echo $customer_details[0]->fax; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">E-mail</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="email" name="email" value="<?php echo $customer_details[0]->email; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12" style="margin-left: 55%;">
                                                <div class="pull-left">
                                                    <input type="submit" class="btn btn-primary" value="Save Changes" />
                                                    <input type="reset" class="btn btn-warning" value="Reset" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
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
            });
        </script>

        <!-- This handles the edit customer modal form field validation -->
        <script>
            $(document).ready(function () {
                $("#editcustomerform").validate({
                    rules: {
                        title: "required",
                        cus_name: "required",
                        cus_address: "required",
                        contact_no: "required",
                        contact_no1: "required",
                        nic: "required",
                        // fax: "required",
                        email: "required"
                    },
                    messages: {
                        title: "Please select a title",
                        cus_name: "Please enter name",
                        cus_address: "Please enter address",
                        contact_no: "Please enter contact",
                        contact_no1: "Please enter contact",
                        nic: "Please enter NIC",
                        // fax: "Please enter fax no",
                        email: "Please enter email address"

                    }
                });
            });
        </script>
        
        <!-- this Jquery handles the add customer function : Edit customer modal form -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#editcustomerform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/customer_c/edit_customers",
                        data: $("#editcustomerform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#editcustomerform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Customer details changes were successful!</strong></p>');
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
                                $("#spnmessage").html('<p><strong>Unable to change customer details please contact IT Department!</strong></p>');
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

