<?php
/**
 * Thinking about having a map marked up with either microformats, georss, or kml,
 * and the adding stuff to a map this way.
 *
 * Could be cool if we could achieve a totally accessible map writer service.
 *
 */

require_once 'Services/Map/Marker.php';
require_once 'Services/Map/MarkerCollection.php';

class Services_Map
{
    private $collection;

    function __construct()
    {
        $this->collection = new MarkerCollection;
    }

    function addMarker($text, $latitude, $longitude)
    {
        $this->collection->add(new Marker($latitude, $longitude));
    }

    function getCollection()
    {
        return $this->collection;
    }
}
?>