<?php

error_reporting(E_ALL);

require_once 'Services/GoogleMaps.php';

// the API key obtained from Google (needs to be replaced by *your* key!)
$key = 'ABQIAAAA-EoixwdCeZlxh-XwyUJPWxSfw0f8w5DXeNB0WsbIuiMVKGsZFxQ2ySrwjYFzG1anzQmrKZbkjJvCkQ';

// initialize the Google Maps class
$airport = new Services_GoogleMaps('airport', $key, null, null, null, 100, 100);

// add a control for zooming and panning
$airport->addControl('GLargeMapControl');

// add a a control for switching the map type
$airport->addControl('GMapTypeControl');

// create a point using Google's Geocoder: Frankfurt Airport (FRA)
$address = 'Hugo-Eckener-Ring, 60547 Frankfurt/Main, Germany';
$laglng = $airport->createGLatLngFromAddress($address);

// instead of the Geocoder call from above, we could simply use the following
// line if we already know the coordinates:
//   $laglng = $airport->createGLatLng(50.053082, 8.581121);

// center and zoom on the airport, switch to the hybrid map view
$airport->setCenter($laglng, 10, 'G_HYBRID_MAP');

// create an icon and set some properties
$icon = $airport->createGIcon();
$icon->image            = 'http://www.google.com/mapfiles/markerF.png';
$icon->shadow           = 'http://www.google.com/mapfiles/shadow50.png';
$icon->iconSize         = $airport->createGSize(20, 34);
$icon->shadowSize       = $airport->createGSize(37, 34);
$icon->iconAnchor       = $airport->createGPoint(9, 34);
$icon->infoWindowAnchor = $airport->createGPoint(9, 2);
$icon->infoShadowAnchor = $airport->createGPoint(18, 25);

// create a marker for our GLatLng object with the created $icon
$marker = $airport->createGMarker($laglng, $icon);

// add the marker to the map
$airport->addOverlay($marker);

// attach an info window with the airport's address to the marker
$airport->addMarkerInfoWindow($marker, '<b>Frankfurt Airport (FRA)</b><br />Hugo-Eckener-Ring<br />60547 Frankfurt/Main<br />Germany');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
  <head>
    <style type="text/css">
      body {
        margin-left: 10px;
        font-family: Arial,sans-serif;
        font-size: small;
      }
    </style>
<?php
echo $airport->getCode('    ');
?>
  </head>
  <title>GMap example</title>
  <body <?php echo $airport->getBodyAttributes(); ?>>
    <h1>Frankfurt Airport (FRA)</h1>
    <p>This is an example page for Services_GoogleMaps, showing the largest airport in Germany.</p>
    <div id="airport" style="width: 500px; height: 400px"></div>
  </body>
</html>
