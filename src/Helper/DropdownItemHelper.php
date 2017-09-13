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
 * Class Dropdown ItemHelper.
 *
 * @package ContaoBootstrap\Navbar\Helper
 */
class DropdownItemHelper extends AbstractItemHelper
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $item)
    {
        parent::__construct($item);

        $this->addClass('dropdown-item');
    }
}
