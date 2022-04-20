<?php

/**
 * Contao Bootstrap Navbar.
 *
 * @filesource
 */

declare(strict_types=1);

namespace ContaoBootstrap\Navbar\Helper;

/**
 * Interface ItemHelper describes an navigation item helper.
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
    public function getItemClass(bool $asArray = false);

    /**
     * Get the tag of the item depending on active state.
     */
    public function getTag(): string;

    /**
     * Generates the item attributes.
     */
    public function __toString(): string;
}
