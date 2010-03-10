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

require_once 'Services/GoogleMaps/Common.php';

/**
 * GSize class. A GSize is the size in pixels of a rectangular area of the map.
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
class Services_GoogleMaps_Geocoder
{
    /**
     * The domain specific API key from Google
     *
     * @var string
     */
    protected $apiKey = null;

    /**
     * The API URL
     *
     * @var string
     */
    protected $apiUrl = null;

    /**
     * The Geocoder API file
     *
     * @var string
     */
    protected $apiFile = 'geo';

    /**
     * Constructor
     *
     * @param  string  $apiKey   Domain specific API key from Google
     * @param  string  $apiUrl   API URL
     * @param  string  $apiFile  API file
     */
    public function __construct($apiKey, $apiUrl, $apiFile = false)
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
        if ($apiFile) {
            $this->apiFile = $apiFile;
        }
    }

    /**
     * Returns the JavaScript code for this class
     *
     * @return string
     */
    public function getLatLngForAddress($address)
    {
        // TODO: this method needs some error checks
        $url = $this->apiUrl . '/' . $this->apiFile
             . '?q=' . urlencode($address)
             . '&output=json'
             . '&key=' . $this->apiKey;
        $file = file_get_contents($url);
        $json = json_decode(utf8_decode($file), true);
        return new Services_GoogleMaps_GLatLng(
            $json['Placemark'][0]['Point']['coordinates'][1],
            $json['Placemark'][0]['Point']['coordinates'][0]);

    }

}

?>