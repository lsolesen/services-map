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
 * GMarker class. A GMarker marks a position on the map.
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
class Services_GoogleMaps_GMarker extends Services_GoogleMaps_Common
{
    /**
     * The GLatLng object with the latitude and longitude coordinates for the
     * marker
     *
     * @var Object::Services_GoogleMaps_GLatLng
     */
    protected $latlng = false;

    /**
     * The icon (GIcon object) for the marker. If no icon is given, the
     * default Google Maps icon will be used.
     *
     * @var Object::Services_GoogleMaps_GIcon
     */
    protected $icon = false;

    /**
     * Constructor
     *
     * @param  Object::Services_GoogleMaps_GLatLng  $latlng  GLatLng object
     * @param  Object::Services_GoogleMaps_GIcon    $icon    GIcon object (opt.)
     */
    public function __construct($latlng, $icon = false)
    {
        parent::__construct();
        $this->latlng = $latlng;
        if ($icon) {
            $this->icon = $icon;
        }
    }

    /**
     * Returns the JavaScript code for this class
     *
     * @return string
     */
    public function getCode()
    {
        parent::getCode();
        if ($this->icon) {
            $js = sprintf('var %s = new GMarker(%s, %s);',
                          $this->getVarName(),
                          $this->latlng,
                          $this->icon);
        } else {
            $js = sprintf('var %s = new GMarker(%s);',
                          $this->getVarName(),
                          $this->latlng);
        }
        return $js;
    }

}

?>