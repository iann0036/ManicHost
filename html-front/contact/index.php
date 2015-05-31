<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manic Host</title>
    <link rel="shortcut icon" href="/images/icons/favicon.png" />
    <link href='http://fonts.googleapis.com/css?family=Hind:400,300,600,500,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Bootstrap & Styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/bootstrap-theme.css" rel="stylesheet">
    <link href="/css/block_grid_bootstrap.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/owl.carousel.css" rel="stylesheet">
    <link href="/css/owl.theme.css" rel="stylesheet">
    <link href="/css/animate.min.css" rel="stylesheet" />
    <link href="/css/jquery.circliful.css" rel="stylesheet" />
    <link href="/css/slicknav.css" rel="stylesheet" />
    <link href="/style.css" rel="stylesheet">

</head>

<body>

<div class="top">
    <div class="row">
        <div class="col-sm-3">
            <div class="logo">
                <a href="/"><img src="/images/logo.png" alt="" />
                </a>
            </div>
        </div>
        <div class="col-sm-9">
            <nav id="desktop-menu">
                <ul class="sf-menu" id="navigation">
                    <li><a href="/">Home</a>
                    </li>
                    <li><a href="#">Hosting</a>
                        <ul>
                            <li><a href="/hosting/shared/">Shared Hosting</a>
                            </li>
                            <li><a href="/hosting/vps/">SSD VPS</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="/domains/">Domains</a>
                    </li>
                    <li><a href="#">Extras</a>
                        <ul>
                            <li><a href="/extras/ssl/">SSL</a>
                            </li>
                            <li><a href="/extras/email/">E-mail</a>
                            </li>
                        </ul>
                    </li>
                    <li class="current"><a href="/contact/">Contact</a>
                    </li>
                    <li><a href="http://my.manic.host/"><b>Login</b></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Breadcrumps -->
<div class="breadcrumbs">
    <div class="row">
        <div class="col-sm-6">
            <h1>Contact</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb">
                <li>You are here: </li>
                <li><a href="/">Home</a>
                </li>
                <li class="active">Contact</li>
            </ol>
        </div>
    </div>
</div>
<!-- End of Breadcrumps -->

<!-- Contact -->
<div id="map_wrapper">
    <div id="map_canvas" class="mapping"></div>
</div>

<section class="contact">
    <div class="row">
        <div class="col-sm-8">
            <h3>Contact us</h3>
            <div id="sendstatus"></div>
            <div id="contactform">



                <form method="post" action="/sendmail.php">

                    <p><label for="name">Name:*</label> <input type="text" class="form-control" name="name" id="name" tabindex="1" /></p>
                    <p><label for="email">Email:*</label> <input type="text" class="form-control" name="email" id="email" tabindex="2" /></p>
                    <p><label for="comments">Message:*</label> <textarea  class="form-control" name="comments" id="comments" cols="12" rows="6" tabindex="3"></textarea></p>
                    <p><input name="submit" type="submit" id="submit" class="submit" value="Send" tabindex="4" /></p>

                </form>
            </div>
        </div>

        <div class="col-sm-3 col-sm-offset-1">
            <h4 class="badge">E-mail</h4>
            <p><a href="mailto:contact@manic.host">contact@manic.host</a></p>
            <h4 class="badge">On the Web</h4>
            <ul>
                <li><a href="http://www.facebook.com/ManicHost">Facebook</a></li>
                <li><a href="http://www.twitter.com/ManicDotHost">Twitter</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- End of Contact  -->

