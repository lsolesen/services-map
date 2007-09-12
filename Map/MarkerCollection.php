<?php
class MarkerCollection
{
    protected $_markers = array();

    function add(Marker $marker)
    {
        $this->_markers[] = $marker;
    }

    function reset()
    {
        reset($this->_markers);
    }

    function first()
    {
        reset($this->_markers);
    }

    function count()
    {
        return count($this->_markers);
    }

    function next()
    {
        return (false !== next($this->_markers));
    }

    function current()
    {
        return current($this->_markers);
    }

    function isDone()
    {
        return (false === current($this->_markers));
    }
}
?>