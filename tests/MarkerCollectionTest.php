<?php
require_once 'PHPUnit/Framework.php';
require_once 'Services/Map/MarkerCollection.php';
require_once 'Services/Map/Marker.php';

class MarkerCollectionTest extends PHPUnit_FrameWork_TestCase {

    function testCountReturnZeroWhenMarkerCollectionIsEmpty()
    {
        $collection = new MarkerCollection();
        $this->assertEquals(0, $collection->count());
    }

    function testCountReturnCanCountTheMarkers()
    {
        $collection = new MarkerCollection();
        $collection->add(new Marker(1, 1));
        $this->assertEquals(1, $collection->count());
    }

    function testIterator()
    {
        $collection = new MarkerCollection();
        $collection->add(new Marker(1, 1));
        $collection->add(new Marker(2, 2));
        $collection->add(new Marker(3, 3));

        $this->assertEquals(3, $collection->count());
        $this->assertFalse($collection->isDone());

        $this->assertEquals(get_class($first = $collection->current()), 'Marker');
        $this->assertEquals($first->latitude, 1);
        $this->assertFalse($collection->isDone());

        $this->assertTrue($collection->next());
        $this->assertEquals(get_class($second = $collection->current()), 'Marker');
        $this->assertEquals($second->latitude, 2);
        $this->assertFalse($collection->isDone());

        $this->assertTrue($collection->next());
        $this->assertEquals(get_class($third = $collection->current()), 'Marker');
        $this->assertEquals($third->latitude, 3);
        $this->assertFalse($collection->next());
        $this->assertTrue($collection->isDone());


    }

    function testIteratorUsage()
    {
        $output = '';
        $collection = new MarkerCollection();
        $collection->add(new Marker(1, 1));
        $collection->add(new Marker(2, 2));
        $collection->add(new Marker(3, 3));

       for ($collection; !$collection->isDone(); $collection->next()) {
            $marker = $collection->current();
            $output .= $marker->latitude;
        }
        $this->assertEquals(123, $output);
    }

}
?>