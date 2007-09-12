<?php
/**
 *
 *
 * Make sure that a body tag is present on the page you are trying to write
 * a map. Otherwise you will get a javascript error from the google map javascript.
 */

abstract class Services_Map_Writer
{
    private $options = array(
                'width'       => 500,
                'height'      => 300,
                'zoom_level'  => 13,
                'center_long' => 37.4419,
                'center_lat'  => -122.1419
            );
    private $marker_collection;
    public  $api_key;
    public  $map_id;

   /**
     * Constructor
     *
     * @param string $api_key           The api key provided by the service
     * @param string $map_id            The id for the individual maps
     * @param object $marker_collection A collection of markers to put on the site
     *
     * @return void
     */
    public function __construct($api_key, $map_id = 'map', $marker_collection = null)
    {
        $this->api_key = $api_key;
        $this->map_id = $map_id;
        $this->marker_collection = $marker_collection;
    }

    /**
     * Creates the appropriate writer
     *
     * @param string $provider          The key to be set
     * @param string $api_key           The api key provided by the service
     * @param string $map_id            The id for the individual maps
     * @param object $marker_collection A collection of markers to put on the site
     *
     * @return object
     */
    public function factory($provider, $api_key, $map_id, $collection = null)
    {
        require_once dirname(__FILE__) . '/Writer/' . ucfirst(strtolower($provider)) . '.php';
        $class = 'Services_Map_Writer_' . ucfirst(strtolower($provider));
        return new $class($api_key, $map_id, $collection);
    }

    /**
     * Sets the option for a given key
     *
     * @param string $key   The key to be set
     * @param string $value The value for the key
     *
     * @return void
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
    }

    /**
     * Returns the option for a given key
     *
     * @param string $key The option key to return
     *
     * @return string
     */
    public function getOption($key)
    {
        return $this->options[$key];
    }

    /**
     * Should return the necessary javascript for the service to work
     *
     * @return string
     */
    abstract public function getServiceJS();

    /**
     * Should return the javascript which initiates the single maps
     *
     * @return string
     */
    abstract public function getInitJS();

    /**
     * Should return the map from the provider
     *
     * @return string
     */
    abstract public function getHtmlMap();

    /**
     * Adds the markers to the map
     *
     * @return string
     */
    public function addMarkersToMap()
    {
        if ($this->marker_collection === null) return;
        $g = 0;
        $output = '';
        for ($collection = $this->marker_collection, $collection->reset(); !$collection->isDone(); $collection->next()) {
            $output .= $this->getMarkerMarkup($g, $collection->current());
            $g++;
        }
        return $output;
    }

    /**
     * Should return the javascript necessary for one marker
     *
     * @param integer $g      Just a mean so two markers wont get the same id
     * @param object  $marker A marker object
     *
     * @return string
     */
    abstract public function getMarkerMarkup($g, $marker);
}
?>