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
        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-daterangepicker-master/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
       <!--  <link href="<?php //echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-daterangepicker-master/css/daterangepicker.css" rel="stylesheet" type="text/css"/> -->

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
                                <li><a style="text-decoration: none;" href="#" class="di">Add Supplier Purchase</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                               <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/supplier_c/supplier_purchase_view" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="row" style="margin-left: 1%">
                        <div class="col-md-12 well well-sm" style="width: 98%;">
                            <div style="font-weight: bold; margin-left: -10%;">
                               <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/supplier_c/add_supplier_purchase_page_new" class="btn btn-round-sm btn-sm btn-primary">Add new purchase</a>
                                <a href="<?php echo base_url(); ?>/index.php/supplier_c/add_supplier_purchase_page_exsisting" class="btn btn-round-sm btn-sm btn-warning">Add existing purchase</a>
                                <a href="#" style="text-decoration: none; font-weight: bold; font-size: 145%; margin-left: 16%;"><?php echo $page_msg; ?></a>
                            </div>

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
                            <form class="form-horizontal" role="form" id="addsupplierwarrantyform" method="POST" action="" enctype="multipart/form-data">
                                        <!-- Text input-->
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Supplier Purchase No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="supplier_purchase_id" name="supplier_purchase_id" value="<?php echo $supplier_purchase_id; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Supplier</label>
                                            <div class="col-sm-5">
                                                <select class="select_picker show-tick" id="supplier_name" name="supplier_name" data-live-search="true">                                                
                                                    <option disabled selected value> - select supplier- </option>
                                                    <?php 

                                                    foreach ($sup_list as $supplier_list) {
                                                        echo"<option value='".$supplier_list->supp_id."'>".$supplier_list->supp_name."</option>";
                                                    }                                                    

                                                     ?>
                                                </select>
                                            </div>
                                            <label for="supplier_name" class="error" style="display:none; font-style: italic; font-weight: bold; margin-left: 43%;"></label>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Sales Order No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="sales_order_no" name="sales_order_no" placeholder="Sales Order No" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Sales Date</label>
                                            <div class="col-sm-5" id="sales_date_block">
                                                <div class="input-group date">
                                                  <input type="text" class="form-control" id="sales_date" name="sales_date" data-date-format="yyyy-mm-dd" />
                                                  <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-th"></i>
                                                  </span>
                                                </div>                                           
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Category</label>
                                            <div class="col-sm-5">
                                                <select class="select_picker show-tick" id="category" name="category" data-live-search="true">                                                
                                                    <option disabled selected value> - select category- </option>
                                                    <option value="Projectors">Projectors</option>
                                                    <option value="Amplifiers">Amplifiers</option>
                                                    <option value="Mixers">Mixers</option>
                                                    <option value="Microphones">Microphones</option>
                                                    <option value="Speakers">Speakers</option>
                                                    <option value="Conference">Conference</option>
                                                    <option value="Electronics">Electronics</option>
                                                </select>
                                            </div>
                                            <label for="category" class="error" style="display:none; font-style: italic; font-weight: bold; margin-left: 43%;"></label>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Make</label>
                                            <div class="col-sm-5">
                                                <select class="select_picker show-tick" id="make" name="make" data-live-search="true">
                                                    <option disabled selected value> - select make- </option>
                                                    <option value="Infocus">Infocus</option>
                                                    <option value="Inter-M">Inter-M</option>
                                                    <option value="Panasonic">Panasonic</option>
                                                    <option value="Sure">Shure</option>
                                                    <option value="JTS">JTS</option>
                                                    <option value="Zoom">Zoom</option>
                                                    <option value="Polycom">Polycom</option>
                                                    <option value="Hi-Tone">Hi-Tone</option>
                                                    <option value="Kramer">Kramer</option>
                                                    <option value="KV2">KV2</option>
                                                </select>
                                            </div>
                                            <label for="make" class="error" style="display:none; font-style: italic; font-weight: bold; margin-left: 43%;"></label>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Model</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="model" name="model" placeholder="Model" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Qty</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="qty" name="qty" placeholder="Qty" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Supplier Warranty applicable</label>
                                            <div class="col-sm-5">
                                                <div class="radio">
                                                  <label><input type="radio" id="w_a" name="w_a" value="yes">Yes</label>
                                                </div>
                                                <div class="radio">
                                                  <label><input type="radio" id="w_a" name="w_a" value="no">No</label>
                                                </div>
                                                <div class="radio">
                                                    <label for="w_a" class="error" style="display:none; font-style: italic; font-weight: bold; margin-left: -5%;"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="" id="warranty_date_range_block"> 
                                            <div class="form-group" style="margin-right:10%">
                                                <label class="col-sm-5 control-label" for="textinput">Supplier Warranty Period</label>
                                                <div class="col-sm-5">
                                                    <select class="select_picker show-tick" id="warranty_period" name="warranty_period" data-live-search="true">
                                                        <option disabled selected value> - select warranty period - </option>
                                                        <option value="3"> 3 Months</option>
                                                        <option value="6"> 6 Months</option>
                                                        <option value="12"> 1 Years</option>
                                                        <option value="24"> 2 Years</option>
                                                        <option value="36"> 3 Years</option>
                                                        <option value="48"> 4 Years</option>
                                                        <option value="60"> 5 Years</option>
                                                        <option value="72"> 6 Years</option>
                                                    </select>
                                                </div>
                                                <label for="warranty_period" class="error" style="display:none; font-style: italic; font-weight: bold; margin-left: 43%;"></label>
                                            </div>
                                        </div>


                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Company Warranty applicable</label>
                                            <div class="col-sm-5">
                                                <div class="radio">
                                                  <label><input type="radio" id="c_w_a" name="c_w_a" value="yes">Yes</label>
                                                </div>
                                                <div class="radio">
                                                  <label><input type="radio" id="c_w_a" name="c_w_a" value="no">No</label>
                                                </div>
                                                <div class="radio">
                                                    <label for="c_w_a" class="error" style="display:none; font-style: italic; font-weight: bold; margin-left: -5%;"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="" id="company_warranty_date_range_block"> 
                                            <div class="form-group" style="margin-right:10%">
                                                <label class="col-sm-5 control-label" for="textinput">Company Warranty Period</label>
                                                <div class="col-sm-5">
                                                    <select class="select_picker show-tick" id="company_warranty_period" name="company_warranty_period" data-live-search="true">
                                                        <option disabled selected value> - select warranty period - </option>
                                                        <option value="3"> 3 Months</option>
                                                        <option value="6"> 6 Months</option>
                                                        <option value="12"> 1 Years</option>
                                                        <option value="24"> 2 Years</option>
                                                        <option value="36"> 3 Years</option>
                                                        <option value="48"> 4 Years</option>
                                                        <option value="60"> 5 Years</option>
                                                        <option value="72"> 6 Years</option>
                                                    </select>
                                                </div>
                                                <label for="company_warranty_period" class="error" style="display:none; font-style: italic; font-weight: bold; margin-left: 43%;"></label>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Upload</label>
                                            <div class="col-sm-5" style="width: 39%; margin-left: 1.5%">
                                                <div class="form-group">
                                                    <div class="file-loading">
                                                        <input id="pop" name="pop" type="file" class="file" 
    data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload...">
                                                    </div> 
                                                </div>                                            
                                            </div>
                                            <label for="pop" class="error" style="display:none; font-style: italic; font-weight: bold; margin-left: 43%;"></label>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-10" style="margin-left: 61%">
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
            $(document).ready(function (){
                $("#warranty_date_range_block").hide();
                $('input[name=w_a]').change(function(){
                    var value = $( 'input[name=w_a]:checked' ).val();
                    // alert(value);
                    if (value === "yes") {
                       // $("#warranty_date_range_block").removeAttr("class","hide");
                        // $("#warranty_date_range_block").fadeIn(3000);
                        $("#warranty_date_range_block").show("slow");

                    }else if(value === "no"){                        
                       // $("#warranty_date_range_block").attr("class","hide");
                        // $("#warranty_date_range_block").fadeIn(3000);
                        $("#warranty_date_range_block").hide("slow");

                    }
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function (){
                $("#company_warranty_date_range_block").hide();
                $('input[name=c_w_a]').change(function(){
                    var value = $( 'input[name=c_w_a]:checked' ).val();
                    // alert(value);
                    if (value === "yes") {
                       // $("#warranty_date_range_block").removeAttr("class","hide");
                        // $("#warranty_date_range_block").fadeIn(3000);
                        $("#company_warranty_date_range_block").show("slow");

                    }else if(value === "no"){                        
                       // $("#warranty_date_range_block").attr("class","hide");
                        // $("#warranty_date_range_block").fadeIn(3000);
                        $("#company_warranty_date_range_block").hide("slow");

                    }
                });
            });
        </script>


        <script type="text/javascript">
            $(document).ready(function(){

                $('.select_picker').selectpicker();

                $('form').on('reset', function(event){
                  $('.select_picker',this).each(function(index, element){
                    var $this = $(this);
                    setTimeout(function(){
                      $this.selectpicker('val',$this.val());
                    },0);
                  });
                });


            });
        </script>

        <script type="text/javascript">
            $(document).ready(function (){

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
            $(document).ready(function (){

                $("#pop").fileinput({
                    minFileCount: 1,
                    maxFileCount: 1,
                    allowedFileExtensions: ["jpg", "png", "pdf", "doc", "docx"]
                });

            });
        </script>


        <!-- This handles the add supplier warranty modal form field validation -->
        <script>
            $(document).ready(function () {
                $("#addsupplierwarrantyform").validate({
                    ignore: [],
                    rules: {
                        supplier_purchase_id: "required",
                        supplier_name: "required",
                        sales_order_no: "required",
                        sales_date: "required",
                        category: "required",
                        make: "required",
                        model: "required",
                        qty: "required",
                        'w_a': {required :true},
                        warranty_period:{ 
                            required: '#w_a[value="yes"]:checked'
                            },
                        'c_w_a': {required :true},
                        company_warranty_period:{ 
                            required: '#c_w_a[value="yes"]:checked'
                            },
                        'pop': {
                            required:true,
                            extension: "docx|rtf|doc|pdf|jpg|png"
                        }    
                    },
                    messages: {
                        supplier_purchase_id: "Please enter supplier purchase no",
                        supplier_name: "Please enter supplier name",
                        sales_order_no: "Please enter SO no",
                        sales_date: "Please enter date",
                        category: "Please select category",
                        make: "Please enter make",
                        model: "Please enter model",
                        qty: "Please enter qty",
                        w_a: "Please select warranty applicable status",
                        warranty_period: "Please enter period",
                        'pop': {
                            required:"Please upload proof of purchase",                  
                            extension:"select valied input file format"
                        }

                    }
                });
            });
        </script>
        
        <!-- this Jquery handles the add supplier warranty function : Add supplier warranty modal form -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#addsupplierwarrantyform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;

                    var fd = new FormData(document.getElementById("addsupplierwarrantyform"));

                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/supplier_c/add_supplier_purchase_new",                        
                        processData: false,
                        contentType: false,
                        data: $("#addsupplierwarrantyform").serialize() && fd,
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#addsupplierwarrantyform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Warranty successfuly added to the system!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    location.reload();
                                }, 5000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to add this Warranty please contact sales team, thank you!</strong></p>');
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
