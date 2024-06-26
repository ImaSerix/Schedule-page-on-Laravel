$(document).ready(function() {
    $(window).on('hashchange', function(e) {
        const hash = window.location.hash;
        handleHashChangeMap(hash)
    });
    if (window.location.hash) handleHashChangeMap(window.location.hash);
});

let map;

async function initMap(stops) {
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
    map = new Map(document.getElementById("map"), {
        center: { lat: 55.88634910521099, lng: 26.534399596374733},
        zoom: 13,
        mapId: 'eb8192abcb943870',
    });
    const infoWindow = new google.maps.InfoWindow();
    stops.forEach(stop => {
        const marker = new AdvancedMarkerElement({
            map: map,
            position: {lat: parseFloat(stop.latitude), lng: parseFloat(stop.longitude)},
            title: stop['name'],
        }); 
        marker.addListener("click", function(e){
            infoWindow.close();
            infoWindow.setContent(marker.title);
            infoWindow.open(marker.map, marker);
        });
    })
}

function handleHashChangeMap(hash) {
    
    const parts = hash.split('/');
    const routeDirection = parts[0].substr(1); 
    const stopId = parts[1];
    if ($('#stop-table').children().length == 0 || !stopId){
        fetchStopsForRouteMap(routeDirection);
    }
}
function fetchStopsForRouteMap(routeDirection){
    routeID = $("option[value='" + routeDirection + "']")[0].dataset.routeId;
    fetch(`/api/route/${routeID}/stops`)
        .then(response => response.json())
        .then(stops => {
            initMap(stops);
        })
}