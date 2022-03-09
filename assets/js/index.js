$('#signUpModal').on('shown.bs.modal', function () {
    map.updateSize();   
});

const map = new ol.Map({
    target: 'map',
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
    })
});

var Mapcoordinates = "";
map.on('click', function(env){
    
    map.getLayers().forEach(layer => {
        if (layer.get('name') && layer.get('name') == 'vectorLayer'){
            map.removeLayer(layer)
        }
    });

    const iconFeature = new ol.Feature({
        geometry: new ol.geom.Point([env.coordinate[0], env.coordinate[1]])
    });

    var layer = new ol.layer.Vector({
        source: new ol.source.Vector({
            features: [iconFeature]
        }),
        style: new ol.style.Style({
            image: new ol.style.Icon({
            anchor: [0.5, 46],
            anchorXUnits: 'fraction',
            anchorYUnits: 'pixels',
            src: 'https://openlayers.org/en/latest/examples/data/icon.png'
            })
        })
    })
    Mapcoordinates = [env.coordinate[0], env.coordinate[1]];
    layer.set('name', 'vectorLayer');
    map.addLayer(layer);
})


$(document).ready(function(){
    $("#alertMessage").hide();
    $("#signUpForm").submit(function(e){
        e.preventDefault();
        var dataForm = $("#signUpForm").serializeArray();
        dataForm.push({name: 'coordinates', value: Mapcoordinates[0]+", "+Mapcoordinates[1]});
        $.ajax({
            url: base_url+"welcome/signUp",
            type: "post",
            dataType: "json",
            data: dataForm,
            success: function(data){
                $("#alertMessage").show();
                $("#alertMessage").html(data.message);
            }
        })
    })
});