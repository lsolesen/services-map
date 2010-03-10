<?php

/**
 * PHP API for the Google Maps API
 *
 * PHP version 5
 *
 * LICENSE: This library is free software; you can redistribute it
 * and/or modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301 USA.
 *
 * @category   Services
 * @package    Services_GoogleMaps
 * @author     Daniel Khan <d.khan@ventigo.com>
 * @author     Markus Tacker <m@tacker.org>
 * @author     Mark Wiesemann <wiesemann@php.net>
 * @copyright  2006-2007 Daniel Khan, Markus Tacker, Mark Wiesemann
 * @license    http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @version    CVS: $Id:$
 * @link       http://pear.php.net/package/Services_GoogleMaps
 */

/**
 * The main class. Provides the factory method to create all other Google Maps
 * objects.
 *
 * @category   Services
 * @package    Services_GoogleMaps
 * @author     Daniel Khan <d.khan@ventigo.com>
 * @author     Markus Tacker <m@tacker.org>
 * @author     Mark Wiesemann <wiesemann@php.net>
 * @copyright  2006-2007 Daniel Khan, Markus Tacker, Mark Wiesemann
 * @license    http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @version    Release: 0.0.2
 * @link       http://pear.php.net/package/Services_GoogleMaps
 */
class Services_GoogleMaps
{
    /**
     * The API URL
     *
     * @var string
     */
    protected $apiUrl = 'http://maps.google.com/maps';

    /**
     * The API file
     *
     * @var string
     */
    protected $apiFile = 'api';

    /**
     * The API version
     *
     * Defaults to '2'. For new features '2.x' needs to be used.
     *
     * @var string
     */
    protected $apiVersion = '2';

    /**
     * The domain specific API key from Google
     *
     * @var string
     */
    protected $apiKey = null;

    /**
     * The ID of the HTML element and the name of the container JavaScript
     * variable (e.g. 'map' or 'country')
     *
     * @var string
     */
    protected $container = 'map';

    /**
     * Array to hold the generated JavaScript code
     *
     * @var array
     */
    protected $javaScriptStack = array();

    /**
     * Constructor
     *
     * @param  string  $container   ID of the HTML element and the name of the
     *                              container JavaScript variable
     * @param  string  $apiKey      Domain specific API key from Google
     * @param  string  $apiVersion  API version (default: '2', new features: '2.x')
     * @param  string  $apiUrl      API URL
     * @param  string  $apiFile     API file
     */
    public function __construct($container = false, $apiKey = false,
        $apiVersion = false, $apiUrl = false, $apiFile = false)
    {
        if ($container) {
            $this->container = $container;
        }
        if ($apiKey) {
            $this->apiKey = $apiKey;
        }
        if ($apiUrl) {
            $this->apiUrl = $apiUrl;
        }
        if ($apiFile) {
            $this->apiFile = $apiFile;
        }
        if ($apiVersion) {
            $this->apiVersion = $apiVersion;
        }

        $this->constructJavaScript();
    }

    /**
     * Enable the dragging of the map (enabled by default)
     */
    public function enableDragging()
    {
        $js = sprintf('%s.enableDragging();', $this->container);
        $this->javaScriptStack[] = $js;
    }

    /**
     * Disable the dragging of the map
     */
    public function disableDragging()
    {
        $js = sprintf('%s.disableDragging();', $this->container);
        $this->javaScriptStack[] = $js;
    }

    /**
     * Enables the popup info windows on the map (enabled by default)
     */
    public function enableInfoWindow()
    {
        $js = sprintf('%s.enableInfoWindow();', $this->container);
        $this->javaScriptStack[] = $js;
    }

    /**
     * Disables (and closes) the popup info windows on the map
     */
    public function disableInfoWindow()
    {
        $js = sprintf('%s.disableInfoWindow();', $this->container);
        $this->javaScriptStack[] = $js;
    }

