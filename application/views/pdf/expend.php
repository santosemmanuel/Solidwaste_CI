<!DOCTYPE html>
<html><head>
    <title></title>
    <style>
    body {
    	width: 90%;
    	margin: auto;
    }

    table {
		border: 1px solid #ddd;
		width: 100%;
		margin-top: 20px;
		margin-bottom: 12px;
		border-collapse: collapse;
		text-align: left;
	}

	td, th {
		border: 1px solid #ddd;
		padding: 12px;
	}

	table th {
		font-weight: bold;
		text-align: left;
	}

	span {
		margin-left: 20px;
	}

	.center {
		text-align: center;
	}

	.right {
		text-align: right;
	}

	#no {
		width: 30px;
	}

	</style>
</head><body>
	<h5>Solid Waste Collection Management System</h5>
	<h1>Transaction Data Report</h1>
	<?php 
		echo '<p>The transaction is completed in the time range</p>';
		echo '<p>From: '.$dari.'<span>To: '.$sampai.'</span></p>';
	?>
    <table>
		<tr>
			<th class="center" id="no">#</th>
            <th class="center">Expenditure ID</th>
            <th>Detail</th>
            <th>Total</th>
            <th>Expenditure Date</th>
            <th class="center">Waste Category ID</th>
            <th>Waste Category</th>
		</tr>
		<?php
            $no = 1;
            $total_expend = 0;
            foreach ($data_expend as $expend) {
            	$total_expend += $expend->total;
        ?>
        <tr>
            <th class="center"><?php echo $no++ ?></th>
            <td class="center"><?php echo $expend->expend_id ?></td>
            <td><?php echo $expend->detail ?></td>
            <td>$<?php echo $expend->total ?></td>
            <td><?php echo $expend->start_expend ?></td>
            <td class="center"><?php echo $expend->wastecat_id ?></td>
            <td><?php echo $expend->name_wastecat ?></td>
		</tr>
		<?php 
			}
		?>
		<tr>
			<td colspan="3"><b>Total Expenditure</b></td>
			<td colspan="4"><b>$ <?php echo $start_expend ?></b></td>
		</tr>
	</table>
	<p>Note: Year-month-day time format (yyyy-mm-dd)</p>
	
</body></html>