<!--<h1>mPDF<img src="<?php // echo base_url();     ?>backend_assets/img/demoImage.jpg" alt=""/></h1>-->

<img src="<?php echo base_url(); ?>psmsbackendtheme/img/header_logo.png" alt=""/>

<!--<h2>PSMS</h2>-->
<div style="margin-left: 30%;">    
    <h3>Zero Qty Parts Stock Report </h3>
</div>


<table border="1">
    <tbody>
        <tr>
            <th>Part Ref Code</th>
            <th>Part No</th>
            <th>Description</th>
            <th>Min Qty</th>
            <th>Category</th>
            <th>Unit Price</th>

        </tr>
        <?php
        foreach ($zero_qty_info as $list) {
            if ((int)$list->store_qty === 0) {
                echo "<tr>";
                echo "<td>" . $list->part_ref_code . "</td>";
                echo "<td>" . $list->part_no . "</td>";
                echo "<td>" . $list->description . "</td>";
                echo "<td>" . $list->min_qty . "</td>";
                echo "<td>" . $list->category . "</td>";
                echo "<td style='text-align:right;'>" . number_format((int) ($list->average_cost_price), 2, '.', '') . "</td>";
                echo "</tr>";
            }
        }
        ?></tbody></table>