    /**
     * Adds the given map control to this map
     *
     * Example: $map->addControl('GSmallMapControl');
     *
     * @param  string  $control  Google Maps control name
     */
    public function addControl($control)
    {
        $js = sprintf('%s.addControl(new %s());', $this->container, $control);
        $this->javaScriptStack[] = $js;
    }

    /**
     * Adds an info window to a marker on the map
     *
     * This method needs to be called after the addOverlay() call for the
     * marker.
     *
     * @param  Object::Services_GoogleMaps_GMartk  $latlng    GMarker object
     * @param  string                              $contents  Contents for the
     *                                                        info window
     */
    public function addMarkerInfoWindow($marker, $contents)
    {
        $js = sprintf('%s.openInfoWindowHtml("%s");',
                      $marker->getVarName(),
                      $contents);
        $this->javaScriptStack[] = $js;
    }

    /**
     * Creates a GPoint (factory)
     *
     * A GPoint represents a point on the map by its pixel coordinates.
     *
     * @param  float  $x  The x coordinate
     * @param  float  $y  The y coordinate
     * @return Object::Services_GoogleMaps_GPoint
     */
    public function createGPoint($x, $y)
    {
        $this->loadClass('GPoint');
        $point = new Services_GoogleMaps_GPoint($x, $y);
        return $point;
    }

    /**
     * Creates a GLatLng (factory)
     *
     * A GLatLng is a point in geographical coordinates longitude and latitude.
     *
     * @param  float  $y  Latitude coordinate in decimal notation
     * @param  float  $x  Longitude coordinate in decimal notation
     * @return Object::Services_GoogleMaps_GLatLng
     */
    public function createGLatLng($lat, $lng)
    {
        $this->loadClass('GLatLng');
        $latlng = new Services_GoogleMaps_GLatLng($lat, $lng);
        return $latlng;
    }

    /**
     * Creates a GLatLng (factory)
     *
     * A GLatLng is a point in geographical coordinates longitude and latitude.
     *
     * @param  float  $y  Latitude coordinate in decimal notation
     * @param  float  $x  Longitude coordinate in decimal notation
     * @return Object::Services_GoogleMaps_GLatLng
     */
    public function createGLatLngFromAddress($address)
    {
        $this->loadClass('Geocoder');
        $this->loadClass('GLatLng');
        $geocoder = new Services_GoogleMaps_Geocoder($this->apiKey, $this->apiUrl);
        return $geocoder->getLatLngForAddress($address);
    }

    /**
     * Creates a GMarker (factory)
     *
     * Creates a marker with the given icon at the given coordinates (GLatLng).
     * If no icon is given, the default Google Maps icon will be used.
     *
     * @param  Object::Services_GoogleMaps_GLatLng  $latlng  GLatLng object
     * @param  Object::Services_GoogleMaps_GIcon    $icon    (optional) GIcon
     * @return Object::Services_GoogleMaps_GMarker
     */
    public function createGMarker($latlng, $icon = false)
    {
        $this->loadClass('GMarker');

        if (!$latlng->getVarName()) {
            $this->javaScriptStack[] = $latlng->getCode();
        }

        $iconVarName   = '';
        $latLngVarName = $latlng->getVarName();

        if ($icon) {
            if (!$icon->getVarName()) {
                $this->javaScriptStack[] = $icon->getCode();
            }
            $iconVarName = $icon->getVarName();
        }

        $marker = new Services_GoogleMaps_GMarker($latLngVarName, $iconVarName);
        return $marker;
    }

    /**
     * Creates a GIcon (factory)
     *
     * @param  Object::Services_GoogleMaps_GIcon  $copy  A GIcon object from
     *                                                   which the properties
     *                                                   should be copied
     * @return Object::Services_GoogleMaps_GIcon
     */
    public function createGIcon($copy = null)
    {
        $this->loadClass('GIcon');
        $icon = new Services_GoogleMaps_GIcon($copy);
        return $icon;
    }

