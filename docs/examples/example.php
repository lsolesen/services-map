<body>
<?php
/**
 * This is just a starting point for creating the maps. The basic idea is to
 * have a generic class called map, which holds all information about a map.
 *
 * We can then use this generic class and feed it to a writer (renderer) which knows
 * how to output one of our maps.
 *
 *
 */


require 'Services/Map.php';
require 'Services/Map/Writer.php';


$map = new Services_Map();
$map->addMarker('Testmarker', 37.4419, -122.1419);
$map->addMarker('Testmarker 2', 37.4519, -122.1519);

echo '<h2>Google</h2>';
$writer = Services_Map_Writer::factory('google', 'ABQIAAAAUFgD-PSpsw5MDGYzf-NyqBT5Xij7PtUjdkWMhSxoVKuMOjPcWxR5Rf13LT-bMD4Iiu_tpJ5XdRMJ3g', 'google', $map->getCollection());
echo $writer->getServiceJS();
echo $writer->getHtmlMap();

echo '<h2>Yahoo</h2>';
$writer = Services_Map_Writer::factory('yahoo', 'Lzt5xE7V34G7KwQ.qc5q3UMDH8IJpQgV41Pf7ygYKWXR8tm1ACz1ZdTzVfmu37piQqlp', 'yahoo', $map->getCollection());
echo $writer->getServiceJS();
echo $writer->getHtmlMap();


echo '<h2>Microformat</h2>';
$writer = Services_Map_Writer::factory('microformat', '', 'microformat', $map->getCollection());
echo $writer->getHtmlMap();

//include 'Intraface/cronjob/email_batch.php';
?>


<script>load()</script>
</body>