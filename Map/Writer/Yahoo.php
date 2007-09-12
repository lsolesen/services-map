<?php
/**
 *
 *
 * Make sure that a body tag is present on the page you are trying to write
 * a map. Otherwise you will get a javascript error from the google map javascript.
 */

require_once 'Services/Map/Writer.php';

class Services_Map_Writer_Yahoo extends Services_Map_Writer
{
    /**
     * Returns the necessary Javascript for the Yahoo Map to work.
     * Should be outputted in the head of your HTML document.
     *
     * @return string
     */
    public function getServiceJS()
    {
        return '<script type="text/javascript" src="http://api.maps.yahoo.com/ajaxymap?v=3.0&appid='.$this->api_key.'"></script>';
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
                var centerPoint = new YGeoPoint('.$this->getOption('center_long').', '.$this->getOption('center_lat').');
                var ymap = new YMap(document.getElementById("'.$this->map_id.'"));
                ymap.drawZoomAndCenter(centerPoint, '.$this->getOption('zoom_level').');
                ymap.setMapType(YAHOO_MAP_REG);
                ' .$this->addMarkersToMap(). '
            </script>';
        return $output;
    }

    /**
     * Returns the map
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
        $output  = 'var ymarker'.$g.' = new YMarker(new YGeoPoint('.$marker->latitude.','.$marker->longitude.'));
                    ymap.addOverlay(ymarker'.$g.');';

        return $output;
    }
}
?>