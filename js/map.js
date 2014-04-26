(function( $ ) {
    
    
 
    $.fn.events_map = function() {

        var map;
        var autocomplete;
        var infobox=new InfoBox();
        var semafor=false;
        var markers=Marker();
        
        var $events=$("#panel_events");
        var $event=$("#panel_event");
        var $select=$("#select");
        var $filter=$("#filter");
        
        $( document ).ready(function() {
            $event.on("click",'a.zamknij',function(){
                $event.hide();
                return false;
            });
            
            $select.change(function(){
                getEvents();
                return false;
            });
            
            $events.on("click",'a.wiecej',function(){
                getEvent($(this).attr('eid'));
                return false;
            });
            
            $events.on("click",'#filter-switch',function(){
                $filter.toggle();
                return false;
            });
            
            $events.on("mouseenter",'.event',function() {
                markers.highlightMarker($(this).attr('eid'));
            });
            $events.on("mouseleave",'.event',function() {
                markers.unhighlightMarker($(this).attr('eid'));
            });
            /*
            $( ".event" ).hover(
                function() {
                    console.log('test');
                    markers.highlightMarker($(this).attr('eid'));
                }, function() {
                    markers.unhighlightMarker($(this).attr('eid'));
                }
            );*/
        });
        
        function Marker(){
            var markers={};
            var count=0;
            var events={};
            
            var obj={};
            obj.addMarker=function(response){
                if(markers.hasOwnProperty(response.eid)===false){
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(response.location_latitude,response.location_longitude),
                        map: map,
                        title: response.name,
                        icon: 'http://maps.google.com/mapfiles/kml/paddle/red-stars.png'
                    });
                    
                    markers[response.eid]=marker;
                    events[response.eid]=response;
                    count++;
                }
                else{
                    marker=markers[response.eid];
                }
                return marker;
            }
            obj.showEvents=function(){
                var $list=$("#events_list").html('');
                var count=0;
                for(var i in events){
                    $list.append(events[i].html);
                    count++;
                    if(count>4){
                        break;
                    }
                } 
            };
            obj.highlightMarker=function(eid){
                markers[eid].setIcon('http://maps.google.com/mapfiles/kml/paddle/grn-stars.png');
            };
            obj.unhighlightMarker=function(eid){
                markers[eid].setIcon('http://maps.google.com/mapfiles/kml/paddle/red-stars.png');
            };
            
            
            
            obj.count=function(){
                return count;
            };
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
                data: {lat:center.lat(),lng:center.lng(),r:50,sort:$select.val()}
            });
            
            request.done(function (response){
                console.log(response);
                
                
                for(var i=0;i<response.length;i++){
                    var marker=markers.addMarker(response[i]);
                    marker.clickMarker(response[i]);
                }
                
                markers.showEvents();
                
                console.log(markers.count());
            });
        }
        
        google.maps.Marker.prototype.clickMarker=function(response){
            google.maps.event.addListener(this, 'click', function() {
                getEvent(response.eid);
            });
        };
        
        init();
        
        
        return this;
 
        function getEvent(eid){
        $.get( "ajax/event.php",{ eid:eid }, function( data ) {
                    $event.show();
                    $event.html(data);
        });
        }
    };
}( jQuery ));
 
