<?php

/**
 * Contao Bootstrap Navbar.
 *
 * @package    contao-bootstrap
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2017 netzmacht David Molineus. All rights reserved.
 * @license    LGPL 3.0
 * @filesource
 */


namespace ContaoBootstrap\Navbar\Helper;

/**
 * Navigation item helper for a nav item.
 *
 * @package ContaoBootstrap\Navbar\Helper
 */
class NavItemHelper extends AbstractItemHelper
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $item)
    {
        parent::__construct($item);

        $this->addClass('nav-link');
        $this->itemClass[] = 'nav-item';

        if ($this->item['subitems']) {
            $this->itemClass[] = 'dropdown';
            $this->addClass('dropdown-toggle');

            $this->setAttribute('data-toggle', 'dropdown');
            $this->setAttribute('aria-haspopup', 'true');
            $this->setAttribute('aria-expanded', 'false');
        }
    }
}
