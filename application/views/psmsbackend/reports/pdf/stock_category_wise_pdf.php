<!--<h1>mPDF<img src="<?php // echo base_url();    ?>backend_assets/img/demoImage.jpg" alt=""/></h1>-->

<img src="<?php echo base_url(); ?>psmsbackendtheme/img/header_logo.png" alt=""/>

<!--<h2>Zonal Education Office Kandy</h2>-->
<div style="margin-left: 30%;">    
    <h3><?php echo $report_stock_category; ?> Stock Report (Count <?php echo $category_count; ?>)</h3>
</div>


<table border="1" width="100">
    <tbody>
        <tr>
            <th>Part No</th>
            <th>Description</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Bin No</th>
            <th>Status</th>
            
        </tr>
        <?php
        foreach ($stock_category_wise_data as $list) {


            echo "<tr>";
            echo "<td>" . $list->part_no . "</td>";
            echo "<td>" . $list->description . "</td>";
            echo "<td>" . $list->store_qty . "</td>";
            echo "<td>" . $list->average_cost_price . "</td>";
            echo "<td>" . $list->bin_no . "</td>";
            echo "<td>" . $list->store_status . "</td>";
           
            echo "</tr>";
        }
        ?></tbody></table>
