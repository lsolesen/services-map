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
 * GPoint class. A GPoint represents a point on the map by its pixel
 * coordinates.
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
class Services_GoogleMaps_GPoint extends Services_GoogleMaps_Common
{
    /**
     * The x coordinate
     *
     * @var float
     */
    protected $x = 0;

    /**
     * The y coordinate
     *
     * @var float
     */
    protected $y = 0;

    /**
     * Constructor
     *
     * @param  float  $x  The x coordinate
     * @param  float  $y  The y coordinate
     */
    public function __construct($x, $y)
    {
        parent::__construct();
        $this->x = number_format($x, 6, '.', '');
        $this->y = number_format($y, 6, '.', '');
    }

    /**
     * Returns the JavaScript code for this class
     *
     * @return string
     */
    public function getCode()
    {
        parent::getCode();
        $js = sprintf('var %s = new GPoint(%s, %s);',
                      $this->getVarName(),
                      $this->x,
                      $this->y);
        return $js;
    }
}

?>