    /**
     * Creates a GSize (factory)
     *
     * A GSize is the size in pixels of a rectangular area of the map.
     *
     * @param  float  $width   The width in pixels
     * @param  float  $height  The height in pixels
     * @return Object::Services_GoogleMaps_GSize
     */
    public function createGSize($width, $height)
    {
        $this->loadClass('GSize');
        $size = new Services_GoogleMaps_GSize($width, $height);
        return $size;
    }

    /**
     * Centers the map to a given point (GLatLng). The zoom level and the type
     * of the map can also be specified.
     *
     * @param  Object::Services_GoogleMaps_GLatLng  $latlng     GLatLng object
     * @param  integer                              $zoomLevel  The zoom level
     * @param  string                               $mapType    The type of the map
     */
    public function setCenter($latlng, $zoomLevel = 11, $mapType = 'G_NORMAL_MAP')
    {
        if (!$latlng->getVarName()) {
            $this->javaScriptStack[] = $latlng->getCode();
        }
        $js = sprintf('%s.setCenter(%s, %s, %s);',
                      $this->container,
                      $latlng->getVarName(),
                      $zoomLevel,
                      $mapType);
        $this->javaScriptStack[] = $js;
    }

    /**
     * Adds the given overlay object to the map
     *
     * @param  Object::Services_GoogleMaps_GMarker  $overlay  GMarker object
     */
    public function addOverlay($overlay)
    {
        if (!$overlay->getVarName()) {
            $this->javaScriptStack[] = $overlay->getCode();
        }
        $js = sprintf('%s.addOverlay(%s);',
                      $this->container,
                      $overlay->getVarName());
        $this->javaScriptStack[] = $js;
    }

    /**
     * Returns the javascript code needed for the <head> section of the page
     *
     * @param   string  $indent    (optional) Tabs or spaces used for indenting
     *                             all generated lines
     * @return  string
     */
    public function getCode($indent = '')
    {
        $javaScriptStack = implode("\n", $this->javaScriptStack);
        $javaScriptStack = str_replace("\n", "\n      ", $javaScriptStack);
        $script = '<script src="%s?file=%s&v=%s&key=%s" type="text/javascript">' . "\n"
                . '</script>' . "\n"
                . '<script type="text/javascript">' . "\n"
                . '//<![CDATA[' . "\n"
                . '  function load() {' . "\n"
                . '    if (GBrowserIsCompatible()) {' . "\n"
                . '      %s' . "\n"
                . '    }' . "\n"
                . '  }' . "\n"
                . '//]]>' . "\n"
                . '</script>' . "\n";
        $js = sprintf($script,
                      $this->apiUrl,
                      $this->apiFile,
                      $this->apiVersion,
                      $this->apiKey,
                      $javaScriptStack);
        $js = rtrim($indent . str_replace("\n", "\n" . $indent, $js), "\t ");
        return $js;
    }

    /**
     * Returns the attributes needed for the <body> tag
     *
     * @return string
     */
    static public function getBodyAttributes()
    {
        return 'onload="load()" onunload="GUnload()"';
    }

    /**
     * Constructs the JavaScript for the GMap2 JavaScript class
     */
    protected function constructJavaScript()
    {
        $js = sprintf('var %s = new GMap2(document.getElementById("%s"));',
                      $this->container,
                      $this->container);
        $this->javaScriptStack[] = $js;
    }

    /**
     * Loads a class
     *
     * @param  string  $class  The name of the class
     */
    protected function loadClass($class)
    {
        $classname = 'Services_GoogleMaps_' . $class;
        if (!class_exists($classname)) {
            $classpath = 'Services/GoogleMaps/' . $class . '.php';
            if (!file_exists($classpath) || !$class) {
                throw new Services_GoogleMaps_Exception("Could not open class file for $classname.");
            }
            include_once $classpath;
        }
    }

}

?>