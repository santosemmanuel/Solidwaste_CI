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
	$("#datepicker").val(formatDate(currentDate));

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
			$("#editPersonal"+dataLength[index].user_id).on("shown.bs.modal", function() {
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
					$("#editPersonal"+dataLength[index].user_id).find("input[name='coordinate']").val(env.coordinate[0]+", "+env.coordinate[1]);
					map[index].addLayer(layer);
				});
			});
		}
	});

	function getRequestUser(){
		$.get(base_url + "dashboard/getListRequestUser/", function (data) {
			var text = "";
			for (let i = 0; i < data.length; i++) {
				text += "<tr>";
				text += "<td>"+(i+1)+"</td>";
				text += "<td>"+data[i].request_date+"</td>";
				text += "<td>"+data[i].remarks+"</td>";
				text += "<td><button type=\"button\" class=\"btn btn-danger btn-sm\">Delete</button></td>";
				text += "</tr>";
			}
			$("#requestTable tbody").html(text);
		},'json');
	}

	setInterval(getRequestUser, 2000);

})
