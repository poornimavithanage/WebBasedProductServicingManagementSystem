<!DOCTYPE html>
<html lang="en">

    <head>


        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <table>
                    <tr>
                        <th>
                            <img style="margin-bottom: 5%;" src="<?php echo base_url(); ?>psmsbackendtheme/img/header_logo.png" id="logoimg" alt=" Logo" />
                        </th>
                    </tr>
                </table>
                
            </div>

            <div class="row">

                <!-- Blog Entries Column -->
                <div class="col-md-8">



                    <div class="row">
                        <div class="col-md-12">
                            <table border="0" width="100%" style="margin-bottom: 3%">
                                <tr>
                                    <th colspan="4" style="font-size: 25px; text-align: center">Job Estimation</th>
                                </tr>
                            </table>
                            <table border="1" width="100%" style="margin-bottom: 2%;">
                                
                                <tr>
                                    <td style="padding: 7px;">Job ID </td>
                                    <td style="padding: 7px;"><?php echo $job_info[0]->job_id; ?></td>
                                    <td style="padding: 7px;">Date</td>
                                    <td style="padding: 7px;"><?php echo $job_info[0]->job_date; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 7px;">Customer ID </td>
                                    <td colspan="3" style="padding: 7px;"><?php echo $job_info[0]->customer_id; ?></td>
                                </tr>
                                
                                <tr colspan="2">
                                    <td style="padding: 7px;">Customer Name </td>
                                    <td colspan="3" style="padding: 7px;"><?php echo $cus_info[0]->cus_name; ?></td>
                                </tr>
                                <tr colspan="2">
                                    <td style="padding: 7px;">Address</td>
                                    <td colspan="3" style="padding: 7px;"><?php echo $cus_info[0]->cus_address; ?></td>
                                </tr>
                                <tr colspan="2">
                                    <td style="padding: 7px;">Contact No </td>
                                    <td colspan="3" style="padding: 7px;"><?php echo $cus_info[0]->contact_no; ?></td>
                                </tr>
                            </table>
                            <table  border="0" width="100%" style="margin-bottom: 2%;">
                                 <tr>
                                    <th colspan="4" style="font-size: 15px;">Item Details</th>
                                </tr>
                            </table>
                            <table border="1" width="100%" style="margin-bottom: 2%;">                               
                                <tr>
                                    <td style="padding: 7px;">Category</td>
                                    <td colspan="3" style="padding: 7px;"><?php echo $job_info[0]->category; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 7px;">Make</td>
                                    <td colspan="3" style="padding: 7px;"><?php echo $job_info[0]->make; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 7px;">Model</td>
                                    <td colspan="3" style="padding: 7px;"><?php echo $job_info[0]->model; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 7px;">Serial No</td>
                                    <td colspan="3" style="padding: 7px;"><?php echo $job_info[0]->serial_no; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 7px;">Defect</td>
                                    <td colspan="3" style="padding: 7px;"><?php echo $job_info[0]->problem_description ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>



                    <!-- Estimate Block -->
                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="row" style="margin-top: 0.5%;">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <table border="1" width="100%">
                                        <thead>
                                            <tr>                                               
                                                <th class="text-center" style="width: 81.9%;">
                                                    Description
                                                </th>
                                                <th class="text-center">
                                                    Amount (Rs.)
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Repair Parts</td>
                                                <td><?php echo $job_estimate[0]->total_parts_markup_cost_final; ?></td>
                                            </tr>
                                            <tr>
                                                <td>VAT (<?php echo number_format((float) ($job_estimate[0]->tax_vat_limit), 2, '.', '') . " %"; ?>)</td>
                                                <td><?php echo $job_estimate[0]->tax_vat; ?></td>
                                            </tr>
                                            <tr>
                                                <td>NBT (<?php echo $job_estimate[0]->tax_nbt_limit . " %"; ?>)</td>
                                                <td><?php echo $job_estimate[0]->tax_nbt; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Technician Charges</td>
                                                <td><?php echo $job_estimate[0]->labour_cost; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                <td><strong><?php echo $job_estimate[0]->total_job_cost; ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!--/.row-->


                        </div>
                        
                    </div>

                    
                </div>



                <!-- Sidebar Widgets Column -->
                
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->


    </body>

</html>
