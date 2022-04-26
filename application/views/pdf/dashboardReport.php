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
		.chartDiv{
			width: 60%;
			height: 50%;
		}
	</style>
</head><body>
<h5>Solid Waste Collection Management System </h5>
<h1>Waste Collection Data Report</h1>
<?php
echo '<p>Active Waste Collection on time range</p>';
?>
<div class="chartDiv">
	<canvas id="myChart"></canvas>
</div>
<p>Note: Year-month-day time format (yyyy-mm-dd)</p>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js"></script>
<script type="text/javascript"> let data = <?php echo json_encode($report);?></script>
<script type="text/javascript">
	for (let i = 0; i < data.length; i++) { //you can also use "for in", so you don't need the variable "len"
		for (let j = 1; j < data.length; j++) {
			if (data[j - 1]['totalWaste'] > data[j]['totalWaste']) {
				let tmp = data[j - 1];
				data[j - 1] = data[j];
				data[j] = tmp;
			}
		}
	}

	var totalKg = 0;
	for(let count = 0; count < data.length; count++){
		totalKg += data[count]['totalWaste'];
	}

	for(let interval = 0; interval < data.length; interval++){
		var percentage = 0;
		if(data[interval]['totalWaste'] !== 0){
			percentage = (data[interval]['totalWaste']/totalKg) * 100;
		}
		data[interval]['totalWaste'] = percentage;
	}

	for (let k = 0; k < data.length; k++) {
		for (let l = 1; l < data.length; l++) {
			if (data[l-1]['barangay'] > data[l]['barangay']) {
				let tmp = data[l -1];
				data[l-1] = data[l];
				data[l] = tmp;
			}
		}
	}

	var finalData = [];
	for(let m = 0; m <= data.length; m++){
		if(m == 9){
			finalData[m] = 100;
		} else {
			finalData[m] = data[m]['totalWaste'];
		}
	}

	console.log(finalData);
	const labels = [
		'District I',
		'District II',
		'District III',
		'District IV',
		'District V',
		'District VI',
		'District VII',
		'District VIII',
		'District IX'
	];

	const dataChart = {
		labels: labels,
		datasets: [{
			label: 'Total Barangay Waste Collected by Percentage  ',
			backgroundColor: 'rgb(135,206,235)',
			borderColor: 'rgb(119,181,254)',
			data: finalData,
		}]
	};

	const config = {
		type: 'line',
		data: dataChart,
		options: {}
	};

	const myChart = new Chart(
		document.getElementById('myChart'),
		config
	);
	window.print();
</script>
</body></html>
