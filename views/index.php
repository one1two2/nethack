<html>
    <head>
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="jquery-ui-1.10.4/css/blitzer/jquery-ui-1.10.4.custom.min.css" />
        <meta charset="utf-8">
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="jquery-ui-1.10.4/js/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYMaScAZ6rluB4cgD__IZkIWMMIMxJFZ0&sensor=true&libraries=places">
        </script>
        <script src="js/description.js"></script>
        <script src="js/infobox_packed.js"></script>
        <script src="js/map.js"></script>
        
    </head> 
    
    

    <body>
        <script type='text/javascript'>
            
            function updateRadius(){
                $( "#radius" ).text($( "#slider-radius" ).slider( "value" )+' km'  );
            }
            
            $( document ).ready(function() {
                $("#map").events_map();
                $( "#date_start" ).datepicker();
                $( "#date_end" ).datepicker();
                
                $( "#slider-radius" ).slider({
                    range: "min",
                    min: 0,
                    max: 100,
                    value: 50,
                    slide: function( event, ui ) {
                      updateRadius();
                    }
                });
                updateRadius();
                
                
                
                
            });
            
        </script>
        <div id="fb-root"></div>
        <script>               
      window.fbAsyncInit = function() {
        FB.init({
          appId: '<?php echo $facebook->getAppID() ?>', 
          cookie: true, 
          xfbml: true,
          oauth: true
        });
        FB.Event.subscribe('auth.login', function(response) {
          window.location.reload();
        });
        FB.Event.subscribe('auth.logout', function(response) {
          window.location.reload();
          <?php session_destroy(); ?>
        });
      };
      (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
        
        <div id="page">
            <input type='text' name='location' value='' id='location'/>
        
            <div id="map">

            </div>
            
            <div id="logo">
                <img src="logo.png" alt="logo" />
            </div>
            
            <div id="panel">
                <div id="panel_events">
                    <select id="select">
                        <option value ="popularity" <?php if(!$user_id): ?> selected="true" <?php endif; ?> >Popularność</option>
                        <option value ="date">Data</option>
                        <option value ="nearest">Najbliższe</option>
                        <?php if($user_id > 0): ?>
                            <option value ="match" selected="true">Dopasowane</option>
                        <?php endif; ?>
                    </select>
                    <div id="filter">
                        <select id="termin">
                            <option value="next7">Następne 7 dni</option>
                            <option value="today">Dzisiaj</option>
                            <option value="tomorow">Jutro</option>
                            <option value="next30">Następne 30 dni</option>
                            <option value="week">Ten tydzień</option>
                            <option value="nextweek">Następny tydzień</option>
                            <option value="weekend">Ten weekend (pt-nd)</option>
                        </select>
                        
                        <!--
                        <input id="date_start" name="date_start" type="text" value="od kiedy" />
                        <input id="date_end" name="date_end" type="text"  value="do kiedy" /><br />
                        
                        
                        <label id="radius"></label>
                        <div id="slider-radius"></div>
                        -->
                    </div>
                    <!--<a href="#" id="filter-switch">Otwórz filtry</a>-->
                    
                    <div id="events_list">
                        
                    </div>
                </div>
            </div>
            
            
            <div id="panel_event">
                    
            </div>
            
            <div id="login">
                <div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="true"></div>
            </div>
        <div class="clear"></div>
    </div>
    </body>


    
</html>