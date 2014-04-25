(function( $ ) {
 
    $.fn.map = function() {
        
        var map;
 
        function initialize() {
        var mapOptions = {
            center: new google.maps.LatLng(-34.397, 150.644),
            zoom: 13
            };
            map = new google.maps.Map(document.getElementById("map"),mapOptions);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
        
        if(navigator.geolocation) {
            var browserSupportFlag = true;
            navigator.geolocation.getCurrentPosition(function(position) {
              var initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
              map.setCenter(initialLocation);
            }, function() {
              handleNoGeolocation(browserSupportFlag);
            });
          }
 
        return this;
 
    };
 
}( jQuery ));
 
