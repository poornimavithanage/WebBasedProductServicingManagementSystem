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
                                <li><a style="text-decoration: none;" href="#" class="di">Edit Supplier Purchase Details</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/supplier_c/supplier_purchase_view" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
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
                                <form class="form-horizontal" role="form" id="editsupplierwarrantyform" method="POST" action="">
                                        <!-- Text input-->
                                <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Supplier Purchase No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="supplier_purchase_id" name="supplier_purchase_id" value="<?php echo $supplier_warranty[0]->supplier_purchase_id; ?>" class="form-control" readonly>
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
                                                <input type="text" id="sales_order_no" name="sales_order_no"  value="<?php echo $supplier_warranty[0]->sales_order_no; ?>"class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Sales Date</label>
                                            <div class="col-sm-5" id="sales_date_block">
                                                <div class="input-group date">
                                                  <input type="text" value="<?php echo $supplier_warranty[0]->sales_date; ?>" class="form-control" id="sales_date" name="sales_date" data-date-format="yyyy-mm-dd" />
                                                  <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-th"></i>
                                                  </span>
                                                </div>                                           
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Category</label>
                                            <div class="col-sm-5">
                                            <select class="form-control" id="category" name="category">                                                
                                            <!-- <option disabled selected value> - select category- </option> -->
                                            <?php 

                                                    echo"<option value='".$supplier_warranty[0]->category."'>".$supplier_warranty[0]->category."</option>";

                                                     ?>

                                                     <?php 
                                                    //not displaying Projectors if the result is Projectors
                                                    if($supplier_warranty[0]->category === 'Projectors'){

                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Speakers'>Speakers</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                        echo"<option value='Electronics'>Electronicss</option>";
                                                       
                                                    
                                                    //not displaying Amplifiers if the the result is Amplifiers
                                                    }else if($supplier_warranty[0]->category === 'Amplifiers'){

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Speakers'>Speakers</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                        echo"<option value='Electronics'>Electronicss</option>";
                                                        
                                                    //not displaying Mixers if the the result is Mixers
                                                    }else if($supplier_warranty[0]->category === 'Mixers'){

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Speakers'>Speakers</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                        echo"<option value='Electronics'>Electronicss</option>";
                                                        
                                                    //not displaying Microphones if the the result is Microphones
                                                    }else if($supplier_warranty[0]->category === 'Microphones'){

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Speakers'>Speakers</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                        echo"<option value='Electronics'>Electronicss</option>";
                                                        
                                                    //not displaying Speakers if the the result is Speakers
                                                    }else if($supplier_warranty[0]->category === 'Speakers'){

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                        echo"<option value='Electronics'>Electronicss</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        
                                                    //not displaying Conference if the the result is Conference
                                                    }else if($supplier_warranty[0]->category === 'Conference'){

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Electronics'>Electronicss</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Speakers'>Speakers</option>";
                                                        
                                                    //not displaying Electronics if the the result is Electronics
                                                    }else if($supplier_warranty[0]->category === 'Electronics'){

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Speakers'>Speakers</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                    
                                                    }
                                                    
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                            <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Make</label>
                                            <div class="col-sm-5">
                                            <select class="form-control" id="make" name="make">                                                
                                            <!-- <option disabled selected value> - select make- </option> -->
                                            <?php 

                                                    echo"<option value='".$supplier_warranty[0]->make."'>".$supplier_warranty[0]->make."</option>";

                                            ?>

                                                     <?php 
                                                    //not displaying Infocus if the result is Infocus
                                                    if($supplier_warranty[0]->make === 'Infocus'){

                                                        echo"<option value='Inter-M'>Inter-M</option>";
                                                        echo"<option value='Panasonic'>Panasonic</option>";
                                                        echo"<option value='Sure'>Sure</option>";
                                                        echo"<option value='KV2'>KV2</option>";
                                                        echo"<option value='JTS'>JTS</option>";
                                                        echo"<option value='Polycom'>Polycom</option>";
                                                        echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                        echo"<option value='Kramer'>Kramer</option>";
                                                       
                                                    
                                                    //not displaying Inter-M if the the result is Inter-M
                                                    }else if($supplier_warranty[0]->make === 'Inter-M'){

                                                        echo"<option value='Infocus'>Infocus</option>";
                                                        echo"<option value='Panasonic'>Panasonic</option>";
                                                        echo"<option value='Sure'>Sure</option>";
                                                        echo"<option value='KV2'>KV2</option>";
                                                        echo"<option value='JTS'>JTS</option>";
                                                        echo"<option value='Polycom'>Polycom</option>";
                                                        echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                        echo"<option value='Kramer'>Kramer</option>";
                                                        
                                                    //not displaying Panasonic if the the result is Panasonic
                                                    }else if($supplier_warranty[0]->make === 'Panasonic'){

                                                        echo"<option value='Infocus'>Infocus</option>";
                                                        echo"<option value='Inter-M'>Inter-M</option>";
                                                        echo"<option value='Sure'>Sure</option>";
                                                        echo"<option value='KV2'>KV2</option>";
                                                        echo"<option value='JTS'>JTS</option>";
                                                        echo"<option value='Polycom'>Polycom</option>";
                                                        echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                        echo"<option value='Kramer'>Kramer</option>";
                                                        
                                                    //not displaying Sure if the the result is Sure
                                                    }else if($supplier_warranty[0]->make === 'Sure'){

                                                        echo"<option value='Infocus'>Infocus</option>";
                                                        echo"<option value='Inter-M'>Inter-M</option>";
                                                        echo"<option value='Panasonic'>Panasonic</option>";
                                                        echo"<option value='KV2'>KV2</option>";
                                                        echo"<option value='JTS'>JTS</option>";
                                                        echo"<option value='Polycom'>Polycom</option>";
                                                        echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                        echo"<option value='Kramer'>Kramer</option>";
                                                        
                                                    //not displaying KV2 if the the result is KV2
                                                    }else if($supplier_warranty[0]->make === 'KV2'){

                                                        echo"<option value='Infocus'>Infocus</option>";
                                                        echo"<option value='Inter-M'>Inter-M</option>";
                                                        echo"<option value='Panasonic'>Panasonic</option>";
                                                        echo"<option value='Sure'>Sure</option>";
                                                        echo"<option value='JTS'>JTS</option>";
                                                        echo"<option value='Polycom'>Polycom</option>";
                                                        echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                        echo"<option value='Kramer'>Kramer</option>";
                                                        
                                                    //not displaying JTS if the the result is JTS
                                                    }else if($supplier_warranty[0]->make === 'JTS'){

                                                        echo"<option value='Infocus'>Infocus</option>";
                                                        echo"<option value='Inter-M'>Inter-M</option>";
                                                        echo"<option value='Panasonic'>Panasonic</option>";
                                                        echo"<option value='KV2'>KV2</option>";
                                                        echo"<option value='Sure'>Sure</option>";
                                                        echo"<option value='Polycom'>Polycom</option>";
                                                        echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                        echo"<option value='Kramer'>Kramer</option>";
                                                    
                                                    //not displaying Polycom if the the result is Polycom    
                                                    }else if($supplier_warranty[0]->make === 'Polycom'){

                                                        echo"<option value='Infocus'>Infocus</option>";
                                                        echo"<option value='Inter-M'>Inter-M</option>";
                                                        echo"<option value='Panasonic'>Panasonic</option>";
                                                        echo"<option value='KV2'>KV2</option>";
                                                        echo"<option value='JTS'>JTS</option>";
                                                        echo"<option value='Sure'>Sure</option>";
                                                        echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                        echo"<option value='Kramer'>Kramer</option>";
                                                        
                                                    //not displaying Hi-Tone if the the result is Hi-Tone
                                                    }else if($supplier_warranty[0]->make === 'Hi-Tone'){

                                                        echo"<option value='Infocus'>Infocus</option>";
                                                        echo"<option value='Inter-M'>Inter-M</option>";
                                                        echo"<option value='Panasonic'>Panasonic</option>";
                                                        echo"<option value='KV2'>KV2</option>";
                                                        echo"<option value='JTS'>JTS</option>";
                                                        echo"<option value='Polycom'>Polycom</option>";
                                                        echo"<option value='Sure'>Sure</option>";
                                                        echo"<option value='Kramer'>Kramer</option>";
                                                    
                                                    //not displaying Kramer if the the result is Kramer    
                                                    }else if($supplier_warranty[0]->make === 'Kramer'){

                                                        echo"<option value='Infocus'>Infocus</option>";
                                                        echo"<option value='Inter-M'>Inter-M</option>";
                                                        echo"<option value='Panasonic'>Panasonic</option>";
                                                        echo"<option value='KV2'>KV2</option>";
                                                        echo"<option value='JTS'>JTS</option>";
                                                        echo"<option value='Polycom'>Polycom</option>";
                                                        echo"<option value='Sure'>Sure</option>";
                                                        echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                    
                                                    }
                                                    
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                       
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Model</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="model" name="model"  value="<?php echo $supplier_warranty[0]->model; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Qty</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="qty" name="qty" value="<?php echo $supplier_warranty[0]->qty; ?>" class="form-control">
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
            });
        </script>
        
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
                $("#editsupplierwarrantyform").validate({
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
                $("#editsupplierwarrantyform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;

                    var fd = new FormData(document.getElementById("editsupplierwarrantyform"));

                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/supplier_c/edit_supplier_purchase_new",                        
                        processData: false,
                        contentType: false,
                        data: $("#editsupplierwarrantyform").serialize() && fd,
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#editsupplierwarrantyform')[0].reset();
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

