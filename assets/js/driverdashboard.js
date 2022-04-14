$(document).ready(function(){

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

	$("#wasteCatForm").find("select[name='name_wastecat']").change(function () {
		var selectedOption = $("#wasteCatForm").find("select[name='name_wastecat']").prop("selectedIndex");
		$("#wasteCatForm").find("#wasteSpecs option").eq(selectedOption).prop("selected", true);
	});

});
