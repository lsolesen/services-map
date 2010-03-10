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
 * GIcon class. An icon specifies the images used to display a GMarker on the
 * map.
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
class Services_GoogleMaps_GIcon extends Services_GoogleMaps_Common
{
    /**
     * Array with properties of the icon
     *
     * @var array
     */
    protected $props = array();

    /**
     * An instance of an already existing icon that should be copied
     *
     * @var Object::Services_GoogleMaps_GIcon
     */
    protected $copy = false;

    /**
     * Constructor
     *
     * @param  Object::Services_GoogleMaps_GIcon  $copy  An instance of an
     *                                                   already existing icon
     *                                                   that should be copied
     */
    public function __construct($copy = null)
    {
        parent::__construct();
        $this->copy = $copy;
    }

    /**
     * Returns the JavaScript code for this class
     *
     * @return string
     */
    public function getCode()
    {
        parent::getCode();
        $js = array();

        if (is_object($this->copy) && !$this->copy->getVarName()) {
            $js[] = $this->copy->getCode();
        }
        $js[] = sprintf('var %s = new GIcon(%s);',
                        $this->getVarName(),
                        is_object($this->copy) ? $this->copy->getVarName()
                                               : false);
        foreach ($this->props as $key => $val) {
            if (is_object($val)) {
                if (!method_exists($val, 'getCode')) {
                    continue;
                }
                if (!$val->getVarName()) {
                    $js[] = $val->getCode();
                    $js[] = sprintf('%s.%s = %s;',
                                    $this->getVarName(),
                                    $key,
                                    $val->getVarName());
                }
            } else {
                $js[] = sprintf('%s.%s = "%s";',
                                $this->getVarName(),
                                $key,
                                $val);
            }
        }
        return implode("\n", $js);
    }

    /**
     * Magic setter function for the properties
     *
     * @param  string  $k  The name of the property
     * @param  mixed   $v  The value of the property
     */
    public function __set($k, $v) {
        $this->props[$k] = $v;
    }

    /**
     * Magic getter function for the properties
     *
     * @param  string  $k  The name of the property
     * @return mixed
     */
    public function __get($k) {
        if (isset($this->props['k'])) {
            return $this->props['k'];
        }
        return false;
    }

}

?>