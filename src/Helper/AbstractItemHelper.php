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

declare(strict_types=1);

namespace ContaoBootstrap\Navbar\Helper;

use Contao\StringUtil;
use Netzmacht\Html\Attributes;
use Netzmacht\Html\Exception\InvalidArgumentException;

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
     * @throws InvalidArgumentException If a broken html attribute is created.
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
                // Detect if attribute is prerendered, for example target is as ' target="..."'
                $key = sprintf(' %s="', $attribute);
                if (strpos($item[$attribute], $key) === 0) {
                    $this->setAttribute($attribute, substr($item[$attribute], strlen($key), -1));
                } else {
                    $this->setAttribute($attribute, $item[$attribute]);
                }
            }
        }

        $title = $this->item['pageTitle'] ?: $this->item['title'];
        $this->setAttribute('title', $title);

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
        return $this->item['isActive'] ? 'strong' : 'a';
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
