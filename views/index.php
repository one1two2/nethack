<html>
    <head>
        <link rel="stylesheet" href="css/style.css" />
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="js/map.js"></script>
        <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYMaScAZ6rluB4cgD__IZkIWMMIMxJFZ0&sensor=true">
        </script>
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


        <div id="map">

        </div>
        <div id="panel">
            <div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="true"></div>
        </div>
        <div class="clear"></div>
    </div>
    </body>


    
</html>