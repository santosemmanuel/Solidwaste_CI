$("#signUpModal").on("shown.bs.modal", function () {
	map.updateSize();
});

var map = new ol.Map({
	target: "map",
	layers: [
		new ol.layer.Tile({
			minZoom: 10,
			source: new ol.source.OSM(),
		}),
	],
	view: new ol.View({
		center: [13903066.89804018, 1229275.2830421156],
		zoom: 15,
		minZoom: 11,
	}),
});

var Mapcoordinates = "";
map.on("click", function (env) {
	map.getLayers().forEach((layer) => {
		if (layer.get("name") && layer.get("name") == "vectorLayer") {
			map.removeLayer(layer);
		}
	});

	const iconFeature = new ol.Feature({
		geometry: new ol.geom.Point([env.coordinate[0], env.coordinate[1]]),
	});

	var layer = new ol.layer.Vector({
		source: new ol.source.Vector({
			features: [iconFeature],
		}),
		style: new ol.style.Style({
			image: new ol.style.Icon({
				anchor: [0.5, 46],
				anchorXUnits: "fraction",
				anchorYUnits: "pixels",
				src: "https://openlayers.org/en/latest/examples/data/icon.png",
			}),
		}),
	});
	Mapcoordinates = [env.coordinate[0], env.coordinate[1]];
	layer.set("name", "vectorLayer");
	map.addLayer(layer);
});

$('#collectSched').hide();

