<html>
    <head>
        <link rel="stylesheet" href="css/style.css" />
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYMaScAZ6rluB4cgD__IZkIWMMIMxJFZ0&sensor=true&libraries=places">
        </script>
        <script src="js/infobox_packed.js"></script>
        <script src="js/map.js"></script>
        
    </head> 
    
    

    <body>
        <script type='text/javascript'>
            
            $( document ).ready(function() {
                $("#map").map();
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
            <div id="panel">
                <div class="fb-login-button" data-max-rows="5" data-size="xlarge" data-show-faces="true" data-auto-logout-link="true"></div>
                <select>
                    <option value ="popularity" <?php if(!$user_id): ?> selected="true" <?php endif; ?> >Popularność</option>
                    <option value ="date">Data</option>
                    <option value ="nearest">Najbliższe</option>
                    <?php if($user_id > 0): ?>
                        <option value ="match" selected="true">Dopasowane</option>
                    <?php endif; ?>
                </select>
            </div>
        <div class="clear"></div>
    </div>
    </body>


    
</html>