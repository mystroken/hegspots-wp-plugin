// Places Markers
// In the following, markers appear when the user clicks on the map.
var map;
var markers = [];

function initialize() {
  var
    inputLng = document.getElementById('map__lng'),
    inputLat = document.getElementById('map__lat'),
    initialPosition = { lat: parseFloat(inputLat.value), lng: parseFloat(inputLng.value) }
  ;

  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: initialPosition,
    mapTypeId: 'roadmap'
  });

  // This event listener calls addMarker() when the map is clicked.
  google.maps.event.addListener(map, 'click', function(event) {
    addMarker(event.latLng, map, inputLat, inputLng);
  });

  // Add a marker at the center of the map.
  addMarker(initialPosition, map, inputLat, inputLng);
}

// Adds a marker to the map.
function addMarker(location, map, inputLat, inputLng) {

  let lng;
  let lat;

  if( typeof location.lat == 'number' ){
    lat = location.lat;
    lng = location.lng;
  }
  else if(typeof location.lat == 'function'){
    lat = location.lat();
    lng = location.lng();
  }

  // Remove the last added marker
  if( markers.length > 0 ){
    let lastMarker = markers[markers.length-1]
    lastMarker.setMap(null);
  }

  // Add the marker at the clicked location, and add the next-available label
  // from the array of alphabetical characters.
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });

  markers.push(marker);
  inputLat.value = lat;
  inputLng.value = lng;
}

google.maps.event.addDomListener(window, 'load', initialize);
