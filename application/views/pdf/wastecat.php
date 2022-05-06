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

	#no {
		width: 30px;
	}

	</style>
</head><body>
	<h5>Solid Waste Collection Management System </h5>
	<h1>Waste Category Data Report</h1>
	<?php 
		echo '<p>Active Waste Collection on time range</p>';
	?>
    <table>
		<thead>
		<tr>
			<th width="200">Date</th>
			<th>Biodegrable Waste</th>
			<th>Residual Waste</th>
			<th>Special Waste</th>
			<th>Recyclable Waste</th>
			<th>Total</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($printWaste as $waste){ ?>
			<td><?php echo (is_int($waste))? $waste."kg": $waste; ?></td>
		<?php } ?>
		</tbody>
	</table>
	<p>Note: Year-month-day time format (yyyy-mm-dd)</p>
	<script type="text/javascript">
		window.print();
	</script>
</body></html>
