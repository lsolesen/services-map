<?php
/**
 *
 *
 * Make sure that a body tag is present on the page you are trying to write
 * a map. Otherwise you will get a javascript error from the google map javascript.
 */

require_once 'Services/Map/Writer.php';

class Services_Map_Writer_Microformat extends Services_Map_Writer
{
    /**
     * Returns the necessary javascript for the Google Map
     *
     * @return string
     */
    public function getServiceJS()
    {
        return '';
    }

    /**
     * Returns the necessary javascript to intiate a map
     *
     * @return string
     */
    public function getInitJS()
    {
        $output = '';
        return $output;
    }

    /**
     * Returns the Google Map
     *
     * @return string
     */
    public function getHtmlMap(){

        $output  = '<div id="'.$this->map_id.'" style="width: '.$this->getOption('width').'px; height: '.$this->getOption('height').'px">';
        $output .= $this->addMarkersToMap();
        $output .= '</div>';
        return $output;
    }

    /**
     * Returns the html for a marker
     *
     * @param integer $g      Just a mean so two markers wont get the same id
     * @param object  $marker A marker object
     *
     * @return string
     */
    public function getMarkerMarkup($g, $marker)
    {
        $output  = '<div class="geo"><span class="latitude">'.$marker->latitude.'</span><span class="longitude">'.$marker->longitude.'</span></div>';

        return $output;
    }
}
?>