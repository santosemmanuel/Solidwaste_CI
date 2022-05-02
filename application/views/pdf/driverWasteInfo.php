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
if($chartType == 'daily'){
	echo '<p><strong>Report:</strong> '.ucfirst($chartType).'&nbsp;&nbsp;<strong>Date:</strong> '.$chartDate.'</p>';
} else if($chartType == 'weekly'){
	echo '<p><strong>Report:</strong> '.ucfirst($chartType).'&nbsp;&nbsp;<strong>Date:</strong> '.$chartDate[0].' to '.$chartDate[1].'</p>';
} else {
	echo '<p><strong>Report:</strong> '.ucfirst($chartType).'&nbsp;&nbsp;<strong>Date:</strong> '.$chartDate[0].' '.$chartDate[1].'</p>';
}
?>
<table>
	<thead>
	<tr>
		<th width="200">Barangay</th>
		<th>Biodegrable Waste</th>
		<th>Residual Waste</th>
		<th>Special Waste</th>
		<th>Recyclable Waste</th>
		<th>Total</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($printWaste as $waste){ ?>
		<tr>
			<td><?php echo $waste[0]?></td>
			<?php foreach($waste[1] as $collection) { ?>
				<td><?= $collection ?></td>
			<?php } ?>
			<td><?php echo array_sum($waste[1]); ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<p>Note: Year-month-day time format (yyyy-mm-dd)</p>
<script type="text/javascript">
	var css = '@page { size: landscape; }',
		head = document.head || document.getElementsByTagName('head')[0],
		style = document.createElement('style');

	style.type = 'text/css';
	style.media = 'print';

	if (style.styleSheet){
		style.styleSheet.cssText = css;
	} else {
		style.appendChild(document.createTextNode(css));
	}

	head.appendChild(style);
	window.print();
</script>
</body></html>
