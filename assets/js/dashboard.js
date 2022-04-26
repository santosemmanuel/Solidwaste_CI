$(document).ready(function(){

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
	$("#requestForm").find("#datepicker").val(formatDate(currentDate));

	const container = document.getElementById('popup');
	const content = document.getElementById('popup-content');
	const closer = document.getElementById('popup-closer');

	const overlay = new ol.Overlay({
		element: container,
		autoPan: {
			animation: {
				duration: 250,
			},
		},
	});

	closer.onclick = function () {
		overlay.setPosition(undefined);
		closer.blur();
		return false;
	};

	var map = new ol.Map({
		target: "dashboardMap",
		layers: [
			new ol.layer.Tile({
				minZoom: 10,
				source: new ol.source.OSM(),
			})
		],
		overlays: [overlay],
		view: new ol.View({
			center: [13903066.89804018, 1229275.2830421156],
			zoom: 15,
			minZoom: 11,
		}),
	});

	function getRequestAdmin() {
		map.getLayers().forEach((layer) => {
			if (layer.get("name") && layer.get("name") == "burauenLeyte") {
				map.removeLayer(layer);
			}
		});
		$.get(base_url + "dashboard/getRequest", function (data) {
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
			map.addLayer(layerBurauen);
		},'json');
	}

	map.on('click',function(evt){

		$("#popup").removeAttr("hidden");
		var feature1 = map.forEachFeatureAtPixel(evt.pixel, (feature1) => feature1);

		if (feature1){
			var geometry = feature1.getGeometry();
			var coordinate = geometry.getCoordinates();

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

				$("#requestID").val(feature1.get('request_id'));
				$("#requestTitle").html(context);


			},'json');
			overlay.setPosition(coordinate);
		}

	});

	setInterval(getRequestAdmin, 2000);

	$("#datepickerChart").datepicker({dateFormat: "yy-mm-dd"});
	$("#chartReport").find("select[name='reportCat']").change(function(){
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
});

