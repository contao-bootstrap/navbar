<?php

/**
 * Contao Bootstrap Navbar.
 *
 * @package    contao-bootstrap
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2017-2018 netzmacht David Molineus. All rights reserved.
 * @license    LGPL 3.0-or-later
 * @filesource
 */

namespace ContaoBootstrap\Navbar\Helper;

use Contao\StringUtil;
use Netzmacht\Html\Attributes;
use Netzmacht\Html\Exception\InvalidArgumentException;

/**
 * Class HeaderItemHelper creates the header navigation item.
 */
final class HeaderItemHelper extends Attributes implements ItemHelper
{
    /**
     * Current item.
     *
     * @var array
     */
    protected array $item;

    /**
     * Item classes.
     *
     * @var array
     */
    protected array $itemClass = array();

    /**
     * AbstractItemHelper constructor.
     *
     * @param array $item Navigation item.
     *
     * @throws InvalidArgumentException When invalid attributes are given.
     */
    public function __construct(array $item)
    {
        parent::__construct();

        $this->item = $item;
        $this->addClass('dropdown-header');

        $this->initializeItemClasses();
    }

    /**
     * {@inheritdoc}
     */
    public function getItemClass(bool $asArray = false)
    {
        if ($asArray) {
            return $this->itemClass;
        }

        return implode(' ', $this->itemClass);
    }

    /**
     * {@inheritdoc}
     */
    public function getTag(): string
    {
        return 'div';
    }

    /**
     * Initialize the item classes.
     *
     * @return void
     */
    private function initializeItemClasses(): void
    {
        if ($this->item['class']) {
            $classes = StringUtil::trimsplit(' ', $this->item['class']);
            foreach ($classes as $class) {
                $this->itemClass[] = $class;
            }

            if (in_array('trail', $this->itemClass)) {
                $this->itemClass[] = 'active';
            }
        }
    }
}
