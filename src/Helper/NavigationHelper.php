<?php

/**
 * @package    contao-bootstrap
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2017 netzmacht David Molineus. All rights reserved.
 * @filesource
 *
 */


namespace ContaoBootstrap\Navbar\Helper;

use Contao\FrontendTemplate;
use Netzmacht\Html\Attributes;

/**
 * Class NavigationHelper provides an navigation template helper for the navbar navigation.
 *
 * @package ContaoBootstrap\Navbar\Helper
 */
class NavigationHelper
{
    /**
     * Navigation item template.
     *
     * @var FrontendTemplate
     */
    private $template;

    /**
     * List attributes.
     *
     * @var Attributes
     */
    private $attributes;

    /**
     * Html tag.
     *
     * @var string
     */
    private $tag;

    /**
     * Navigation level.
     *
     * @var int
     */
    private $level;

    /**
     * NavigationHelper constructor.
     *
     * @param FrontendTemplate $template Frontend template.
     */
    public function __construct(FrontendTemplate $template)
    {
        $this->template   = $template;
        $this->attributes = new Attributes();
        $this->level      = (int) substr($this->template->level, 6);

        $attributes = $this->attributes;
        $attributes->addClass($this->template->level);

        if ($this->level === 1) {
            $attributes->addClass('navbar-nav');
            $this->tag = 'ul';
        } elseif ($this->level === 2) {
            $attributes->addClass('dropdown-menu');
            $this->tag = 'div';
        }
    }

    /**
     * Create a new instance for a template.
     *
     * @param FrontendTemplate $template Frontend template.
     *
     * @return static
     */
    public static function createForTemplate(FrontendTemplate $template)
    {
        return new static($template);

    }

    /**
     * Get all attributes.
     *
     * @return Attributes
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Get an item helper for an item.
     *
     * @param array $item Item data.
     *
     * @return ItemHelper
     */
    public function getItemHelper(array $item)
    {
        if ($this->level === 1) {
            return new NavItemHelper($item);
        } else {
            return new DropdownItemHelper($item);
        }
    }

    /**
     * Get the html tag.
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Check the level.
     *
     * @param int $level Navigation level.
     *
     * @return bool
     */
    public function isLevel($level)
    {
        return $this->level === $level;
    }
}