<!--  Footer -->
<div class="social">
    <div class="row">

        <div class="col-sm-6">
            <ul>
                <li><a href="http://www.facebook.com/ManicHost" title="facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                </li>
                <li><a href="http://www.twitter.com/ManicDotHost" title="twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                </li>
                <!--<li><a href="#" title="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>
                </li>
                <li><a href="#" title="rss" target="_blank"><i class="fa fa-rss"></i></a>
                </li>
                <li><a href="#" title="instagram" target="_blank"><i class="fa fa-instagram"></i></a>
                </li>
                <li><a href="#" title="github" target="_blank"><i class="fa fa-github"></i></a>
                </li>-->
            </ul>
        </div>

        <div class="col-sm-6">

            <div id="mc_embed_signup">
                <form class="form-inline validate" action="//host.us10.list-manage.com/subscribe/post?u=a8a5f270c08579e5abc9a6e04&amp;id=df16fc28d8" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" novalidate>
                    <div class="row no-gutter">
                        <div class="col-sm-9">
                            <input type="email" value="" name="EMAIL" class="form-control" id="mce-EMAIL" placeholder="Subscribe to our newsletter" required>
                            <div style="position: absolute; left: -5000px;">
                                <input type="text" name="b_a8a5f270c08579e5abc9a6e04_df16fc28d8" tabindex="-1" value="">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <input type="submit" value="SUBSCRIBE" name="subscribe" id="mc-embedded-subscribe">
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<section class="footer">
    <div class="row">
        <div class="col-sm-3">
            <h4>Choose.</h4>
            <ul>
                <li><a href="/hosting/shared/">Shared Hosting</a>
                </li>
                <li><a href="/hosting/vps/">SSD VPS</a>
                </li>
                <li><a href="/domains/">Domain Names</a>
                </li
            </ul>
        </div>
        <div class="col-sm-3">
            <h4>Add-on.</h4>
            <ul>
                <li><a href="/extras/ssl/">SSL Certificates</a>
                </li>
                <li><a href="/extras/email/">Hosted E-mail</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-3">
            <h4>Start.</h4>
            <ul>
                <li><a href="/hosting/wordpress/">WordPress Hosting</a>
                </li>
                <li><a href="/hosting/joomla/">Joomla Hosting</a>
                </li>
                <li><a href="/hosting/drupal/">Drupal Hosting</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-3">
            <h4>Ask.</h4>
            <ul class="questions">
                <li><a href="mailto:contact@manic.host"><i class="fa fa-envelope"></i> E-MAIL US</a>
                </li>
            </ul>
        </div>
    </div>
</section>

<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/contact-script.js"></script>
<script src="/js/hoverIntent.js"></script>
<script src="/js/superfish.min.js"></script>
<script src="/js/owl.carousel.js"></script>
<script src="/js/wow.min.js"></script>
<script src="/js/jquery.circliful.min.js"></script>
<script src="/js/waypoints.min.js"></script>
<script src="/js/jquery.slicknav.min.js"></script>
<script src="/js/custom.js"></script>
<script>
    jQuery(function($) {
        // Asynchronously Load the map API
        var script = document.createElement('script');
        script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
        document.body.appendChild(script);
    });

    function initialize() {
        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap',
            scrollwheel: false,
            draggable: false,
            styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#c6eee7"},{"visibility":"on"}]}]
        };

        // Display a map on the page
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        map.setTilt(45);

        // Multiple Markers
        var markers = [
            ['Manic Host, Wollongong, NSW, Australia', -34.403221, 150.898086],
        ];

        // Info Window Content
        var infoWindowContent = [
            ['<div class="info_content">' +
            '<h5>Manic Host, Wollongong, NSW, Australia</h5>' +
            '<p>Search and buy domains, hosting and more from a huge inventory of premium services. Give your brand some class - join Manic Host today!</p>' +        '</div>']
        ];

        // Display multiple markers on a map
        var infoWindow = new google.maps.InfoWindow(), marker, i;

        // Loop through our array of markers & place each one on the map
        for( i = 0; i < markers.length; i++ ) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0]
            });

            // Allow each marker to have an info window
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));

            // Automatically center the map fitting all markers on the screen
            map.fitBounds(bounds);
        }

        // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(12);
            google.maps.event.removeListener(boundsListener);
        });

    }
</script>

</body>

</html>