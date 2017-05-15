<?php

/**
 * @package    contao-bootstrap
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2017 netzmacht David Molineus. All rights reserved.
 * @filesource
 *
 */

namespace ContaoBootstrap\Navbar\Helper;

use Netzmacht\Html\Attributes;

/**
 * Base helper for an navigation item.
 *
 * @package ContaoBootstrap\Navbar\Helper
 */
abstract class AbstractItemHelper extends Attributes implements ItemHelper
{
    /**
     * Current item.
     *
     * @var array
     */
    protected $item;

    /**
     * Item classes.
     *
     * @var array
     */
    protected $itemClass = array();

    /**
     * AbstractItemHelper constructor.
     *
     * @param array $item
     */
    public function __construct(array $item)
    {
        parent::__construct();

        $this->item = $item;

        if ($this->getTag() === 'a') {
            $this->setAttribute('href', $item['href']);
            $this->setAttribute('itemprop', 'url');

            if ($this->item['nofollow']) {
                $this->setAttribute('rel', 'nofollow');
            }
        } else {
            $this->setAttribute('itemprop', 'name');
        }

        $attributes = array('accesskey', 'tabindex', 'target');
        foreach ($attributes as $attribute) {
            if ($item[$attribute]) {
                $this->setAttribute($attribute, $item[$attribute]);
            }
        }

        $title = $this->item['pageTitle'] ?: $this->item['title'];
        $this->setAttribute('title', $title);

        if ($this->item['class']) {
            $classes = trimsplit(' ', $this->item['class']);
            foreach ($classes as $class) {
                $this->itemClass[] = $class;
            }

            if (in_array('trail', $this->itemClass)) {
                $this->itemClass[] = 'active';
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getItemClass($asArray = false)
    {
        if ($asArray) {
            return $this->itemClass;
        }

        return implode(' ', $this->itemClass);
    }

    /**
     * {@inheritdoc}
     */
    public function getTag()
    {
        return $this->item['isActive'] ? 'strong' : 'a';
    }
}
