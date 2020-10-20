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
                                <li><a style="text-decoration: none;" href="#" class="di">Add serial no</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/serialno_c/load_add_serial_no_with_sales_order_no?var1=<?php echo $sales_order_no; ?>" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
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
                            <div class="col-lg-12">
                                <div class="well well-sm">
                                    <div class="row">
                                        <div class="col-md-2" style="color: #3c69b2; font-size: 103%;     margin-left: 1%;"> 
                                            <strong>Status:</strong> 
                                        </div>
                                        <div class="col-md-4 <?php if(($total_qty - $entered_qty) > 0){echo "";} else if(($total_qty - $entered_qty) === 0  || $page_msg ==="no"){ echo "hide";} ?>" style="color: #e87f00; font-size: 100%; margin-left: -11%;"> 
                                            <strong><?php echo ($total_qty - $entered_qty); ?> items remaining</strong> 
                                        </div>
                                        <div class="col-md-4 <?php if(($total_qty - $entered_qty) === 0){echo "";} else if(($total_qty - $entered_qty) > 0 || $page_msg ==="no"){ echo "hide";} ?>" style="color: #00e212; font-size: 100%; margin-left: -11%;"> 
                                            <strong> Completed adding serials numbers!</strong> 
                                        </div>
                                        <div class="col-md-4 <?php if($page_msg === "yes"){echo "";} else if($page_msg === "no"){ echo "hide";} ?>" style="color: #ff0000; font-size: 100%; margin-left: -11%;"> 
                                            <strong> Duplicate Entry...</strong> 
                                        </div>
                                    </div>
                                                                        
                                </div>
                            </div>    
                        </div>
                    </div>

                    <div class="row <?php if(($total_qty - $entered_qty) === 0){echo "hide";} else if(($total_qty - $entered_qty) > 0){ echo "";} ?>" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <form class="form-horizontal" role="form" id="addserialnosform" method="POST" action="<?php echo base_url();?>index.php/serialno_c/add_serial_no">
                                        <!-- Text input-->
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-lg-5 control-label" for="textinput">Sales Order No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="sales_order_no" name="sales_order_no" value="<?php echo $sales_order_no; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Category</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="category" name="category" value="<?php echo $category; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Make</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="make" name="make" value="<?php echo $make; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Model</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="model" name="model" value="<?php echo $model; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Serial No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="serial_no" name="serial_no" placeholder="Serial No" class="form-control" autofocus <?php if(($total_qty - $entered_qty) === 0){echo "readonly";} else if(($total_qty - $entered_qty) > 0){ echo "";} ?>>
                                            </div>
                                        </div>
                                        <div class="form-group <?php if(($total_qty - $entered_qty) === 0){echo "hide";} else if(($total_qty - $entered_qty) > 0){ echo "";} ?>">
                                            <div class="col-sm-offset-3 col-sm-10" style="margin-left: 60%">
                                                <div class="pull-left">
                                                    <input type="submit" class="btn btn-primary" value="Save" />
                                                    <input type="button" class="btn btn-danger close_modal" data-dismiss="modal" value="Close" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
        <!--<script src="<?php //echo base_url();  ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>-->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-selectpicker/js/bootstrap-select.min.js" type="text/javascript">            
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

                if("<?php if($page_block === "no_result"){echo "true";}?>"){
                    setTimeout(function () {
                                    //location.reload();
                                     window.location.href = "<?php echo base_url(); ?>/index.php/serialno_c/add_serial_nos_page_sales_order_search";
                                }, 2500);
                }

            });
        </script>
       

    </body>    
</html>

