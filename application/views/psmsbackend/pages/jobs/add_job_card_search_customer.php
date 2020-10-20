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
                                <li><a style="text-decoration: none;" href="#" class="di">Create job card</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/jobentry_c/jobentry_view" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
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


                    <div class="row" style="margin-left: 1%">
                        <div class="col-md-12 well well-sm" style="width: 98%;">
                            <form class="form-inline" id="search_cus_for_job" method="POST" action="<?php echo base_url(); ?>index.php/jobentry_c/load_add_job_with_customer">
                              <div class="form-group col-md-2">
                                <label class="control-label" for="email">Search by</label>
                              </div>  
                              <div class="form-group col-md-2" style="margin-left: -8%;">
                                <select class="form-control" id="search_type" name="search_type">
                                    <option disabled selected value> - search by- </option>
                                    <option value="cus_name">Customer name</option>
                                    <option value="cus_id">Customer id</option>
                                    <option value="nic">NIC</option>
                                    <option value="contact_no">Contact no</option>
                                    <option value="invoice_no">Invoice no</option>
                                    <option value="serial_no">Serial no</option>
                                </select>
                              </div>
                              <div id="cus_name_search" class="">
                                    <div class="col-sm-5">
                                        <select class="select_picker show-tick" id="search_value1" name="search_value1" data-live-search="true">                                                
                                            <option disabled selected value> - select customer name - </option>
                                            <?php 

                                            foreach ($customer_info as $cus_info) {
                                                echo"<option value='".$cus_info->cus_name."'>".$cus_info->cus_name."</option>";
                                            }                                                    

                                             ?>
                                        </select>
                                    </div>
                              </div>
                              <div id="cus_id_search" class="">
                                    <div class="col-sm-5">
                                        <select class="select_picker show-tick" id="search_value2" name="search_value2" data-live-search="true">                                                
                                            <option disabled selected value> - select customer id - </option>
                                            <?php 

                                            foreach ($customer_info as $cus_info) {
                                                echo"<option value='".$cus_info->customer_id."'>".$cus_info->customer_id."</option>";
                                            }                                                    

                                             ?>
                                        </select>
                                    </div>                                  
                              </div>
                              <div id="nic_search" class="">
                                    <div class="col-sm-5">
                                        <select class="select_picker show-tick" id="search_value3" name="search_value3" data-live-search="true">                                                
                                            <option disabled selected value> - select NIC - </option>
                                            <?php 

                                            foreach ($customer_info as $cus_info) {
                                                echo"<option value='".$cus_info->NIC."'>".$cus_info->NIC."</option>";
                                            }                                                    

                                             ?>
                                        </select>
                                    </div>
                              </div>
                              <div id="contact_no_search" class="">
                                    <div class="col-sm-5">
                                        <select class="select_picker show-tick" id="search_value4" name="search_value4" data-live-search="true">                                                
                                            <option disabled selected value> - select contact no - </option>
                                            <?php 

                                            foreach ($customer_info as $cus_info) {
                                                echo"<option value='".$cus_info->contact_no."'>".$cus_info->contact_no."</option>";
                                            }                                                    

                                             ?>
                                        </select>
                                    </div>
                              </div>
                              <div id="invoice_no_search" class="">
                                    <div class="col-sm-5">
                                        <select class="select_picker show-tick" id="search_value5" name="search_value5" data-live-search="true">                                                
                                            <option disabled selected value> - select invoice no - </option>
                                            <?php 

                                            foreach ($invoice_info as $invo_info) {
                                                echo"<option value='".$invo_info->invoice_no."'>".$invo_info->invoice_no."</option>";
                                            }                                                    

                                             ?>
                                        </select>
                                    </div>
                              </div>

                              <div id="serial_search" class="">                                  
                                  <div class="form-group col-md-3">
                                    <input type="text" id="search_value6" name="search_value6" class="form-control" >
                                  </div>
                              </div>

                              <div id="search_butston">
                                    <div class="row">
                                        <button type="submit" id="sub_button" class="btn btn-default" disabled="">Search</button>
                                    </div>                                  
                              </div>
                            </form>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 <?php if($active_job_cus === "NO" || $active_job_cus_yes === "yes_cus" ){ echo "hide";}else{echo "";} ?>" id="divmessage">
                                <div id="" class="alert alert-danger alert-dismissible" role="alert">
                                    Customer not found!<br>
                                    <strong>NOTE: </strong> Please check the search type.
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row <?php if($active_job_cus === "NO" || $active_job_cus === "no_cus"){ echo "hide";}else{echo "";} ?>" style="width: 100%; margin-left: 0%">
                        <div class="col-md-12">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th>Customer ID</th>
                                        <td>Invoice No</td>
                                        <td>Invoice Date</td>
                                        <th>Name</th>
                                        <th>NIC</th>                                        
                                        <th>Contact</th>               
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($active_job_cus as $job_cus) {

                                            echo "<tr>";
                                            echo "<td>" . $job_cus->customer_id . "</td>";
                                            echo "<td>" . $job_cus->invoice_no . "</td>";
                                            echo "<td>" . $job_cus->invoice_date . "</td>";
                                            echo "<td>" . $job_cus->cus_name . "</td>";
                                            echo "<td>" . $job_cus->NIC . "</td>";
                                            echo "<td>" . $job_cus->contact_no . "</td>";
                                            echo "<td>";
                                            echo "<a href='". base_url()."/index.php/jobentry_c/add_job_card_page?var1=".$job_cus->customer_id."&var2=".$job_cus->invoice_no."&var3=".$job_cus->invoice_date."' class='btn btn-primary btn-xs'><i class='icon-external-link'></i>&nbsp;Create Job</a>&nbsp; &nbsp";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                </tbody>
                            </table>
                            <hr>
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

        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-selectpicker/js/bootstrap-select.min.js" type="text/javascript"></script>

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

                $('#cus_id_search').hide();
                $('#nic_search').hide();
                $('#contact_no_search').hide();
                $('#serial_search').hide();
                $('#invoice_no_search').hide();
                $('#cus_name_search').hide();

                $('#search_button').hide();

                $('#search_type').on('change', function() {
                 search_type = this.value;

                    $('#sub_button').attr('disabled','disabled');

                    $('#cus_id_search').hide();
                    $('#nic_search').hide();
                    $('#contact_no_search').hide();
                    $('#serial_search').hide();
                    $('#invoice_no_search').hide();
                    $('#cus_name_search').hide();

                    $('#search_button').hide();

                 if(search_type === "cus_name"){

                    $('#cus_id_search').hide('Slow');
                    $('#nic_search').hide('Slow');
                    $('#contact_no_search').hide('Slow');
                    $('#serial_search').hide('Slow');
                    $('#invoice_no_search').hide('Slow');

                    $('#cus_name_search').show('Slow');
                    $('#search_button').show('Slow');
                    $('#sub_button').removeAttr('disabled','disabled');

                 }else if(search_type === "cus_id"){

                    $('#cus_name_search').hide('Slow');
                    $('#nic_search').hide('Slow');
                    $('#contact_no_search').hide('Slow');
                    $('#serial_search').hide('Slow');
                    $('#invoice_no_search').hide('Slow');

                    $('#cus_id_search').show('Slow');
                    $('#search_button').show('Slow');
                    $('#sub_button').removeAttr('disabled','disabled');

                 }else if(search_type === "nic"){

                    $('#cus_id_search').hide('Slow');
                    $('#cus_name_search').hide('Slow');
                    $('#contact_no_search').hide('Slow');
                    $('#serial_search').hide('Slow');
                    $('#invoice_no_search').hide('Slow');

                    $('#nic_search').show('Slow');
                    $('#search_button').show('Slow');
                    $('#sub_button').removeAttr('disabled','disabled');

                 }else if(search_type === "contact_no"){

                    $('#cus_id_search').hide('Slow');
                    $('#nic_search').hide('Slow');
                    $('#cus_name_search').hide('Slow');
                    $('#serial_search').hide('Slow');
                    $('#invoice_no_search').hide('Slow');

                    $('#contact_no_search').show('Slow');
                    $('#search_button').show('Slow');
                    $('#sub_button').removeAttr('disabled','disabled');

                 }else if(search_type === "invoice_no"){

                    $('#cus_id_search').hide('Slow');
                    $('#nic_search').hide('Slow');
                    $('#contact_no_search').hide('Slow');
                    $('#serial_search').hide('Slow');
                    $('#cus_name_search').hide('Slow');

                    $('#invoice_no_search').show('Slow');
                    $('#search_button').show('Slow');
                    $('#sub_button').removeAttr('disabled','disabled');

                 }else if(search_type === "serial_no"){

                    $('#cus_id_search').hide('Slow');
                    $('#nic_search').hide('Slow');
                    $('#contact_no_search').hide('Slow');
                    $('#cus_name_search').hide('Slow');
                    $('#invoice_no_search').hide('Slow');

                    $('#serial_search').show('Slow');
                    $('#search_button').show('Slow');
                    $('#sub_button').removeAttr('disabled','disabled');

                 }

                });



            });

        </script>

       

    </body>    
</html>