$(document).ready(function () {
	$("#alertMessage").hide();

	$("#signUpForm").submit(function (e) {
		e.preventDefault();
		var dataForm = {
			firstName: $("#signUpForm").find("input[name='firstName']").val(),
			middleName: $("#signUpForm").find("input[name='middleName']").val(),
			lastName: $("#signUpForm").find("input[name='lastName']").val(),
			contactNumber: $("#signUpForm").find("input[name='contactNumber']").val(),
			userName: $("#signUpForm").find("input[name='userName']").val(),
			password: $("#signUpForm").find("input[name='password']").val(),
			reTypePassword: $("#signUpForm")
				.find("input[name='reTypePassword']")
				.val(),
			realEstate: $("#signUpForm")
				.find("select[name='realEstate'] option:selected")
				.val(),
			barangay: $("#signUpForm")
				.find("select[name='barangay'] option:selected")
				.val(),
			address: $("#signUpForm").find("input[name='address']").val(),
		};

		if ($("#realEstate").val() != "residential") {
			dataForm.businessName = $("#signUpForm")
				.find("input[name='businessName']")
				.val();
			dataForm.businessPermit = $("#signUpForm")
				.find("input[name='businessPermit']")
				.val();
			dataForm.businessType = $("#signUpForm")
				.find("select[name='businessType'] option:selected")
				.val();
		}

		if (Mapcoordinates.length == 0) {
			dataForm.coordinates = "";
		} else {
			dataForm.coordinates = Mapcoordinates[0] + ", " + Mapcoordinates[1];
		}

		$.ajax({
			url: base_url + "welcome/signUp",
			type: "post",
			dataType: "json",
			data: dataForm,
			success: function (data) {
				if (data.response == "success") {
					window.location.href = base_url + "welcome?pesan=SignUpConfirm";
				} else {
					$("#alertMessage").show();
					$("#alertMessage").html(data.message);
				}
			},
		});
	});

	//Add Admin
	$("#submitAdmin").submit(function (e) {
		e.preventDefault();

		var dataForm = $("#submitAdmin").serializeArray();
		$.ajax({
			url: base_url + "admin/addAdmin",
			type: "post",
			dataType: "json",
			data: dataForm,
			success: function (data) {
				if (data.response == "success") {
					toastr.success("Admin has successfully been add.");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertMessage").show();
					$("#alertMessage").html(data.message);
				}
			},
		});
	});

	//Edit Admin
	$(".submiteditAdmin").submit(function (e) {
		e.preventDefault();

		var dataForm = $(this).serializeArray();
		$.ajax({
			url: base_url + "admin/editAdmin",
			type: "post",
			dataType: "json",
			data: dataForm,
			success: function (data) {
				if (data.response == "success") {
					toastr.success("An Admin has successfully been edit.");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertMessage" + dataForm[0].value + "").removeAttr(
						"hidden",
						"hidden"
					);
					$("#alertMessage" + dataForm[0].value + "").html(data.message);
				}
			},
		});
	});

	// var pickerOpts1 = {
	// 	dateFormat: "yy-mm-dd",
	// 	onSelect: function (dateText, inst) {
	// 		var date = $(this).datepicker("getDate");
	// 		$("#datepicker2").val($.datepicker.formatDate("DD", date));
	// 	},
	// };

	function formatDate(date) {
		var d = new Date(date),
			month = '' + (d.getMonth() + 1),
			day = '' + d.getDate(),
			year = d.getFullYear();

		if (month.length < 2)
			month = '0' + month;
		if (day.length < 2)
			day = '0' + day;

		return [year, month, day].join('-');
	}

	var currentDate = new Date();
	$("#datepicker").val(formatDate(currentDate));

	$("form[name='form_edit_mahasiswa']").each(function () {
		$(this)
			.find("select[name='name_wastecat']")
			.change(function () {
				var selectedOption = $(this).prop("selectedIndex");
				var changeOption = $(this).parent().parent();
				changeOption
					.find("select[name='spec'] option")
					.eq(selectedOption)
					.prop("selected", true);
			});
		var pickerOpts2 = {
			dateFormat: "yy-mm-dd",
			onSelect: function (dateText, inst) {
				var date = $(this).datepicker("getDate");
				$(this)
					.parent()
					.parent()
					.find("input[name='wastecat_day']")
					.val($.datepicker.formatDate("DD", date));
			},
		};
		$(this).find("input[name='wastecat_date']").datepicker(pickerOpts2);
	});

	$("form[name='editUserModal']").each(function () {
		$(this)
			.find("select[name='realEstate']")
			.change(function () {
				if ($(this).val() == "residential") {
					$(this).parent().parent().parent().find(".commercialIndustry").hide();
				} else {
					$(this).parent().parent().parent().find(".commercialIndustry").show();
				}
			});
	});

	$("#realEstate").change(function () {
		if ($(this).val() == "residential") {
			$("#commercialIndustry").hide();
		} else {
			$("#commercialIndustry").show();
		}
	});

	$.get(base_url + "usersection/get_ajaxData", function (data) {
		var dataLength = JSON.parse(data);
		let map = [];
		for (let index = 0; index < dataLength.length; index++) {
			var location = dataLength[index].location.split(", ");
			iconFeature1 = new ol.Feature({
				geometry: new ol.geom.Point([location[0], location[1]]),
			});
			map1 = new ol.Map({
				target: "viewMap" + dataLength[index].user_id,
				layers: [
					new ol.layer.Tile({
						minZoom: 10,
						source: new ol.source.OSM(),
					}),
				],
				view: new ol.View({
					center: [13903066.89804018, 1229275.2830421156],
					zoom: 15,
					minZoom: 11,
				}),
			});
			var layer = new ol.layer.Vector({
				source: new ol.source.Vector({
					features: [iconFeature1],
				}),
				style: new ol.style.Style({
					image: new ol.style.Icon({
						anchor: [0.5, 46],
						anchorXUnits: "fraction",
						anchorYUnits: "pixels",
						src: "https://openlayers.org/en/latest/examples/data/icon.png",
					}),
				}),
			});
			layer.set("name", "vector");
			map1.addLayer(layer);
			map.push(map1);
		}
		for (let index = 0; index < dataLength.length; index++) {
			$("#viewBusiness"+dataLength[index].user_id).on("shown.bs.modal", function() {
				map[index].updateSize();
			});
		}
	});

	$.get(base_url + "usersection/get_ajaxData", function (data) {
		var dataLength = JSON.parse(data);
		let map = [];
		for (let index = 0; index < dataLength.length; index++) {
			var location = dataLength[index].location.split(", ");
			iconFeature1 = new ol.Feature({
				geometry: new ol.geom.Point([location[0], location[1]]),
			});
			map1 = new ol.Map({
				target: "viewMap1" + dataLength[index].user_id,
				layers: [
					new ol.layer.Tile({
						minZoom: 10,
						source: new ol.source.OSM(),
					}),
				],
				view: new ol.View({
					center: [13903066.89804018, 1229275.2830421156],
					zoom: 15,
					minZoom: 11,
				}),
			});
			var layer = new ol.layer.Vector({
				source: new ol.source.Vector({
					features: [iconFeature1],
				}),
				style: new ol.style.Style({
					image: new ol.style.Icon({
						anchor: [0.5, 46],
						anchorXUnits: "fraction",
						anchorYUnits: "pixels",
						src: "https://openlayers.org/en/latest/examples/data/icon.png",
					}),
				}),
			});
			layer.set("name", "vector");
			$("#editMunicipal"+dataLength[index].user_id).find("input[name='coordinate']").val(location[0]+", "+location[1]);
			map1.addLayer(layer);
			map.push(map1);
		}
		for (let index = 0; index < dataLength.length; index++) {
			$("#editMunicipal"+dataLength[index].user_id).on("shown.bs.modal", function() {
				map[index].updateSize();
				map[index].on("click", function (env) {
					map[index].getLayers().forEach((layer) => {
						if (layer.get("name") && layer.get("name") == "vectorLayer" || layer.get("name") && layer.get("name") == "vector") {
							map[index].removeLayer(layer);
						}
					});

					const iconFeature = new ol.Feature({
						geometry: new ol.geom.Point([env.coordinate[0], env.coordinate[1]]),
					});

					var layer = new ol.layer.Vector({
						source: new ol.source.Vector({
							features: [iconFeature],
						}),
						style: new ol.style.Style({
							image: new ol.style.Icon({
								anchor: [0.5, 46],
								anchorXUnits: "fraction",
								anchorYUnits: "pixels",
								src: "https://openlayers.org/en/latest/examples/data/icon.png",
							}),
						}),
					});
					layer.set("name", "vectorLayer");
					$("#editMunicipal"+dataLength[index].user_id).find("input[name='coordinate']").val(env.coordinate[0]+", "+env.coordinate[1]);
					map[index].addLayer(layer);
				});
			});
		}
	});

	$("#dataTable1").DataTable();
	$("#dataTable2").DataTable();

	//Add Driver
	$("#submitDriver").on('submit', function(e){
		e.preventDefault();
		var driverData = $(this).serializeArray();
		$.ajax({
			url: base_url + "drivertruck/addDriver",
			type: "post",
			dataType: "json",
			data: driverData,
			success: function (data) {
				if (data.response == "success") {
					toastr.success("Driver successfully added.");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertMessage").html(data.message).show();
				}
			},
		});
	});

	//Edit Driver
	$(".editDriverForm").submit(function (e) {
		e.preventDefault();

		var dataForm = $(this).serializeArray();
		$.ajax({
			url: base_url + "drivertruck/editDriver",
			type: "post",
			dataType: "json",
			data: dataForm,
			success: function (data) {
				if (data.response == "success") {
					toastr.success("An Admin has successfully been edit.");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertMessage" + dataForm[0].value + "").removeAttr(
						"hidden",
						"hidden"
					);
					$("#alertMessage" + dataForm[0].value + "").html(data.message);
				}
			},
		});
	});

	//Add Truck
	$("#submitTruck").on('submit', function(e){
		e.preventDefault();
		var driverData = $(this).serializeArray();
		$.ajax({
			url: base_url + "drivertruck/addTruck",
			type: "post",
			dataType: "json",
			data: driverData,
			success: function (data) {
				if (data.response == "success") {
					toastr.success("Truck successfully added.");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertMessage1").html(data.message).removeAttr("hidden","hidden");
				}
			},
		});
	});

	$(".editTruck").on('submit', function(e){
		e.preventDefault();

		var dataForm = $(this).serializeArray();
		$.ajax({
			url: base_url + "drivertruck/editTruck",
			type: "post",
			dataType: "json",
			data: dataForm,
			success: function (data) {
				if (data.response == "success") {
					toastr.success("Truck has successfully been edit.");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertMessage" + dataForm[0].value + "").removeAttr(
						"hidden",
						"hidden"
					);
					$("#alertMessage" + dataForm[0].value + "").html(data.message);
				}
			},
		});
	});

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
			url: base_url+"wastecat/getWasteReport",
			data: dataFromForm,
			type: 'post',
			dataType: 'json',
			success: function(data){
				var inputData = "<td>"+data[0]+"</td>"
								+"<td>"+data[1]+"kg</td>"
								+"<td>"+data[2]+"kg</td>"
								+"<td>"+data[3]+"kg</td>"
								+"<td>"+data[4]+"kg</td>"
								+"<td><strong>"+data[5]+"kg</strong></td>";
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
			url:base_url+"wastecat/printTable",
			data: dataToPrint,
			type: 'post',
			success: function(data){
				if(data){
					window.location.href = base_url+"wastecat/printPage/print";
				}
			}
		});
	})

	$('#pdfTable').click(function(){
		var wasteReportType = $("#wasteReportForm").find("select[name='reportCat']").val();
		var dataForm = $("#wasteReportForm").find("input[name='dateWaste']").val();

		var dataToPrint = setData(wasteReportType, dataForm);
		$.ajax({
			url:base_url+"wastecat/printTable",
			data: dataToPrint,
			type: 'post',
			success: function(data){
				if(data){
					window.location.href = base_url+"wastecat/printPage/pdf";
				}
			}
		});
	})

	$("#activityLogForm").submit(function(e){
		e.preventDefault();
		var dataForm = $(this).find("input[name='dateWaste']").val();
		$.post(base_url+"settings/getLoggerByDate",{dataWaste:dataForm},function(data){
			let contentLog = "";
			for (let i = 0; i < data.length; i++) {
				contentLog += "<p>"+data[i].date_log+" - "+data[i].message_log+"</p>";
			}
			$("#loggerContent").html(contentLog);
		},'json');
	})

	$("#barangayWasteForm").find("select[name='reportCat']").change(function(){
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

	})

	$("#barangayWasteForm").submit(function(e){
		e.preventDefault();
		var wasteReportType = $(this).find("select[name='reportCat']").val();
		var dataForm = $(this).find("input[name='dateWaste']").val();

		var dataFromForm = setData(wasteReportType, dataForm);

		$.ajax({
			url: base_url+"wasteInfo/getBarangayWasteInfo",
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
	})

	$('#printTableBarangay').click(function(){
		var wasteReportType = $("#barangayWasteForm").find("select[name='reportCat']").val();
		var dataForm = $("#barangayWasteForm").find("input[name='dateWaste']").val();

		var dataToPrint = setData(wasteReportType, dataForm);
		$.ajax({
			url:base_url+"wasteInfo/printTableBarangay",
			data: dataToPrint,
			type: 'post',
			success: function(data){
				if(data){
					window.location.href = base_url+"wasteInfo/printPageBarangay/print";
				}
			}
		});
	})

	$('#pdfTableBarangay').click(function(){
		var wasteReportType = $("#barangayWasteForm").find("select[name='reportCat']").val();
		var dataForm = $("#barangayWasteForm").find("input[name='dateWaste']").val();

		var dataToPrint = setData(wasteReportType, dataForm);
		$.ajax({
			url:base_url+"wasteInfo/printTableBarangay",
			data: dataToPrint,
			type: 'post',
			success: function(data){
				if(data){
					window.location.href = base_url+"wasteInfo/printPageBarangay/pdf";
				}
			}
		});
	});

	function getConcernList(){
		$.get(base_url+"concerns/getConcernList", function(data){
			let content = "";
			let name = "";
			for (let i = 0; i < data.length; i++) {
				if(data[i].level == 'admin'){
					name = 'admin';
				} else {
					name = data[i].lastName+", "+data[i].firstName;
				}
				content += "<li href=\"#\" class=\"list-group-item\">\n" +
					"\t\t\t\t\t\t\t<a href='"+base_url+"concerns/concernConversation/"+data[i].user_id+"'>" +
					"<span class=\"name label label-info\" style=\"min-width: 120px; display: inline-block;\">"+name+"</span></a>\n" +
					"<span class=\"badge badge-info\">New</span>\n"+
					"\t\t\t\t\t\t\t<span class=\"float-right\">\n" +
					"\t\t\t\t\t\t\t\t<a href=''><i class=\"fas fa-trash\"></i></a>\n" +
					"\t\t\t\t\t\t\t</span>\n" +
					"\t\t\t\t\t\t</li>";
			}
			$("#concern_list").html(content);
		},'json');
	}

	setInterval(getConcernList, 1000);


	function getConversationConcern(){
		if(userConversationID){
			$.ajax({
				url: base_url+"concerns/getConversationConcern",
				data: {dataItem: userConversationID},
				type: 'post',
				dataType: 'json',
				success: function(data){
					let name = "";
					let content = "";
					for (let j = 0; j < data.length; j++) {
						if(data[j].level == 'admin'){
							name = 'Administrator';
						} else {
							name = data[j].lastName+", "+data[j].firstName;
						}
						content += "<li href=\"#\" class=\"list-group-item\">\n" +
							"\t\t\t\t\t\t\t<a href='#'><span class=\"name label label-info\" style=\"min-width: 120px; display: inline-block;\">"+name+"</span></a>\n" +
							"\t\t\t\t\t\t\t<br><span class=\"text-muted\" style=\"font-size: 11px;\">- "+data[j].message+"</span>\n" +
							"\t\t\t\t\t\t\t<br><span class=\"badge\">"+data[j].message_date+"</span>\n" +
							"\t\t\t\t\t\t\t<span class=\"float-right\">\n" +
							"\t\t\t\t\t\t\t\t<a href=''><i class=\"fas fa-trash\"></i></a>\n" +
							"\t\t\t\t\t\t\t</span>\n" +
							"\t\t\t\t\t\t</li>";
					}
					$("#conversation_list").html(content);
				}
			});
		}
	}

	setInterval(getConversationConcern, 1000);
});



