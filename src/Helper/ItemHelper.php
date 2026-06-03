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
     * Get the item class as combined string.
     */
    public function getItemClass(): string;

    /**
     * Get the item class as string list.
     *
     * @return list<string>
     */
    public function getItemClassAsArray(): array;

    /**
     * Get the tag of the item depending on active state.
     */
    public function getTag(): string;

    /**
     * Generates the item attributes.
     */
    public function __toString(): string;
}
