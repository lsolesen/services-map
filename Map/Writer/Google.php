<?php
/**
 *
 *
 * Make sure that a body tag is present on the page you are trying to write
 * a map. Otherwise you will get a javascript error from the google map javascript.
 */

require_once 'Services/Map/Writer.php';

class Services_Map_Writer_Google extends Services_Map_Writer
{
    /**
     * Returns the necessary javascript for the Google Map
     *
     * @return string
     */
    public function getServiceJS()
    {
        return '<script src="http://maps.google.com/maps?file=api&v=2&key='.$this->api_key.'" type="text/javascript"></script>';
    }

    /**
     * Returns the necessary javascript to intiate a map
     *
     * @return string
     */
    public function getInitJS()
    {
        $output = '
            <script type="text/javascript">
                //<![CDATA[
                function load() {
                    if (GBrowserIsCompatible()) {
                        var gmap = new GMap2(document.getElementById("'. $this->map_id . '"));
                        gmap.setCenter(new GLatLng('.$this->getOption('center_long').', '.$this->getOption('center_lat').'), ' . $this->getOption('zoom_level') . ');
                        ' .$this->addMarkersToMap(). '
                    }
                }
                //]]>
            </script>';
        return $output;
    }

    /**
     * Returns the Google Map
     *
     * @return string
     */
    public function getHtmlMap(){

        $output  = '<div id="'.$this->map_id.'" style="width: '.$this->getOption('width').'px; height: '.$this->getOption('height').'px"></div>';
        $output .= $this->getInitJS();
        return $output;
    }

    /**
     * Returns the javascript necessary for one marker
     *
     * @param integer $g      Just a mean so two markers wont get the same id
     * @param object  $marker A marker object
     *
     * @return string
     */
    public function getMarkerMarkup($g, $marker)
    {
        $output  = 'var gpoint'.$g.' = new GLatLng('.$marker->latitude.','.$marker->longitude.');
                    var gmarker'.$g.' = new GMarker(gpoint'.$g.');
                    gmap.addOverlay(gmarker'.$g.');';

        return $output;
    }
}
?>