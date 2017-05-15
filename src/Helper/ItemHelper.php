<?php

/**
 * @package    contao-bootstrap
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2017 netzmacht David Molineus. All rights reserved.
 * @filesource
 *
 */


namespace ContaoBootstrap\Navbar\Helper;

/**
 * Interface ItemHelper describes an navigation item helper.
 *
 * @package ContaoBootstrap\Navbar\Helper
 */
interface ItemHelper
{
    /**
     * Get the item class as combined st ring or as array.
     *
     * @param bool $asArray If true an array is returned.
     *
     * @return mixed
     */
    public function getItemClass($asArray = false);


    /**
     * Get the tag of the item depending on active state.
     *
     * @return string
     */
    public function getTag();

    /**
     * Generates the item attributes.
     *
     * @return string
     */
    public function __toString();
}
