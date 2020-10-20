<!--<h1>mPDF<img src="<?php // echo base_url();       ?>backend_assets/img/demoImage.jpg" alt=""/></h1>-->

<img src="<?php echo base_url(); ?>psmsbackendtheme/img/header_logo.png" alt=""/>

<!--<h2>PSMS</h2>-->
<div style="margin-left: 30%;">    
    <h3>Minimum Level Qty Parts Stock Report </h3>
</div>


<table border="1">
    <tbody>
        <tr>
            <th>Part Ref Code</th>
            <th>Part No</th>
            <th>Description</th>
            <th>Min Qty</th>
            <th>Store Qty</th>
            <th>Category</th>
            <th>Unit Price</th>

        </tr>
        <?php
        foreach ($min_level_qty_info as $list) {
            if ((int) $list->store_qty < (int) $list->min_qty) {
                echo "<tr>";
                echo "<td>" . $list->part_ref_code . "</td>";
                echo "<td>" . $list->part_no . "</td>";
                echo "<td>" . $list->description . "</td>";
                echo "<td>" . $list->min_qty . "</td>";
                echo "<td>" . $list->store_qty . "</td>";
                echo "<td>" . $list->category . "</td>";
                echo "<td style='text-align:right;'>" . number_format((float) ($list->average_cost_price), 2, '.', '') . "</td>";
                echo "</tr>";
            }
        }
        ?>

        <?php
//        $total = 0;
//        foreach ($min_level_qty_info as $list) {
//            if ((int) $list->store_qty < (int) $list->min_qty) {
//
//                $a = ((float) $list->average_cost_price * (int) $list->store_qty);
//
//                $total += $a;
//            }
//        }
//
//        echo "<tr>";
//        echo "<td colspan='6'><strong>Total</strong></td>";
//        echo "<td>" . $total . "</td>";
//        echo "</tr>";
        ?>      
       


    </tbody></table>


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

