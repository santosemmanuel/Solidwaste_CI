$(document).ready(function(){


	$("#wasteCatForm").find("select[name='name_wastecat']").change(function () {
		var selectedOption = $("#wasteCatForm").find("select[name='name_wastecat']").prop("selectedIndex");
		$("#wasteCatForm").find("#wasteSpecs option").eq(selectedOption).prop("selected", true);
	});

	var map1 = new ol.Map({
	target: "dashboardMapDriver",
	layers: [
		new ol.layer.Tile({
			minZoom: 10,
			source: new ol.source.OSM(),
		})
	],
	view: new ol.View({
		center: [13903066.89804018, 1229275.2830421156],
		zoom: 15,
		minZoom: 11,
	}),
});

	function getRequestDriver() {
	map1.getLayers().forEach((layer) => {
		if (layer.get("name") && layer.get("name") == "burauenLeyte") {
			map1.removeLayer(layer);
		}
	});
	$.get(base_url + "dashboard/getRequestDriver", function (data) {
		let featureArray = [];
		for (let i = 0; i < data.length; i++) {
			let coordinate = data[i].location.split(", ");
			let featureElement = new ol.Feature({
				geometry: new ol.geom.Point([coordinate[0], coordinate[1]]),
			});
			featureElement.setProperties(data[i]);
			featureArray.push(featureElement);
		}

		var layerBurauen = new ol.layer.Vector({
			source: new ol.source.Vector({
				features: featureArray,
			}),
			style: new ol.style.Style({
				image: new ol.style.Icon({
					color: "red",
					anchor: [0.5, 0.9],
					anchorXUnits: "fraction",
					anchorYUnits: "pixels",
					src: "https://openlayers.org/en/latest/examples/data/dot.png",
				}),
			}),
		});
		layerBurauen.set("name", "burauenLayer");
		map1.addLayer(layerBurauen);
	}, 'json');
}

	map1.on('click',function(evt){

	var feature1 = map1.forEachFeatureAtPixel(evt.pixel, (feature1) => feature1);

	if (feature1){
		var geometry = feature1.getGeometry();

		$.post(base_url+"dashboard/getUser",{userID: feature1.get('user_id')}, function(data){

			let context = "<strong>";
			if(feature1.get('businessName') != ""){
				context += feature1.get('businessName');
			} else {
				context += data[0].lastName+", "+data[0].firstName;
			}

			context += "</strong> ("+feature1.get('realEstate')+"), "+
				feature1.get('waste_kg')+
				"kg.<br><small>"+feature1.get('street')+"</small>";

			$("#wasteCatForm").find("input[name='requestID']").val(feature1.get('request_id'));
			$("#requestTitle").html(context);
			$('#exampleModal').modal('show');

		},'json');

	}

});

	setInterval(getRequestDriver, 2000);

	$(".week-picker").datepicker();
	$("#wasteReportForm").find("select[name='reportCat']").change(function(){
		var setCalendar;
		var startDate;
		var endDate;

		var selectCurrentWeek = function () {
			window.setTimeout(function () {
				$('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
			}, 1);
		}
		$("#dateByWeek").val("");
		switch ($(this).val()) {
			case 'daily':
				setCalendar = {};
				break;
			case 'weekly':
				setCalendar = {
					showOtherMonths: true,
					selectOtherMonths: true,
					onSelect: function (dateText, inst) {
						var date = $(this).datepicker('getDate');
						startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
						endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
						var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;

						var dateByWeek = $.datepicker.formatDate(dateFormat, startDate, inst.settings) + "-" +
							$.datepicker.formatDate(dateFormat, endDate, inst.settings);
						$("#dateByWeek").val(dateByWeek);
						selectCurrentWeek();
					},
					beforeShowDay: function (date) {
						var cssClass = '';
						if (date >= startDate && date <= endDate)
							cssClass = 'ui-datepicker-current-day';
						return [true, cssClass];
					},
					onChangeMonthYear: function (year, month, inst) {
						selectCurrentWeek();
					}
				};
				break;
			case 'monthly':
				setCalendar = {
					changeMonth: true,
					changeYear: true,
					showButtonPanel: true,
					dateFormat: 'MM/yy',
					onClose: function(dateText, inst) {
						$(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
					}
				};
				break;
			default:
		}
		$("#dateByWeek").datepicker("destroy");
		$('.week-picker').datepicker(setCalendar);

	});

	$("#wasteReportForm").on('submit', function(e){
		e.preventDefault();
		var wasteReportType = $(this).find("select[name='reportCat']").val();
		var dataForm = $(this).find("input[name='dateWaste']").val();

		var dataFromForm = setData(wasteReportType, dataForm);

		$.ajax({
			url: base_url+"wasteInfo/getDriverWasteCollection",
			data: dataFromForm,
			type: 'post',
			dataType: 'json',
			success: function(data){
				console.log(data);
				var inputData = "";
				for (let i = 0; i < data.length; i++) {
					inputData += "<tr><td>"+data[i][0]+"</td>";
					for (let j = 0; j < data[i][1].length; j++){
						inputData += "<td>"+data[i][1][j]+"kg</td>";
					}
						inputData += "<td><strong>"+data[i][1].reduce((total, num) => total + num, 0)+"kg</strong></td></tr>";
				}
				$("#dataTable tbody").html(inputData);
			}

		});
	});

	function dateToISOSTring(dateToConvert){
		dateToConvert.setDate(dateToConvert.getDate() + 1);
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

	$('#printTable').click(function(){
		var wasteReportType = $("#wasteReportForm").find("select[name='reportCat']").val();
		var dataForm = $("#wasteReportForm").find("input[name='dateWaste']").val();

		var dataToPrint = setData(wasteReportType, dataForm);
		$.ajax({
			url:base_url+"wasteInfo/printTable",
			data: dataToPrint,
			type: 'post',
			success: function(data){
				if(data){
					window.location.href = base_url+"wasteInfo/printPage/print";
				}
			}
		});
	})

	$('#pdfTable').click(function(){
		var wasteReportType = $("#wasteReportForm").find("select[name='reportCat']").val();
		var dataForm = $("#wasteReportForm").find("input[name='dateWaste']").val();

		var dataToPrint = setData(wasteReportType, dataForm);
		$.ajax({
			url:base_url+"wasteInfo/printTable",
			data: dataToPrint,
			type: 'post',
			success: function(data){
				if(data){
					window.location.href = base_url+"wasteInfo/printPage/pdf";
				}
			}
		});
	})
});
