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
                                <a href="<?php echo base_url(); ?>/index.php/serialno_c/serialno_view" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
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


                    <div class="row" style="margin-left: 1%">
                        <div class="col-md-12 well well-sm" style="width: 98%;">
                            <form class="form-inline" id="search_sales_order_no_for_serial" method="POST" action="<?php echo base_url(); ?>index.php/serialno_c/load_add_serial_no_with_sales_order_no">
                              <div class="form-group col-md-2">
                                <label class="control-label" for="email">Sales order no</label>
                              </div>  
                              <div class="form-group col-md-2" style="margin-left: -7%; margin-right: 9%">
                                <select class="select_picker show-tick" id="sales_order_no" name="sales_order_no" data-live-search="true" data-size="5">                                                
                                    <option disabled selected value> - select sales order- </option>
                                    <?php 

                                    foreach ($sup_sales_order as $sales_order_nos) {
                                        echo"<option value='".$sales_order_nos->sales_order_no."'>".$sales_order_nos->sales_order_no."</option>";
                                    }                                                    

                                     ?>
                                </select>
                              </div>
                              <div class="form-group col-md-5 hide" style="margin-left: 15%;">
                              </div>
                              <button type="submit" class="btn btn-default">Search</button>
                            </form>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="container-fluid">
                            <div class="<?php if($page_block === "fresh" || $page_block === "yes_result"){ echo "hide";}else if($page_block === "no_result"){ echo "";} ?>" id="divmessage">
                                <div class="col-md-12">
                                    <div id="spnmessage" class=" alert alert-danger alert-dismissible" role="alert">
                                        Sales Order not found!<br>
                                    <strong>NOTE: </strong> Please enter the sales order no!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="<?php if($page_block === "fresh" || ($page_block === "no_result")){echo "hide";} else if($page_block === "yes_result"){echo "";} ?>">
                        <div class='row' style="width: 100%; margin-left: 0%">
                            <div class="col-md-12">
                                <table class="table table-responsive" id="table">
                                    <thead>
                                        <tr>
                                            <th>Sales order no</th>
                                            <th>Sales date</th>
                                            <th>Category</th>                                        
                                            <th>Make</th>               
                                            <th>Model</th>
                                            <th>Entered Qty</th>      
                                            <th>Total Qty</th>   
                                            <th>Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($sales_order_nos_g as $sales_order_n) {

                                                echo "<tr>";
                                                echo "<td>" . $sales_order_n->sales_order_no . "</td>";
                                                echo "<td>" . $sales_order_n->sales_date . "</td>";
                                                echo "<td>" . $sales_order_n->category . "</td>";
                                                echo "<td>" . $sales_order_n->make . "</td>";
                                                echo "<td>" . $sales_order_n->model . "</td>";
                                                echo "<td>" . $sales_order_n->entered_qty . "</td>";
                                                echo "<td>" . $sales_order_n->qty . "</td>";

                                                if(($sales_order_n->qty - $sales_order_n->entered_qty) === 0){

                                                echo "<td>";
                                                // echo "<strong style='color:#00e212'>Completed</strong>";
                                                echo "<span class='label label-success label-medium' style='padding: 0.6em 0.6em 0.5em; font-size: 89%;'>Completed</span>";
                                                echo "</td>";

                                                echo "<td>";
                                                echo "<a href='". base_url()."/index.php/serialno_c/add_serial_nos_page?var1=".$sales_order_n->sales_order_no."&var2=".$sales_order_n->category."&var3=".$sales_order_n->make."&var4=".$sales_order_n->model."&var5=".$sales_order_n->qty."&var6=".$sales_order_n->entered_qty."' class='btn btn-warning btn-xs'><i class='icon-external-link'></i>&nbsp;View</a>&nbsp; &nbsp";
                                                echo "</td>";

                                                }else{


                                                echo "<td>";
                                                echo "<a href='". base_url()."/index.php/serialno_c/add_serial_nos_page?var1=".$sales_order_n->sales_order_no."&var2=".$sales_order_n->category."&var3=".$sales_order_n->make."&var4=".$sales_order_n->model."&var5=".$sales_order_n->qty."&var6=".$sales_order_n->entered_qty."' class='btn btn-primary btn-xs'><i class='icon-external-link'></i>&nbsp;Add Serial No</a>&nbsp; &nbsp";
                                                echo "</td>";


                                                echo "<td>";
                                                echo "<a href='". base_url()."/index.php/serialno_c/add_serial_nos_page?var1=".$sales_order_n->sales_order_no."&var2=".$sales_order_n->category."&var3=".$sales_order_n->make."&var4=".$sales_order_n->model."&var5=".$sales_order_n->qty."&var6=".$sales_order_n->entered_qty."' class='btn btn-warning btn-xs'><i class='icon-external-link'></i>&nbsp;View</a>&nbsp; &nbsp";
                                                echo "</td>";

                                                }       
                                                
                                                echo "</tr>";
                                            }
                                            ?>
                                    </tbody>
                                </table>
                                <hr>
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

