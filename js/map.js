(function( $ ) {
    
    
 
    $.fn.map = function() {

        var map;
        var autocomplete;
        var infobox=new InfoBox();
        var semafor=false;
        var markers=Marker();
        
        var $events=$("#panel_events");
        var $event=$("#panel_event");
        
        $( document ).ready(function() {
            $event.on("click",'a.zamknij',function(){
                $event.hide();
                return false;
            });
        });
        
        function Marker(){
            var markers={};
            var count=0;
            
            var obj={};
            obj.addMarker=function(response){
                if(markers.hasOwnProperty(response.id)===false){
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(response.latitude,response.longitude),
                        map: map,
                        title: response.name
                    });
                    
                    markers[response.id]=marker;
                    count++;
                }
                else{
                    marker=markers[response.id];
                }
                return marker;
            }
            obj.count=function(){
                return count;
            }
            return obj;
        }
        
        function init(){
 
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
                  getEvents();
                }, function() {
                  handleNoGeolocation(browserSupportFlag);
                });
              }
              else{
                  getEvents();
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
            
            google.maps.event.addListener(map, 'bounds_changed', function() {
                getEvents();
            });
        }
        
        function getEvents(){
            if(semafor===false){
                semafor=true;
                setTimeout(function(){
                    _getEvents();
                    semafor=false;
                },1000);
            }
        }
        
        function _getEvents(){
            var center=map.getCenter();
            
            var request=$.ajax({
                url: "ajax/events.php",
                dataType: "json",
                type:'get',
                data: {lat:center.lat(),lng:center.lng(),r:50}
            });
            
            request.done(function (response){
                console.log(response);
                
                var $list=$("#events_list").html('');
                for(var i=0;i<response.length;i++){
                    
                    var marker=markers.addMarker(response[i]);
                    marker.clickMarker(response[i]);
                    $list.append(response[i].html);
                }
                
                console.log(markers.count());
            });
        }
        
        google.maps.Marker.prototype.clickMarker=function(response){
            google.maps.event.addListener(this, 'click', function() {
                $.get( "ajax/event.php",{ eid:response.eid }, function( data ) {
                    $event.show();
                    $event.html(data);
                });
            });
        };
        
        init();
        
        
        return this;
 
    };
 
}( jQuery ));
 
