<?php

declare(strict_types=1);

namespace ContaoBootstrap\Navbar\Helper;

final class DropdownItemHelper extends AbstractItemHelper
{
    /**
     * {@inheritDoc}
     */
    public function __construct(array $item)
    {
        parent::__construct($item);

        $this->addClass('dropdown-item');
        $this->addClasses($this->itemClass);
    }
}
