<?php

class Marker
{
    public $longitude;
    public $latitude;

    function __construct($latitude, $longitude, $msg = '', $address = '')
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->msg = $msg;
        $this->address = $address;

    }

    function isValid()
    {
        return true;
    }

}

?>