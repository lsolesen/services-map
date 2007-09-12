<?php
require_once 'PHPUnit/Framework.php';
require_once 'Services/Map/MarkerCollection.php';
require_once 'Services/Map/Marker.php';

class MapTest extends PHPUnit_FrameWork_TestCase {

    function testConstruction()
    {
        $map = new Services_Map();
        $this->assertTrue(is_object($map));
    }

    function testAddMarker()
    {

    }

}
?>