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
class Services_GoogleMaps_GSize extends Services_GoogleMaps_Common
{
    /**
     * The width in pixels
     *
     * @var integer
     */
    private $width  = 0;

    /**
     * The height in pixels
     *
     * @var integer
     */
    private $height = 0;

    /**
     * Constructor
     *
     * @param  integer  $width   The width in pixels
     * @param  integer  $height  The height in pixels
     */
    public function __construct($width, $height)
    {
        parent::__construct();
        $this->width  = $width;
        $this->height = $height;
    }

    /**
     * Returns the JavaScript code for this class
     *
     * @return string
     */
    public function getCode()
    {
        parent::getCode();
        $js = sprintf('var %s = new GSize(%s, %s);',
                      $this->getVarName(),
                      $this->width,
                      $this->height);
        return $js;
    }

}

?>