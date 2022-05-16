$(document).ready(function(){
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
				label: 'Biodegradable',
				backgroundColor: 'rgb(135,206,235)',
				borderColor: 'rgb(119,181,254)',
				data: [],
			},
			{
				label: 'Residual Waste',
				backgroundColor: 'rgb(255,215,0)',
				borderColor: 'rgb(255,215,0)',
				data: [],
			},
			{
				label: 'Special Waste',
				backgroundColor: 'rgb(34,139,34)',
				borderColor: 'rgb(34,139,34)',
				data: [],
			},
			{
				label: 'Recyclable Waste',
				backgroundColor: 'rgb(255,0,0)',
				borderColor: 'rgb(255,0,0)',
				data: [],
			}
			]
	};

	const bgColor = {
		id: 'bgColor',
		beforeDraw: (chart, steps, options) => {
			const {ctx, width, height} = chart;
			ctx.fillStyle = options.backgroundColor;
			ctx.fillRect(0, 0, width, height);
			ctx.restore();
		}

	}

	const config = {
		type: 'line',
		data: dataChart,
		options: {
			plugins: {
				bgColor: {
					backgroundColor: 'white'
				}
			}
		},
		plugins: [bgColor]
	};

	const myChart = new Chart(
		document.getElementById('myChart'),
		config
	);

	$("#chartReport").submit(function(e){
		e.preventDefault();
		var wasteReportType = $(this).find("select[name='reportCat']").val();
		var dataForm = $(this).find("input[name='dateWaste']").val();
		var dataSetToSubmit = setData(wasteReportType, dataForm);

		$.ajax({
			url: base_url+"dashboard/getChartDataReport",
			data: dataSetToSubmit,
			method: 'post',
			dataType: 'json',
			success: function(data){
				for (let i = 0; i < data.length; i++) {
					myChart.config.data.datasets[i].data = getPecentage(data[i]);
				}
				myChart.update();
			}
		})
	});

	function getPecentage(dataWaste){
		var finalData = [];

		for (let i = 0; i < dataWaste.length; i++) { //you can also use "for in", so you don't need the variable "len"
			for (let j = 1; j < dataWaste.length; j++) {
				if (dataWaste[j - 1]['totalWaste'] > dataWaste[j]['totalWaste']) {
					let tmp = dataWaste[j - 1];
					dataWaste[j - 1] = dataWaste[j];
					dataWaste[j] = tmp;
				}
			}
		}

		var totalKg = 0;
		for(let count = 0; count < dataWaste.length; count++){
			totalKg += dataWaste[count]['totalWaste'];
		}

		for(let interval = 0; interval < dataWaste.length; interval++){
			var percentage = 0;
			if(dataWaste[interval]['totalWaste'] !== 0){
				percentage = (dataWaste[interval]['totalWaste']/totalKg) * 100;
			}
			dataWaste[interval]['totalWaste'] = percentage;

		}

		for (let k = 0; k < dataWaste.length; k++) {
			for (let l = 1; l < dataWaste.length; l++) {
				if (dataWaste[l-1]['barangay'] > dataWaste[l]['barangay']) {
					let tmp = dataWaste[l -1];
					dataWaste[l-1] = dataWaste[l];
					dataWaste[l] = tmp;
				}
			}
		}

		for(let m = 0; m <= dataWaste.length; m++){
			if(m == 9){
				finalData[m] = 100;
			} else {
				finalData[m] = dataWaste[m]['totalWaste'];
			}
		}

		return finalData;
	}

	function dateToISOSTring(dateToConvert){
		dateToConvert.setDate(dateToConvert.getDate());
		return dateToConvert.toISOString().split('T')[0];
	}

	function setData(wasteReportType, dataForm){
		var dataFromForm = {};
		if(wasteReportType == 'daily'){
			dataFromForm = {type:wasteReportType, dataItem:dateToISOSTring(new Date(dataForm))};
		} else if (wasteReportType == 'weekly'){
			var dateFromWeek = dataForm.split('-');
			dataFromForm = {type:wasteReportType,
				dataItem:[dateToISOSTring(new Date(dateFromWeek[0])),
					dateToISOSTring(new Date(dateFromWeek[1]))]};
		} else if (wasteReportType == 'monthly'){
			var dateFromMonth = dataForm.split('/');
			dataFromForm = {type:wasteReportType, dataItem:[dateFromMonth[0], dateFromMonth[1]]};
		}
		return dataFromForm;
	}

	$('#printChart').click(function(){
		var wasteReportType = $("#chartReport").find("select[name='reportCat']").val();
		var dataForm = $("#chartReport").find("input[name='dateWaste']").val();

		var dataToPrint = setData(wasteReportType, dataForm);
		$.ajax({
			url:base_url+"dashboard/printTable",
			data: dataToPrint,
			type: 'post',
			success: function(data){
				if(data){
					window.location.href = base_url+"dashboard/printPage/print";
				}
			}
		});
	})

	$("#pdfChart").on('click', function(){
		var wasteReportType = $("#chartReport").find("select[name='reportCat']").val();
		var dataForm = $("#chartReport").find("input[name='dateWaste']").val();
		const canvas = document.getElementById('myChart');
		const canvasImage = canvas.toDataURL('image/jpeg', 1.0);
		let pdf = new jsPDF('landscape');
		pdf.setFontSize(10);
		pdf.addImage(canvasImage, 'JPEG', 20, 38, 255, 150);
		pdf.text(15,10, "Solid Waste Collection Management System");
		pdf.setFontSize(20);
		pdf.text(15,20, "Waste Collection Data Report");
		pdf.setFontSize(10);
		var reportString = "Report: "+wasteReportType+" Date: "+dataForm;
		pdf.text(15,30, reportString);
		pdf.save('mychart.pdf');
	});
});
