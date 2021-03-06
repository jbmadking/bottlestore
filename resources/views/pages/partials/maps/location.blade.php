<style>
    #map-canvas {
        height: 100%;
        margin: 0;
        padding: 0;
    }

</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script>
    var map;

    function initialize () {
        var mapOptions = {
            zoom: 14
        };
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = new google.maps.LatLng(position.coords.latitude,
                        position.coords.longitude);

                var infowindow = new google.maps.InfoWindow({
                    map     : map,
                    position: pos,
                    content : 'Location found using HTML5.'
                });

                map.setCenter(pos);
            }, function () {
                handleNoGeolocation(true);
            });
        } else {
// Browser doesn't support Geolocation
            handleNoGeolocation(false);
        }
    }

    function handleNoGeolocation (errorFlag) {
        if (errorFlag) {
            var content = 'Error: The Geolocation service failed.';
        } else {
            var content = 'Error: Your browser doesn\'t support geolocation.';
        }

        var options = {
            map     : map,
            position: new google.maps.LatLng(60, 105),
            content : content
        };

        var infowindow = new google.maps.InfoWindow(options);
        map.setCenter(options.position);
    }

    google.maps.event.addDomListener(window, 'load', initialize);

</script>

<div class="" id="map-canvas"  style="width: 300px; height: 300px"></div>
