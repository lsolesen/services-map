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
 * GLatLng class. A GLatLng is a point in geographical coordinates longitude
 * and latitude.
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
class Services_GoogleMaps_GLatLng extends Services_GoogleMaps_Common
{
    /**
     * Latitude coordinate in decimal notation
     *
     * @var float
     */
    protected $lat = 0;

    /**
     * Longitude coordinate in decimal notation
     *
     * @var float
     */
    protected $lng = 0;

    /**
     * Constructor
     *
     * @param  float  $lat  Latitude coordinate in decimal notation
     * @param  float  $lng  Longitude coordinate in decimal notation
     */
    public function __construct($lat, $lng)
    {
        parent::__construct();
        $this->lat = number_format($lat, 6, '.', '');
        $this->lng = number_format($lng, 6, '.', '');
    }

    /**
     * Returns the JavaScript code for this class
     *
     * @return string
     */
    public function getCode()
    {
        parent::getCode();
        $js = sprintf('var %s = new GLatLng(%s, %s);',
                      $this->getVarName(),
                      $this->lat,
                      $this->lng);
        return $js;
    }
}

?>