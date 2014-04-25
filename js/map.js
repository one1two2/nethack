(function( $ ) {
    
    
 
    $.fn.map = function() {
        
        var map;
        var autocomplete;
        var markers=[];
        var infobox=new InfoBox();
 
        function initialize() {
        var mapOptions = {
            center: new google.maps.LatLng(-34.397, 150.644),
            zoom: 13
            };
            map = new google.maps.Map(document.getElementById("map"),mapOptions);
            
            if(navigator.geolocation) {
                var browserSupportFlag = true;
                navigator.geolocation.getCurrentPosition(function(position) {
                  var initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                  map.setCenter(initialLocation);
                }, function() {
                  handleNoGeolocation(browserSupportFlag);
                });
              }
              
               // Create the search box and link it to the UI element.
            var input = (document.getElementById('location'));
            //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);
            
            google.maps.event.addListener(autocomplete, 'place_changed', function() {

                var place = autocomplete.getPlace();
                if (!place.geometry) {
                  return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                  map.fitBounds(place.geometry.viewport);
                  map.setCenter(place.geometry.location);
                  map.setZoom(map.getZoom()+2);  

                } else {
                  map.setCenter(place.geometry.location);
                  map.setZoom(13);  
                }
            });
        }
        
        function getEvents(){
            var request=$.ajax({
                url: "ajax/events.php",
                dataType: "json"
            });
            
            request.done(function (response){
                console.log(response);
                
                for(var i=0;i<response.length;i++){
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(response[i].latitude,response[i].longitude),
                        map: map,
                        title: response[i].name
                    });
                    marker.clickMarker(response[i]);
                    //markerClick(response[i]);
                    
                    markers.push(marker);
                }
                
                
            });
        }
        
        function markerClick(response){
           
        }
        
        google.maps.Marker.prototype.clickMarker=function(response){
            google.maps.event.addListener(this, 'click', function() {
                var options={
                    content: response.name
                };
                
                infobox.setOptions(options);
                infobox.open(map,this);      
            });
            
        }
         
        
        google.maps.event.addDomListener(window, 'load', initialize);
        
        getEvents();
        
        return this;
 
    };
 
}( jQuery ));
 
